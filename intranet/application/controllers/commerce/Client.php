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
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "error") redirect($result["url"]);
		
		$params = [
			"page" => $this->input->get("page"),
			"client" => $this->input->get("client"),
			"doc" => $this->input->get("doc"),
		];
		if (!$params["page"]) $params["page"] = 1;
		
		$w = $l = $w_in = [];
		if ($params["client"]) $l[] = ["field" => "name", "values" => explode(" ", $params["client"])];
		if ($params["doc"]) $l[] = ["field" => "doc_number", "values" => [$params["doc"]]];
		
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
			"is_filtered" => ($w or $l or $w_in),
			"params" => $params,
			"paging" => $this->my_func->paging($params["page"], $this->gm->qty("client", $w, $l, $w_in)),
			"clients" => $clients,
			"doc_types_arr" => $doc_types_arr,
			"main" => "commerce/client/index",
		];
		$this->load->view('layout', $data);
	}
	
	public function detail($client_id){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "error") redirect($result["url"]);
		
		$client = $this->gm->unique("client", "client_id", $client_id);
		$client->doc_type = $this->gm->unique("client_doc_type", "doc_type_id", $client->doc_type_id, false)->doc_type;
		
		if ($client->image){
			if (!file_exists("uploads/client/".$client->image)) $client->image = "no_img.png";
		}else $client->image = "no_img.png";
		
		$w = ["client_id" => $client_id, "valid" => true];
		$data = [
			"client" => $client,
			"sales" => $this->gm->filter("sale", $w, null, null, [["registed_at", "desc"]], 25, 0),
			"sales_paging" => $this->my_func->paging(1, $this->gm->qty("sale", $w, null, null)),
			"notes" => $this->gm->filter("client_note", $w, null, null, [["registed_at", "desc"]]),
			"main" => "commerce/client/detail",
		];
		
		$this->load->view('layout', $data);
	}
	
	public function register(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "error") redirect($result["url"]);
		
		$data = [
			"doc_types" =>$this->gm->all_simple("client_doc_type", "doc_type_id", "asc"),
			"main" => "commerce/client/register",
		];
		$this->load->view('layout', $data);
	}
	
	public function add(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$client = $this->input->post("client");
			
			$this->load->library('my_val');
			$result = $this->my_val->add_client($client);
			
			if ($result["type"] === "success"){
				$client["registed_at"] = $client["updated_at"] = date("Y-m-d H:i:s");
				$client_id = $this->gm->insert("client", $client);
				
				$result["msg"] = $this->lang->line("s_client_insert");
				$result["url"] = base_url()."commerce/client/detail/".$client_id;
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function update_data(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$client = $this->input->post();
			$client["updated_at"] = date("Y-m-d H:i:s");
			
			//no validation required
			$this->gm->update("client", ["client_id" => $client["client_id"]], $client);
			
			$result["type"] = "success";
			$result["msg"] = $this->lang->line("s_client_update");
			$result["url"] = base_url()."commerce/client/detail/".$client["client_id"];
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function update_image(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$data = $this->input->post();
			$data["image"] = $_FILES["image"]["name"];
			
			$this->load->library('my_val');
			$result = $this->my_val->add_image($data);
			
			if ($result["type"] === "success"){
				$client = $this->gm->unique("client", "client_id", $data["client_id"]);
				
				$path = './uploads/client/';
				if (!is_dir($path)) mkdir($path, 0777, true);
				
				//removing uploaded files
				if ($client->image)
					if (file_exists($path.$client->image)) 
						unlink($path.$client->image);
				
				$config['upload_path'] = $path;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['file_name'] = $client->doc_type_id."_".$client->doc_number."_".date("YmdHis");
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('image')){
					$upload_data = $this->upload->data();
					$this->my_func->image_resize($path, $upload_data, 1300, 1300);
					
					$data["image"] = $upload_data['file_name'];
					$this->gm->update("client", ["client_id" => $client->client_id], $data);
					
					$result["msg"] = $this->lang->line("s_client_update");
					$result["url"] = base_url()."commerce/client/detail/".$client->client_id;
				}else $result = ["type" => "error", "msg" => $this->upload->display_errors()];
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function add_note(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$note = $this->input->post();
			
			$this->load->library('my_val');
			$result = $this->my_val->add_note($note);
			
			if ($result["type"] === "success"){
				$note["note"] = trim($note["note"]);
				$note["registed_at"] = date("Y-m-d H:i:s");
				$this->gm->insert("client_note", $note);
				
				$result["msg"] = $this->lang->line("s_note_insert");
				$result["url"] = base_url()."commerce/client/detail/".$note["client_id"];
			}else $result["msg"] = $this->lang->line("e_check_datas");
		}else $result["url"] = null;
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function delete_note(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
			$note = $this->gm->unique("client_note", "note_id", $this->input->post('note_id'));
			
			$this->gm->update("client_note", ["note_id" => $note->note_id], ["valid" => false]);
			
			$result["msg"] = $this->lang->line("s_note_delete");
			$result["url"] = base_url()."commerce/client/detail/".$note->client_id;
		}else $result["url"] = null;
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function search_client_ajax(){
		$result = $this->my_func->check_access($this->nav_menu, $this->router->fetch_method());
		if ($result["type"] === "success"){
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
					
					$result["person"] = $person;
				}else $result["msg"] = $this->lang->line("e_no_result");
			}else $result["msg"] = $this->lang->line("e_doc_number_enter");
		}else $result["person"] = null;
			
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "person" => $person]);
	}

	/*public function methods(){
		$cl = $this->router->fetch_class();
		$aux = get_class_methods($this);
		
		$no_class = ["__construct", "methods", "get_instance"];
		foreach($aux as $a) if (!in_array($a, $no_class)) echo $cl."_".$a."<br/>";
	}*/
}