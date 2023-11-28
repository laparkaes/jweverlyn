<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('username')) redirect("auth/login");
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["dashboard", ""];
		$this->js_init = "dashboard.js";
	}

	public function index(){
		//access check
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "error") redirect($result["url"]);
		
		$data = [
			"main" => "dashboard/index",
		];
		$this->load->view('layout', $data);
	}
	
	private function test_access(){
		//1. normal access
		$this->nav_menu[] = $this->router->fetch_method();
		$result = $this->my_func->check_access($this->nav_menu);
		if ($result["type"] === "error") redirect($result["url"]);
		
		//2. ajax access
		$this->nav_menu[] = $this->router->fetch_method();
		$result = $this->my_func->check_access($this->nav_menu);
		if ($result["type"] === "success"){ /* codes here */ }
	}
}
