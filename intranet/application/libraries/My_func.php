<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//use Luecano\NumeroALetras\NumeroALetras;
//use Dompdf\Dompdf;

class My_func{
	
	public function __construct(){
		$this->CI = &get_instance();
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
	
	public function utildatos_dni($dni){
		$curl = curl_init();
		/*
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://utildatos.com/api/dni',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => ['dni' => $dni],
			CURLOPT_HTTPHEADER => ['Authorization: Bearer {5e973b619e195eed0aea209fcf27e5}']
		));
		*/
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://utildatos.com/bussines/get-random-dni',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => ['dni' => $dni],
		));

		$response = json_decode(curl_exec($curl));
		curl_close($curl);
		
		$res = new stdClass;
		$res->status = false;
		$res->data = null;
		if ($response){
			if (property_exists($response, 'success')){
				$res->status = $response->success;
				$res->data = $response->result;
			}	
		}
		
		return $res;
	}
	
	public function utildatos_ruc($ruc){
		$curl = curl_init();
		
		curl_setopt_array($curl, [
			//CURLOPT_URL => 'https://utildatos.com/api/sunat-reducido',
			CURLOPT_URL => 'https://utildatos.com/bussines/get-sunat-reducido',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => ['ruc' => $ruc],
			//CURLOPT_HTTPHEADER => ['Authorization: Bearer {5e973b619e195eed0aea209fcf27e5}'],
		]);

		$response = json_decode(curl_exec($curl));
		curl_close($curl);
		
		$res = new stdClass;
		$res->status = false;
		$res->data = null;
		if ($response){
			if (property_exists($response, 'success')){
				$res->status = $response->success;
				$res->data = $response->result;
			}
		}
		
		return $res;
		
		//stdClass Object ( [status] => [message] => No se encontro el ruc ) 
		//stdClass Object ( [success] => 1 [result] => stdClass Object ( [ruc] => 20557939645 [razon_social] => MOARA PERU E.I.R.L. [estado] => SUSPENSION TEMPORAL [condicion_domicilio] => HABIDO [ubigeo] => 150130 [tipo_via] => AV. [nombre_via] => SAN BORJA SUR [codigo_zona] => URB. [tipo_zona] => SAN BORJA [numero] => 689 [interior] => - [lote] => - [departamento] => 401 [manzana] => - [kilometro] => - [direccion] => AV. SAN BORJA SUR URB. SAN BORJA Nro. 689 Dpto. 401 ) ) 
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
}