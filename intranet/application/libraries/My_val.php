<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* My validations */
class My_val{
	
	public function __construct(){
		$this->CI = &get_instance();
		$this->CI->lang->load("message", "spanish");
		$this->CI->load->model('general_model','gm');
	}
	
	private function check_blank($data, $names, $msgs){
		foreach($names as $n){
			if ($data[$n]) $msgs = $this->set_msg($msgs, $n);
			else $msgs = $this->set_msg($msgs, $n, "e_required_field");	
		}
		
		return $msgs;
	}
	
	private function get_type($msgs){
		foreach($msgs as $m) if ($m["msg"]) return "error";
		
		return "success";
	}
	
	private function set_msg($msgs, $name, $code = ""){
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
		$msgs = [];
		
		if ($data["username"]){
			if (filter_var($data["username"], FILTER_VALIDATE_EMAIL)){
				$account = $this->CI->gm->unique("account", "username", $data["username"]);
				if ($account){
					$msgs = $this->set_msg($msgs, "username");
					if ($data["password"]){
						if (password_verify($data["password"], $account->password)) $msgs = $this->set_msg($msgs, "password");
						else $msgs = $this->set_msg($msgs, "password", "e_password_wrong");
					}else $msgs = $this->set_msg($msgs, "password", "e_required_field");
				}else $msgs = $this->set_msg($msgs, "username", "e_username_wrong");
			}else $msgs = $this->set_msg($msgs, "username", "e_username_email");
		}else $msgs = $this->set_msg($msgs, "username", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs];
	}
	
	public function add_module($data){
		$msgs = []; $msg = "";
		
		if ($data["module"]){
			if (!$this->CI->gm->unique("module", "module", $data["module"])) $msgs = $this->set_msg($msgs, "module");
			else $msgs = $this->set_msg($msgs, "module", "e_module_exists");
		}else $msgs = $this->set_msg($msgs, "module", "e_required_field");	
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function delete_module($data){
		$type = "error"; $msg = "";
		
		if ($data["module_id"]){
			if (!$this->CI->gm->filter("access", ["module_id" => $data["module_id"]])) $type = "success";
			else $msg = $this->CI->lang->line("e_module_linked_access");
		}else $msg = $this->CI->lang->line("e_unknown_refresh");
		
		return ["type" => $type, "msg" => $msg];
	}
	
	public function add_access($data){
		$msgs = []; $msg = "";
		
		if ($data["access"]){
			if (!$this->CI->gm->unique("access", "access", $data["access"])) $msgs = $this->set_msg($msgs, "access");
			else $msgs = $this->set_msg($msgs, "access", "e_access_exists");
		}else $msgs = $this->set_msg($msgs, "access", "e_required_field");
		
		if ($data["code"]){
			if (!$this->CI->gm->unique("access", "code", $data["code"])) $msgs = $this->set_msg($msgs, "code");
			else $msgs = $this->set_msg($msgs, "code", "e_code_exists");
		}else $msgs = $this->set_msg($msgs, "code", "e_required_field");	
		
		$msgs = $this->check_blank($data, ["module_id"], $msgs);
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function delete_access($data){
		$type = "error"; $msg = "";
		
		if ($data["access_id"]) $type = "success";
		else $msg = $this->CI->lang->line("e_unknown_refresh");
		
		return ["type" => $type, "msg" => $msg];
	}
	
	public function add_role($data){
		$msgs = []; $msg = "";
		
		if ($data["role"]){
			if (!$this->CI->gm->unique("role", "role", $data["role"])) $msgs = $this->set_msg($msgs, "role");
			else $msgs = $this->set_msg($msgs, "role", "e_role_exists");
		}else $msgs = $this->set_msg($msgs, "role", "e_required_field");	
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
}