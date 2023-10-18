<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Greenter\See;
use Greenter\Ws\Services\SunatEndpoints;

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\FormaPagos\FormaPagoContado;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\Document;
use Greenter\Model\Summary\Summary;
use Greenter\Model\Summary\SummaryDetail;

use Greenter\XMLSecLibs\Certificate\X509Certificate;
use Greenter\XMLSecLibs\Certificate\X509ContentType;

use Luecano\NumeroALetras\NumeroALetras;

class My_greenter{
	
	public function __construct(){
		$this->CI = &get_instance();
		
		$this->ruc = "20610879668";
		$this->user = "JEONGWOO";
		$this->pass = "Wjddn0315";
		$this->cert_path = FCPATH."uploads/cert/cert_jweverlyn.pem";
		$this->service_link = SunatEndpoints::FE_BETA;
		$this->path = "./uploads/sunat/";
	}
	
	private function set_see(){
		$see = new See();
		$see->setCertificate(file_get_contents($this->cert_path));
		$see->setService($this->service_link);
		$see->setClaveSOL($this->ruc, $this->user, $this->pass);
		
		return $see;
	}
	
	public function set_invoice_greenter($invoice_id){
		$formatter = new NumeroALetras();
		
		$company = $this->CI->gm->unique("setting_company", "company_id", 1, false);
		$address_department = $this->CI->gm->unique("address_department", "department_id", $company->department_id, false);
		$address_province = $this->CI->gm->unique("address_province", "province_id", $company->province_id, false);
		$address_district = $this->CI->gm->unique("address_district", "district_id", $company->district_id, false);
		
		$invoice = $this->CI->gm->unique("invoice", "invoice_id", $invoice_id);
		$invoice_serie = $this->CI->gm->unique("invoice_serie", "serie_id", $invoice->serie_id, false);
		$invoice_type = $this->CI->gm->unique("invoice_type", "type_id", $invoice->type_id, false);
		
		$products = $this->CI->gm->filter("sale_product", ["sale_id" => $invoice->sale_id], null, null, [], "", "", false);
		//$payments = $this->CI->gm->filter("sale_payment", ["sale_id" => $invoice->sale_id]);
		
		$client = $this->CI->gm->unique("client", "client_id", $invoice->client_id);
		if (!$client){
			$client = new stdClass;
			$client->doc_type_id = 1;
			$client->doc_number = "0";
			$client->name = "---";
		}
		$client_doc_type = $this->CI->gm->unique("client_doc_type", "doc_type_id", $client->doc_type_id, false);
		
		//Client
		$client = (new Client())
			->setTipoDoc($client_doc_type->sunat)
			->setNumDoc($client->doc_number)
			->setRznSocial($client->name);

		//Emisor
		$address = (new Address())
			->setUbigueo($address_district->ubigeo)
			->setDepartamento($address_department->department)
			->setProvincia($address_province->province)
			->setDistrito($address_district->district)
			->setUrbanizacion('-')
			->setDireccion($company->address)
			->setCodLocal('0000'); // Codigo de establecimiento asignado por SUNAT, 0000 por defecto.

		$company = (new Company())
			->setRuc($company->ruc)
			->setRazonSocial($company->company)
			->setNombreComercial($company->company)
			->setAddress($address);

		// Venta
		$invoice_greenter = (new Invoice())
			->setUblVersion('2.1')
			->setTipoOperacion('0101') // Venta - Catalog. 51
			->setTipoDoc($invoice_type->sunat)
			->setSerie($invoice_type->letter.$invoice_serie->serie)
			->setCorrelativo($invoice->correlative)
			->setFechaEmision(new DateTime($invoice->registed_at.'-05:00')) // Zona horaria: Lima
			->setFormaPago(new FormaPagoContado()) // FormaPago: Contado
			->setTipoMoneda('PEN') // Sol - Catalog. 02
			->setCompany($company)
			->setClient($client)
			->setMtoOperGravadas($invoice->amount)
			->setMtoIGV($invoice->vat)
			->setTotalImpuestos($invoice->vat)
			->setValorVenta($invoice->amount)
			->setSubTotal($invoice->total)
			->setMtoImpVenta($invoice->total);

		$items = [];
		foreach($products as $p){
			$prod = $this->CI->gm->unique("product", "product_id", $p->product_id, false);
			
			$total_value = $p->subtotal/1.18;
			$total_vat = $p->subtotal - $total_value;
			$unit_value = $total_value / $p->qty;
			
			$items[] = (new SaleDetail())
				->setCodProducto($prod->code)
				->setUnidad('NIU') // Unidad - Catalog. 03
				->setCantidad($p->qty)
				->setMtoValorUnitario($unit_value)
				->setDescripcion($prod->product)
				->setMtoBaseIgv($total_value)
				->setPorcentajeIgv(18.00) // 18%
				->setIgv($total_vat)
				->setTipAfeIgv('10') // Gravado Op. Onerosa - Catalog. 07
				->setTotalImpuestos($total_vat) // Suma de impuestos en el detalle
				->setMtoValorVenta($total_value)
				->setMtoPrecioUnitario($p->price);
		}

		$legend = (new Legend())
			->setCode('1000') // Monto en letras - Catalog. 52
			->setValue('SON '.$formatter->toInvoice($invoice->total, 2, 'soles'));

		$invoice_greenter
			->setDetails($items)
			->setLegends([$legend]);
			
		return $invoice_greenter;
	}
	
