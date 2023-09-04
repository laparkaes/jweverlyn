<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["commerce", "product"];
		$this->js_init = "commerce/product.js";
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
			$i->image_path = $path."no_img.png";
			if ($i->image){
				$aux = explode(".", $i->image);
				$filepath = $i->product_id."/".$aux[0]."_thumb.".$aux[1];
				if (file_exists("uploads/prod/".$filepath)){
					$img = $path.$filepath;
					$i->image_path = $path.$i->product_id."/".$i->image;
				}else $img = $path."no_img.png";
			}else $img = $path."no_img.png";
			$i->thumb = $img;
		}
		
		return $images;
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
			$l["product"] = $params["search"];
			
			$categories = $this->gm->filter("product_category", $w, ["category" => $params["search"]]);
			if ($categories){
				$cat_ids = [];
				foreach($categories as $c) $cat_ids[] = $c->category_id;
				$w_in[] = ["field" => "category_id", "values" => $cat_ids];	
			}
		}else unset($params["search"]);
		
		$products = $this->gm->filter("product", $w, $l, $w_in, [["product", "asc"]], 25, 25 * ($params["page"] - 1), false);
		foreach($products as $p){
			if ($p->image){
				$path = "uploads/prod/".$p->product_id."/".$p->image;
				if (file_exists($path)) $p->thumb = base_url().$path;
				else $p->thumb = base_url()."uploads/prod/no_img.png";
			}else $p->thumb = base_url()."uploads/prod/no_img.png";
			
			$p->category = $this->gm->unique("product_category", "category_id", $p->category_id)->category;
			$p->sold_qty = 0;
			if ($p->valid) $p->color = "success"; else $p->color = "danger";
		}
		
		$data = [
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("product", $w, $l, $w_in)),
			"products" => $products,
			"main" => "commerce/product/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($product_id){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$product = $this->gm->unique("product", "product_id", $product_id);
		$product->category = $this->gm->unique("product_category", "category_id", $product->category_id)->category;
		
		if ($product->image){
			$path = "uploads/prod/".$product->product_id."/".$product->image;
			if (file_exists($path)) $product->thumb = base_url().$path;
			else $product->thumb = base_url()."uploads/prod/no_img.png";
		}else $product->thumb = base_url()."uploads/prod/no_img.png";
		
		
		$op_aux = $this->calculate_stock($product_id);
		$options = $op_aux["options"];
		$product->stock = $op_aux["stock"];
		
		$data = [
			"product" => $product,
			"options" => $options,
			"images" => $this->get_images($product_id),
			"categories" => $this->gm->all("product_category", [["category", "asc"]]),
			"main" => "commerce/product/detail",
		];
		$this->load->view('layout', $data);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"categories" => $this->gm->all("product_category", [["category", "asc"]]),
			"main" => "commerce/product/register",
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
				if ($this->gm->update("product_option", ["option_id" => $option->option_id], ["valid" => false])){
					$op_aux = $this->calculate_stock($option->product_id);
					
					$stock = $op_aux["stock"];
					$options = $op_aux["options"];
					$type = "success";
					$msg = $this->lang->line("s_option_delete");
				}else $msg = $this->lang->line("e_internal_again");
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
					$filedata = array('upload_data' => $this->upload->data());
					$data["image"] = $filedata['upload_data']['file_name'];

					$this->load->library('image_lib');
					$config['image_library'] = 'gd2';
					$config['source_image'] = $path.$data["image"];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 300;
					$config['height'] = 300;

					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					
					$this->gm->insert("product_image", $data);
					if (!$this->gm->unique("product", "product_id", $data["product_id"])->image){
						$aux = explode(".", $data["image"]);
						$main_image = $aux[0]."_thumb.".$aux[1];
						$this->gm->update("product", ["product_id" => $data["product_id"]], ["image" => $main_image]);
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
		$type = "error"; $msg = null; $image = "";
		
		if ($this->session->userdata('username')){
			$image = $this->gm->unique("product_image", "image_id", $this->input->post("image_id"));
			if ($image){
				$aux = explode(".", $image->image);
				$main_image = $aux[0]."_thumb.".$aux[1];
				if ($this->gm->update("product", ["product_id" => $image->product_id], ["image" => $main_image])){
					$image = base_url()."uploads/prod/".$image->product_id."/".$main_image;
					$type = "success";
					$msg = $this->lang->line("s_option_delete");
				}else $msg = $this->lang->line("e_internal_again");
			}else $msg = $this->lang->line("e_unknown_refresh");
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "image" => $image]);
	}

	public function delete_image(){
		$type = "error"; $msg = null; $images = [];
		
		if ($this->session->userdata('username')){
			$image = $this->gm->unique("product_image", "image_id", $this->input->post("image_id"));
			if ($image){
				if ($this->gm->update("product_image", ["image_id" => $image->image_id], ["valid" => false])){
					$aux = explode(".", $image->image);
					$thumb = $aux[0]."_thumb.".$aux[1];
					
					//removing uploaded files
					$path = "uploads/prod/".$image->product_id."/"; 
					if (file_exists($path.$image->image)) unlink($path.$image->image);
					if (file_exists($path.$thumb)) unlink($path.$thumb);
					
					//product main image validation
					$product = $this->gm->unique("product", "product_id", $image->product_id);
					if (!file_exists($path.$product->image))
						$this->gm->update("product", ["product_id" => $image->product_id], ["image" => null]);
				
					$images = $this->get_images($image->product_id);
					$type = "success";
					$msg = $this->lang->line("s_option_delete");
				}else $msg = $this->lang->line("e_internal_again");
			}else $msg = $this->lang->line("e_unknown_refresh");
		}else $msg = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "images" => $images]);
	}
}
