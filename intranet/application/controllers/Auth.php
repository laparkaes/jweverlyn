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
		$type = "error"; $msgs = []; $msg = "";
		$data = $this->input->post();
		
		print_r($data);
		
	}
	
	public function create_first_admin(){
		$role = $this->gm->unique("role", "role", "Admin");
		
		if ($this->gm->unique("account", "role_id", $role->role_id)) echo "Existe usuario admin en sistema.";
		else{
			$data = [
				"role_id" => $role->role_id, 
				"username" => "laparkaes@gmail.com",
				"password" => password_hash("wjddn0315", PASSWORD_BCRYPT),
				"name" => "Georgio Park",
				"updated_at" => date("Y-m-d H:i:s"),
				"registed_at" => date("Y-m-d H:i:s"),
			];
			
			print_R($data);
		}
		
		echo $this->lang->line('e_required_field');
	}
}
