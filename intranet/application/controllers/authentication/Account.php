<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["authentication", "account"];
		$this->js_init = "authentication/account.js";
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
			$l["username"] = $params["search"];
			$l["name"] = $params["search"];
			
			$roles = $this->gm->filter("role", null, ["role" => $params["search"]], null, [], 25, 25 * ($params["page"] - 1));
			if ($roles){
				$role_ids = [];
				foreach($roles as $r) $role_ids[] = $r->role_id;
				$w_in[] = ["field" => "role_id", "values" => $role_ids];
			}
		}else unset($params["search"]);
		
		$accounts = $this->gm->filter("account", $w, $l, $w_in, [["username", "asc"]], 25, 25 * ($params["page"] - 1), false);
		foreach($accounts as $a) $a->role = $this->gm->unique("role", "role_id", $a->role_id)->role;
		
		$data = [
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("account", $w, $l, $w_in)),
			"accounts" => $accounts,
			"main" => "authentication/account/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"roles" => $this->gm->all("role", [["role", "asc"]]),
			"main" => "authentication/account/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_account($data);
			
			if ($result["type"] === "success"){
				unset($data["password_confirm"]);
				$data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);
				$data["updated_at"] = $data["registed_at"] = date("Y-m-d H:i:s");
				
				$result["account_id"] = $this->gm->insert("account", $data);
				$result["msg"] = $this->lang->line("s_account_insert");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function edit($account_id){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"roles" => $this->gm->all("role", [["role", "asc"]]),
			"account" => $this->gm->unique("account", "account_id", $account_id),
			"main" => "authentication/account/edit",
		];
		$this->load->view('layout', $data);
	}
	
	public function update(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->update_account($data);
			
			if ($result["type"] === "success"){
				$data["updated_at"] = date("Y-m-d H:i:s");
				$this->gm->update("account", ["account_id" => $data["account_id"]], $data);
				$result["account_id"] = $data["account_id"];
				$result["msg"] = $this->lang->line("s_account_update");
			}
		}else $result = ["type" => "error", "msgs" => [], "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function update_password(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->update_password($data);
			
			if ($result["type"] === "success"){
				$aux_data = [
					"password" => password_hash($data["password"], PASSWORD_BCRYPT),
					"updated_at" => date("Y-m-d H:i:s"),
				];
				
				$this->gm->update("account", ["account_id" => $data["account_id"]], $aux_data);
				$result["account_id"] = $data["account_id"];
				$result["msg"] = $this->lang->line("s_account_update");
			}
		}else $result = ["type" => "error", "msgs" => [], "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}
