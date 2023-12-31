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
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "error") redirect($result["url"]);
		
		$modules = $this->gm->all("access_module", [["module", "asc"]]);
		foreach($modules as $m) $m->access = $this->gm->filter("access", ["module_id" => $m->module_id], null, null, [["code", "asc"]]);
		
		$data = [
			"modules" => $modules,
			"main" => "authentication/access/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function register(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "error") redirect($result["url"]);
		
		$data = [
			"modules" => $this->gm->all("access_module", [["module", "asc"]]),
			"main" => "authentication/access/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add_module(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_module($data);
			
			if ($result["type"] === "success")
				if ($this->gm->insert("access_module", $data)) 
					$result["msg"] = $this->lang->line("s_module_insert");
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_module(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->delete_module($data);
			
			if ($result["type"] === "success")
				if ($this->gm->update("module", ["module_id" => $data["module_id"]], ["valid" => false]))
					$result["msg"] = $this->lang->line("s_module_delete");
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function add_access(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_access($data);
			
			if ($result["type"] === "success")
				if ($this->gm->insert("access", $data)) 
					$result["msg"] = $this->lang->line("s_access_insert");
		}else
			
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_access(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->delete_access($data);
			
			if ($result["type"] === "success")
				if ($this->gm->update("access", ["access_id" => $data["access_id"]], ["valid" => false]))
					$result["msg"] = $this->lang->line("s_access_delete");
		}
			
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	/*public function methods(){
		$cl = $this->router->fetch_class();
		$aux = get_class_methods($this);
		
		$no_class = ["__construct", "methods", "get_instance"];
		foreach($aux as $a) if (!in_array($a, $no_class)) echo $cl."_".$a."<br/>";
	}*/
}
