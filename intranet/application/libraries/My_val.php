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
	
	public function module($data){
		$type = "error"; $msgs = []; $msg = "";
		
		if ($data["module"]){
			if (!$this->CI->gm->unique("module", "module", $data["module"])){
				$type = "success";
				$msgs = $this->set_msg($msgs, "module");
			}else $msgs = $this->set_msg($msgs, "module", "e_module_exists");
		}else $msgs = $this->set_msg($msgs, "module", "e_required_field");	
		
		return ["type" => $type, "msgs" => $msgs, "msg" => $msg];
	}
	
	public function access($data){
		$type = "error"; $msgs = []; $msg = ""; $results = [];
		
		$results["module_id"] = false;
		if ($data["module_id"]){
			$results["module_id"] = true;
			$msgs = $this->set_msg($msgs, "module_id");
		}else $msgs = $this->set_msg($msgs, "module_id", "e_required_field");	
		
		$results["access"] = false;
		if ($data["access"]){
			if (!$this->CI->gm->unique("access", "access", $data["access"])){
				$results["access"] = true;
				$msgs = $this->set_msg($msgs, "access");
			}else $msgs = $this->set_msg($msgs, "access", "e_access_exists");
		}else $msgs = $this->set_msg($msgs, "access", "e_required_field");	
		
		$results["code"] = false;
		if ($data["code"]){
			$results["code"] = true;
			$msgs = $this->set_msg($msgs, "code");
		}else $msgs = $this->set_msg($msgs, "code", "e_required_field");	
		
		$result = true;
		foreach($results as $r) $result = ($result and $r);
		
		if ($result) $type = "success";
		else $type = "error";
		
		return ["type" => $type, "msgs" => $msgs, "msg" => $msg];
	}
}