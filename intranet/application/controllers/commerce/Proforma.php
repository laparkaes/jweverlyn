<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proforma extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["commerce", "proforma"];
		$this->js_init = "commerce/proforma.js";
	}
	
	public function index(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "error") redirect($result["url"]);
		
		$params = [
			"page" => $this->input->get("page"),
			"client" => $this->input->get("client"),
			"i_from" => $this->input->get("i_from"),
			"i_to" => $this->input->get("i_to"),
			"v_from" => $this->input->get("v_from"),
			"v_to" => $this->input->get("v_to"),
			"a_min" => $this->input->get("a_min"),
			"a_max" => $this->input->get("a_max"),
		];
		if (!$params["page"]) $params["page"] = 1;
	
		$w = $l = $w_in = [];
		if ($params["client"]){
			$client_ids = [-1];
			$clients = $this->gm->filter("client", null, [["field" => "name", "values" => explode(" ", $params["client"])]]);
			if ($clients) foreach($clients as $c) $client_ids[] = $c->client_id;
			
			$w_in[] = ["field" => "client_id", "values" => $client_ids];
		}
		
		if ($params["i_from"]) $w["registed_at >="] = $params["i_from"]." 00:00:00";
		if ($params["i_to"]) $w["registed_at <="] = $params["i_to"]." 23:59:59";
		if ($params["v_from"]) $w["validity >="] = $params["v_from"]." 00:00:00";
		if ($params["v_to"]) $w["validity <="] = $params["v_to"]." 23:59:59";
		if ($params["a_min"]) $w["amount >="] = str_replace(",", "", $params["a_min"]);
		if ($params["a_max"]) $w["amount <="] = str_replace(",", "", $params["a_max"]);
		
		$proformas = $this->gm->filter("proforma", $w, $l, $w_in, [["registed_at", "desc"]], 25, 25 * ($params["page"] - 1), false);
		foreach($proformas as $p){
			if ($p->client_id) $p->client = $this->gm->unique("client", "client_id", $p->client_id)->name;
			else $p->client = "";
			if ($p->valid and (time() < strtotime("+1 day", strtotime($p->validity)))) $p->color = "success";
			else $p->color = "danger";
		}
		
		$data = [
			"is_filtered" => ($w or $l or $w_in),
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("proforma", $w, $l, $w_in)),
			"proformas" => $proformas,
			"main" => "commerce/proforma/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($proforma_id){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "error") redirect($result["url"]);

		$proforma = $this->gm->unique("proforma", "proforma_id", $proforma_id, false);
		if (!$proforma) redirect("no_page");
			
		if ($proforma->client_id){
			$client = $this->gm->unique("client", "client_id", $proforma->client_id);
			$client->doc_type = $this->gm->unique("client_doc_type", "doc_type_id", $client->doc_type_id, false)->doc_type;
		}else $client = null;
		
		$proforma->color = "danger";
		if ($proforma->valid){
			if (time() < strtotime("+1 day", strtotime($proforma->validity))){
				$proforma->status = "Vigente";
				$proforma->color = "success";
			}else $proforma->status = "Vencido";
		}else $proforma->status = "Anulado";
		
		$products = $this->gm->filter("proforma_product", ["proforma_id" => $proforma->proforma_id], null, null, [["price", "desc"]], "", "", false);
		foreach($products as $p){
			$p->prod = $this->gm->unique("product", "product_id", $p->product_id);
			$p->op = $this->gm->unique("product_option", "option_id", $p->option_id);
		}
		
		$data = [
			"proforma" => $proforma,
			"client" => $client,
			"products" => $products,
			"payment_methods" => $this->gm->all_simple("payment_method", "payment_method_id", "asc"),
			"main" => "commerce/proforma/detail",
		];
		$this->load->view('layout', $data);
	}
	
	public function load_product(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$result["type"] = "error";
			
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
						$result["type"] = "success";
						$result["product"] = $product;
						$result["options"] = $options;
					}else $result["msg"] = $this->lang->line("e_product_no_stock");
				}else{//Service
					$result["type"] = "success";
					$result["product"] = $product;
					$result["options"] = [];
				}
			}else $result["msg"] = $this->lang->line("e_no_product_registed");	
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function check_stock(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$prod = $this->input->post("prod");
			$product = $this->gm->unique("product", "product_id", $prod["product_id"]);
			$type = $this->gm->unique("product_type", "type_id", $product->type_id, false);
			
			if ($type->type === "Producto"){
				if ($prod["option_id"]){
					$option = $this->gm->unique("product_option", "option_id", $prod["option_id"]);
					
					if ($prod["qty"] > $option->stock){
						$result["type"] = "error";
						$result["msg"] = $this->lang->line("e_product_no_stock")." (Max: ".number_format($option->stock).")";
					}	
				}else{
					$result["type"] = "error";
					$result["msg"] = $this->lang->line("e_option_select");
				}
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function register(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "error") redirect($result["url"]);
		
		$data = [
			"client_doc_types" => $this->gm->all_simple("client_doc_type", "doc_type_id", "asc"),
			"main" => "commerce/proforma/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function search_product(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$products = [];
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
					
					$result["type"] = "success";
					$result["products"] = $products;
				}else $result["msg"] = $this->lang->line("e_no_result");
			}else $result["msg"] = $this->lang->line("e_enter_keyword");
		}
			
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function add_proforma(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$products_json = $this->input->post("products");
			$proforma = $this->input->post("proforma");
			$client = $this->input->post("client");	
			
			/* data processing */
			$products = [];
			if ($products_json) foreach($products_json as $p) $products[] = json_decode($p, true);
			
			$proforma["amount"] = round(str_replace(",", "", $proforma["amount"]), 2);
			
			$this->load->library('my_val');
			$result = $this->my_val->add_proforma($products, $client);
			
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
				
				//proforma process
				$amount = 0;
				foreach($products as $prod) $amount += $prod["price"] * $prod["qty"];
				
				if (!$proforma["validity"]) $proforma["validity"] = null;
				
				$proforma["client_id"] = $client_id;
				$proforma["amount"] = $amount;
				$proforma["registed_at"] = $now;
				$proforma_id = $this->gm->insert("proforma", $proforma);
				
				//products process
				foreach($products as $p){
					$p["proforma_id"] = $proforma_id;
					$this->gm->insert("proforma_product", $p);
				}
				
				$result["proforma_id"] = $proforma_id;
				$result["msg"] = $this->lang->line("s_proforma_insert");
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function add_sale(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$result["msgs"] = [];
			
			$proforma_id = $this->input->post("proforma_id");
			$payment = $this->input->post("payment");
			
			$payment["received"] = round(str_replace(",", "", $payment["received"]), 2);
			$payment["total"] = round(str_replace(",", "", $payment["total"]), 2);
			$payment["change"] = round(str_replace(",", "", $payment["change"]), 2);
			
			$this->load->library('my_val');
			$result = $this->my_val->add_sale_from_proforma($proforma_id, $payment);
			
			if ($result["type"] === "success"){
				$proforma = $this->gm->unique("proforma", "proforma_id", $proforma_id);
				$now = date("Y-m-d H:i:s");
				$paid = $payment["received"] - $payment["change"];
				
				$sale = [
					"client_id" => $proforma->client_id,
					"proforma_id" => $proforma->proforma_id,
					"amount" => $proforma->amount,
					"paid" => $paid,
					"balance" => $proforma->amount - $paid,
					"updated_at" => $now,
					"registed_at" => $now,
				];
				
				$sale_id = $this->gm->insert("sale", $sale);
				if ($sale_id){
					$f = ["proforma_id" => $proforma_id];
					$products = $this->gm->filter("proforma_product", $f, null, null, [], "", "", false);
					foreach($products as $p){
						$sale_prod = [
							"sale_id" => $sale_id,
							"product_id" => $p->product_id,
							"option_id" => $p->option_id,
							"qty" => $p->qty,
							"price" => $p->price,
							"subtotal" => $p->qty * $p->price,
						];
						$this->gm->insert("sale_product", $sale_prod);
					}
				
					unset($payment["received_txt"]);
					$payment["sale_id"] = $sale_id;
					$this->gm->insert("sale_payment", $payment);
					
					$result["msg"] = $this->lang->line("s_sale_based_proforma");
					$result["url"] = base_url()."commerce/sale/detail/".$sale_id;
				}else{
					$result["type"] = "error";
					$result["msg"] = $this->lang->line("e_internal_again");
				}
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}
			
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function view($proforma_id){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "error") redirect($result["url"]);
		
		$proforma = $this->gm->unique("proforma", "proforma_id", $proforma_id, false);
		if ($proforma){
			if ($proforma->client_id){
				$client = $this->gm->unique("client", "client_id", $proforma->client_id, false);
				$client->doc_type = $this->gm->unique("client_doc_type", "doc_type_id", $client->doc_type_id, false)->short;
			}else{
				$client = $this->gm->structure("client");
				$client->doc_type = null;
			}
			
			$products = $this->gm->filter("proforma_product", ["proforma_id" => $proforma_id], null, null, [], "", "", false);
			foreach($products as $p){
				$p->product = $this->gm->unique("product", "product_id", $p->product_id, false)->product;
				$p->option = ($p->option_id > 0) ? $this->gm->unique("product_option", "option_id", $p->option_id, false)->option : null;
			}
			
			$data = [
				"logo" => base64_encode(file_get_contents("./assets/img/logo.svg")),
				"proforma" => $proforma,
				"client" => $client,
				"products" => $products,
				"sign_jw" => base64_encode(file_get_contents("./assets/img/sign_jw.png")),
			];
			
			$html = $this->load->view('commerce/proforma/proforma_a4', $data, true);
			$this->my_func->make_pdf_a4($html, "Proforma - ".$client->name." - ".date("Y md"));
			//echo $html;
		}else redirect("no_page");
	}

	public function update_proforma(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$data = $this->input->post();
			if (!$data["validity"]) $data["validity"] = null;
			
			$this->gm->update("proforma", ["proforma_id" => $data["proforma_id"]], $data)
			$result["msgs"] = $this->lang->line("s_proforma_update");
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function void_proforma(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			if ($this->gm->update("proforma", ["proforma_id" => $this->input->post("proforma_id")], ["valid" => false])){
				$result["msg"] = $this->lang->line("s_proforma_void");
			}else{
				$result["type"] == "error";
				$result["msg"] = $this->lang->line("e_unknown_refresh");
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}

	/*public function methods(){
		$cl = $this->router->fetch_class();
		$aux = get_class_methods($this);
		
		$no_class = ["__construct", "methods", "get_instance"];
		foreach($aux as $a) if (!in_array($a, $no_class)) echo $cl."_".$a."<br/>";
	}*/
}
