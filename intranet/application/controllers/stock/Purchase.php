<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* last check 2023 1115 */
class Purchase extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["stock", "purchase"];
		$this->js_init = "stock/purchase.js";
	}
	
	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$params = [
			"page" => $this->input->get("page"),
			"provider" => $this->input->get("provider"),
			"from" => $this->input->get("from"),
			"to" => $this->input->get("to"),
			"a_min" => $this->input->get("a_min"),
			"a_max" => $this->input->get("a_max"),
			"b_min" => $this->input->get("b_min"),
			"b_max" => $this->input->get("b_max"),
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
		if ($params["b_min"]) $w["balance >="] = str_replace(",", "", $params["b_min"]);
		if ($params["b_max"]) $w["balance <="] = str_replace(",", "", $params["b_max"]);
		
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
			
		$w = ["purchase_id" => $purchase_id, "valid" => true];
		
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
		
		$payments = $this->gm->filter("purchase_payment", $w, null, null, [["registed_at", "desc"]], "", "");
		foreach($payments as $p){
			$p->payment_method = $this->gm->unique("payment_method", "payment_method_id", $p->payment_method_id, false)->payment_method;
		}
		
		$products = $this->gm->filter("purchase_product", ["purchase_id" => $purchase_id], null, null, [["subtotal", "desc"]], "", "", false);
		foreach($products as $p){
			$p->prod = $this->gm->unique("product", "product_id", $p->product_id);
			$p->op = $this->gm->unique("product_option", "option_id", $p->option_id);
		}
		
		$data = [
			"purchase" => $purchase,
			"provider" => $provider,
			"products" => $products,
			"payments" => $payments,
			"files" => $this->gm->filter("purchase_file", $w, null, null, [["registed_at", "desc"]]),
			"notes" => $this->gm->filter("purchase_note", $w, null, null, [["registed_at", "desc"]]),
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
		foreach($payments as $p) $paid = $paid + $p->paid;
		
		$f = ["purchase_id" => $purchase->purchase_id];
		$d = [
			"paid" => $paid,
			"balance" => $purchase->amount - $paid,
			"updated_at" => date("Y-m-d H:i:s"),
		];
		$this->gm->update("purchase", $f, $d);
	}
	
	public function add_file(){
		$result = ["type" => "error", "msg" => null, "url" => null];
		
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			$data["filename"] = $_FILES["upload"]["name"];
			
			$this->load->library('my_val');
			$result = $this->my_val->file_upload_purchase($data);
			
			if ($result["type"] === "success"){
				$path = './uploads/purchase/'.$data["purchase_id"]."/";
				if (!is_dir($path)) mkdir($path, 0777, true);
				
				$config['upload_path'] = $path;
				$config['allowed_types'] = '*';
				$config['file_name'] = date("YmdHis");
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('upload')){
					$upload_data = $this->upload->data();
					
					$data["filename"] = $upload_data['file_name'];
					$data["registed_at"] = date("Y-m-d H:i:s");
					$this->gm->insert("purchase_file", $data);
					
					$result["msg"] = $this->lang->line("s_file_upload");
					$result["url"] = base_url()."stock/purchase/detail/".$data["purchase_id"];
				}else $result = ["type" => "error", "msg" => $this->upload->display_errors()];
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_file(){
		$type = "error"; $msg = null; $url = null;
		
		if ($this->session->userdata('username')){
			$file = $this->gm->unique("purchase_file", "file_id", $this->input->post('file_id'));
			$this->gm->update("purchase_file", ["file_id" => $file->file_id], ["valid" => false]);
			
			$type = "success";
			$msg = $this->lang->line("s_file_delete");
			$url = base_url()."stock/purchase/detail/".$file->purchase_id;
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "url" => $url]);
	}
	
	public function add_note(){
		$result = ["type" => "error", "msg" => null, "url" => null];
		
		if ($this->session->userdata('username')){
			$note = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_note($note);
			
			if ($result["type"] === "success"){
				$note["note"] = trim($note["note"]);
				$note["registed_at"] = date("Y-m-d H:i:s");
				$this->gm->insert("purchase_note", $note);
				
				$result["msg"] = $this->lang->line("s_note_insert");
				$result["url"] = base_url()."stock/purchase/detail/".$note["purchase_id"];
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_note(){
		$type = "error"; $msg = null; $url = null;
		
		if ($this->session->userdata('username')){
			$note = $this->gm->unique("purchase_note", "note_id", $this->input->post('note_id'));
			
			$this->gm->update("purchase_note", ["note_id" => $note->note_id], ["valid" => false]);
			
			$type = "success";
			$msg = $this->lang->line("s_note_delete");
			$url = base_url()."stock/purchase/detail/".$note->purchase_id;
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "url" => $url]);
	}
	
	public function add_payment(){
		$result = ["type" => "error", "msg" => null, "url" => null];
		
		if ($this->session->userdata('username')){
			$payment = $this->input->post();
			$payment["paid"] = str_replace(",", "", $payment["paid"]);
			$payment["total"] = str_replace(",", "", $payment["total"]);
			$payment["balance"] = str_replace(",", "", $payment["balance"]);
			
			$this->load->library('my_val');
			$result = $this->my_val->add_payment_purchase($payment);
			
			if ($result["type"] === "success"){
				$payment["registed_at"] = date("Y-m-d H:i:s");
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
			$type_prod = $this->gm->unique("product_type", "type", "Producto", false);
			$products_rec = $this->gm->filter("product", ["type_id" => $type_prod->type_id], [["field" => "product", "values" => explode(" ", $keyword)]]);
			
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
			$f = ["purchase_id" => $purchase_id];
			
			//stock validation
			$products = $this->gm->filter("purchase_product", $f, null, null, [], "", "", false);
			foreach($products as $p){
				$op = $this->gm->unique("product_option", "option_id", $p->option_id);
				if ($op->stock < $p->qty){
					$pr = $this->gm->unique("product", "product_id", $p->product_id)->product;
					$msg = str_replace("%product%", $pr, $this->lang->line("e_cancel_no_stock"))." (".$op->option.")";
					break;
				}
			}
			
			//stock validation done
			if (!$msg){
				//product stock update
				foreach($products as $p){
					$op = $this->gm->unique("product_option", "option_id", $p->option_id);
					$stock_new = $op->stock - $p->qty;
					$this->gm->update("product_option", ["option_id" => $p->option_id], ["stock" => $stock_new]);
				}
				
				// cancel payment and purchase
				$this->gm->update("purchase_payment", $f, ["valid" => false]);
				$this->gm->update("purchase", $f, ["updated_at" => date("Y-m-d H:i:s"), "valid" => false]);
				
				$type = "success";
				$msg = $this->lang->line("s_purchase_cancel");
				$url = base_url()."stock/purchase/detail/".$purchase_id;
			}
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "url" => $url]);
	}

	/*public function methods(){
		$cl = $this->router->fetch_class();
		$aux = get_class_methods($this);
		
		$no_class = ["__construct", "methods", "get_instance"];
		foreach($aux as $a) if (!in_array($a, $no_class)) echo $cl."_".$a."<br/>";
	}*/
}
