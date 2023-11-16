<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provider extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["stock", "provider"];
		$this->js_init = "stock/provider.js";
	}
	
	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$params = [
			"page" => $this->input->get("page"),
			"provider" => $this->input->get("provider"),
			"doc" => $this->input->get("doc"),
		];
		if (!$params["page"]) $params["page"] = 1;
		
		$w = $l = $w_in = [];
		if ($params["provider"]) $l[] = ["field" => "name", "values" => explode(" ", $params["provider"])];
		if ($params["doc"]) $l[] = ["field" => "doc_number", "values" => [$params["doc"]]];
		
		$providers = $this->gm->filter("provider", $w, $l, $w_in, [["registed_at", "desc"]], 25, 25 * ($params["page"] - 1), false);
		foreach($providers as $c){
			$c->thumb = base_url()."uploads/provider/no_img.png";
			if ($c->image){
				$path = "uploads/provider/".$c->image;
				if (file_exists($path)) $c->thumb = base_url().$path;
			}
		}
		
		$doc_types_arr = [];
		$doc_types = $this->gm->all_simple("provider_doc_type", "sunat", "asc");
		foreach($doc_types as $dt) $doc_types_arr[$dt->doc_type_id] = $dt->short;
		
		$data = [
			"is_filtered" => ($w or $l or $w_in),
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("provider", $w, $l, $w_in)),
			"providers" => $providers,
			"doc_types_arr" => $doc_types_arr,
			"main" => "stock/provider/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($provider_id){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$provider = $this->gm->unique("provider", "provider_id", $provider_id);
		$provider->doc_type = $this->gm->unique("provider_doc_type", "doc_type_id", $provider->doc_type_id, false)->short;
		
		if ($provider->image){
			if (!file_exists("uploads/provider/".$provider->image)) $provider->image = "no_img.png";
		}else $provider->image = "no_img.png";
		
		$purchase_w = ["provider_id" => $provider_id];
		$data = [
			"provider" => $provider,
			"purchases" => $this->gm->filter("purchase", $purchase_w, null, null, [["registed_at", "desc"]], 25, 0),
			"purchases_paging" => $this->my_func->paging(1, $this->gm->qty("purchase", $purchase_w, null, null)),
			"main" => "stock/provider/detail",
		];
		
		$this->load->view('layout', $data);
	}
	
	public function register(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"doc_types" =>$this->gm->all_simple("provider_doc_type", "doc_type_id", "asc"),
			"main" => "stock/provider/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add(){
		$result = ["type" => "error", "msg" => null];
		
		if ($this->session->userdata('username')){
			$provider = $this->input->post("provider");
			
			$this->load->library('my_val');
			$result = $this->my_val->add_provider($provider);
			
			if ($result["type"] === "success"){
				$provider["registed_at"] = $provider["updated_at"] = date("Y-m-d H:i:s");
				$provider_id = $this->gm->insert("provider", $provider);
				
				$result["msg"] = $this->lang->line("s_provider_insert");
				$result["url"] = base_url()."stock/provider/detail/".$provider_id;
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function update_data(){
		$result = ["type" => "error", "msg" => null];
		
		if ($this->session->userdata('username')){
			$provider = $this->input->post();
			$provider["updated_at"] = date("Y-m-d H:i:s");
			
			//no validation required
			$this->gm->update("provider", ["provider_id" => $provider["provider_id"]], $provider);
			
			$result["type"] = "success";
			$result["msg"] = $this->lang->line("s_provider_update");
			$result["url"] = base_url()."stock/provider/detail/".$provider["provider_id"];
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
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
				$provider = $this->gm->unique("provider", "provider_id", $data["provider_id"]);
				
				$path = './uploads/provider/';
				if (!is_dir($path)) mkdir($path, 0777, true);
				
				//removing uploaded files
				if ($provider->image)
					if (file_exists($path.$provider->image)) 
						unlink($path.$provider->image);
				
				$config['upload_path'] = $path;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['file_name'] = $provider->doc_type_id."_".$provider->doc_number."_".date("YmdHis");
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('image')){
					$upload_data = $this->upload->data();
					$this->my_func->image_resize($path, $upload_data, 1300, 1300);
					
					$data["image"] = $upload_data['file_name'];
					$this->gm->update("provider", ["provider_id" => $provider->provider_id], $data);
					
					$result["msg"] = $this->lang->line("s_provider_update");
					$result["url"] = base_url()."stock/provider/detail/".$provider->provider_id;
				}else $result = ["type" => "error", "msg" => $this->upload->display_errors()];
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}else $result["msg"] = $this->lang->line("e_finished_session");
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function search_provider_ajax(){
		$type = "error"; $msg = ""; $person = null;
		$data = $this->input->post();
		
		if ($data["doc_number"]){
			$person = $this->gm->filter("provider", $data);
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
				
				$person = $this->gm->structure("provider");
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
}