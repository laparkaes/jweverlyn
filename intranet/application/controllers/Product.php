<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["products", ""];
		$this->js_init = "product.js";
	}

	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$params = [
			"page" => $this->input->get("page"),
			"search" => $this->input->get("search"),
		];
		if (!$params["page"]) $params["page"] = 1;
		
		$w = $l = $w_in = [];
		if ($params["search"]){
			
		}else unset($params["search"]);
		
		$products = $this->gm->filter("product", $w, $l, $w_in, [["product", "asc"]], 25, 25 * ($params["page"] - 1), false);
		foreach($products as $p){
			$p->category = $this->gm->unique("product_category", "category_id", $p->category_id)->category;
			$p->sold_qty = 0;
			if ($p->valid) $p->color = "success"; else $p->color = "danger";
		}
		
		$data = [
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("product", $w, $l, $w_in)),
			"products" => $products,
			"main" => "product/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($product_id){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$product = $this->gm->unique("product", "product_id", $product_id);
		$product->category = $this->gm->unique("product_category", "category_id", $product->category_id)->category;
		$product->stock = 0;
		
		$path = base_url()."uploaded/imgs/"; 
		if ($product->thumb){
			if (file_exists($path.$product->thumb)) $img = $path.$product->thumb;
			else $img = $path."no_img.png";
		}else $img = $path."no_img.png";
		$product->img = $img;
		
		$options = $this->gm->filter("product_option", ["product_id" => $product_id], null, null, [["option", "asc"]]);
		foreach($options as $o) $product->stock += $o->stock;
		
		$data = [
			"product" => $product,
			"options" => $options,
			"categories" => $this->gm->all("product_category", [["category", "asc"]]),
			"main" => "product/detail",
		];
		$this->load->view('layout', $data);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"categories" => $this->gm->all("product_category", [["category", "asc"]]),
			"main" => "product/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_product($data);
			
			if ($result["type"] === "success"){
				$data["updated_at"] = $data["registed_at"] = date("Y-m-d H:i:s");
				
				$result["product_id"] = $this->gm->insert("product", $data);
				$result["msg"] = $this->lang->line("s_product_insert");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function update(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->update_product($data);
			
			if ($result["type"] === "success"){
				$data["updated_at"] = date("Y-m-d H:i:s");
				
				$this->gm->update("product", ["product_id" => $data["product_id"]], $data);
				$result["product_id"] = $data["product_id"];
				$result["msg"] = $this->lang->line("s_product_update");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function add_category(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_category($data);
			
			if ($result["type"] === "success"){
				$this->gm->insert("product_category", $data);
				$result["msg"] = $this->lang->line("s_category_insert");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_category(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->delete_category($data);
			
			if ($result["type"] === "success"){
				$this->gm->update("product_category", $data, ["valid" => false]);
				$result["msg"] = $this->lang->line("s_category_delete");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function move_category(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->move_category($data);
			
			if ($result["type"] === "success"){
				$this->gm->update("product", ["category_id" => $data["from_id"]], ["category_id" => $data["to_id"]]);
				$result["msg"] = $this->lang->line("s_category_move");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function add_option(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_option($data);
			
			if ($result["type"] === "success"){
				$this->gm->insert("product_option", $data);
				
				$result["product_id"] = $data["product_id"];
				$result["msg"] = $this->lang->line("s_option_insert");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function load_option(){
		if ($this->session->userdata('username')){
			$result = [
				"type" => "success",
				"option" => $this->gm->unique("product_option", "option_id", $this->input->post("option_id")),
			];
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function update_option(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->update_option($data);
			
			if ($result["type"] === "success"){
				$this->gm->update("product_option", ["option_id" => $data["option_id"]], $data);
				
				$result["product_id"] = $data["product_id"];
				$result["msg"] = $this->lang->line("s_option_update");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_option(){
		$type = "error"; $msg = $product_id = null;
		
		if ($this->session->userdata('username')){
			$option = $this->gm->unique("product_option", "option_id", $this->input->post("option_id"));
			if ($option){
				if ($this->gm->update("product_option", ["option_id" => $option->option_id], ["valid" => false])){
					$product_id = $option->product_id;
					$type = "success";
					$msg = $this->lang->line("s_option_delete");
				}else $msg = $this->lang->line("e_internal_again");
			}else $msg = $this->lang->line("e_unknown_refresh");
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "product_id" => $product_id]);
	}
	
	public function add_image(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			$data["image"] = $_FILES["image"]["name"];
			$data["type"] = $_FILES["image"]["type"];
			
			$this->load->library('my_val');
			$result = $this->my_val->add_image($data);
			
			if ($result["type"] === "success"){
				//$this->gm->insert("product_option", $data);
				
				$result["product_id"] = $data["product_id"];
				$result["msg"] = $this->lang->line("s_option_update");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}
