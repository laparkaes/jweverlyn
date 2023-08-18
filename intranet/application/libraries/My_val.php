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
		$msgs = $this->check_blank($data, ["module_id"], $msgs);
		
		if ($data["access"]){
			if (!$this->CI->gm->unique("access", "access", $data["access"])) $msgs = $this->set_msg($msgs, "access");
			else $msgs = $this->set_msg($msgs, "access", "e_access_exists");
		}else $msgs = $this->set_msg($msgs, "access", "e_required_field");
		
		if ($data["code"]){
			if (!$this->CI->gm->unique("access", "code", $data["code"])) $msgs = $this->set_msg($msgs, "code");
			else $msgs = $this->set_msg($msgs, "code", "e_code_exists");
		}else $msgs = $this->set_msg($msgs, "code", "e_required_field");	
		
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
	
	public function delete_role($data){
		$type = "error"; $msg = "";
		
		if ($data["role_id"]){
			if (!$this->CI->gm->unique("account", "role_id", $data["role_id"])) $type = "success";
			else $msg = $this->CI->lang->line("e_role_linked_account");
		}else $msg = $this->CI->lang->line("e_unknown_refresh");
		
		return ["type" => $type, "msg" => $msg];
	}
	
	public function update_role($data){
		$type = "error"; $msgs = []; $msg = "";
		
		if (!$data["role_id"]) $msg = $this->CI->lang->line("e_unknown_refresh");
		
		if ($data["role"]){
			$role = $this->CI->gm->unique("role", "role", $data["role"]);
			if ((!$role) or ($role->role_id == $data["role_id"])) $msgs = $this->set_msg($msgs, "role");
			else $msgs = $this->set_msg($msgs, "role", "e_role_exists");
		}else $msgs = $this->set_msg($msgs, "role", "e_required_field");
		
		if (!$msg) $type = $this->get_type($msgs);
		
		return ["type" => $type, "msgs" => $msgs, "msg" => $msg];
	}
	
	public function add_account($data){
		$msgs = []; $msg = "";
		$msgs = $this->check_blank($data, ["role_id", "name"], $msgs);
		
		if ($data["username"]){
			if (filter_var($data["username"], FILTER_VALIDATE_EMAIL)){
				if (!$this->CI->gm->unique("account", "username", $data["username"])) 
					$msgs = $this->set_msg($msgs, "username");
				else $msgs = $this->set_msg($msgs, "username", "e_username_exists");
			}else $msgs = $this->set_msg($msgs, "username", "e_username_email");
		}else $msgs = $this->set_msg($msgs, "username", "e_required_field");
		
		if ($data["password"]){
			if (strlen($data["password"]) >= 6){
				$msgs = $this->set_msg($msgs, "password");
				if ($data["password_confirm"]){
					if ($data["password"] === $data["password_confirm"]){
						$msgs = $this->set_msg($msgs, "password_confirm");
					}else $msgs = $this->set_msg($msgs, "password_confirm", "e_password_confirm_wrong");
				}else $msgs = $this->set_msg($msgs, "password_confirm", "e_required_field");
			}else $msgs = $this->set_msg($msgs, "password", "e_password_length");
		}else $msgs = $this->set_msg($msgs, "password", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function update_account($data){
		$msgs = []; $msg = "";
		$msgs = $this->check_blank($data, ["role_id", "name"], $msgs);
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function update_password($data){
		$msgs = []; $msg = "";
		
		if ($data["password"]){
			if (strlen($data["password"]) >= 6){
				$msgs = $this->set_msg($msgs, "password");
				if ($data["password_confirm"]){
					if ($data["password"] === $data["password_confirm"]){
						$msgs = $this->set_msg($msgs, "password_confirm");
					}else $msgs = $this->set_msg($msgs, "password_confirm", "e_password_confirm_wrong");
				}else $msgs = $this->set_msg($msgs, "password_confirm", "e_required_field");
			}else $msgs = $this->set_msg($msgs, "password", "e_password_length");
		}else $msgs = $this->set_msg($msgs, "password", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function deactivate_account($data){
		$type = "error"; $msgs = []; $msg = "";
		
		if ($data["account_id"]){
			if ($data["is_confirmed"]){
				$account = $this->CI->gm->unique("account", "account_id", $data["account_id"]);
				if ($account->username !== $this->CI->session->userdata('username')) $type = "success";
				else $msg = $this->CI->lang->line("e_itself_deactivate_account");
			}else $msg = $this->CI->lang->line("e_confirm_deactivate_account");
		}else $msg = $this->CI->lang->line("e_unknown_refresh");
		
		return ["type" => $type, "msgs" => $msgs, "msg" => $msg];
	}
	
	public function activate_account($data){
		$type = "error"; $msgs = []; $msg = "";
		
		if ($data["account_id"]){
			if ($data["is_confirmed"]) $type = "success";
			else $msg = $this->CI->lang->line("e_confirm_activate_account");
		}else $msg = $this->CI->lang->line("e_unknown_refresh");
		
		return ["type" => $type, "msgs" => $msgs, "msg" => $msg];
	}
	
	public function add_category($data){
		$msgs = []; $msg = "";
		
		if ($data["category"]){
			if (!$this->CI->gm->unique("product_category", "category", $data["category"])){
				$msgs = $this->set_msg($msgs, "category");
			}else $msgs = $this->set_msg($msgs, "category", "e_category_exists");
		}else $msgs = $this->set_msg($msgs, "category", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	
	public function delete_category($data){
		$msgs = []; $msg = "";
		
		if ($data["category_id"]){
			if (!$this->CI->gm->filter("product", $data)){
				$msgs = $this->set_msg($msgs, "category_id");
			}else $msgs = $this->set_msg($msgs, "category_id", "e_category_include_products");
		}else $msgs = $this->set_msg($msgs, "category_id", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function move_category($data){
		$msgs = []; $msg = "";
		$msgs = $this->check_blank($data, ["from_id"], $msgs);
		
		if ($data["to_id"]){
			if ($data["from_id"] != $data["to_id"]){
				$msgs = $this->set_msg($msgs, "to_id");
			}else $msgs = $this->set_msg($msgs, "to_id", "e_diff_category");
		}else $msgs = $this->set_msg($msgs, "to_id", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function add_product($data){
		$msgs = []; $msg = "";
		$msgs = $this->check_blank($data, ["category_id", "product"], $msgs);
		
		if ($data["price"]){
			if (is_numeric($data["price"])){
				if ($data["price"] > 0){
					$msgs = $this->set_msg($msgs, "price");
				}else $msgs = $this->set_msg($msgs, "price", "e_numeric_positive");
			}else $msgs = $this->set_msg($msgs, "price", "e_numeric");
		}else $msgs = $this->set_msg($msgs, "price", "e_required_field");
		
		if ($data["code"]){
			if (!$this->CI->gm->unique("product", "code", $data["code"], false)){
				$msgs = $this->set_msg($msgs, "code");
			}else $msgs = $this->set_msg($msgs, "code", "e_duplicate_code");
		}else $msgs = $this->set_msg($msgs, "code", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function update_product($data){
		$msgs = []; $msg = "";
		$msgs = $this->check_blank($data, ["category_id", "product"], $msgs);
		
		if ($data["price"]){
			if (is_numeric($data["price"])){
				if ($data["price"] > 0){
					$msgs = $this->set_msg($msgs, "price");
				}else $msgs = $this->set_msg($msgs, "price", "e_numeric_positive");
			}else $msgs = $this->set_msg($msgs, "price", "e_numeric");
		}else $msgs = $this->set_msg($msgs, "price", "e_required_field");
		
		if ($data["code"]){
			$product = $this->CI->gm->unique("product", "code", $data["code"], false);
			if ($product) $aux = ($product->product_id == $data["product_id"]); else $aux = true;
			
			if ($aux){
				$msgs = $this->set_msg($msgs, "code");
			}else $msgs = $this->set_msg($msgs, "code", "e_duplicate_code");
		}else $msgs = $this->set_msg($msgs, "code", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function add_option($data){
		$msgs = []; $msg = "";
		
		if ($data["option"]){
			if (!$this->CI->gm->unique("product_option", "option", $data["option"])){
				$msgs = $this->set_msg($msgs, "option");
			}else $msgs = $this->set_msg($msgs, "option", "e_duplicate_option");
		}else $msgs = $this->set_msg($msgs, "option", "e_required_field");
		
		if ($data["stock"]){
			if (filter_var($data["stock"], FILTER_VALIDATE_INT) !== false){
				if ($data["stock"] > 0){
					$msgs = $this->set_msg($msgs, "stock");
				}else $msgs = $this->set_msg($msgs, "stock", "e_numeric_positive");
			}else $msgs = $this->set_msg($msgs, "stock", "e_integer");
		}else $msgs = $this->set_msg($msgs, "stock", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function update_option($data){
		$msgs = []; $msg = "";
		
		if ($data["option"]){
			$option = $this->CI->gm->unique("product_option", "option", $data["option"]);
			if ($option) $aux = ($option->option_id == $data["option_id"]); else $aux = true;
			
			if ($aux){
				$msgs = $this->set_msg($msgs, "option");
			}else $msgs = $this->set_msg($msgs, "option", "e_duplicate_option");
		}else $msgs = $this->set_msg($msgs, "option", "e_required_field");
		
		if ($data["stock"]){
			if (filter_var($data["stock"], FILTER_VALIDATE_INT) !== false){
				if ($data["stock"] >= 0){
					$msgs = $this->set_msg($msgs, "stock");
				}else $msgs = $this->set_msg($msgs, "stock", "e_numeric_positive");
			}else $msgs = $this->set_msg($msgs, "stock", "e_integer");
		}else $msgs = $this->set_msg($msgs, "stock", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function add_image($data){
		$msgs = []; $msg = "";
		
		if ($data["image"]){
			$msgs = $this->set_msg($msgs, "image");
		}else $msgs = $this->set_msg($msgs, "image", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
}