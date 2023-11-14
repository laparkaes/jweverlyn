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
	
	private function update_balance($purchase_id){//ok
		$purchase = $this->gm->unique("purchase", "purchase_id", $purchase_id);
		
		$paid = 0;
		$payments = $this->gm->filter("purchase_payment", ["purchase_id" => $purchase->purchase_id]);
		foreach($payments as $p) $paid = $paid + $p->paid;
		
		$f = ["purchase_id" => $purchase->purchase_id];
		$d = [
			"paid" => $paid,
			"balance" => $purchase->amount - $paid,
			"updated_at" => date("Y-m-d H:i:s"),
		];
		$this->gm->update("purchase", $f, $d);
	}
	
	public function add_payment(){//ok
		$result = ["type" => "error", "msg" => null, "url" => null];
		
		if ($this->session->userdata('username')){
			$payment = $this->input->post();
			$payment["paid"] = str_replace(",", "", $payment["paid"]);
			$payment["total"] = str_replace(",", "", $payment["total"]);
			$payment["balance"] = str_replace(",", "", $payment["balance"]);
			
			$this->load->library('my_val');
			$result = $this->my_val->add_payment_purchase($payment);
			
			if ($result["type"] === "success"){
				$this->gm->insert("purchase_payment", $payment);
				$this->update_balance($payment["purchase_id"]);
				
				$result["msg"] = $this->lang->line("s_payment_insert");
				$result["url"] = base_url()."stock/purchase/detail/".$payment["purchase_id"];
			}
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_payment(){//ok
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
	
	public function search_product(){//ok
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
	
	public function load_product(){//ok
		$res = ["type" => "error", "msg" => null];
		
		$product = $this->gm->unique("product", "product_id", $this->input->post("product_id"));
		if ($product){
			$options = $this->gm->filter("product_option", ["product_id" => $product->product_id], null, null, [["option_id", "asc"]]);
			
			unset($product->category_id);
			unset($product->image);
			unset($product->valid);
			unset($product->updated_at);
			unset($product->registed_at);
			
			$res["type"] = "success";
			$res["product"] = $product;
			$res["options"] = $options;
		}else $res["msg"] = $this->lang->line("e_no_product_registed");
		
		header('Content-Type: application/json');
		echo json_encode($res);
	}
	
	public function register(){//ok
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"payment_methods" => $this->gm->all_simple("payment_method", "payment_method_id", "asc"),
			"provider_doc_types" => $this->gm->all_simple("provider_doc_type", "doc_type_id", "asc"),
			"main" => "stock/purchase/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add_purchase(){//ok
		$result = ["type" => "error", "msg" => null];
		
		if ($this->session->userdata('username')){
			$products_json = $this->input->post("products");
			$payment = $this->input->post("payment");
			$provider = $this->input->post("provider");
			
			/* data processing */
			$products = [];
			if ($products_json) foreach($products_json as $p) $products[] = json_decode($p, true);
			
			$payment["paid"] = str_replace(",", "", $payment["paid"]);
			$payment["total"] = str_replace(",", "", $payment["total"]);
			$payment["balance"] = str_replace(",", "", $payment["balance"]);
			
			$this->load->library('my_val');
			$result = $this->my_val->add_purchase($products, $payment, $provider);
			
			if ($result["type"] === "success"){
				$now = date("Y-m-d H:i:s");
				
				//provider process
				$provider_rec = $this->gm->filter("provider", $provider);
				if ($provider_rec) $provider_id = $provider_rec[0]->provider_id;
				else{
					$provider["valid"] = true;
					$provider["updated_at"] = $provider["registed_at"] = $now;	
					$provider_id = $this->gm->insert("provider", $provider);
				}
				
				//purchase process
				$amount = 0;
				foreach($products as $i => $p) $amount += $p["price"] * $p["qty"];
				
				$purchase = [
					"provider_id" => $provider_id,
					"amount" => $amount,
					"paid" => $payment["paid"],
					"balance" => $amount - $payment["paid"],
					"updated_at" => $now,
					"registed_at" => $now,
				];
				$purchase_id = $this->gm->insert("purchase", $purchase);
				
				//payment process
				$payment["purchase_id"] = $purchase_id;
				$payment["registed_at"] = $now;
				$this->gm->insert("purchase_payment", $payment);
				
				//products process
				foreach($products as $p){
					if (!$p["option_id"]){
						$option_id = 0;
						$op_name = "-";
						while (!$option_id){
							if ($this->gm->filter("product_option", ["product_id" => $p["product_id"], "option" => $op_name])) $op_name = $op_name."-";
							else{
								$op = [
									"product_id" => $p["product_id"],
									"option" => $op_name,
									"stock" => 0,
								];
								$option_id = $this->gm->insert("product_option", $op);
							}
						}
						$p["option_id"] = $option_id;
					}
					
					$p["purchase_id"] = $purchase_id;
					$p["subtotal"] = $p["price"] * $p["qty"];
					$this->gm->insert("purchase_product", $p);
					
					$option = $this->gm->unique("product_option", "option_id", $p["option_id"]);
					$this->gm->update("product_option", ["option_id" => $p["option_id"]], ["stock" => $option->stock + $p["qty"]]);
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
}
