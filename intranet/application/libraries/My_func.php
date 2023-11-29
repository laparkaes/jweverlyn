<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//use Luecano\NumeroALetras\NumeroALetras;
use Dompdf\Dompdf;

class My_func{
	
	public function __construct(){
		$this->CI = &get_instance();
	}
	
	public function check_access($code = [], $add = "", $check_logged = true){
		$result = ["type" => "success", "msg" => null, "url" => null];
		$code[] = $add;
		
		$access = $this->CI->gm->unique("access", "code", implode("_", array_filter($code)), false);
		if ($access){
			if (!$this->CI->session->userdata('username')){
				$result["type"] = "error";
				$result["msg"] = $this->lang->line("e_finished_session");
				$result["url"] = "auth/login";
			}
			
			if ($result["type"] === "success"){
				$f = [
					"role_id" => $this->CI->session->userdata('rid'),
					"access_id" => $access->access_id,
				];
				
				if (!$this->CI->gm->filter("role_access", $f, null, null, [], "", "", false)){
					$result["type"] = "error";
					$result["msg"] = $this->CI->lang->line("e_no_access");
					$result["url"] = "auth/no_access";
				}
			}
		}else $result["type"] = "error";
		
		return $result;
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
	
	public function utildatos($type, $number){
		switch($type){
			case "dni": 
				//$url = 'https://utildatos.com/api/dni';
				$url = 'https://utildatos.com/bussines/get-random-dni';
				$data = ['dni' => $number];
				break;
			case "ruc":
				//$url = 'https://utildatos.com/api/sunat-reducido';
				$url = 'https://utildatos.com/bussines/get-sunat-reducido';
				$data = ['ruc' => $number];
				break;
		}
		
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $data,
			//CURLOPT_HTTPHEADER => ['Authorization: Bearer {5e973b619e195eed0aea209fcf27e5}']
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
	
	public function make_pdf_a4($html, $filename){
		// instantiate and use the dompdf class
		$dompdf = new Dompdf();

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');//vertical [0.0, 0.0, 595.28, 841.89]
		//$dompdf->setPaper('A4', 'landscape');//horizontal
		//$dompdf->setPaper(array(0,0,240,600));
		$dompdf->loadHtml($html);
		$dompdf->render();
		
		// Output the generated PDF to Browser
		if ($dompdf) $dompdf->stream($filename, array("Attachment" => false));
		else echo "Error";
	}
	
	public function make_pdf_ticket($html, $filename){
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
	
	public function image_resize($path, $upload_data, $w_max, $h_max, $is_thumb = false){
		$w = $upload_data['image_width'];
		$h = $upload_data['image_height'];
		
		if (($w > $w_max) or ($h > $h_max)){
			$this->CI->load->library('image_lib');
			$config = [
				'image_library' => 'gd2',
				'source_image' => $path.$upload_data['file_name'],
				'create_thumb' => $is_thumb,
				'maintain_ratio' => TRUE,
				'width' => $w_max,
				'height' => $h_max,
			];
			
			$this->CI->image_lib->initialize($config);
			$this->CI->image_lib->resize();
		}
	}
	
	function randomString($length, $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"){
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return trim($randomString);
	}
}