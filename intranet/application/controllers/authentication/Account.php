<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["authentication", "role"];
		$this->js_init = "authentication/role.js";
	}

	/* Account list */
	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$params = [
			"page" => $this->input->get("page"),
			"search" => $this->input->get("search"),
		];
		if (!$params["page"]) $params["page"] = 1;
		
		$w = $l = $w_in = [];
		if ($params["search"]){
			$l["role"] = $params["search"];
		}else unset($params["search"]);
		
		$accounts = $this->gm->filter("account", $w, $l, $w_in, [["username", "asc"]], 25, 25 * ($params["page"] - 1));
		foreach($accounts as $a)
			$a->role = $this->gm->unique("role", "role_id", $a->role_id)->role;
		
		$data = [
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("account", $w, $l, $w_in)),
			"accounts" => $accounts,
			"main" => "authentication/account/index",
		];
		$this->load->view('layout', $data);
	}
	
}
