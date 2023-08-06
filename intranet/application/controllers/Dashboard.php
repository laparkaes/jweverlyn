<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/Lima');
		setlocale(LC_TIME, 'spanish.utf8');
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
