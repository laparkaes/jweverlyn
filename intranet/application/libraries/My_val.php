<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* My validations */
class My_val{
	
	public function __construct(){
		$this->CI = &get_instance();
		$this->CI->lang->load("message", "spanish");
		$this->CI->load->model('general_model','gm');
	}
	
	public function set_msg($msgs, $name, $code = ""){
		if ($code){
			$msg = $this->CI->lang->line($code);
			$class = "is-invalid";
		}else{
			$msg = "";
			$class = "is-valid";
		}
		
		$msgs[] = ["name" => $name, "class" => $class, "msg" => $msg];
		
		return $msgs;
	}
	
	public function login($data){
		$type = "error"; $msgs = [];
		
		if ($data["username"]){
			if (filter_var($data["username"], FILTER_VALIDATE_EMAIL)){
				$account = $this->CI->gm->unique("account", "username", $data["username"]);
				if ($account){
					$msgs = $this->set_msg($msgs, "username");
					if ($data["password"]){
						if (password_verify($data["password"], $account->password)){
							$type = "success";
							$msgs = $this->set_msg($msgs, "password");
						}else $msgs = $this->set_msg($msgs, "password", "e_password_wrong");
					}else $msgs = $this->set_msg($msgs, "password", "e_required_field");
				}else $msgs = $this->set_msg($msgs, "username", "e_username_wrong");
			}else $msgs = $this->set_msg($msgs, "username", "e_username_email");
		}else $msgs = $this->set_msg($msgs, "username", "e_required_field");
		
		return ["type" => $type, "msgs" => $msgs];
	}
}