	public function issue_invoice($invoice_id){
		$invoice = $this->set_invoice_greenter($invoice_id);

		$see = $this->set_see();
		$result = $see->send($invoice);

		// Guardar XML firmado digitalmente.
		$file_xml = $invoice->getName().'.xml';
		file_put_contents($this->path.$file_xml, $see->getFactory()->getLastXml());

		// Verificamos que la conexión con SUNAT fue exitosa.
		if ($result->isSuccess()){
			// Guardar CDR
			$file_cdr = 'R-'.$invoice->getName().'.zip';
			file_put_contents($this->path.$file_cdr, $result->getCdrZip());
			
			$type = "success";
			$msg = $result->getCdrResponse()->getDescription();
		}else{
			$file_cdr = null;
			$type = "error";
			$msg = $result->getError()->getMessage();
		}

		return ["type" => $type, "msg" => $msg, "xml" => $file_xml, "cdr" => $file_cdr];
	}
	
	private function void_invoice_boleta($invoice, $invoice_type){
		$type = "error"; $msg = null;
		
		$company = $this->CI->gm->unique("setting_company", "company_id", 1, false);
		$address_department = $this->CI->gm->unique("address_department", "department_id", $company->department_id, false);
		$address_province = $this->CI->gm->unique("address_province", "province_id", $company->province_id, false);
		$address_district = $this->CI->gm->unique("address_district", "district_id", $company->district_id, false);
		
		$invoice_serie = $this->CI->gm->unique("invoice_serie", "serie_id", $invoice->serie_id, false);
		
		$client = $this->CI->gm->unique("client", "client_id", $invoice->client_id);
		if (!$client){
			$client = new stdClass;
			$client->doc_type_id = 1;
			$client->doc_number = "0";
			$client->name = "---";
		}
		$client_doc_type = $this->CI->gm->unique("client_doc_type", "doc_type_id", $client->doc_type_id, false);
		
		//Emisor
		$address = (new Address())
			->setUbigueo($address_district->ubigeo)
			->setDepartamento($address_department->department)
			->setProvincia($address_province->province)
			->setDistrito($address_district->district)
			->setUrbanizacion('-')
			->setDireccion($company->address)
			->setCodLocal('0000'); // Codigo de establecimiento asignado por SUNAT, 0000 por defecto.
		
		$company = (new Company())
			->setRuc($company->ruc)
			->setRazonSocial($company->company)
			->setNombreComercial($company->company)
			->setAddress($address);
		
		$detail = (new SummaryDetail())
			->setTipoDoc($invoice_type->sunat) // Boleta
			->setSerieNro($invoice_type->letter.$invoice_serie->serie."-".$invoice->correlative)
			->setEstado('3') // Anulación
			->setClienteTipo($client_doc_type->sunat)
			->setClienteNro($client->doc_number)
			->setTotal($invoice->total)
			->setMtoOperGravadas($invoice->amount)
			//->setMtoOperInafectas(24.4)
			//->setMtoOperExoneradas(50)
			//->setMtoOtrosCargos(21)
			->setMtoIGV($invoice->vat);
		
		$last_resume = $this->CI->gm->filter("sunat_resume", ["date" => date("Y-m-d")], null, null, [["correlative", "desc"]], 1, 0, false);
		if ($last_resume) $correlative = $last_resume[0]->correlative + 1; else $correlative = 1;
		
		$resumen = (new Summary())
			->setFecGeneracion(new \DateTime(date("Y-m-d", strtotime($invoice->registed_at)))) // Fecha de emisión de las boletas.
			->setFecResumen(new \DateTime(date("Y-m-d"))) // Fecha de envío del resumen diario.
			->setCorrelativo($correlative) // Correlativo, necesario para diferenciar de otros Resumen diario del mismo día.
			->setCompany($company)
			->setDetails([$detail]);
		
		$see = $this->set_see();
		$result = $see->send($resumen);
		
		// Guardar XML firmado digitalmente.
		$file_xml = $resumen->getName().'.xml';
		file_put_contents($this->path.$file_xml, $see->getFactory()->getLastXml());
		
		$type = "error"; $ticket = $file_cdr = null;
		if ($result->isSuccess()){
			$ticket = $result->getTicket();
			
			$statusResult = $see->getStatus($ticket);
			if ($statusResult->isSuccess()) {
				// Guardar CDR
				$file_cdr = 'R-'.$resumen->getName().'.zip';
				file_put_contents($this->path.$file_cdr, $statusResult->getCdrZip());
				
				$type = "success";
				$msg = $statusResult->getCdrResponse()->getDescription();
			}else $msg = $statusResult->getError()->getCode()." - ".$statusResult->getError()->getMessage();
		}else $msg = $result->getError()->getCode()." - ".$result->getError()->getMessage();
		
		return ["type" => $type, "msg" => $msg, "ticket" => $ticket, "correlative" => $correlative, "xml" => $file_xml, "cdr" => $file_cdr];
	}
	
	private function void_invoice_factura($invoice, $type){
		$type = "error"; $msg = null;
		
		return ["type" => $type, "msg" => $msg];
	}
	
	public function void_invoice($invoice){
		$invoice_type = $this->CI->gm->unique("invoice_type", "type_id", $invoice->type_id, false);
		
		if ($invoice_type->letter === "B") $result = $this->void_invoice_boleta($invoice, $invoice_type);
		else $result = $this->void_invoice_factura($invoice, $invoice_type);
		
		return $result;
	}
	
	public function convert_to_pem(){
		$path_pfx = FCPATH."uploads/cert/cert_jweverlyn.pfx";
		$pass = "QkRwjdDn0315QkrwjDDN";
		
		$pfx = file_get_contents($path_pfx);
		$password = $pass;

		$certificate = new X509Certificate($pfx, $password);
		$pem = $certificate->export(X509ContentType::PEM);
			
		file_put_contents(FCPATH."uploads/cert/cert_jweverlyn.pem", $pem);
		echo "Conversion is done!<br/>".FCPATH."uploads/cert/cert_jweverlyn.pem";
	}
}