<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style>
	html, body{font-size: 14px; font-family: 'poppins', sans-serif; line-height: 1.5;}
	table{width: 100%; padding: 0; margin: 0; border: 0; border-collapse: collapse;}
	.mt{margin-top: 20px;}
	.mt-lg{margin-top: 50px;}
	.pt{padding-top: 20px;}
	.text-start{text-align: left;}
	.text-center{text-align: center;}
	.text-end{text-align: right;}
	</style>
</head>
<body style="padding: 0 40px;">
	<table>
		<tr>
			<td style="width:55%;"><strong>Proforma</strong></td>
			<td style="width:45%;" class="text-end"><img src="data:image/jpeg;base64,<?= $logo ?>" style="width: 80%;"></td>
		</tr>
		<tr>
			<td class="pt" valign="top">
				<table>
					<tr><td><strong>Cliente</strong></td></tr>
					<tr><td><?= $client->name ?></td></tr>
					<tr><td><?= $client->doc_type." ".$client->doc_number ?></td></tr>
					<?php
					$aux = [];
					if ($client->tel) $aux[] = $client->tel;
					if ($client->mobile) $aux[] = $client->mobile;
					if ($aux){ ?>
					<tr><td><?= implode(", ", $aux) ?></td></tr>
					<?php } if ($client->address){ ?>
					<tr><td><?= $client->address ?></td></tr>
					<?php } ?>
				</table>
			</td>
			<td class="pt" valign="top">
				<table>
					<tr>
						<td><strong>Nº de Proforma</strong></td>
						<td class="text-end"><?= date("y").str_pad($proforma->proforma_id, 4, '0', STR_PAD_LEFT) ?></td>
					</tr>
					<tr>
						<td><strong>Fecha de Emisión</strong></td>
						<td class="text-end"><?= date("Y-m-d", strtotime($proforma->registed_at)) ?></td>
					</tr>
					<tr>
						<td><strong>Vigencia</strong></td>
						<td class="text-end"><?= date("Y-m-d", strtotime($proforma->validity)) ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table class="mt-lg">
		<tr>
			<th class="text-start">#</th>
			<th style="width: 40%;">Producto</th>
			<th>Opción</th>
			<th>P/U</th>
			<th>Cant.</th>
			<th class="text-end">Subtotal</th>
		</tr>
		<?php foreach($products as $i => $p){ ?>
		<tr>
			<td><?= number_format($i + 1) ?></td>
			<td><?= $p->product ?></td>
			<td class="text-center"><?= $p->option ?></td>
			<td class="text-center"><?= number_format($p->price, 2) ?></td>
			<td class="text-center"><?= number_format($p->qty) ?></td>
			<td class="text-end"><?= number_format($p->price * $p->qty, 2) ?></td>
		</tr>
		<?php } ?>
	</table>
	<div class="mt"><strong>Observación</strong></div>
	<div><?= nl2br($proforma->remark) ?></div>
	<div class="mt-lg"><strong>Datos del Banco</strong></div>
	<table>
		<tr>
			<td colspan="3">Interbank</td>
		</tr>
		<tr>
			<td style="width: 100px;">Soles</td>
			<td style="width: 150px;">432-3004927103</td>
			<td>/ CCI 003-432-003004927103-21</td>
		</tr>
		<tr>
			<td>Dólares</td><td>432-3004927110</td><td>/ CCI 003-432-003004927110-26</td>
		</tr>
	</table>
	
	
	<div></div>
	<div><span></span><span></span></div>
	<div><span style="width: 120px;"></span><span></span></div>
</body>
</html>