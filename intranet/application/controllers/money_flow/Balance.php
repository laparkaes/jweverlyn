<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Balance extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load("message", "spanish");
		$this->load->model('general_model','gm');
		$this->nav_menu = ["money_flow", "balance"];
		$this->js_init = "money_flow/balance.js";
	}
	
	private function make_list($params){
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
		
		return ["params" => $params, "balance" => $balance, "types" => $types, "other" => $other];
	}
	
	public function index(){
		if (!$this->session->userdata('username')) redirect("auth/login");
		
		$params = [
			"bt" => $this->input->get("bt"),//balance type: monthly or yearly
			"bp" => $this->input->get("bp"),//balance period
		];
		
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
		
		$data = array_merge($this->make_list($params) ,[
			"years" => array_unique($years),
			"months" => $months,
			"main" => "money_flow/balance/index",
		]);
		$this->load->view('layout', $data);
	}

	public function download_excel(){
		$params = $this->input->post();
		
		$this->load->library('my_val');
		$result = $this->my_val->download_excel_balance($params);
		
		if ($result["type"] === "success"){
			$data = $this->make_list($params);
			$balance = $data["balance"];
			$types = $data["types"];
			$other = $data["other"];
			
			//basic data
			$sheet_data[] = ["Balance ".($params["bt"] === "m" ? "Mensual" : "Anual")];
			$sheet_data[] = ["Emisión", date("Y-m-d H:i:s")];
			$sheet_data[] = ["Periodo", $params["bp"]];
			$sheet_data[] = ["Resultado", (($balance["total"] > 0) ? "+" : "-")." S/ ".number_format(abs($balance["total"]), 2)];
			
			//headers
			$sheet_data[] = [""];
			$sheet_data[] = ["Tipo", "Fecha", "Categoría", "Descripción", "Monto (S/)"];
			
			//setting datas
			foreach($types as $t){
				if ($t->type === "Egreso") $other[$t->type]["total"] = -$other[$t->type]["total"];
				$sheet_data[] = [$t->type, $params["bp"], $other[$t->type]["description"], "", $other[$t->type]["total"]];
				$categories = $t->categories;
				foreach($categories as $c){
					$ios = $c->ios;
					foreach($ios as $io){
						if ($t->type === "Egreso") $io->amount = -$io->amount;
						$sheet_data[] = [$t->type, $io->date, $c->category, $io->description, $io->amount];
					}
				}
			}
			
			$spreadsheet = new Spreadsheet();
			
			$sheet = $spreadsheet->getActiveSheet();
			foreach($sheet_data as $ri => $row){
				foreach ($row as $ci => $value){
					$sheet->setCellValueByColumnAndRow($ci + 1, $ri + 1, $value);
				}
			}
			
			$ri++; $ci++;
			
			//set sheet title
			$sheet->setTitle('Balance '.$params["bp"]);
			
			//set title font size
			$sheet->mergeCells('A1:E1');
			$sheet->getStyle("A1")->getFont()->setSize(18);
			
			//set report information
			$sheet->getStyle("B2")->getAlignment()->setHorizontal('right');
			$sheet->getStyle("B3")->getAlignment()->setHorizontal('right');
			$sheet->getStyle("B4")->getAlignment()->setHorizontal('right');
			
			//set result marking
			$t_color = ($balance["total"] >= 0) ? "198754" : "dc3545";
			$sheet->getStyle("A4")->getFont()->getColor()->setRGB($t_color);
			$sheet->getStyle("B4")->getFont()->getColor()->setRGB($t_color);
			
			//set column width
			$sheet->getColumnDimension("A")->setWidth(15);
			$sheet->getColumnDimension("B")->setWidth(20);
			$sheet->getColumnDimension("C")->setWidth(50);
			$sheet->getColumnDimension("D")->setWidth(50);
			$sheet->getColumnDimension("E")->setWidth(20);
			
			//set bold text, white text color and dark blue fill color
			$f_solid = \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID;
			$cells = ["A1", "A6", "B6", "C6", "D6", "E6"];
			foreach($cells as $c){
				$sheet->getStyle($c)->getFont()->getColor()->setRGB('FFFFFF');
				$sheet->getStyle($c)->getAlignment()->setHorizontal('center');
				$sheet->getStyle($c)->getFill()->setFillType($f_solid)->getStartColor()->setRGB('012970');
				$sheet->getStyle($c)->getFont()->setBold(true);
			}
			
			//set text align to right on amount columns
			for($i = $ri; $i >= 7; $i--){
				$sheet->getStyle("E".$i)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				$sheet->getStyle("E".$i)->getAlignment()->setHorizontal('right');
			}
			
			$filename = FCPATH.'uploads/balance/'.$params["bp"].'.xlsx';
			$writer = new Xlsx($spreadsheet);
			$writer->save($filename);
			
			$result["url"] = base_url()."uploads/balance/".$params["bp"].".xlsx";
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	/*public function methods(){
		$cl = $this->router->fetch_class();
		$aux = get_class_methods($this);
		
		$no_class = ["__construct", "methods", "get_instance"];
		foreach($aux as $a) if (!in_array($a, $no_class)) echo $cl."_".$a."<br/>";
	}*/
}
