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
		
		$proformas = $this->gm->filter("proforma", $w, $l, $w_in, [["registed_at", "desc"]], 25, 25 * ($params["page"] - 1), false);
		foreach($proformas as $s){
			if ($s->client_id) $s->client = $this->gm->unique("client", "client_id", $s->client_id)->name;
			else $s->client = "";
			if ($s->valid) $s->color = "success";
			else $s->color = "danger";
		}
		
		$data = [
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("proforma", $w, $l, $w_in)),
			"proformas" => $proformas,
			"main" => "commerce/proforma/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($proforma_id){
		if (!$this->session->userdata('username')) redirect("auth/login");

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
			"client_doc_types" => $this->gm->all_simple("client_doc_type", "doc_type_id", "asc"),
			"main" => "commerce/proforma/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add_proforma(){
		$result = ["type" => "error", "msg" => null];
		
		if ($this->session->userdata('username')){
			$products = $this->input->post("products");
			$proforma = $this->input->post("proforma");
			$client = $this->input->post("client");	
			
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
			}
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function add_sale(){
		print_r($this->input->post());
	}
}
