<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["stock", "purchase"];
		$this->js_init = "stock/purchase.js";
	}
	
	public function index(){//ok
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$params = [
			"page" => $this->input->get("page"),
			"provider" => $this->input->get("provider"),
			"from" => $this->input->get("from"),
			"to" => $this->input->get("to"),
			"a_min" => $this->input->get("a_min"),
			"a_max" => $this->input->get("a_max"),
		];
		if (!$params["page"]) $params["page"] = 1;

		$w = $l = $w_in = [];
		if ($params["provider"]){
			$provider_ids = [-1];
			$providers = $this->gm->filter("provider", null, [["field" => "name", "values" => explode(" ", $params["provider"])]]);
			if ($providers) foreach($providers as $c) $provider_ids[] = $c->provider_id;
			
			$w_in[] = ["field" => "provider_id", "values" => $provider_ids];
		}
		
		if ($params["from"]) $w["registed_at >="] = $params["from"]." 00:00:00";
		if ($params["to"]) $w["registed_at <="] = $params["to"]." 23:59:59";
		if ($params["a_min"]) $w["amount >="] = str_replace(",", "", $params["a_min"]);
		if ($params["a_max"]) $w["amount <="] = str_replace(",", "", $params["a_max"]);
		
		$purchases = $this->gm->filter("purchase", $w, $l, $w_in, [["registed_at", "desc"]], 25, 25 * ($params["page"] - 1), false);
		foreach($purchases as $s){
			if ($s->provider_id) $s->provider = $this->gm->unique("provider", "provider_id", $s->provider_id)->name;
			else $s->provider = "";
			if ($s->valid){
				if ($s->balance) $s->color = "warning"; else $s->color = "success";
			}else $s->color = "danger";
		}
		
		$data = [
			"is_filtered" => ($w or $l or $w_in),
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("purchase", $w, $l, $w_in)),
			"purchases" => $purchases,
			"main" => "stock/purchase/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($purchase_id){
		if (!$this->session->userdata('username')) redirect("auth/login");

		$purchase = $this->gm->unique("purchase", "purchase_id", $purchase_id, false);
		if (!$purchase) redirect("no_page");
			
		if ($purchase->provider_id){
			$provider = $this->gm->unique("provider", "provider_id", $purchase->provider_id);
			$provider->doc_type = $this->gm->unique("provider_doc_type", "doc_type_id", $provider->doc_type_id, false)->doc_type;
		}else $provider = null;
		
		if ($purchase->valid){
			if ($purchase->balance) $purchase->color = "warning"; else $purchase->color = "success";
		}else $purchase->color = "danger";
		
		switch($purchase->color){
			case "success": $purchase->status = "Finalizado"; break;
			case "warning": $purchase->status = "Pendiente"; break;
			case "danger": $purchase->status = "Anulado"; break;
		}
		
		$payments = $this->gm->filter("purchase_payment", ["purchase_id" => $purchase->purchase_id], null, null, [["registed_at", "desc"]], "", "");
		foreach($payments as $p){
			$p->payment_method = $this->gm->unique("payment_method", "payment_method_id", $p->payment_method_id, false)->payment_method;
		}
		
		$products = $this->gm->filter("purchase_product", ["purchase_id" => $purchase->purchase_id], null, null, [["subtotal", "desc"]], "", "", false);
		foreach($products as $p){
			$p->prod = $this->gm->unique("product", "product_id", $p->product_id);
			$p->op = $this->gm->unique("product_option", "option_id", $p->option_id);
		}
		
		$data = [
			"purchase" => $purchase,
			"provider" => $provider,
			"payments" => $payments,
			"products" => $products,
			"payment_methods" => $this->gm->all_simple("payment_method", "payment_method_id", "asc"),
			"provider_doc_types" => $this->gm->all_simple("provider_doc_type", "doc_type_id", "asc"),
			"main" => "stock/purchase/detail",
		];
		$this->load->view('layout', $data);
	}
	
	private function update_balance($purchase_id){
		$purchase = $this->gm->unique("purchase", "purchase_id", $purchase_id);
		
		$paid = 0;
		$payments = $this->gm->filter("purchase_payment", ["purchase_id" => $purchase->purchase_id]);
		foreach($payments as $p) $paid = $paid + $p->received - $p->change;
		
		$f = ["purchase_id" => $purchase->purchase_id];
		$d = [
			"paid" => $paid,
			"balance" => $purchase->amount - $paid,
			"updated_at" => date("Y-m-d H:i:s"),
		];
		$this->gm->update("purchase", $f, $d);
	}
	
	public function add_payment(){
		$result = ["type" => "error", "msg" => null, "url" => null];
		
		if ($this->session->userdata('username')){
			$payment = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_payment($payment);
			
			if ($result["type"] === "success"){
				unset($payment["received_txt"]);
				$this->gm->insert("purchase_payment", $payment);
				$this->update_balance($payment["purchase_id"]);
				
				$result["msg"] = $this->lang->line("s_payment_insert");
				$result["url"] = base_url()."stock/purchase/detail/".$payment["purchase_id"];
			}
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_payment(){
		$type = "error"; $msg = null; $url = null;
		$payment = $this->gm->unique("purchase_payment", "payment_id", $this->input->post('payment_id'));
		
		if ($this->session->userdata('username')){
			if ($payment){
				$this->gm->update("purchase_payment", ["payment_id" => $payment->payment_id], ["valid" => false]);
				$this->update_balance($payment->purchase_id);
				
				$type = "success";
				$msg = $this->lang->line("s_payment_delete");
				$url = base_url()."stock/purchase/detail/".$payment->purchase_id;
			}else $msg = $this->lang->line("e_no_payment_record");
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "url" => $url]);
	}
	
	public function search_product(){
		$type = "error"; $msg = ""; $products = [];
		$keyword = $this->input->post("keyword");
		
		if ($keyword){
			$products_rec = $this->gm->filter_like("product", "product", $keyword, "", "", $check_valid = true);
			if ($products_rec){
				$categories = [];
				$categories_rec = $this->gm->all("product_category", [], "", "", true);
				foreach($categories_rec as $c) $categories[$c->category_id] = $c->category;
				
				$products = [];
				foreach($products_rec as $p) $products[] = ["product_id" => $p->product_id, "category" => $categories[$p->category_id], "product" => $p->product, "price" => number_format($p->price, 2), "code" => $p->code];
				
				$type = "success";
			}else $msg = $this->lang->line("e_no_result");
		}else $msg = $this->lang->line("e_enter_keyword");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "products" => $products]);
	}
	
	public function load_product(){
		$product = $this->gm->unique("product", "product_id", $this->input->post("product_id"));
		$product->category = $this->gm->unique("product_category", "category_id", $product->category_id)->category;
		
		$options = $this->gm->filter("product_option", ["product_id" => $product->product_id], null, null, [["option_id", "asc"]]);
		
		header('Content-Type: application/json');
		echo json_encode(["product" => $product, "options" => $options]);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"payment_methods" => $this->gm->all_simple("payment_method", "payment_method_id", "asc"),
			"provider_doc_types" => $this->gm->all_simple("provider_doc_type", "doc_type_id", "asc"),
			"main" => "stock/purchase/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add_purchase(){
		$result = ["type" => "error", "msg" => null];
		
		if ($this->session->userdata('username')){
			$products = $this->input->post("products");
			$payment = $this->input->post("payment");
			$provider = $this->input->post("provider");	
			
			$this->load->library('my_val');
			$result = $this->my_val->add_purchase($products, $payment, $provider);
			
			if ($result["type"] === "success"){
				$now = date("Y-m-d H:i:s");
				
				//provider process
				if ($provider["doc_type_id"] == 1) $provider_id = null; //case of no provider document
				else{
					$provider_rec = $this->gm->filter("provider", $provider);
					if ($provider_rec) $provider_id = $provider_rec[0]->provider_id;
					else{
						$provider["valid"] = true;
						$provider["updated_at"] = $provider["registed_at"] = $now;	
						$provider_id = $this->gm->insert("provider", $provider);
					}
				}
				
				//purchase process
				$purchase = [
					"provider_id" => $provider_id,
					"updated_at" => $now,
					"registed_at" => $now,
				];
				
				$amount = 0;
				foreach($products as $i => $p){
					$prod = $this->gm->unique("product", "product_id", $p["product_id"]);
					$products[$i]["price"] = $prod->price;
					$products[$i]["subtotal"] = $prod->price * $products[$i]["qty"];
					$amount += $products[$i]["subtotal"];
				}
				
				$purchase["amount"] = $amount;
				$purchase["paid"] = $payment["received"] - $payment["change"];
				$purchase["balance"] = $purchase["amount"] - $purchase["paid"];
				$purchase_id = $this->gm->insert("purchase", $purchase);
				
				//payment process
				unset($payment["received_txt"]);
				$payment["purchase_id"] = $purchase_id;
				$payment["registed_at"] = $now;
				$this->gm->insert("purchase_payment", $payment);
				
				//products process
				foreach($products as $p){
					$p["purchase_id"] = $purchase_id;
					$this->gm->insert("purchase_product", $p);
					
					$option = $this->gm->unique("product_option", "option_id", $p["option_id"]);
					$this->gm->update("product_option", ["option_id" => $p["option_id"]], ["stock" => $option->stock - $p["qty"]]);
				}
				
				$result["purchase_id"] = $purchase_id;
				$result["msg"] = $this->lang->line("s_purchase_insert");
			}
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function cancel_purchase(){
		$type = "error"; $msg = null; $url = "";
		
		if ($this->session->userdata('username')){
			$purchase_id = $this->input->post("purchase_id");
			
			if (!$this->gm->unique("invoice", "purchase_id", $purchase_id)){
				$f = ["purchase_id" => $purchase_id];
				
				// cancelar pagos y venta
				$this->gm->update("purchase_payment", $f, ["valid" => false]);
				$this->gm->update("purchase", $f, ["updated_at" => date("Y-m-d H:i:s"), "valid" => false]);
				
				$type = "success";
				$msg = $this->lang->line("s_purchase_cancel");
				$url = base_url()."stock/purchase";	
			}else $msg = $this->lang->line("e_invoice_issued");
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "url" => $url]);
	}

	public function send_to_sunat($invoice_id){
		$this->load->library('my_greenter');
		$result = $this->my_greenter->issue_invoice($invoice_id);
		
		if ($result["type"] === "success"){
			$invoice = $this->gm->unique("invoice", "invoice_id", $invoice_id);
			
			//xml y cdr update in invoice record
			$sunat_file = [
				"invoice_id " => $invoice->invoice_id,
				"purchase_id " => $invoice->purchase_id,
				"xml" => $result["xml"], 
				"cdr" => $result["cdr"],
				"registed_at" => date("Y-m-d H:i:s"),
			];
			$this->gm->insert("sunat_file", $sunat_file);
			$this->gm->update("invoice", ["invoice_id" => $invoice_id], ["is_sent_sunat" => true]);
			
			$result["url"] = base_url()."stock/purchase/view_invoice/".$invoice_id;	
		}
		
		unset($result["xml"]);
		unset($result["cdr"]);
		
		return $result;
	}

	public function issue_invoice(){
		$result = ["type" => "error", "msg" => "", "url" => null];
		
		if ($this->session->userdata('username')){
			$invoice = $this->input->post("invoice");
			$provider = $this->input->post("provider");
			
			if (!$this->gm->unique("invoice", "purchase_id", $invoice["purchase_id"])){
				$this->load->library('my_val');
				$result = $this->my_val->issue_invoice($invoice, $provider);
				
				if ($result["type"] === "success"){
					$purchase = $this->gm->unique("purchase", "purchase_id", $invoice["purchase_id"], false);
					if (!$purchase->balance){
						$now = date("Y-m-d H:i:s");
						
						//provider process
						if ($provider["doc_type_id"] == 1) $provider_id = null; //case of no provider document
						else{
							$provider_rec = $this->gm->filter("provider", $provider);
							if ($provider_rec) $provider_id = $provider_rec[0]->provider_id;
							else{
								$provider["valid"] = true;
								$provider["updated_at"] = $provider["registed_at"] = $now;	
								$provider_id = $this->gm->insert("provider", $provider);
							}
						}
						
						//invoice process
						$invoice["provider_id"] = $provider_id;
						
						$f = [
							"type_id" => $invoice["type_id"],
							"serie_id" => $invoice["serie_id"],
						];
						$last_invoice = $this->gm->filter("invoice", $f, null, null, [["correlative", "desc"]], 1, 0, false);
						if ($last_invoice) $invoice["correlative"] = $last_invoice[0]->correlative + 1;
						else $invoice["correlative"] = 1;
						
						$invoice["total"] = $purchase->amount;
						$invoice["amount"] = round($purchase->amount / 1.18, 2);
						$invoice["vat"] = $invoice["total"] - $invoice["amount"];
						$invoice["hash"] = substr(password_hash(date("Ymdhims"), PASSWORD_BCRYPT), -28, 28);
						$invoice["registed_at"] = $now;
						$invoice_id = $this->gm->insert("invoice", $invoice);
						
						//sent to sunat
						$result = $this->send_to_sunat($invoice_id);
					}else{
						$result["type"] = "error";
						$result["msg"] = $this->lang->line("e_unfinished_purchase");
					}
				}else $result["msg"] = $this->lang->line("e_check_datas");
			}else $result["msg"] = $this->lang->line("e_invoice_issued");
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function send_invoice(){
		if ($this->session->userdata('username')) $result = $this->send_to_sunat($this->input->post("invoice_id"));
		else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function view_invoice($invoice_id){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$invoice = $this->gm->unique("invoice", "invoice_id", $invoice_id);
		if (!$invoice){
			echo "No hay comprobante generado en la base de datos.";
			return;
		}
		
		$this->load->library('my_greenter');
		$invoice = $this->my_greenter->set_invoice_greenter($invoice_id);
		
		$invoice_rec = $this->gm->unique("invoice", "invoice_id", $invoice_id);
		$payments = $this->gm->filter("purchase_payment", ["purchase_id" => $invoice_rec->purchase_id]);
		
		$received = $change = 0;
		foreach($payments as $p){
			$received += $p->received;
			$change += $p->change;
		}
		
		if (count($payments) > 1) $method = $this->gm->unique("payment_method", "payment_method", "Efectivo", false);
		else $method = $this->gm->unique("payment_method", "payment_method_id", $payments[0]->payment_method_id, false);
		
		$qr_data = [
			$invoice->getCompany()->getRuc(), $invoice->getTipoDoc(), $invoice->getSerie(), $invoice->getCorrelativo(), 
			$invoice->getTotalImpuestos(), $invoice->getMtoImpVenta(), $invoice->getFechaEmision()->format('Y-m-d'), 
			$invoice->getprovider()->getTipoDoc(), $invoice->getprovider()->getNumDoc(), $invoice_rec->hash
		];
			
		$this->load->library('ciqrcode');
		$qr_params = array(
			"data" => implode("|", $qr_data), "level" => 'H', 
			"size" => 10, "savename" => FCPATH.'/uploads/qr.png'
		);
		
		$data = [
			"method" => $method->payment_method,
			"received" => $received,
			"change" => $change,
			"qr" => base64_encode(file_get_contents($this->ciqrcode->generate($qr_params))),
			"hash" => $invoice_rec->hash,
		];
		
		$html = $this->load->view('stock/purchase/invoice', ["invoice" => $invoice, "data" => $data], true);
		$this->my_func->make_pdf_ticket($html, $invoice->getSerie()." - ".str_pad($invoice->getCorrelativo(), 6, '0', STR_PAD_LEFT));
	}
	
	public function void_invoice(){
		$result = ["type" => "error", "msg" => ""];
		
		if ($this->session->userdata('username')){
			$invoice_id = $this->input->post("invoice_id");
			$invoice = $this->gm->unique("invoice", "invoice_id", $invoice_id);
			
			$this->load->library('my_greenter');
			$result = $this->my_greenter->void_invoice($invoice);
			
			if ($result["type"] === "success"){
				$now = date("Y-m-d H:i:s");
				
				//xml y cdr update in invoice record
				$sunat_file = [
					"invoice_id " => $invoice_id,
					"purchase_id " => $invoice->purchase_id,
					"xml" => $result["xml"], 
					"cdr" => $result["cdr"],
					"registed_at" => $now,
				];
				$this->gm->insert("sunat_file", $sunat_file);
				
				$sunat_resume = [
					"date" => date("Y-m-d"),
					"ticket" => $result["ticket"],
					"correlative" => $result["correlative"],
					"registed_at" => $now,
				];
				$this->gm->insert("sunat_resume", $sunat_resume);
				
				$this->gm->update("invoice", ["invoice_id" => $invoice_id], ["valid" => false]);
			}
			
			unset($result["xml"]);
			unset($result["cdr"]);
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function convert_pem(){//convert *.pfx cert to *.pem for facturacion electronica
		$this->load->library('my_greenter');
		$this->my_greenter->convert_to_pem();
	}
}
