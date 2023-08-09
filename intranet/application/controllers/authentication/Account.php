<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('username')) redirect("auth/login");
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["authentication", "account"];
	}

	/* Account list */
	public function index(){
		
		$data = [
			"accounts" => $this->gm->all("account", [["name", "asc"]]),
			//all($tablename, $order_by = "id", $order = "desc", $limit = "", $offset = "", $check_valid = true)
			"main" => "authentication/account/index",
		];
		$this->load->view('layout', $data);
	}
	
}
