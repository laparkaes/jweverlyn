<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style>
	html, body{font-size: 14px; font-family: 'poppins', sans-serif; line-height: 1.5;}
	table{width: 100%; padding: 0; margin: 0; border: 0; border-collapse: collapse;}
	strong, th{color: #233774;}
	.mt{margin-top: 20px;}
	.mt-lg{margin-top: 50px;}
	.pt{padding-top: 20px;}
	.pb{padding-bottom: 20px;}
	.text-start{text-align: left;}
	.text-center{text-align: center;}
	.text-end{text-align: right;}
	.fs-xs{font-size: 0.6rem;}
	.fs-sm{font-size: 0.8rem;}
	.fs-lg{font-size: 1.2rem;}
	.fs-xl{font-size: 2rem;}
	.bg-color{background-color: #D9E1F2;}
	#tb_products td, #tb_products th{padding: 7px 5px;}
	</style>
</head>
<body style="padding: 0 40px;">
	<table>
		<tr>
			<td class="fs-xl" style="width:55%;"><strong>Proforma</strong></td>
			<td style="width:45%;" class="text-end"><img src="data:image/svg;base64,<?= $logo ?>" style="width: 80%;"></td>
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
	<table class="mt-lg" id="tb_products" style="border-top: 1px solid black;">
		<tr>
			<th class="text-start">#</th>
			<th style="width: 40%;">Ítem</th>
			<th>Opción</th>
			<th>P/U</th>
			<th>Cant.</th>
			<th class="text-end">Subtotal</th>
		</tr>
		<?php foreach($products as $i => $p){ if ($i % 2) $bg = ""; else $bg = "bg-color"; ?>
		<tr class="<?= $bg ?>">
			<td><?= number_format($i + 1) ?></td>
			<td><?= $p->product ?></td>
			<td class="text-center"><?= $p->option ?></td>
			<td class="text-center">S/ <?= number_format($p->price, 2) ?></td>
			<td class="text-center"><?= number_format($p->qty) ?></td>
			<td class="text-end">S/ <?= number_format($p->price * $p->qty, 2) ?></td>
		</tr>
		<?php } ?>
		<tr style="border-top: 1px solid black;">
			<td class="pt pb" colspan="2"></td>
			<td class="text-end pt pb" colspan="2"><strong>TOTAL</strong></td>
			<td class="text-end pt pb" colspan="2"><strong>S/ <?= number_format($proforma->amount, 2) ?></strong></td>
		</tr>
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
	<div class="mt text-end">
		<div><img src="data:image/png;base64,<?= $sign_jw ?>" style="width:200px;"></div>
		<div>Jeong Woo Park</div>
		<div>Gerente General</div>
		<div>JW Everlyn S.A.C.</div>
	</div>
</body>
</html>