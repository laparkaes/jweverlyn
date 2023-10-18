<div>hola</div>
<div><?php print_r($invoice); ?></div>
<br/><br/>
<?php 
$company = $invoice->getCompany();
$address = $company->getAddress();
$client = $invoice->getClient();
$items = $invoice->getDetails();
print_r($client);
?>
<br/><br/>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="<?= base_url() ?>resorces/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>resorces/css/setting.css">
	<style>
	html, body{margin: 5px; font-size: 14px; font-family: 'poppins', sans-serif; line-height: 1.5;}
	table{width: 100%; padding: 0; margin: 0; border: 0; border-collapse: collapse;}
	.mt{margin-top: 20px;}
	.text-center{text-align: center;}
	</style>
</head>
<body>
	<table>
		<tr>
			<td style="text-align: center;">
				<div style="margin-bottom: 3px;"><strong><?= $company->getRazonSocial() ?></strong></div>
				<div><?= $address->getDireccion() ?></div>
				<div><?= $address->getDistrito()." - ".$address->getProvincia()." - ".$address->getDepartamento() ?></div>
			</td>
			<!--
			<td style="text-align: right; vertical-align: top;">
				<img src="data:image/png;base64,<?= $logo ?>" style="max-width: 80px;"/>
			</td>
			-->
		</tr>
	</table>
	<div class="text-center mt">
		<div><strong>RUC: <?= $company->getRuc() ?></strong></div>
		<div><strong><?= strtoupper($this->gm->unique("invoice_type", "sunat", $invoice->getTipoDoc(), false)->type) ?> DE VENTA ELECTRÓNICA</strong></div>
		<div><strong><?= $invoice->getSerie()." - ".str_pad($invoice->getCorrelativo(), 6, '0', STR_PAD_LEFT) ?></strong></div>
	</div>
	<table class="mt" style="border-top: 1px dashed black; border-bottom: 1px dashed black;">
		<tr><td style="width: 80px;">Cliente</td><td>: <?= $client->getRznSocial() ?></td></tr>
		<tr><td><?= $this->gm->unique("client_doc_type", "sunat", $client->getTipoDoc(), false)->short ?></td><td>: <?= $client->getNumDoc() ?></td></tr>
		<tr><td>Fecha</td><td>: <?= $invoice->getFechaEmision()->format('Y-m-d H:i:s') ?></td></tr>
	</table>
	<div class="mt" style="border-bottom: 1px solid black;">
		<table>
			<tr>
				<td>Descripción<br/>Cantidad * P/U</td>
				<td style="text-align: right; vertical-align: bottom;"><?= $this->lang->line('label_total') ?></td>
			</tr>
		</table>
		<table style="border-top: 1px solid black;">
			<?php foreach($items as $item){ ?>
			<tr>
				<td><?= $item->getDescripcion() ?><br/><?= number_format($item->getCantidad(), 2) ?> x <?= number_format($item->getMtoPrecioUnitario(), 2) ?></td>
				<td style="text-align: right; vertical-align: bottom;"><?= number_format($item->getCantidad() * $item->getMtoPrecioUnitario(), 2) ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
	<table style="margin-top: 10px; text-align: right;">
		<tr>
			<td>Op. Gravada</td>
			<td>S/ <?= number_format($invoice->getMtoOperGravadas(), 2) ?></td>
		</tr>
		<tr>
			<td>IGV (18%)</td>
			<td>S/ <?= number_format($invoice->getTotalImpuestos(), 2) ?></td>
		</tr>
		<tr>
			<td>Total</td>
			<td>S/ <?= number_format($invoice->getMtoImpVenta(), 2) ?></td>
		</tr>
		<tr>
			<td style="padding-top: 10px;"><?= $voucher->payment_method ?></td>
			<td style="padding-top: 10px;">S/ <?= number_format($voucher->received, 2) ?></td>
		</tr>
		<tr>
			<td><?= $this->lang->line('label_change') ?></td>
			<td><?= $voucher->currency." ".number_format($voucher->change, 2) ?></td>
		</tr>
	</table>
	<div style="margin-top: 10px;"><?= $this->lang->line('label_are_u')." ".$invoice->getLegends()[0]->getValue(); ?></div>
	<div class="mt" style="border-top: 1px dashed black; border-bottom: 1px dashed black;">
		<div><strong><?= $this->lang->line('label_remarks') ?></strong></div>
		<table>
			<tr>
				<td style="width: 80px;"><?= $this->lang->line('label_way_to_pay') ?></td>
				<td>: <?= $invoice->getFormaPago()->getTipo() ?></td>
			</tr>
		</table>
	</div>
	<div class="mt text-center">
		<div><img src="data:image/png;base64,<?= $qr ?>" style="max-width: 100px;"/></div>
		<div><?= $this->lang->line("resolution_num").": ".$this->sunat_resolution ?></div>
		<div><?= $this->lang->line("hash_code").": ".$voucher->hash ?></div>
	</div>
</body>
</html>

