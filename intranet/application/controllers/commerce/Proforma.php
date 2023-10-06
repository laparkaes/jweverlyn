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
			if ($s->valid){
				if ($s->balance) $s->color = "warning"; else $s->color = "success";
			}else $s->color = "danger";
		}
		
		$data = [
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("proforma", $w, $l, $w_in)),
			"proformas" => $proformas,
			"main" => "commerce/proforma/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($sale_id){
		if (!$this->session->userdata('username')) redirect("auth/login");

		$sale = $this->gm->unique("sale", "sale_id", $sale_id, false);
		if (!$sale) redirect("no_page");
			
		if ($sale->client_id){
			$client = $this->gm->unique("client", "client_id", $sale->client_id);
			$client->doc_type = $this->gm->unique("identification_document", "identification_document_id", $client->doc_type_id, false)->identification_document;
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
		
		$data = [
			"sale" => $sale,
			"client" => $client,
			"payments" => $payments,
			"products" => $products,
			"payment_methods" => $this->gm->all_simple("payment_method", "payment_method_id", "asc"),
			"main" => "commerce/sale/detail",
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
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"ident_documents" => $this->gm->all_simple("identification_document", "identification_document_id", "asc"),
			"main" => "commerce/proforma/register",
		];
		$this->load->view('layout', $data);
	}
	
}
