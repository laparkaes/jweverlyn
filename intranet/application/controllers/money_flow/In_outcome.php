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
			"description" => $this->input->get("description"),
			"type" => $this->input->get("type"),
			"category" => $this->input->get("category"),
			"from" => $this->input->get("from"),
			"to" => $this->input->get("to"),
			"a_min" => $this->input->get("a_min"),
			"a_max" => $this->input->get("a_max"),
		];
		if (!$params["page"]) $params["page"] = 1;
		
		$w = $l = $w_in = [];
		if ($params["description"]) $l[] = ["field" => "description", "values" => explode(" ", $params["description"])];
		if ($params["type"]) $w["type_id"] = $params["type"];
		if ($params["category"]) $w["category_id"] = $params["category"];
		if ($params["from"]) $w["date >="] = $params["from"]." 00:00:00";
		if ($params["to"]) $w["date <="] = $params["to"]." 23:59:59";
		if ($params["a_min"]) $w["amount >="] = str_replace(",", "", $params["a_min"]);
		if ($params["a_max"]) $w["amount <="] = str_replace(",", "", $params["a_max"]);
		
		$types_arr = [];
		$types = $this->gm->all_simple("in_outcome_type", "type", "asc");
		foreach($types as $t) $types_arr[$t->type_id] = $t->type;
		
		$categories = $this->gm->all("in_outcome_category", [["type_id", "asc"], ["category", "asc"]]);
		foreach($categories as $c) $c->category = $types_arr[$c->type_id]." - ".$c->category;
		
		$in_outs = $this->gm->filter("in_outcome", $w, $l, $w_in, [["date", "desc"]], 25, 25 * ($params["page"] - 1));
		foreach($in_outs as $io){
			$io->type = $types_arr[$io->type_id];
			if ($io->type === "Ingreso") $io->color = "success"; else $io->color = "danger";
			
			$io->category = $this->gm->unique("in_outcome_category", "category_id", $io->category_id)->category;
		}
		
		$data = [
			"is_filtered" => ($w or $l or $w_in),
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("in_outcome", $w, $l, $w_in)),
			"in_outs" => $in_outs,
			"categories" => $categories,
			"types" => $types,
			"main" => "money_flow/in_outcome/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"types" => $this->gm->all_simple("in_outcome_type", "type", "asc"),
			"categories" => $this->gm->all("in_outcome_category", [["type_id", "asc"], ["category", "asc"]]),
			"main" => "money_flow/in_outcome/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add_in_outcome(){
		$result = ["type" => "error", "msg" => null];
		
		if ($this->session->userdata('username')){
			$io = $this->input->post();
			$io["amount"] = str_replace(",", "", $io["amount"]);
		
			$this->load->library('my_val');
			$result = $this->my_val->add_in_outcome($io);
			
			if ($result["type"] === "success"){
				$this->gm->insert("in_outcome", $io);
				$result["msg"] = $this->lang->line("s_add_in_outcome");
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_in_outcome(){
		$result = ["type" => "error", "msg" => null];
		
		if ($this->session->userdata('username')){
			$this->gm->update("in_outcome", ["in_outcome_id" => $this->input->post("in_outcome_id")], ["valid" => false]);
			$result["type"] = "success";
			$result["msg"] = $this->lang->line("s_delete_in_outcome");
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function add_category(){
		$result = ["type" => "error", "msg" => null];
		
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_category_inout($data);
			
			if ($result["type"] === "success"){
				$this->gm->insert("in_outcome_category", $data);
				$result["msg"] = $this->lang->line("s_category_insert");
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_category(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->delete_category_inout($data);
			
			if ($result["type"] === "success"){
				$this->gm->update("in_outcome_category", $data, ["valid" => false]);
				$result["msg"] = $this->lang->line("s_category_delete");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}
