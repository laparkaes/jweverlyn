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
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$params = [
			"page" => $this->input->get("page"),
			"from" => $this->input->get("from"),
			"to" => $this->input->get("to"),
			"client" => $this->input->get("client"),
		];
		if (!$params["page"]) $params["page"] = 1;
		$w = $l = $w_in = [];
	
		if (!$params["to"]) $params["to"] = Date("Y-m-d");
		$w["registed_at <"] = Date("Y-m-d", strtotime("+1 day", strtotime($params["to"])));
		
		if (!$params["from"]) $params["from"] = Date("Y-m-d", strtotime("-1 months", strtotime($params["to"])));
		$w["registed_at >="] = $params["from"];

		if ($params["client"]){
			$client_ids = [-1];
			$clients = $this->gm->filter("client", null, ["name" => $params["client"]]);
			if ($clients) foreach($clients as $c) $client_ids[] = $c->client_id;
			
			$w_in[] = ["field" => "client_id", "values" => $client_ids];
		}
		
		$sales = $this->gm->filter("sale", $w, $l, $w_in, [["registed_at", "desc"]], 25, 25 * ($params["page"] - 1), false);
		foreach($sales as $s){
			if ($s->client_id) $s->client = $this->gm->unique("client", "client_id", $s->client_id)->name;
			else $s->client = "";
			if ($s->valid){
				if ($s->balance) $s->color = "warning"; else $s->color = "success";
			}else $s->color = "danger";
		}
		
		$data = [
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("sale", $w, $l, $w_in)),
			"sales" => $sales,
			"main" => "commerce/sale/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($sale_id){
		if (!$this->session->userdata('username')) redirect("auth/login");

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
		
		$payments = $this->gm->filter("sale_payment", ["sale_id" => $sale->sale_id], null, null, [["registed_at", "desc"]], "", "");
		foreach($payments as $p){
			$p->payment_method = $this->gm->unique("payment_method", "payment_method_id", $p->payment_method_id, false)->payment_method;
		}
		
		$products = $this->gm->filter("sale_product", ["sale_id" => $sale->sale_id], null, null, [["subtotal", "desc"]], "", "", false);
		foreach($products as $p){
			$p->prod = $this->gm->unique("product", "product_id", $p->product_id);
			$p->op = $this->gm->unique("product_option", "option_id", $p->option_id);
		}
		
		$invoice = $this->gm->unique("invoice", "sale_id", $sale->sale_id);
		if ($invoice){
			$invoice->type = $this->gm->unique("invoice_type", "type_id", $invoice->type_id, false)->type;
			$invoice->files = $this->gm->filter("sunat_file", ["invoice_id" => $invoice->invoice_id], null, null, [["registed_at", "desc"]], "", "", false);
		}
		
		$data = [
			"sale" => $sale,
			"client" => $client,
			"payments" => $payments,
			"products" => $products,
			"invoice" => $invoice,
			"payment_methods" => $this->gm->all_simple("payment_method", "payment_method_id", "asc"),
			"invoice_types" => $this->gm->all_simple("invoice_type", "type", "asc"),
			"client_doc_types" => $this->gm->all_simple("client_doc_type", "doc_type_id", "asc"),
			"invoice_series" => $this->gm->all_simple("invoice_serie", "serie", "asc"),
			"main" => "commerce/sale/detail",
		];
		$this->load->view('layout', $data);
	}
	
	private function update_balance($sale_id){
		$sale = $this->gm->unique("sale", "sale_id", $sale_id);
		
		$paid = 0;
		$payments = $this->gm->filter("sale_payment", ["sale_id" => $sale->sale_id]);
		foreach($payments as $p) $paid = $paid + $p->received - $p->change;
		
		$f = ["sale_id" => $sale->sale_id];
		$d = [
			"paid" => $paid,
			"balance" => $sale->amount - $paid,
			"updated_at" => date("Y-m-d H:i:s"),
		];
		$this->gm->update("sale", $f, $d);
	}
	
	public function add_payment(){
		$result = ["type" => "error", "msg" => null, "url" => null];
		
		if ($this->session->userdata('username')){
			$payment = $this->input->post();
			
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
	
	public function delete_payment(){
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
	
	public function search_person(){
		$type = "error"; $msg = ""; $person = null;
		$data = $this->input->post();
		
		if ($data["doc_number"]){
			$person = $this->gm->filter("client", $data);
			if ($person) $person = $person[0];
			else{
				$name = "";
				switch($data["doc_type_id"]){
					case 2: //dni
						$aux = $this->my_func->utildatos("dni", $data["doc_number"]);
						if ($aux->status) $name = $aux->data->nombres." ".$aux->data->apellidoPaterno." ".$aux->data->apellidoMaterno;
						break;
					case 4: //ruc
						$aux = $this->my_func->utildatos("ruc", $data["doc_number"]);
						if ($aux->status) $name = $aux->data->razon_social;
						break;
				}
				
				$person = $this->gm->structure("client");
				$person->name = $name;
			}
			
			if ($person->name){
				$person->doc_type_id = $data["doc_type_id"];
				$person->doc_number = $data["doc_number"];
				
				$type = "success";
			}else $msg = $this->lang->line("e_no_result");
		}else $msg = $this->lang->line("e_doc_number_enter");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "person" => $person]);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"payment_methods" => $this->gm->all_simple("payment_method", "payment_method_id", "asc"),
			"client_doc_types" => $this->gm->all_simple("client_doc_type", "doc_type_id", "asc"),
			"main" => "commerce/sale/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add_sale(){
		$result = ["type" => "error", "msg" => null];
		
		if ($this->session->userdata('username')){
			$products = $this->input->post("products");
			$payment = $this->input->post("payment");
			$client = $this->input->post("client");	
			
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
					$products[$i]["subtotal"] = $prod->price * $products[$i]["qty"];
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
					$this->gm->insert("sale_product", $p);
					
					$option = $this->gm->unique("product_option", "option_id", $p["option_id"]);
					$this->gm->update("product_option", ["option_id" => $p["option_id"]], ["stock" => $option->stock - $p["qty"]]);
				}
				
				$result["sale_id"] = $sale_id;
				$result["msg"] = $this->lang->line("s_sale_insert");
			}
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function cancel_sale(){
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

	public function issue_invoice(){
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
						
						$last_invoice = $this->gm->filter("invoice", ["serie_id" => $invoice["serie_id"]], null, null, [["correlative", "desc"]], 1, 0, false);
						if ($last_invoice) $invoice["correlative"] = $last_invoice[0]->correlative + 1;
						else $invoice["correlative"] = 1;
						
						$invoice["total"] = $sale->amount;
						$invoice["amount"] = round($sale->amount / 1.18, 2);
						$invoice["vat"] = $invoice["total"] - $invoice["amount"];
						$invoice["registed_at"] = $now;
						$invoice_id = $this->gm->insert("invoice", $invoice);
						
						//sent to sunat
						$this->load->library('my_greenter');
						$result = $this->my_greenter->issue_invoice($invoice_id);
						
						if ($result["type"] === "success"){
							//xml y cdr update in invoice record
							$sunat_file = [
								"invoice_id " => $invoice_id,
								"xml" => $result["xml"], 
								"cdr" => $result["cdr"],
								"registed_at" => date("Y-m-d H:i:s"),
							];
							$this->gm->insert("sunat_file", $sunat_file);
							
							$result["url"] = base_url()."commerce/sale/view_invoice/".$invoice_id;	
						}
						
						unset($result["xml"]);
						unset($result["cdr"]);
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
	
	public function send_invoice(){
		$result = ["type" => "error", "msg" => "", "url" => null];
		
		if ($this->session->userdata('username')){
			$invoice_id = $this->input->post("invoice_id");
			
			$this->load->library('my_greenter');
			$result = $this->my_greenter->issue_invoice($invoice_id);
			
			if ($result["type"] === "success"){
				//xml y cdr update in invoice record
				$sunat_file = [
					"invoice_id " => $invoice_id,
					"xml" => $result["xml"], 
					"cdr" => $result["cdr"],
					"registed_at" => date("Y-m-d H:i:s"),
				];
				$this->gm->insert("sunat_file", $sunat_file);
				
				$result["url"] = base_url()."commerce/sale/view_invoice/".$invoice_id;	
			}
			
			unset($result["xml"]);
			unset($result["cdr"]);
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function view_invoice($invoice_id){
		$invoice = $this->gm->unique("invoice", "invoice_id", $invoice_id);
		
		print_r($invoice);
	}
	
	public function void_invoice(){
		$result = ["type" => "error", "msg" => ""];
		
		if ($this->session->userdata('username')){
			$invoice_id = $this->input->post("invoice_id");
			$invoice = $this->gm->unique("invoice", "invoice_id", $invoice_id);
			
			$this->load->library('my_greenter');
			$result = $this->my_greenter->void_invoice($invoice);
			
			if ($result["type"] === "success"){
				//xml y cdr update in invoice record
				$sunat_file = [
					"invoice_id " => $invoice_id,
					"xml" => $result["xml"], 
					"cdr" => $result["cdr"],
					"registed_at" => date("Y-m-d H:i:s"),
				];
				$this->gm->insert("sunat_file", $sunat_file);
				
				$result["url"] = base_url()."commerce/sale/view_invoice/".$invoice_id;	
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
