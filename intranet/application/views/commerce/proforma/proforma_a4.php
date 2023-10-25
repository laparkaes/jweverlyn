<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style>
	html, body{font-size: 14px; font-family: 'poppins', sans-serif; line-height: 1.5;}
	table{width: 100%; padding: 0; margin: 0; border: 0; border-collapse: collapse;}
	.mt{margin-top: 20px;}
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
						<td><strong>Nº de Proforma</strong></td><td class="text-end">PR230001</td>
					</tr>
					<tr>
						<td><strong>Fecha de Emisión</strong></td><td class="text-end"></td>
					</tr>
					<tr>
						<td><strong>Vigencia</strong></td><td class="text-end"></td>
					</tr>
					<tr>
						<td><strong>Término de Pago</strong></td><td class="text-end"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

<br/><br/><br/>
<?php print_r($proforma); ?><br/><br/>
<?php print_r($client); ?><br/><br/>
<?php print_r($products); ?><br/><br/>

</body>
</html>