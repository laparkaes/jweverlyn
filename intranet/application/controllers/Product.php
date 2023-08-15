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
		
		$products = [];
		
		$data = [
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("product", $w, $l, $w_in)),
			"products" => $products,
			"main" => "product/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($product_id){
		$product = $this->gm->unique("product", "product_id", $product_id);
		$product->category = $this->gm->unique("product_category", "category_id", $product->category_id)->category;
		$product->stock = 134375;
		
		$path = base_url()."uploaded/imgs/"; 
		if ($product->thumb){
			if (file_exists($path.$product->thumb)) $img = $path.$product->thumb;
			else $img = $path."no_img.png";
		}else $img = $path."no_img.png";
		$product->img = $img;
		
		$options = [];
		
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
			$result = $this->my_val->add_product($data);
			
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
	
	
}
