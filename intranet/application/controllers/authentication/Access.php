<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["authentication", "access"];
		$this->js_init = "authentication/access.js";
	}

	/* Access list */
	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$modules = $this->gm->all("module", [["module", "asc"]]);
		foreach($modules as $m) $m->access = $this->gm->filter("access", ["module_id" => $m->module_id], null, null, [["access", "asc"]]);
		
		$data = [
			"modules" => $modules,
			"main" => "authentication/access/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"modules" => $this->gm->all("module", [["module", "asc"]]),
			"main" => "authentication/access/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function insert_module(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->module($data);
			
			if ($result["type"] === "success")
				if ($this->gm->insert("module", $data)) 
					$result["msg"] = $this->lang->line("s_module_insert");
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function insert_access(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->access($data);
			
			if ($result["type"] === "success")
				if ($this->gm->insert("access", $data)) 
					$result["msg"] = $this->lang->line("s_access_insert");
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
			
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}
