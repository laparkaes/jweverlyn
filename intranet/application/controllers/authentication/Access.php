<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('username')) redirect("auth/login");
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["authentication", "access"];
	}

	/* Access list */
	public function index(){
		$modules = $this->gm->all("module", [["module", "asc"]]);
		foreach($modules as $m) $m->access = $this->gm->filter("access", ["module_id" => $m->module_id], null, null, [["action", "asc"]]);
		
		$data = [
			"modules" => $modules,
			//all($tablename, $order_by = "id", $order = "desc", $limit = "", $offset = "", $check_valid = true)
			"main" => "authentication/access/index",
		];
		$this->load->view('layout', $data);
	}
}
