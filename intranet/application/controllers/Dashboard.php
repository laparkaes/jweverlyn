<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->load->model('general_model','general');
		$this->nav_menu = "dashboard";
	}

	public function index(){
		
		$data = [
			"main" => "dashboard/master",
		];
		$this->load->view('layout', $data);
	}
}
