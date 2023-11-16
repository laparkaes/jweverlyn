<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["stock", "product"];
		$this->js_init = "stock/product.js";
	}
	
	private function calculate_stock($product_id){
		$stock = 0;
		$options = $this->gm->filter("product_option", ["product_id" => $product_id], null, null, [["option_id", "asc"]]);
		foreach($options as $o){
			$stock += $o->stock;
			$o->stock = number_format($o->stock);
		}
		
		return ["stock" => number_format($stock), "options" => $options];
	}

	private function get_images($product_id){
		$path = base_url()."uploads/prod/";
		$images = $this->gm->filter("product_image", ["product_id" => $product_id], null, null, [["image", "desc"]]);
		foreach($images as $i){
			$filepath = $i->product_id."/".$i->image;
			if (file_exists("uploads/prod/".$filepath)) $i->image_path = $path.$filepath;
			else $i->image_path = $path."no_img.png";
		}
		
		return $images;
	}

	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$params = [
			"page" => $this->input->get("page"),
			"category" => $this->input->get("category"),
			"product" => $this->input->get("product"),
		];
		if (!$params["page"]) $params["page"] = 1;
		
		$w = $l = $w_in = [];
		if ($params["category"]) $w["category_id"] = $params["category"];
		if ($params["product"]) $l[] = ["field" => "product", "values" => explode(" ", $params["product"])];
		
		$f_op = ["valid" => true];
		$products = $this->gm->filter("product", $w, $l, $w_in, [["product", "asc"]], 25, 25 * ($params["page"] - 1));
		foreach($products as $p){
			if ($p->image) $p->image = $p->product_id."/".$p->image;
			else $p->image = "no_img.png";
			
			$f_op["product_id"] = $p->product_id;
			$p->stock = number_format($this->gm->sum("product_option", "stock", $f_op)->stock);
			$p->category = $this->gm->unique("product_category", "category_id", $p->category_id)->category;
			if ($p->valid) $p->color = "success"; else $p->color = "danger";
		}
		
		$data = [
			"is_filtered" => ($w or $l or $w_in),
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("product", $w, $l, $w_in)),
			"categories" => $this->gm->all("product_category", [["category", "asc"]]),
			"products" => $products,
			"main" => "stock/product/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($product_id){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$product = $this->gm->unique("product", "product_id", $product_id);
		$product->category = $this->gm->unique("product_category", "category_id", $product->category_id)->category;
		
		
		if ($product->image){
			$image_path = $product->product_id."/".$product->image;
			if (file_exists("uploads/prod/".$image_path)) $product->image = $image_path;
			else $product->image = "no_img.png";
		}else $product->image = "no_img.png";
		
		$op_aux = $this->calculate_stock($product_id);
		$options = $op_aux["options"];
		$product->stock = $op_aux["stock"];
		
		$data = [
			"product" => $product,
			"options" => $options,
			"images" => $this->get_images($product_id),
			"categories" => $this->gm->all("product_category", [["category", "asc"]]),
			"main" => "stock/product/detail",
		];
		$this->load->view('layout', $data);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"categories" => $this->gm->all("product_category", [["category", "asc"]]),
			"main" => "stock/product/register",
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
	
	/*
	public function generate($qty){
		$categories = $this->gm->all("product_category");
		$productNames = array("Manzana", "Banana", "Naranja", "Uvas", "Fresas", "Pera", "Pomelo", "Kiwi", "Melocotón", "Mango", "Cereza", "Ciruela", "Limón", "Sandía", "Aguacate", "Higo", "Papaya", "Guayaba", "Piña", "Fruta de la pasión", "Granada", "Moras", "Frambuesas", "Arándanos", "Mora", "Coco", "Coco rallado", "Dátiles", "Higos secos", "Nuez", "Avellana", "Almendra", "Castañas", "Cacahuetes", "Pistachos", "Anacardos", "Nuez de Brasil", "Macadamia", "Chirimoya", "Feijoa", "Nispero", "Caqui", "Guindas", "Uvas pasas", "Pasas", "Higos pasos", "Almendra confitada", "Miel", "Jalea", "Mermelada", "Compota", "Puré de fruta", "Canela", "Vainilla", "Chocolate", "Cacao", "Café", "Té", "Té verde", "Té negro", "Té de hierbas", "Cerveza", "Vino", "Ron", "Whisky", "Brandy", "Tequila", "Vodka", "Ginebra", "Cava", "Champán", "Sidra", "Vino tinto", "Vino blanco", "Vino rosado", "Cava rosado", "Cava blanco", "Cava tinto", "Agua", "Agua mineral", "Agua con gas", "Agua sin gas", "Refresco", "Cola", "Limonada", "Naranjada", "Tónica", "Zumo", "Zumo de naranja", "Zumo de manzana", "Zumo de uva", "Zumo de piña", "Zumo de pera", "Zumo de melocotón", "Zumo de ciruela", "Zumo de fresa", "Zumo de fruta de la pasión", "Zumo de mango", "Zumo de guayaba", "Zumo de limón", "Zumo de sandía", "Zumo de pomelo", "Zumo de kiwi", "Zumo de granada", "Zumo de papaya", "Zumo de mora", "Zumo de frambuesa", "Zumo de arándanos");
		
		for($i = 0; $i < $qty; $i++){
			$product = "";
			$j_end = rand(3, 6);
			for($j = 0; $j < $j_end; $j++) $product .= " ".$productNames[array_rand($productNames)];
			
			$now = date("Y-m-d H:i:s");
			
			$data = [
				"code" => str_replace(" ", "", strtolower($productNames[array_rand($productNames)]))."-".rand(1000,500000),
				"product" => trim($product),
				"price" => (rand(1000, 10000) / 100),
				"category_id" => $categories[array_rand($categories)]->category_id,
				"updated_at" => $now,
				"registed_at" => $now,
			];
			
			$this->gm->insert("product", $data);
		}
	}
	*/
	
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
				
				$op_aux = $this->calculate_stock($data["product_id"]);
				$result["stock"] = $op_aux["stock"];
				$result["options"] = $op_aux["options"];
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
				
				$op_aux = $this->calculate_stock($data["product_id"]);
				$result["stock"] = $op_aux["stock"];
				$result["options"] = $op_aux["options"];
				$result["msg"] = $this->lang->line("s_option_update");
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_option(){
		$type = "error"; $msg = null; $options = []; $stock = null;
		
		if ($this->session->userdata('username')){
			$option = $this->gm->unique("product_option", "option_id", $this->input->post("option_id"));
			if ($option){
				if (!$option->stock){
					if ($this->gm->update("product_option", ["option_id" => $option->option_id], ["valid" => false])){
						$op_aux = $this->calculate_stock($option->product_id);
						
						$stock = $op_aux["stock"];
						$options = $op_aux["options"];
						$type = "success";
						$msg = $this->lang->line("s_option_delete");
					}else $msg = $this->lang->line("e_internal_again");
				}else $msg = $this->lang->line("e_option_stock");
			}else $msg = $this->lang->line("e_unknown_refresh");
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "options" => $options, "stock" => $stock]);
	}
	
	public function add_image(){
		if ($this->session->userdata('username')){
			$data = $this->input->post();
			$data["image"] = $_FILES["image"]["name"];
			
			$this->load->library('my_val');
			$result = $this->my_val->add_image($data);
			
			if ($result["type"] === "success"){
				$path = './uploads/prod/'.$data["product_id"]."/";
				if (!is_dir($path)) mkdir($path, 0777, true);
				
				$config['upload_path'] = $path;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['file_name'] = date("YmdHis");
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('image')){
					$upload_data = $this->upload->data();
					$this->my_func->image_resize($path, $upload_data, 1300, 1300);
					
					//insert new image record
					$data["image"] = $upload_data['file_name'];
					$this->gm->insert("product_image", $data);
					
					//update product main image if doesn't have image
					if (!$this->gm->unique("product", "product_id", $data["product_id"])->image){
						$this->gm->update("product", ["product_id" => $data["product_id"]], ["image" => $data["image"]]);
						$result["image"] = base_url()."uploads/prod/".$data["product_id"]."/".$data["image"];
					}
					
					$result["images"] = $this->get_images($data["product_id"]);
					$result["msg"] = $this->lang->line("s_image_insert");
				}else $result = ["type" => "error", "msg" => $this->upload->display_errors()];
			}
		}else $result = ["type" => "error", "msg" => $this->lang->line("e_finished_session")];
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function set_main_image(){
		$type = "error"; $msg = null; $img = "";
		
		if ($this->session->userdata('username')){
			$image = $this->gm->unique("product_image", "image_id", $this->input->post("image_id"));
			if ($image){
				if ($this->gm->update("product", ["product_id" => $image->product_id], ["image" => $image->image])){
					$img = base_url()."uploads/prod/".$image->product_id."/".$image->image;
					$type = "success";
					$msg = $this->lang->line("s_set_as_main_img");
				}else $msg = $this->lang->line("e_internal_again");
			}else $msg = $this->lang->line("e_unknown_refresh");
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "image" => $img]);
	}

	public function delete_image(){
		$type = "error"; $msg = null; $images = []; $img = base_url()."uploads/prod/no_img.png";
		
		if ($this->session->userdata('username')){
			$image = $this->gm->unique("product_image", "image_id", $this->input->post("image_id"));
			if ($image){
				if ($this->gm->update("product_image", ["image_id" => $image->image_id], ["valid" => false])){
					//removing uploaded files
					$path = "uploads/prod/".$image->product_id."/"; 
					if (file_exists($path.$image->image)) unlink($path.$image->image);//remove file on server
					
					//product main image validation
					$product = $this->gm->unique("product", "product_id", $image->product_id);
					if (file_exists($path.$product->image)) $img = base_url()."uploads/prod/".$product->product_id."/".$product->image;
					else $this->gm->update("product", ["product_id" => $image->product_id], ["image" => null]);
					
					$images = $this->get_images($image->product_id);
					$type = "success";
					$msg = $this->lang->line("s_option_delete");
				}else $msg = $this->lang->line("e_internal_again");
			}else $msg = $this->lang->line("e_unknown_refresh");
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "images" => $images, "image" => $img]);
	}
}
