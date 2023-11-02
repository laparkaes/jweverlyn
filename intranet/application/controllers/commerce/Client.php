<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["commerce", "client"];
		$this->js_init = "commerce/client.js";
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
			$l["doc_number"] = $params["search"];
			$l["name"] = $params["search"];
		}else unset($params["search"]);
		
		$clients = $this->gm->filter("client", $w, $l, $w_in, [["registed_at", "desc"]], 25, 25 * ($params["page"] - 1), false);
		foreach($clients as $c){
			$c->thumb = base_url()."uploads/client/no_img.png";
			if ($c->image){
				$path = "uploads/client/".$c->image;
				if (file_exists($path)) $c->thumb = base_url().$path;
			}
		}
		
		$doc_types_arr = [];
		$doc_types = $this->gm->all_simple("client_doc_type", "sunat", "asc");
		foreach($doc_types as $dt) $doc_types_arr[$dt->doc_type_id] = $dt->short;
		
		$data = [
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("client", $w, $l, $w_in)),
			"clients" => $clients,
			"doc_types_arr" => $doc_types_arr,
			"main" => "commerce/client/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($client_id){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$client = $this->gm->unique("client", "client_id", $client_id);
		$client->doc_type = $this->gm->unique("client_doc_type", "doc_type_id", $client->doc_type_id, false)->short;
		
		$client->thumb = base_url()."uploads/prod/no_img.png";
		if ($client->image){
			$path = "uploads/client/".$client->image;
			if (file_exists($path)) $client->thumb = base_url().$path;
		}
		
		$sale_w = ["client_id" => $client_id];
		$data = [
			"client" => $client,
			"sales" => $this->gm->filter("sale", $sale_w, null, null, [["registed_at", "desc"]], 25, 0),
			"sales_paging" => $this->my_func->paging(1, $this->gm->qty("sale", $sale_w, null, null)),
			"main" => "commerce/client/detail",
		];
		
		$this->load->view('layout', $data);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"doc_types" =>$this->gm->all_simple("client_doc_type", "doc_type_id", "asc"),
			"main" => "commerce/client/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add_client(){
		$result = ["type" => "error", "msg" => null];
		
		if ($this->session->userdata('username')){
			$client = $this->input->post("client");
			
			$this->load->library('my_val');
			$result = $this->my_val->add_client($client);
			
			if ($result["type"] === "success"){
				$client_id = $this->gm->insert("client", $client);
				
				$result["msg"] = $this->lang->line("s_client_insert");
				$result["url"] = base_url()."commerce/client/detail/".$client_id;
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function search_client_ajax(){
		$type = "error"; $msg = ""; $person = null;
		$data = $this->input->post();
		
		if ($data["doc_number"]){
			$person = $this->gm->filter("client", $data);
			if ($person) $person = $person[0];
			else{
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
				$person->name = $name;
			}
			
			if ($person->name){
				$person->doc_type_id = $data["doc_type_id"];
				$person->doc_number = $data["doc_number"];
				
				$type = "success";
			}else $msg = $this->lang->line("e_no_result");
		}else $msg = $this->lang->line("e_doc_number_enter");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "person" => $person]);
	}
	
	///////////////////////////// will be tested
	
	
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
