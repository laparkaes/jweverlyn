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
			$company = $res->data;
			
			//load distric, province, department using ubigeo
			$district = $this->gm->unique("address_district", "ubigeo", $company->ubigeo, false);
			if ($district){
				$province = $this->gm->unique("address_province", "province_id", $district->province_id, false);
				$company->department_id = $province->department_id;
				$company->province_id = $province->province_id;
				$company->district_id = $district->district_id;
			}else $company->department_id = $company->province_id = $company->district_id = "";
		}else $msg = $this->lang->line("e_no_result");
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "company" => $company]);
	}
}
