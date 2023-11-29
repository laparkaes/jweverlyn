<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["commerce", "sale"];
		$this->js_init = "commerce/sale.js";
	}
	
	public function index(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "error") redirect($result["url"]);
		
		$params = [
			"page" => $this->input->get("page"),
			"client" => $this->input->get("client"),
			"from" => $this->input->get("from"),
			"to" => $this->input->get("to"),
			"a_min" => $this->input->get("a_min"),
			"a_max" => $this->input->get("a_max"),
			"b_min" => $this->input->get("b_min"),
			"b_max" => $this->input->get("b_max"),
		];
		if (!$params["page"]) $params["page"] = 1;

		$w = $l = $w_in = [];
		if ($params["client"]){
			$client_ids = [-1];
			$clients = $this->gm->filter("client", null, [["field" => "name", "values" => explode(" ", $params["client"])]]);
			if ($clients) foreach($clients as $c) $client_ids[] = $c->client_id;
			
			$w_in[] = ["field" => "client_id", "values" => $client_ids];
		}
		
		if ($params["from"]) $w["registed_at >="] = $params["from"]." 00:00:00";
		if ($params["to"]) $w["registed_at <="] = $params["to"]." 23:59:59";
		if ($params["a_min"]) $w["amount >="] = str_replace(",", "", $params["a_min"]);
		if ($params["a_max"]) $w["amount <="] = str_replace(",", "", $params["a_max"]);
		if ($params["b_min"]) $w["balance >="] = str_replace(",", "", $params["b_min"]);
		if ($params["b_max"]) $w["balance <="] = str_replace(",", "", $params["b_max"]);
		
		$sales = $this->gm->filter("sale", $w, $l, $w_in, [["registed_at", "desc"]], 25, 25 * ($params["page"] - 1), false);
		foreach($sales as $s){
			if ($s->client_id) $s->client = $this->gm->unique("client", "client_id", $s->client_id)->name;
			else $s->client = "";
			if ($s->valid){
				if ($s->balance) $s->color = "warning"; else $s->color = "success";
			}else $s->color = "danger";
		}
		
		$data = [
			"is_filtered" => ($w or $l or $w_in),
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("sale", $w, $l, $w_in)),
			"sales" => $sales,
			"main" => "commerce/sale/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($sale_id){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "error") redirect($result["url"]);

		$sale = $this->gm->unique("sale", "sale_id", $sale_id, false);
		if (!$sale) redirect("no_page");
			
		if ($sale->client_id){
			$client = $this->gm->unique("client", "client_id", $sale->client_id);
			$client->doc_type = $this->gm->unique("client_doc_type", "doc_type_id", $client->doc_type_id, false)->doc_type;
		}else $client = null;
		
		if ($sale->valid){
			if ($sale->balance) $sale->color = "warning"; else $sale->color = "success";
		}else $sale->color = "danger";
		
		switch($sale->color){
			case "success": $sale->status = "Finalizado"; break;
			case "warning": $sale->status = "Pendiente"; break;
			case "danger": $sale->status = "Anulado"; break;
		}
		
		$w = ["sale_id" => $sale->sale_id, "valid" => true];
		
		$payments = $this->gm->filter("sale_payment", $w, null, null, [["registed_at", "desc"]], "", "");
		foreach($payments as $p){
			$p->payment_method = $this->gm->unique("payment_method", "payment_method_id", $p->payment_method_id, false)->payment_method;
		}
		
		$products = $this->gm->filter("sale_product", ["sale_id" => $sale->sale_id], null, null, [["subtotal", "desc"]], "", "", false);
		foreach($products as $p){
			$p->prod = $this->gm->unique("product", "product_id", $p->product_id);
			if ($p->option_id) $p->op = $this->gm->unique("product_option", "option_id", $p->option_id);
		}
		
		$invoice = $this->gm->unique("invoice", "sale_id", $sale->sale_id);
		if ($invoice) $invoice->type = $this->gm->unique("invoice_type", "type_id", $invoice->type_id, false)->type;
		
		$sunat_files = $this->gm->filter("sunat_file", ["sale_id" => $sale->sale_id], null, null, [["registed_at", "desc"]], "", "", false);
		
		$data = [
			"sale" => $sale,
			"client" => $client,
			"payments" => $payments,
			"products" => $products,
			"invoice" => $invoice,
			"sunat_files" => $sunat_files,
			"notes" => $this->gm->filter("sale_note", $w, null, null, [["registed_at", "desc"]]),
			"files" => $this->gm->filter("sale_file", $w, null, null, [["registed_at", "desc"]]),
			"payment_methods" => $this->gm->all_simple("payment_method", "payment_method_id", "asc"),
			"invoice_types" => $this->gm->all_simple("invoice_type", "type", "asc"),
			"client_doc_types" => $this->gm->all_simple("client_doc_type", "doc_type_id", "asc"),
			"invoice_series" => $this->gm->all_simple("invoice_serie", "serie", "asc"),
			"main" => "commerce/sale/detail",
		];
		$this->load->view('layout', $data);
	}
	
	private function update_balance($sale_id){//ok
		$sale = $this->gm->unique("sale", "sale_id", $sale_id);
		
		$paid = 0;
		$payments = $this->gm->filter("sale_payment", ["sale_id" => $sale->sale_id]);
		foreach($payments as $p) $paid = $paid + $p->received - $p->change;
		
		$f = ["sale_id" => $sale->sale_id];
		$d = [
			"paid" => $paid,
			"balance" => round($sale->amount - $paid, 2),
			"updated_at" => date("Y-m-d H:i:s"),
		];
		$this->gm->update("sale", $f, $d);
	}
	
	public function add_file(){//ok
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$data = $this->input->post();
			$data["filename"] = $_FILES["upload"]["name"];
			
			$this->load->library('my_val');
			$result = $this->my_val->file_upload_purchase($data);
			
			if ($result["type"] === "success"){
				$path = './uploads/sale/'.$data["sale_id"]."/";
				if (!is_dir($path)) mkdir($path, 0777, true);
				
				$config['upload_path'] = $path;
				$config['allowed_types'] = '*';
				$config['file_name'] = date("YmdHis");
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('upload')){
					$upload_data = $this->upload->data();
					
					$data["filename"] = $upload_data['file_name'];
					$data["registed_at"] = date("Y-m-d H:i:s");
					$this->gm->insert("sale_file", $data);
					
					$result["msg"] = $this->lang->line("s_file_upload");
					$result["url"] = base_url()."commerce/sale/detail/".$data["sale_id"];
				}else $result = ["type" => "error", "msg" => $this->upload->display_errors()];
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_file(){//ok
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$file = $this->gm->unique("sale_file", "file_id", $this->input->post('file_id'));
			$this->gm->update("sale_file", ["file_id" => $file->file_id], ["valid" => false]);
			
			$result["msg"] = $this->lang->line("s_file_delete");
			$result["url"] = base_url()."commerce/sale/detail/".$file->sale_id;
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	/////////////////////////////////continue with access validation
	public function add_payment(){//ok
		$result = ["type" => "error", "msg" => null, "url" => null];
		
		if ($this->session->userdata('username')){
			$payment = $this->input->post();
			
			$payment["received"] = round(str_replace(",", "", $payment["received"]), 2);
			$payment["total"] = round(str_replace(",", "", $payment["total"]), 2);
			$payment["change"] = round(str_replace(",", "", $payment["change"]), 2);
			
			$this->load->library('my_val');
			$result = $this->my_val->add_payment($payment);
			
			if ($result["type"] === "success"){
				unset($payment["received_txt"]);
				$this->gm->insert("sale_payment", $payment);
				$this->update_balance($payment["sale_id"]);
				
				$result["msg"] = $this->lang->line("s_payment_insert");
				$result["url"] = base_url()."commerce/sale/detail/".$payment["sale_id"];
			}
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_payment(){//ok
		$type = "error"; $msg = null; $url = null;
		$payment = $this->gm->unique("sale_payment", "payment_id", $this->input->post('payment_id'));
		
		if ($this->session->userdata('username')){
			if ($payment){
				$this->gm->update("sale_payment", ["payment_id" => $payment->payment_id], ["valid" => false]);
				$this->update_balance($payment->sale_id);
				
				$type = "success";
				$msg = $this->lang->line("s_payment_delete");
				$url = base_url()."commerce/sale/detail/".$payment->sale_id;
			}else $msg = $this->lang->line("e_no_payment_record");
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "url" => $url]);
	}
	
	public function search_product(){//ok
		$type = "error"; $msg = ""; $products = [];
		$keyword = $this->input->post("keyword");
		
		if ($keyword){
			$products_rec = $this->gm->filter("product", [], [["field" => "product", "values" => explode(" ", $keyword)]], null, [["product", "asc"]]);
			
			if ($products_rec){
				$categories = [];
				$categories_rec = $this->gm->all("product_category", [], "", "", true);
				foreach($categories_rec as $c) $categories[$c->category_id] = $c->category;
				
				$type_prod = $this->gm->unique("product_type", "type", "Producto", false);
				
				$products = [];
				foreach($products_rec as $p){
					if ($p->type_id == $type_prod->type_id){
						$stock = $this->gm->sum("product_option", "stock", ["product_id" => $p->product_id, "valid" => true])->stock;
						if ($stock) $stock = number_format($stock)." disponibles";
						else $stock = "<span class='text-danger'>No disponible</span>";	
					}else $stock = "-";
					
					
					$products[] = ["product_id" => $p->product_id, "category" => $categories[$p->category_id], "product" => $p->product, "price" => number_format($p->price, 2), "code" => $p->code, "stock" => $stock];
				}
				
				$type = "success";
			}else $msg = $this->lang->line("e_no_result");
		}else $msg = $this->lang->line("e_enter_keyword");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "products" => $products]);
	}
	
	public function load_product(){//ok
		$res = ["type" => "error", "msg" => null];
		
		$product = $this->gm->unique("product", "product_id", $this->input->post("product_id"));
		if ($product){
			unset($product->category_id);
			unset($product->image);
			unset($product->valid);
			unset($product->updated_at);
			unset($product->registed_at);
			
			$type_prod = $this->gm->unique("product_type", "type", "Producto", false);
			if ($product->type_id == $type_prod->type_id){//Product
				$options = $this->gm->filter("product_option", ["product_id" => $product->product_id], null, null, [["option_id", "asc"]]);
				foreach($options as $i_o => $op) if (!$op->stock) unset($options[$i_o]);
				
				if ($options){
					$res["type"] = "success";
					$res["product"] = $product;
					$res["options"] = $options;
				}else $res["msg"] = $this->lang->line("e_product_no_stock");
			}else{//Service
				$res["type"] = "success";
				$res["product"] = $product;
				$res["options"] = [];
			}
		}else $res["msg"] = $this->lang->line("e_no_product_registed");
		
		header('Content-Type: application/json');
		echo json_encode($res);
	}
	
	public function check_stock(){//ok
		$res = ["type" => "success", "msg" => null];
		
		$prod = $this->input->post("prod");
		$product = $this->gm->unique("product", "product_id", $prod["product_id"]);
		$type = $this->gm->unique("product_type", "type_id", $product->type_id, false);
		
		if ($type->type === "Producto"){
			if ($prod["option_id"]){
				$option = $this->gm->unique("product_option", "option_id", $prod["option_id"]);
				
				if ($prod["qty"] > $option->stock){
					$res["type"] = "error";
					$res["msg"] = $this->lang->line("e_product_no_stock")." (Max: ".number_format($option->stock).")";
				}	
			}else{
				$res["type"] = "error";
				$res["msg"] = $this->lang->line("e_option_select");
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode($res);
	}
	
	public function register(){//ok
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"payment_methods" => $this->gm->all_simple("payment_method", "payment_method_id", "asc"),
			"client_doc_types" => $this->gm->all_simple("client_doc_type", "doc_type_id", "asc"),
			"main" => "commerce/sale/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add_sale(){//ok
		$result = ["type" => "error", "msg" => null];
		
		if ($this->session->userdata('username')){
			$products_json = $this->input->post("products");
			$payment = $this->input->post("payment");
			$client = $this->input->post("client");	 
			
			/* data processing */
			$products = [];
			if ($products_json) foreach($products_json as $p) $products[] = json_decode($p, true);
			
			$payment["received"] = round(str_replace(",", "", $payment["received"]), 2);
			$payment["total"] = round(str_replace(",", "", $payment["total"]), 2);
			$payment["change"] = round(str_replace(",", "", $payment["change"]), 2);
			
			$this->load->library('my_val');
			$result = $this->my_val->add_sale($products, $payment, $client);
			
			if ($result["type"] === "success"){
				$now = date("Y-m-d H:i:s");
				
				//client process
				if ($client["doc_type_id"] == 1) $client_id = null; //case of no client document
				else{
					$client_rec = $this->gm->filter("client", $client);
					if ($client_rec) $client_id = $client_rec[0]->client_id;
					else{
						$client["valid"] = true;
						$client["updated_at"] = $client["registed_at"] = $now;	
						$client_id = $this->gm->insert("client", $client);
					}
				}
				
				//sale process
				$sale = [
					"client_id" => $client_id,
					"updated_at" => $now,
					"registed_at" => $now,
				];
				
				$amount = 0;
				foreach($products as $i => $p){
					$prod = $this->gm->unique("product", "product_id", $p["product_id"]);
					$products[$i]["price"] = $prod->price;
					$products[$i]["subtotal"] = round($prod->price * $products[$i]["qty"], 2);
					$amount += $products[$i]["subtotal"];
				}
				
				$sale["amount"] = $amount;
				$sale["paid"] = $payment["received"] - $payment["change"];
				$sale["balance"] = $sale["amount"] - $sale["paid"];
				$sale_id = $this->gm->insert("sale", $sale);
				
				//payment process
				unset($payment["received_txt"]);
				$payment["sale_id"] = $sale_id;
				$payment["registed_at"] = $now;
				$this->gm->insert("sale_payment", $payment);
				
				//products process
				foreach($products as $p){
					$p["sale_id"] = $sale_id;
					if ($p["option_id"]){
						$option = $this->gm->unique("product_option", "option_id", $p["option_id"]);
						$this->gm->update("product_option", ["option_id" => $p["option_id"]], ["stock" => $option->stock - $p["qty"]]);	
					}else unset($p["option_id"]);
					
					$this->gm->insert("sale_product", $p);
				}
				
				$result["sale_id"] = $sale_id;
				$result["msg"] = $this->lang->line("s_sale_insert");
			}
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function cancel_sale(){//ok
		$type = "error"; $msg = null; $url = "";
		
		if ($this->session->userdata('username')){
			$sale_id = $this->input->post("sale_id");
			
			if (!$this->gm->unique("invoice", "sale_id", $sale_id)){
				$f = ["sale_id" => $sale_id];
				
				// cancelar pagos y venta
				$this->gm->update("sale_payment", $f, ["valid" => false]);
				$this->gm->update("sale", $f, ["updated_at" => date("Y-m-d H:i:s"), "valid" => false]);
				
				$type = "success";
				$msg = $this->lang->line("s_sale_cancel");
				$url = base_url()."commerce/sale";	
			}else $msg = $this->lang->line("e_invoice_issued");
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "url" => $url]);
	}

	public function add_note(){//ok
		$result = ["type" => "error", "msg" => null, "url" => null];
		
		if ($this->session->userdata('username')){
			$note = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_note($note);
			
			if ($result["type"] === "success"){
				$note["note"] = trim($note["note"]);
				$note["registed_at"] = date("Y-m-d H:i:s");
				$this->gm->insert("sale_note", $note);
				
				$result["msg"] = $this->lang->line("s_note_insert");
				$result["url"] = base_url()."commerce/sale/detail/".$note["sale_id"];
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_note(){//ok
		$type = "error"; $msg = null; $url = null;
		
		if ($this->session->userdata('username')){
			$note = $this->gm->unique("sale_note", "note_id", $this->input->post('note_id'));
			
			$this->gm->update("sale_note", ["note_id" => $note->note_id], ["valid" => false]);
			
			$type = "success";
			$msg = $this->lang->line("s_note_delete");
			$url = base_url()."commerce/sale/detail/".$note->sale_id;
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
				"sale_id " => $invoice->sale_id,
				"xml" => $result["xml"], 
				"cdr" => $result["cdr"],
				"registed_at" => date("Y-m-d H:i:s"),
			];
			$this->gm->insert("sunat_file", $sunat_file);
			$this->gm->update("invoice", ["invoice_id" => $invoice_id], ["is_sent_sunat" => true]);
			
			$result["url"] = base_url()."commerce/sale/view_invoice/".$invoice_id;	
		}
		
		unset($result["xml"]);
		unset($result["cdr"]);
		
		return $result;
	}

	public function issue_invoice(){//ok
		$result = ["type" => "error", "msg" => "", "url" => null];
		
		if ($this->session->userdata('username')){
			$invoice = $this->input->post("invoice");
			$client = $this->input->post("client");
			
			if (!$this->gm->unique("invoice", "sale_id", $invoice["sale_id"])){
				$this->load->library('my_val');
				$result = $this->my_val->issue_invoice($invoice, $client);
				
				if ($result["type"] === "success"){
					$sale = $this->gm->unique("sale", "sale_id", $invoice["sale_id"], false);
					if (!$sale->balance){
						$now = date("Y-m-d H:i:s");
						
						//client process
						if ($client["doc_type_id"] == 1) $client_id = null; //case of no client document
						else{
							$client_rec = $this->gm->filter("client", $client);
							if ($client_rec) $client_id = $client_rec[0]->client_id;
							else{
								$client["valid"] = true;
								$client["updated_at"] = $client["registed_at"] = $now;	
								$client_id = $this->gm->insert("client", $client);
							}
						}
						
						//invoice process
						$invoice["client_id"] = $client_id;
						
						$f = [
							"type_id" => $invoice["type_id"],
							"serie_id" => $invoice["serie_id"],
						];
						$last_invoice = $this->gm->filter("invoice", $f, null, null, [["correlative", "desc"]], 1, 0, false);
						if ($last_invoice) $invoice["correlative"] = $last_invoice[0]->correlative + 1;
						else $invoice["correlative"] = 1;
						
						$invoice["total"] = $sale->amount;
						$invoice["amount"] = round($sale->amount / 1.18, 2);
						$invoice["vat"] = $invoice["total"] - $invoice["amount"];
						$invoice["hash"] = substr(password_hash(date("Ymdhims"), PASSWORD_BCRYPT), -28, 28);
						$invoice["registed_at"] = $now;
						$invoice_id = $this->gm->insert("invoice", $invoice);
						
						//sent to sunat
						$result = $this->send_to_sunat($invoice_id);
					}else{
						$result["type"] = "error";
						$result["msg"] = $this->lang->line("e_unfinished_sale");
					}
				}else $result["msg"] = $this->lang->line("e_check_datas");
			}else $result["msg"] = $this->lang->line("e_invoice_issued");
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function send_invoice(){//ok
		if ($this->session->userdata('username')) $result = $this->send_to_sunat($this->input->post("invoice_id"));
		else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function view_invoice($invoice_id){//ok
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$invoice = $this->gm->unique("invoice", "invoice_id", $invoice_id);
		if (!$invoice){
			echo "No hay comprobante generado en la base de datos.";
			return;
		}
		
		$this->load->library('my_greenter');
		$invoice = $this->my_greenter->set_invoice_greenter($invoice_id);
		
		$invoice_rec = $this->gm->unique("invoice", "invoice_id", $invoice_id);
		$payments = $this->gm->filter("sale_payment", ["sale_id" => $invoice_rec->sale_id]);
		
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
			$invoice->getClient()->getTipoDoc(), $invoice->getClient()->getNumDoc(), $invoice_rec->hash
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
		
		$html = $this->load->view('commerce/sale/invoice', ["invoice" => $invoice, "data" => $data], true);
		$this->my_func->make_pdf_ticket($html, $invoice->getSerie()." - ".str_pad($invoice->getCorrelativo(), 6, '0', STR_PAD_LEFT));
	}
	
	public function void_invoice(){//ok
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
					"sale_id " => $invoice->sale_id,
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
	
	/*public function convert_pem(){//convert *.pfx cert to *.pem for facturacion electronica
		$this->load->library('my_greenter');
		$this->my_greenter->convert_to_pem();
	}*/

	/*public function methods(){
		$cl = $this->router->fetch_class();
		$aux = get_class_methods($this);
		
		$no_class = ["__construct", "methods", "get_instance"];
		foreach($aux as $a) if (!in_array($a, $no_class)) echo $cl."_".$a."<br/>";
	}*/
}
