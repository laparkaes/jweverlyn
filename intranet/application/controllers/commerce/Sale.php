<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["commerce", "sale"];
		$this->js_init = "commerce/sale.js";
	}
	
	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$params = [
			"page" => $this->input->get("page"),
			"from" => $this->input->get("from"),
			"to" => $this->input->get("to"),
			"client" => $this->input->get("client"),
		];
		if (!$params["page"]) $params["page"] = 1;
		$w = $l = $w_in = [];
	
		if (!$params["to"]) $params["to"] = Date("Y-m-d");
		$w["registed_at <"] = Date("Y-m-d", strtotime("+1 day", strtotime($params["to"])));
		
		if (!$params["from"]) $params["from"] = Date("Y-m-d", strtotime("-1 months", strtotime($params["to"])));
		$w["registed_at >="] = $params["from"];

		if ($params["client"]){
			$client_ids = [-1];
			$clients = $this->gm->filter("client", null, ["name" => $params["client"]]);
			if ($clients) foreach($clients as $c) $client_ids[] = $c->client_id;
			
			$w_in[] = ["field" => "client_id", "values" => $client_ids];
		}
		
		$sales = $this->gm->filter("sale", $w, $l, $w_in, [["registed_at", "desc"]], 25, 25 * ($params["page"] - 1), false);
		foreach($sales as $s){
			if ($s->client_id) $s->client = $this->gm->unique("client", "client_id", $s->client_id)->name;
			else $s->client = "";
			if ($s->balance) $s->color = "warning"; else $s->color = "success";
		}
		
		$data = [
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("sale", $w, $l, $w_in)),
			"sales" => $sales,
			"main" => "commerce/sale/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($sale_id){
		if (!$this->session->userdata('username')) redirect("auth/login");

		$sale = $this->gm->unique("sale", "sale_id", $sale_id);
		if ($sale->client_id){
			$client = $this->gm->unique("client", "client_id", $sale->client_id);
			$client->doc_type = $this->gm->unique("identification_document", "identification_document_id", $client->doc_type_id, false)->identification_document;
		}else $client = null;
		
		if ($sale->valid){
			if ($sale->balance) $sale->color = "warning"; else $sale->color = "success";
		}else $sale->color = "danger";
		
		switch($sale->color){
			case "success": $sale->status = "Finalizado"; break;
			case "warning": $sale->status = "Pendiente"; break;
			case "danger": $sale->status = "Cancelado"; break;
		}
		
		$payments = $this->gm->filter("sale_payment", ["sale_id" => $sale->sale_id], null, null, [["registed_at", "desc"]], "", "", false);
		$products = $this->gm->filter("sale_product", ["sale_id" => $sale->sale_id], null, null, [["subtotal", "desc"]], "", "", false);
		
		/*
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
		*/
		$data = [
			"sale" => $sale,
			"client" => $client,
			"payments" => $payments,
			"products" => $products,
			//"categories" => $this->gm->all("product_category", [["category", "asc"]]),
			"main" => "commerce/sale/detail",
		];
		$this->load->view('layout', $data);
	}
	
	public function search_product(){
		$type = "error"; $msg = ""; $products = [];
		$keyword = $this->input->post("keyword");
		
		if ($keyword){
			$products_rec = $this->gm->filter_like("product", "product", $keyword, "", "", $check_valid = true);
			if ($products_rec){
				$categories = [];
				$categories_rec = $this->gm->all("product_category", [], "", "", true);
				foreach($categories_rec as $c) $categories[$c->category_id] = $c->category;
				
				$products = [];
				foreach($products_rec as $p) $products[] = ["product_id" => $p->product_id, "category" => $categories[$p->category_id], "product" => $p->product, "price" => number_format($p->price, 2), "code" => $p->code];
				
				$type = "success";
			}else $msg = $this->lang->line("e_no_result");
		}else $msg = $this->lang->line("e_enter_keyword");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "products" => $products]);
	}
	
	public function load_product(){
		$product = $this->gm->unique("product", "product_id", $this->input->post("product_id"));
		$product->category = $this->gm->unique("product_category", "category_id", $product->category_id)->category;
		
		$options = $this->gm->filter("product_option", ["product_id" => $product->product_id], null, null, [["option_id", "asc"]]);
		
		header('Content-Type: application/json');
		echo json_encode(["product" => $product, "options" => $options]);
	}
	
	public function search_person(){
		$type = "error"; $msg = ""; $person = null;
		$data = $this->input->post();
		
		if ($data["doc_number"]){
			$person = $this->gm->filter("client", $data);
			if (!$person){
				$name = "";
				switch($data["doc_type_id"]){
					case 2: //dni
						$aux = $this->my_func->utildatos("dni", $data["doc_number"]);
						if ($aux->status) $name = $aux->data->nombres." ".$aux->data->apellidoPaterno." ".$aux->data->apellidoMaterno;
						break;
					case 4: //ruc
						$aux = $this->my_func->utildatos("ruc", $data["doc_number"]);
						if ($aux->status) $name = $aux->data->razon_social;
						break;
				}
				
				$person = $this->gm->structure("client");
				if ($name){
					$person->doc_type_id = $data["doc_type_id"];
					$person->doc_number = $data["doc_number"];
					$person->name = $name;
				}
			}
			
			if ($person->name) $type = "success";
			else $msg = $this->lang->line("e_no_result");
		}else $msg = $this->lang->line("e_doc_number_enter");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "person" => $person]);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"payment_methods" => $this->gm->all_simple("payment_method", "payment_method_id", "asc"),
			"ident_documents" => $this->gm->all_simple("identification_document", "identification_document_id", "asc"),
			"main" => "commerce/sale/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add_sale(){
		$type = "error"; $msg = null;
		
		if ($this->session->userdata('username')){
			$products = $this->input->post("products");
			$payment = $this->input->post("payment");
			$client = $this->input->post("client");	
			
			$this->load->library('my_val');
			$result = $this->my_val->add_sale($products, $payment, $client);
			
			if ($result["type"] === "success"){
				$now = date("Y-m-d H:i:s");
				
				//client process
				if ($client["doc_type_id"] == 1) $client_id = null; //case of no client document
				else{
					$client_rec = $this->gm->filter("client", $client);
					if ($client_rec) $client_id = $client_rec[0]->client_id;
					else{
						$client["valid"] = true;
						$client["updated_at"] = $client["registed_at"] = $now;	
						$client_id = $this->gm->insert("client", $client);
					}
				}
				
				//sale process
				$sale = [
					"client_id" => $client_id,
					"updated_at" => $now,
					"registed_at" => $now,
				];
				
				$amount = 0;
				foreach($products as $i => $p){
					$prod = $this->gm->unique("product", "product_id", $p["product_id"]);
					$products[$i]["price"] = $prod->price;
					$products[$i]["subtotal"] = $prod->price * $products[$i]["qty"];
					$amount += $products[$i]["subtotal"];
				}
				
				$sale["amount"] = $amount;
				$sale["paid"] = $payment["received"] - $payment["change"];
				$sale["balance"] = $sale["amount"] - $sale["paid"];
				$sale_id = $this->gm->insert("sale", $sale);
				
				//payment process
				unset($payment["received_txt"]);
				$payment["sale_id"] = $sale_id;
				$payment["registed_at"] = $now;
				$this->gm->insert("sale_payment", $payment);
				
				//products process
				foreach($products as $p){
					$p["sale_id"] = $sale_id;
					$this->gm->insert("sale_product", $p);
					
					$option = $this->gm->unique("product_option", "option_id", $p["option_id"]);
					$this->gm->update("product_option", ["option_id" => $p["option_id"]], ["stock" => $option->stock - $p["qty"]]);
				}
				
				$result["sale_id"] = $sale_id;
				$result["msg"] = $this->lang->line("s_sale_insert");
			}
		}else $msg = $this->lang->line("e_finished_session");
		
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
