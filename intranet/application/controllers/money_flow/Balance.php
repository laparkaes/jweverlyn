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
		
		$params = [
			"bt" => $this->input->get("bt"),//balance type: monthly or yearly
			"bp" => $this->input->get("bp"),//balance period
		];
		
		if (!$params["bp"]){//balance period no selected => show actual month balance
			$params = [
				"bt" => "m",
				"bp" => date("Y-m"),
			];
			$from = "Y-m";
			$to = "Y-m";
		}else{//balance period selcted
			switch($params["bt"]){
				case "y":
					$from = $params["bp"]."-01";
					$to = $params["bp"]."-12";
					break;
				case "m":
					$from = $params["bp"];
					$to = $params["bp"];
					break;
			}
		}
		
		$date_start = date($from."-01", strtotime($params["bp"]))." 00:00:00";
		$date_end = date($to."-t", strtotime($params["bp"]))." 23:59:59";
		
		//calculate sale and purchase total amount
		$w = [
			"registed_at >=" => $date_start,
			"registed_at <=" => $date_end,
		];
		
		$other = [];
		$other["Ingreso"] = [
			"description" => "Venta ".$params["bp"],
			"total" => round($this->gm->sum("sale", "amount", $w)->amount, 2)
		];
		$other["Egreso"] = [
			"description" => "Compra ".$params["bp"],
			"total" => round($this->gm->sum("purchase", "amount", $w)->amount, 2)
		];
		
		$b_total = $other["Ingreso"]["total"] - $other["Egreso"]["total"];
		
		//calculate income and outcome total amount
		$w = [
			"date >=" => $date_start,
			"date <=" => $date_end,
			"valid" => true,
		];
		
		$types = $this->gm->all_simple("in_outcome_type", "type", "desc");
		foreach($types as $t){
			$w["type_id"] = $t->type_id;
			$t->total = round($this->gm->sum("in_outcome", "amount", $w)->amount, 2);
			
			switch ($t->type){
				case "Ingreso": 
					$b_total += $t->total;
					$t->total += $other[$t->type]["total"];
					$t->color = "success";
					break;
				case "Egreso": 
					$b_total -= $t->total;
					$t->total += $other[$t->type]["total"];
					$t->color = "danger";
					break;
			}
			
			$cat_ids_arr = [-1];
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
		
		$balance = ["total" => $b_total];
		switch(true){
			case ($b_total < 0): $balance["color"] = "danger"; break;
			case ($b_total == 0): $balance["color"] = "primary"; break;
			case ($b_total > 0): $balance["color"] = "success"; break;
		}
		
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
		$now = $date_upper;
		while(strtotime($date_lower) <= strtotime($now)){
			$years[] = date('Y', strtotime($now));
			$months[] = $now;
			$now = date('Y-m', strtotime($now . ' -1 month'));
		}
		$years = array_unique($years);
		
		$data = [
			"params" => $params,
			"balance" => $balance,
			"types" => $types,
			"other" => $other,
			"years" => $years,
			"months" => $months,
			"main" => "money_flow/balance/index",
		];
		$this->load->view('layout', $data);
	}
}
