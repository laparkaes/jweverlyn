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
			"role" => $this->input->get("role"),
		];
		if (!$params["page"]) $params["page"] = 1;
		
		$w = $l = $w_in = [];
		if ($params["role"]) $l[] = ["field" => "role", "values" => explode(" ", $params["role"])];
		
		$roles = $this->gm->filter("role", $w, $l, $w_in, [["role", "asc"]], 25, 25 * ($params["page"] - 1));
		foreach($roles as $r){
			$r->account_qty = $this->gm->qty("account", ["role_id" => $r->role_id]);
			$r->access_qty = $this->gm->qty("role_access", ["role_id" => $r->role_id], null, null, null, false);
		}
		
		$data = [
			"is_filtered" => ($w or $l or $w_in),
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("role", $w, $l, $w_in)),
			"roles" => $roles,
			"main" => "authentication/role/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"main" => "authentication/role/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add(){
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
	
	public function delete(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->delete_role($data);
			
			if ($result["type"] === "success"){
				$aux = ["role_id" => $data["role_id"]];
				if ($this->gm->update("role", $aux, ["valid" => false])){
					$result["msg"] = $this->lang->line("s_role_delete");
					$this->gm->delete("role_access", $aux);
				}	
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function edit($role_id){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$modules = $this->gm->all("module", [["module", "asc"]]);
		foreach($modules as $m) $m->access = $this->gm->filter("access", ["module_id" => $m->module_id], null, null, [["access", "asc"]]);
		
		$access_ids = [];
		$access = $this->gm->filter("role_access", ["role_id" => $role_id], null, null, null, [], "", "", false);
		foreach($access as $a) $access_ids[] = $a->access_id;
		
		$data = [
			"role" => $this->gm->unique("role", "role_id", $role_id),
			"accounts" => $this->gm->filter("account", ["role_id" => $role_id], null, null, [["username", "asc"]]),
			"modules" => $modules,
			"access_ids" => $access_ids,
			"main" => "authentication/role/edit",
		];
		$this->load->view('layout', $data);
	}
	
	public function update(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->update_role($data);
			
			if ($result["type"] === "success"){
				$this->gm->update("role", ["role_id" => $data["role_id"]], $data);
				$result["role_id"] = $data["role_id"];
				$result["msg"] = $this->lang->line("s_role_update");
			}
		}else $result = ["type" => "error", "msgs" => [], "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function access_control(){
		$type = "error"; $msg = null;
		
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			$action = $data["action"]; unset($data["action"]);
			if ($action == "add"){
				$result = $this->gm->insert("role_access", $data);
				$msg = $this->lang->line("s_role_access_assigned");
			}else{
				$result = $this->gm->delete("role_access", $data);
				$msg = $this->lang->line("s_role_access_designated");
			}
			
			$type = "success";
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	/* public function generate(){
		for($i = 0; $i < 26; $i++){
			$aux = $this->my_func->randomString(10);
			if (!$this->gm->filter("role", ["role" => $aux])) $this->gm->insert("role", ["role" => $aux]);
			echo $aux."<br/>";
		}
	} */
	
}
