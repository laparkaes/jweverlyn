<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["authentication", "role"];
		$this->js_init = "authentication/role.js";
	}

	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$params = [
			"page" => $this->input->get("page"),
			"search" => $this->input->get("search"),
		];
		if (!$params["page"]) $params["page"] = 1;
		
		$w = $l = $w_in = [];
		if ($params["search"]){
			$l["role"] = $params["search"];
		}else unset($params["search"]);
		
		$roles = $this->gm->filter("role", $w, $l, $w_in, [["role", "asc"]], 25, 25 * ($params["page"] - 1));
		foreach($roles as $r){
			$r->account_qty = $this->gm->qty("account", ["role_id" => $r->role_id]);
			$r->access_qty = $this->gm->qty("role_access", ["role_id" => $r->role_id], null, null, null, false);
		}
		
		$data = [
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("role", $w, $l, $w_in)),
			"roles" => $roles,
			"main" => "authentication/role/index",
		];
		$this->load->view('layout', $data);
	}
	
	/* public function generate(){
		for($i = 0; $i < 26; $i++){
			$aux = $this->my_func->randomString(10);
			if (!$this->gm->filter("role", ["role" => $aux])) $this->gm->insert("role", ["role" => $aux]);
			echo $aux."<br/>";
		}
	} */
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"main" => "authentication/role/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add_role(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_role($data);
			
			if ($result["type"] === "success"){
				$result["role_id"] = $this->gm->insert("role", $data);
				$result["msg"] = $this->lang->line("s_role_insert");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_module(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->delete_module($data);
			
			if ($result["type"] === "success")
				if ($this->gm->update("module", ["module_id" => $data["module_id"]], ["valid" => false]))
					$result["msg"] = $this->lang->line("s_module_delete");
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function add_access(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_access($data);
			
			if ($result["type"] === "success")
				if ($this->gm->insert("access", $data)) 
					$result["msg"] = $this->lang->line("s_access_insert");
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
			
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_access(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->delete_access($data);
			
			if ($result["type"] === "success")
				if ($this->gm->update("access", ["access_id" => $data["access_id"]], ["valid" => false]))
					$result["msg"] = $this->lang->line("s_access_delete");
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
			
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}
