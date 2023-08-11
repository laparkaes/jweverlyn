<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//use Luecano\NumeroALetras\NumeroALetras;
//use Dompdf\Dompdf;

class My_func{
	
	public function __construct(){
		$this->CI = &get_instance();
	}
	/*
	public function make_pdf($html, $filename){
		// instantiate and use the dompdf class
		$dompdf = new Dompdf();

		// (Optional) Setup the paper size and orientation
		//$dompdf->setPaper('A4', 'portrait');//vertical [0.0, 0.0, 595.28, 841.89]
		//$dompdf->setPaper('A4', 'landscape');//horizontal
		$dompdf->setPaper(array(0,0,240,600));
		
		$GLOBALS['bodyHeight'] = 0;
		$dompdf->setCallbacks(
			array(
				'myCallbacks' => array(
				'event' => 'end_frame', 'f' => function ($infos) {
					$frame = $infos->get_frame();
					if (!strcmp("body", $frame->get_node()->nodeName))
						$GLOBALS['bodyHeight'] += $frame->get_padding_box()['h'];
				})
			)
		);
		
		$dompdf->loadHtml($html);
		$dompdf->render();
		unset($dompdf);
		
		$dompdf = new Dompdf();
		$dompdf->set_paper(array(0,0,240,$GLOBALS['bodyHeight']+20));

		// Render the HTML as PDF
		$dompdf->loadHtml($html);
		$dompdf->render();
		
		// Output the generated PDF to Browser
		if ($dompdf) $dompdf->stream($filename, array("Attachment" => false));
		else echo "Error";
	}
	
	public function get_numletter($num, $cur){
		switch($cur){
			case "USD": $formatter_currency = "DÓLARES"; break;
			default: $formatter_currency = "SOLES";//PEN
		}
		$formatter = new NumeroALetras();
		
		return $formatter->toInvoice($num, 2, $formatter_currency);
	}
	*/
	
	function randomString($length, $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz "){
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return trim($randomString);
	}
	
	public function paging($page, $qty){
		$pages = [];
		if ($qty){
			$last = floor($qty / 25); if ($qty % 25) $last++;
			if (3 < $page) $pages[] = [1, "<<", ""];
			if (3 < $page) $pages[] = [$page-3, "...", ""];
			if (2 < $page) $pages[] = [$page-2, $page-2, ""];
			if (1 < $page) $pages[] = [$page-1, $page-1, ""];
			$pages[] = [$page, $page, "active"];
			if ($page+1 <= $last) $pages[] = [$page+1, $page+1, ""];
			if ($page+2 <= $last) $pages[] = [$page+2, $page+2, ""];
			if ($page+3 <= $last) $pages[] = [$page+3, "...", ""];
			if ($page+3 <= $last) $pages[] = [$last, ">>", ""];
		}
		
		return $pages;
	}
}