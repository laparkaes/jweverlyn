<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('username')) redirect("auth/login");
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["dashboard", ""];
	}

	public function index(){
		
		$data = [
			"main" => "dashboard/admin",
		];
		$this->load->view('layout', $data);
	}
}
