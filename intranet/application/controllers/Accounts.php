<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('username')) redirect("auth/login");
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["accounts", ""];
	}

	/* Account list */
	public function index(){
		$this->nav_menu[1] = "accounts_index";
		
		$data = [
			"main" => "accounts/index",
		];
		$this->load->view('layout', $data);
	}
	
	/* Role list */
	public function roles(){
		$this->nav_menu[1] = "accounts_roles";
		
		$data = [
			"main" => "accounts/roles",
		];
		$this->load->view('layout', $data);
	}
	
	/* Access list */
	public function access(){
		$this->nav_menu[1] = "accounts_access";
		
		$data = [
			"main" => "accounts/access",
		];
		$this->load->view('layout', $data);
	}
}
