<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["authentication", "account"];
		$this->js_init = "authentication/account.js";
	}

	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$params = [
			"page" => $this->input->get("page"),
			"rid" => $this->input->get("rid"),//role_id
			"u" => $this->input->get("u"),//username
			"n" => $this->input->get("n"),//name
		];
		if (!$params["page"]) $params["page"] = 1;
		
		$w = $l = $w_in = [];
		if ($params["rid"]) $w["role_id"] = $params["rid"];
		if ($params["u"]) $l[] = ["field" => "username", "values" => explode(" ", $params["u"])];
		if ($params["n"]) $l[] = ["field" => "name", "values" => explode(" ", $params["n"])];
		
		$accounts = $this->gm->filter("account", $w, $l, $w_in, [["username", "asc"]], 25, 25 * ($params["page"] - 1), false);
		foreach($accounts as $a){
			$a->role = $this->gm->unique("role", "role_id", $a->role_id)->role;
			if ($a->valid) $a->color = "success"; else $a->color = "danger";
		}
		
		$data = [
			"is_filtered" => ($w or $l or $w_in),
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("account", $w, $l, $w_in)),
			"accounts" => $accounts,
			"roles" => $this->gm->all("role", [["role", "asc"]]),
			"main" => "authentication/account/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"roles" => $this->gm->all("role", [["role", "asc"]]),
			"main" => "authentication/account/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_account($data);
			
			if ($result["type"] === "success"){
				unset($data["password_confirm"]);
				$data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);
				$data["updated_at"] = $data["registed_at"] = date("Y-m-d H:i:s");
				
				$result["account_id"] = $this->gm->insert("account", $data);
				$result["msg"] = $this->lang->line("s_account_insert");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function detail($account_id){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$account = $this->gm->unique("account", "account_id", $account_id, false);
		$account->role = $this->gm->unique("role", "role_id", $account->role_id)->role;
		
		if ($account->image){
			if (!file_exists("uploads/account/".$account->image)) $account->image = "no_img.png";
		}else $account->image = "no_img.png";
		
		$data = [
			"roles" => $this->gm->all("role", [["role", "asc"]]),
			"account" => $account,
			"main" => "authentication/account/detail",
		];
		$this->load->view('layout', $data);
	}
	
	public function update(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->update_account($data);
			
			if ($result["type"] === "success"){
				$data["updated_at"] = date("Y-m-d H:i:s");
				$this->gm->update("account", ["account_id" => $data["account_id"]], $data);
				$result["account_id"] = $data["account_id"];
				$result["msg"] = $this->lang->line("s_account_update");
			}
		}else $result = ["type" => "error", "msgs" => [], "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function update_image(){
		$result = ["type" => "error", "msg" => null];
		
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			$data["image"] = $_FILES["image"]["name"];
			
			$this->load->library('my_val');
			$result = $this->my_val->add_image($data);
			
			if ($result["type"] === "success"){
				$account = $this->gm->unique("account", "account_id", $data["account_id"], false);
				
				$path = './uploads/account/';
				if (!is_dir($path)) mkdir($path, 0777, true);
				
				//removing uploaded files
				if ($account->image)
					if (file_exists($path.$account->image)) 
						unlink($path.$account->image);
				
				$config['upload_path'] = $path;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['file_name'] = $account->doc_number."_".date("YmdHis");
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('image')){
					$upload_data = $this->upload->data();
					$this->my_func->image_resize($path, $upload_data, 1300, 1300);
					
					$data["image"] = $upload_data['file_name'];
					$this->gm->update("account", ["account_id" => $account->account_id], $data);
					
					$result["msg"] = $this->lang->line("s_account_update");
					$result["url"] = base_url()."authentication/account/detail/".$account->account_id;
				}else $result = ["type" => "error", "msg" => $this->upload->display_errors()];
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function update_password(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->update_password($data);
			
			if ($result["type"] === "success"){
				$aux_data = [
					"password" => password_hash($data["password"], PASSWORD_BCRYPT),
					"updated_at" => date("Y-m-d H:i:s"),
				];
				
				$this->gm->update("account", ["account_id" => $data["account_id"]], $aux_data);
				$result["account_id"] = $data["account_id"];
				$result["msg"] = $this->lang->line("s_account_update");
			}
		}else $result = ["type" => "error", "msgs" => [], "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function deactivate(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			$data["is_confirmed"] = $this->input->post("is_confirmed");
			
			$this->load->library('my_val');
			$result = $this->my_val->deactivate_account($data);
			
			if ($result["type"] === "success"){
				$aux_data = [
					"valid" => false,
					"updated_at" => date("Y-m-d H:i:s"),
				];
				
				$this->gm->update("account", ["account_id" => $data["account_id"]], $aux_data);
				$result["account_id"] = $data["account_id"];
				$result["msg"] = $this->lang->line("s_account_deactivate");
			}
		}else $result = ["type" => "error", "msgs" => [], "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function activate(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			$data["is_confirmed"] = $this->input->post("is_confirmed");
			
			$this->load->library('my_val');
			$result = $this->my_val->activate_account($data);
			
			if ($result["type"] === "success"){
				$aux_data = [
					"valid" => true,
					"updated_at" => date("Y-m-d H:i:s"),
				];
				
				$this->gm->update("account", ["account_id" => $data["account_id"]], $aux_data);
				$result["account_id"] = $data["account_id"];
				$result["msg"] = $this->lang->line("s_account_deactivate");
			}
		}else $result = ["type" => "error", "msgs" => [], "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	/* public function generate(){
		$names = [
			"Alice", "Bob", "Charlie", "David", "Emily", "Frank", "Grace", "Henry", "Isabella",
			"Jack", "Katherine", "Liam", "Mia", "Noah", "Olivia", "Penelope", "Quinn", "Ryan",
			"Sophia", "Thomas", "Uma", "Victoria", "William", "Xander", "Yasmine", "Zachary",
			"Ava", "Benjamin", "Chloe", "Daniel", "Emma"
		];
		
		$surnames = [
			"Smith", "Johnson", "Williams", "Brown", "Jones", "Miller", "Davis", "Garcia", "Rodriguez",
			"Martinez", "Hernandez", "Lopez", "Gonzalez", "Perez", "Wilson", "Anderson", "Thomas", "Lee",
			"Moore", "Jackson", "White", "Harris", "Martin", "Thompson", "Garcia", "Young", "Hall", "King",
			"Scott", "Morris", "Turner"
		];
		
		$roles = $this->gm->all("role");
		foreach($surnames as $s){
			foreach($names as $n){
				$now = date("Y-m-d H:i:s");
				$data = [
					"role_id" => $roles[array_rand($roles)]->role_id,
					"name" => $s." ".$n,
					"username" => strtolower($s.".".$n)."@gmail.com",
					"password" => password_hash($n, PASSWORD_BCRYPT),
					"updated_at" => $now,
					"registed_at" => $now,
				];
				
				$this->gm->insert("account", $data);
			}	
		}
	} */
}
