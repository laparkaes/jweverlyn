<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["setting", "company"];
		$this->js_init = "setting/company.js";
	}
	
	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$data = [
			"departments" => $this->gm->all_simple("address_department", "department", "asc"),
			"provinces" => $this->gm->all_simple("address_province", "province", "asc"),
			"districts" => $this->gm->all_simple("address_district", "district", "asc"),
			"main" => "setting/company",
		];
		$this->load->view('layout', $data);
	}
	
	public function search(){
		$type = "error"; $msg = $company = null;
		
		$res = $this->my_func->utildatos_ruc($this->input->post("ruc"));
		if ($res->status){
			$type = "success";
			$msg = "Datos de empresa han sido cargados.";
			$company = $res->data;
			
			//load distric, province, department using ubigeo
			print_r($company);
		}else $msg = "No hay resultado de busqueda.";
		
		//header('Content-Type: application/json');
		//echo json_encode(["type" => $type, "msg" => $msg, "company" => $company]);
	}
}
