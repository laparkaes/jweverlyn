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
	
	public function add_category_inout($data){
		$msgs = $this->check_blank($data, ["type_id"], []);
		
		if ($data["category"]){
			if (!$this->CI->gm->filter("in_outcome_category", $data)){
				$msgs = $this->set_msg($msgs, "category");
			}else $msgs = $this->set_msg($msgs, "category", "e_category_exists");
		}else $msgs = $this->set_msg($msgs, "category", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs];
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
	
	public function delete_category_inout($data){
		$msgs = []; $msg = "";
		
		if ($data["category_id"]){
			if (!$this->CI->gm->filter("in_outcome", $data)){
				$msgs = $this->set_msg($msgs, "category_id");
			}else $msgs = $this->set_msg($msgs, "category_id", "e_category_include_inout");
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
		$msgs = $this->check_blank($data, ["category_id", "type_id", "product"], $msgs);
		
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
		$msgs = $this->check_blank($data, ["category_id", "type_id", "product"], $msgs);
		
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
			$f = ["product_id" => $data["product_id"], "option" => $data["option"]];
			if (!$this->CI->gm->filter("product_option", $f)){
				$msgs = $this->set_msg($msgs, "option");
			}else $msgs = $this->set_msg($msgs, "option", "e_duplicate_option");
		}else $msgs = $this->set_msg($msgs, "option", "e_required_field");
		/*
		if ($data["stock"]){
			if (filter_var($data["stock"], FILTER_VALIDATE_INT) !== false){
				if ($data["stock"] > 0){
					$msgs = $this->set_msg($msgs, "stock");
				}else $msgs = $this->set_msg($msgs, "stock", "e_numeric_positive");
			}else $msgs = $this->set_msg($msgs, "stock", "e_integer");
		}else $msgs = $this->set_msg($msgs, "stock", "e_required_field");
		*/
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function update_option($data){
		$msgs = []; $msg = "";
		
		if ($data["option"]){
			$op = $this->CI->gm->unique("product_option", "option_id", $data["option_id"]);
			
			$f = ["product_id" => $op->product_id, "option" => $data["option"]];
			if (!$this->CI->gm->filter("product_option", $f)){
				$msgs = $this->set_msg($msgs, "option");
			}else $msgs = $this->set_msg($msgs, "option", "e_duplicate_option");
		}else $msgs = $this->set_msg($msgs, "option", "e_required_field");
		/*
		if ($data["stock"]){
			if (filter_var($data["stock"], FILTER_VALIDATE_INT) !== false){
				if ($data["stock"] >= 0){
					$msgs = $this->set_msg($msgs, "stock");
				}else $msgs = $this->set_msg($msgs, "stock", "e_numeric_positive");
			}else $msgs = $this->set_msg($msgs, "stock", "e_integer");
		}else $msgs = $this->set_msg($msgs, "stock", "e_required_field");
		*/
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function add_image($data){
		$msgs = [];
		
		if ($data["image"]) $msgs = $this->set_msg($msgs, "image");
		else $msgs = $this->set_msg($msgs, "image", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs];
	}
	
	public function save_company_info($data){
		$msgs = []; $msg = "";
		
		if ($data["ruc"]) $msgs = $this->set_msg($msgs, "ruc");
		else $msgs = $this->set_msg($msgs, "ruc", "e_required_field");
		
		if ($data["company"]) $msgs = $this->set_msg($msgs, "company");
		else $msgs = $this->set_msg($msgs, "company", "e_required_field");
		
		if ($data["tel"]) $msgs = $this->set_msg($msgs, "tel");
		else $msgs = $this->set_msg($msgs, "tel", "e_required_field");
		
		if ($data["email"]) $msgs = $this->set_msg($msgs, "email");
		else $msgs = $this->set_msg($msgs, "email", "e_required_field");
		
		if ($data["address"]) $msgs = $this->set_msg($msgs, "address");
		else $msgs = $this->set_msg($msgs, "address", "e_required_field");
		
		if ($data["department_id"]) $msgs = $this->set_msg($msgs, "department_id");
		else $msgs = $this->set_msg($msgs, "department_id", "e_required_field");
		
		if ($data["province_id"]) $msgs = $this->set_msg($msgs, "province_id");
		else $msgs = $this->set_msg($msgs, "province_id", "e_required_field");
		
		if ($data["district_id"]) $msgs = $this->set_msg($msgs, "district_id");
		else $msgs = $this->set_msg($msgs, "district_id", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function add_sale($products, $payment, $client){
		$msgs = []; $msg = "";
		
		//product list validation
		if ($products){
			//merge duplicate product
			$prod_list = [];
			foreach($products as $p){
				$aux_key = $p["product_id"]."_".$p["option_id"];
				if (isset($prod_list[$aux_key])) $prod_list[$aux_key]["qty"] = $prod_list[$aux_key]["qty"] + $p["qty"];
				else $prod_list[$aux_key] = $p;
			}
			
			//stock validation
			$type_prod = $this->CI->gm->unique("product_type", "type", "Producto", false);
			foreach($prod_list as $p){
				$prod = $this->CI->gm->unique("product", "product_id", $p["product_id"]);
				if ($prod->type_id == $type_prod->type_id){//in case of a product type item
					$prod_op = $this->CI->gm->unique("product_option", "option_id", $p["option_id"]);
					if ($prod_op){
						if ($prod_op->stock < $p["qty"]) $msg = $this->CI->lang->line("e_product_no_stock").$prod->product.".";
					}else $msg = $this->CI->lang->line("e_product_invalid_option").$prod->product.".";	
				}
			}
		}else $msg = $this->CI->lang->line("e_select_product");
		
		//payment method validation
		$msgs = $this->set_msg($msgs, "payment[payment_method_id]"); //no validation required
		if ($payment["received"] > 0) $msgs = $this->set_msg($msgs, "payment[received_txt]");
		else $msgs = $this->set_msg($msgs, "payment[received_txt]", "e_invalid_payment");
		
		//client validation
		$msgs = $this->set_msg($msgs, "client[doc_type_id]"); //no validation required
		if ($client["doc_type_id"] != 1){
			if ($client["doc_number"]) $msgs = $this->set_msg($msgs, "client[doc_number]");
			else $msgs = $this->set_msg($msgs, "client[doc_number]", "e_required_field");
			
			if ($client["name"]) $msgs = $this->set_msg($msgs, "client[name]");
			else $msgs = $this->set_msg($msgs, "client[name]", "e_required_field");
		}
		
		$type = $this->get_type($msgs);
		if ($msg) $type = "error";
		
		return ["type" => $type, "msgs" => $msgs, "msg" => $msg];
	}
	
	public function add_payment($payment){
		$msgs = []; $msg = "";
		
		//payment validation
		$msgs = $this->set_msg($msgs, "payment_method_id"); //no validation required
		if ($payment["received"] > 0) $msgs = $this->set_msg($msgs, "received_txt");
		else $msgs = $this->set_msg($msgs, "received_txt", "e_invalid_payment");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function add_payment_purchase($payment){
		$msgs = []; $msg = "";
		
		//payment validation
		$msgs = $this->set_msg($msgs, "payment_method_id"); //no validation required
		if ($payment["paid"] >= 0) $msgs = $this->set_msg($msgs, "paid");
		else $msgs = $this->set_msg($msgs, "paid", "e_invalid_payment");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs, "msg" => $msg];
	}
	
	public function add_proforma($products, $client){
		$msgs = []; $msg = "";
		
		//product list validation
		if ($products){
			//merge duplicate product
			$prod_list = [];
			foreach($products as $p){
				$aux_key = $p["product_id"]."_".$p["option_id"];
				if (isset($prod_list[$aux_key])) $prod_list[$aux_key]["qty"] = $prod_list[$aux_key]["qty"] + $p["qty"];
				else $prod_list[$aux_key] = $p;
			}
			
			//stock validation
			foreach($prod_list as $p){
				$prod = $this->CI->gm->unique("product", "product_id", $p["product_id"]);
				$prod_op = $this->CI->gm->unique("product_option", "option_id", $p["option_id"]);
				if ($prod_op){
					if ($prod_op->stock < $p["qty"]) $msg = $this->CI->lang->line("e_product_no_stock").$prod->product.".";
				}else $msg = $this->CI->lang->line("e_product_invalid_option").$prod->product.".";
			}
		}else $msg = $this->CI->lang->line("e_select_product");
		
		//client validation
		$msgs = $this->set_msg($msgs, "client[doc_type_id]"); //no validation required
		if ($client["doc_type_id"] != 1){
			if ($client["doc_number"]) $msgs = $this->set_msg($msgs, "client[doc_number]");
			else $msgs = $this->set_msg($msgs, "client[doc_number]", "e_required_field");
			
			if ($client["name"]) $msgs = $this->set_msg($msgs, "client[name]");
			else $msgs = $this->set_msg($msgs, "client[name]", "e_required_field");
		}
		
		$type = $this->get_type($msgs);
		if ($msg) $type = "error";
		
		return ["type" => $type, "msgs" => $msgs, "msg" => $msg];
	}
	
	public function issue_invoice($invoice, $client){
		$msgs = [];
		
		$invoice_type = $this->CI->gm->unique("invoice_type", "type_id", $invoice["type_id"], false);
		if ($invoice_type->sunat == "01"){
			$doc_type = $this->CI->gm->unique("client_doc_type", "doc_type_id", $client["doc_type_id"], false);
			if ($doc_type->sunat !== "6") $msgs = $this->set_msg($msgs, "client[doc_type_id]", "e_doc_type_ruc");
		}
		
		if ($client["doc_type_id"] != 1){
			if ($client["doc_number"]) $msgs = $this->set_msg($msgs, "client[doc_number]");
			else $msgs = $this->set_msg($msgs, "client[doc_number]", "e_required_field");
			
			if ($client["name"]) $msgs = $this->set_msg($msgs, "client[name]");
			else $msgs = $this->set_msg($msgs, "client[name]", "e_required_field");
		}
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs];
	}
	
	public function add_sale_from_proforma($proforma_id, $payment){
		$msg = null; $msgs = [];
		
		if (!$proforma_id) $msg = $this->CI->lang->line("e_unknown_refresh");
		
		if ($payment){
			if ($payment["received"] > 0) $msgs = $this->set_msg($msgs, "payment[received_txt]");
			else $msgs = $this->set_msg($msgs, "payment[received_txt]", "e_invalid_payment");
		}else $msg = $this->CI->lang->line("e_unknown_refresh");
		
		$type = $this->get_type($msgs);
		if ($msg) $type = "error";
		
		return ["type" => $type, "msgs" => $msgs, "msg" => $msg];
	}
	
	public function add_client($client){
		$msgs = [];
		
		//client validation
		$msgs = $this->set_msg($msgs, "client[doc_type_id]"); //no validation required
		
		if ($client["doc_number"]){
			$f = [
				"doc_type_id" => $client["doc_type_id"],
				"doc_number" => $client["doc_number"],
			];
			if (!$this->CI->gm->filter("client", $f)) $msgs = $this->set_msg($msgs, "client[doc_number]");
			else $msgs = $this->set_msg($msgs, "client[doc_number]", "e_client_exists");
		}else $msgs = $this->set_msg($msgs, "client[doc_number]", "e_required_field");
		
		if ($client["name"]) $msgs = $this->set_msg($msgs, "client[name]");
		else $msgs = $this->set_msg($msgs, "client[name]", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs];
	}
	
	public function add_provider($provider){
		$msgs = [];
		
		//provider validation
		$msgs = $this->set_msg($msgs, "provider[doc_type_id]"); //no validation required
		
		if ($provider["doc_number"]){
			$f = [
				"doc_type_id" => $provider["doc_type_id"],
				"doc_number" => $provider["doc_number"],
			];
			if (!$this->CI->gm->filter("provider", $f)) $msgs = $this->set_msg($msgs, "provider[doc_number]");
			else $msgs = $this->set_msg($msgs, "provider[doc_number]", "e_provider_exists");
		}else $msgs = $this->set_msg($msgs, "provider[doc_number]", "e_required_field");
		
		if ($provider["name"]) $msgs = $this->set_msg($msgs, "provider[name]");
		else $msgs = $this->set_msg($msgs, "provider[name]", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs];
	}
	
	public function add_purchase($products, $payment, $provider){
		$msgs = []; $msg = null;
		
		//products
		if ($products){
			foreach($products as $p) if ($p["qty"] <= 0){
				$msg = $this->CI->lang->line("e_product_qty_zero");
				break;
			}
		}else $msg = $this->CI->lang->line("e_select_product");
		
		//payment
		$msgs = $this->set_msg($msgs, "payment[total]");
		$msgs = $this->set_msg($msgs, "payment[balance]");
		$msgs = $this->set_msg($msgs, "payment[payment_method_id]");
		if ($payment["paid"] > 0) $msgs = $this->set_msg($msgs, "payment[paid]");
		else $msgs = $this->set_msg($msgs, "payment[paid]", "e_no_zero");
		
		//provider
		$msgs = $this->set_msg($msgs, "provider[doc_type_id]");
		if ($provider["doc_type_id"] != 1){//doc_type == Sin documento
			if ($provider["doc_number"]) $msgs = $this->set_msg($msgs, "provider[doc_number]");
			else $msgs = $this->set_msg($msgs, "provider[doc_number]", "e_required_field");
			if ($provider["name"]) $msgs = $this->set_msg($msgs, "provider[name]");
			else $msgs = $this->set_msg($msgs, "provider[name]", "e_required_field");
		}else{
			$msgs = $this->set_msg($msgs, "provider[doc_number]");
			$msgs = $this->set_msg($msgs, "provider[name]");
		}
		
		$type = $this->get_type($msgs);
		if ($type === "error") $msg = $this->CI->lang->line("e_check_datas");
		elseif ($msg) $type = "error";
		
		return ["type" => $type, "msgs" => $msgs, "msg" => $msg];
	}

	public function add_note($note){
		$msgs = [];
		
		if ($note["note"]) $msgs = $this->set_msg($msgs, "note");
		else $msgs = $this->set_msg($msgs, "note", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs];
	}

	public function file_upload_purchase($data){
		$msgs = [];
		
		if ($data["description"]) $msgs = $this->set_msg($msgs, "description");
		else $msgs = $this->set_msg($msgs, "description", "e_required_field");
		
		if ($data["filename"]) $msgs = $this->set_msg($msgs, "upload");
		else $msgs = $this->set_msg($msgs, "upload", "e_required_field");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs];
	}

	public function add_person($person){
		$msgs = $this->check_blank($person, ["name"], []);
		return ["type" => $this->get_type($msgs), "msgs" => $msgs];
	}

	public function add_in_outcome($io){
		$msgs = $this->check_blank($io, ["date", "type_id", "category_id", "description"], []);
		
		if ($io["amount"] > 0) $msgs = $this->set_msg($msgs, "amount");
		else $msgs = $this->set_msg($msgs, "amount", "e_numeric_positive");
		
		return ["type" => $this->get_type($msgs), "msgs" => $msgs];
		
	}

	public function download_excel_balance($data){
		$msg = null;
		
		if (!$data["bp"]) $msg = $this->CI->lang->line("e_balance_period");
		if (!$data["bt"]) $msg = $this->CI->lang->line("e_balance_type");
		if ($msg) $type = "error"; else $type = "success";
		
		return ["type" => $type, "msg" => $msg];
	}
}