<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class In_outcome extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["money_flow", "in_outcome"];
		$this->js_init = "money_flow/in_outcome.js";
	}
	
	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$params = [
			"page" => $this->input->get("page"),
			"type" => $this->input->get("type"),
			"from" => $this->input->get("from"),
			"to" => $this->input->get("to"),
			"a_min" => $this->input->get("a_min"),
			"a_max" => $this->input->get("a_max"),
		];
		if (!$params["page"]) $params["page"] = 1;
		
		$w = $l = $w_in = [];
		if ($params["type"]) $w["type_id"] = $params["type"];
		if ($params["from"]) $w["registed_at >="] = $params["from"]." 00:00:00";
		if ($params["to"]) $w["registed_at <="] = $params["to"]." 23:59:59";
		if ($params["a_min"]) $w["abs(amount) >="] = str_replace(",", "", $params["a_min"]);
		if ($params["a_max"]) $w["abs(amount) <="] = str_replace(",", "", $params["a_max"]);
		
		$in_outs = $this->gm->filter("in_outcome", $w, $l, $w_in, [["registed_at", "desc"]], 25, 25 * ($params["page"] - 1));
		foreach($in_outs as $s){
			
		}
		
		$data = [
			"is_filtered" => ($w or $l or $w_in),
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("in_outcome", $w, $l, $w_in)),
			"in_outs" => $in_outs,
			"main" => "money_flow/in_outcome/index",
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
}
