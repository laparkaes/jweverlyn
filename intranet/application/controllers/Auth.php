<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->init_js = "auth.js";
	}

	public function login(){
		$this->load->view('auth/login');
	}
	
	public function login_validation(){
		$data = $this->input->post();
		
		$this->load->library('my_val');
		$result = $this->my_val->login($data);
		
		if ($result["type"] === "success"){
			//set session data
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function create_first_admin(){
		$role = $this->gm->unique("role", "role", "Admin");
		
		if (!$this->gm->unique("account", "role_id", $role->role_id)){
			$account = [
				"username" => "laparkaes@gmail.com",
				"password" => "wjddn0315",
				"name" => "Georgio Park",
			];
			
			$data = [
				"role_id" => $role->role_id, 
				"username" => $account["username"],
				"password" => password_hash($account["password"], PASSWORD_BCRYPT),
				"name" => $account["name"],
				"updated_at" => date("Y-m-d H:i:s"),
				"registed_at" => date("Y-m-d H:i:s"),
			];
			
			if ($this->gm->insert("account", $data)){
				$this->load->view('auth/admin_create', $account);
			}else echo $this->lang->line('e_internal_again');
		}else echo $this->lang->line('e_admin_exists');
	}
}
