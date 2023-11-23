<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balance extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["money_flow", "balance"];
		$this->js_init = "money_flow/balance.js";
	}
	
	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$s_date = $this->input->get("s_date");
		if (!$s_date) $s_date = date("Y-m");
		
		//define date limits
		$aux1_lower = $this->gm->filter("sale", null, null, null, [["registed_at", "asc"]], 1, 0, true);
		if ($aux1_lower) $aux1_lower = $aux1_lower[0]->registed_at; else $aux1_lower = date("Y-m");
		
		$aux2_lower = $this->gm->filter("purchase", null, null, null, [["registed_at", "asc"]], 1, 0, true);
		if ($aux2_lower) $aux2_lower = $aux2_lower[0]->registed_at; else $aux2_lower = date("Y-m");
		
		$aux3_lower = $this->gm->filter("in_outcome", null, null, null, [["date", "asc"]], 1, 0, true);
		if ($aux3_lower) $aux3_lower = $aux3_lower[0]->date; else $aux3_lower = date("Y-m");
		
		$date_lower = date("Y-m", min(strtotime($aux1_lower), strtotime($aux2_lower), strtotime($aux3_lower)));
		$date_upper = date("Y-m");
		
		$years = [];
		$months = [];
		$now = $date_lower;
		while(strtotime($now) <= strtotime($date_upper)){
			$years[] = date('Y', strtotime($now));
			$months[] = $now;
			$now = date('Y-m', strtotime($now . ' +1 month'));
		}
		$years = array_unique($years);
		
		//calculate income and outcome total amount
		$w = [
			"date >=" => date("Y-m-01", strtotime($s_date))." 00:00:00",
			"date <=" => date("Y-m-t", strtotime($s_date))." 23:59:59",
		];
		
		$b_total = 0;
		$types = $this->gm->all_simple("in_outcome_type", "type", "desc");
		foreach($types as $t){
			$w["type_id"] = $t->type_id;
			$t->total = round($this->gm->sum("in_outcome", "amount", $w)->amount, 2);
			
			switch ($t->type){
				case "Ingreso": $b_total += $t->total; $t->color = "success"; break;
				case "Egreso": $b_total -= $t->total; $t->color = "danger"; break;
			}
			
			$cat_ids_arr = [];
			$cat_ids = $this->gm->only("in_outcome", "category_id", $w);
			foreach($cat_ids as $cat_id) $cat_ids_arr[] = $cat_id->category_id;
			
			$w_in = [["field" => "category_id", "values" => $cat_ids_arr]];
			$categories = $this->gm->filter("in_outcome_category", null, null, $w_in);
			foreach($categories as $c){
				$w["category_id"] = $c->category_id;
				$c->total = round($this->gm->sum("in_outcome", "amount", $w)->amount, 2);
				
				$c->ios = $this->gm->filter("in_outcome", $w, null, null, [["amount", "desc"]]);
			}
			usort($categories, function($a, $b) {return $b->total - $a->total;});
			
			unset($w["category_id"]);
			
			$t->categories = $categories;
		}
		
		//calculate sale and purchase total amount
		$w = [
			"registed_at >=" => date("Y-m-01", strtotime($s_date))." 00:00:00",
			"registed_at <=" => date("Y-m-t", strtotime($s_date))." 23:59:59",
		];
		
		$other = [];
		$other["Ingreso"] = [
			"description" => "Venta ".$s_date, 
			"total" => round($this->gm->sum("sale", "amount", $w)->amount, 2)
		];
		$other["Egreso"] = [
			"description" => "Compra ".$s_date, 
			"total" => round($this->gm->sum("purchase", "amount", $w)->amount, 2)
		];
		
		$b_total = $b_total + $other["Ingreso"]["total"] - $other["Egreso"]["total"];
		$balance = ["total" => $b_total];
		switch(true){
			case ($balance < 0): $balance["color"] = "danger"; break;
			case ($balance == 0): $balance["color"] = "primary"; break;
			case ($balance > 0): $balance["color"] = "success"; break;
		}
		
		$data = [
			"s_date" => $s_date,
			"balance" => $balance,
			"types" => $types,
			"other" => $other,
			"main" => "money_flow/balance/index",
		];
		$this->load->view('layout', $data);
	}
}
