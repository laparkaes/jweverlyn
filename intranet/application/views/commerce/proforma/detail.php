<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Detalle de Proforma</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Venta</li>
					<li class="breadcrumb-item active">Detalle</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>commerce/sale" type="button" class="btn btn-success">
				<i class="bi bi-arrow-left"></i>
			</a>
		</div>
	</div>
</div>
<section class="section profile">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-body profile-card pt-4 d-flex flex-column align-items-center text-center">
					<?php if ($client){ ?><h2 class="mb-5"><?= $client->name ?></h2><?php } ?>
					<ul class="list-group w-100">
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<strong>Monto</strong>
							<span>S/. <?= number_format($proforma->amount, 2) ?></span>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<strong>Estado</strong>
							<span class="text-<?= $proforma->color ?>"><?= $proforma->status ?></span>
						</li>
						<li class="list-group-item">
							<div class="text-start"><strong>Vigencia</strong></div>
							<div class="text-end"><span>Hasta <?= $proforma->validity ?></span></div>
							
						</li>
						<li class="list-group-item">
							<div class="text-start"><strong>Emisión</strong></div>
							<div class="text-end"><span><?= $proforma->registed_at ?></span></div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-body pt-3">
					<?php if ($proforma->valid){ ?>
					<div class="row">
						<div class="col-md-4 d-grid">
							<?php if ($proforma->color === "success") $d = ""; else $d = "disabled"; ?>
							<button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#md_generate_sale" <?= $d ?>>
								<i class="bi bi-coin" style="font-size: 2rem;"></i><br/>Generar Venta
							</button>
						</div>
						<div class="col-md-4 d-grid">
							<a href="<?= base_url()?>commerce/proforma/view/<?= $proforma->proforma_id ?>" class="btn btn-primary mb-3" target="_blank">
								<i class="bi bi-file-earmark-pdf" style="font-size: 2rem;"></i><br/>PDF
							</a>
						</div>
						<div class="col-md-4 d-grid">
							<button type="button" class="btn btn-outline-danger mb-3" id="btn_cancel_proforma" value="<?= $proforma->proforma_id ?>">
								<i class="bi bi-trash" style="font-size: 2rem;"></i><br/>Anular Proforma
							</button>
						</div>
					</div>
					<?php } ?>
					<table class="table align-middle pt-4">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Producto</th>
								<th scope="col">Cant.</th>
								<th scope="col">P/U</th>
								<th scope="col">Subtotal</th>
							</tr>
						</thead>
						<tbody id="tbody_images">
							<?php foreach($products as $p_i => $p){ ?>
							<tr>
								<th scope="row"><?= number_format($p_i + 1) ?></th>
								<td><?= $p->prod->product ?><br><small><?= $p->op->option ?></small></td>
								<td><?= number_format($p->qty) ?></td>
								<td class="text-nowrap text-end">S/ <?= number_format($p->price, 2) ?></td>
								<td class="text-nowrap text-end">S/ <?= number_format($p->price * $p->qty, 2) ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- modals -->
<?php if ($proforma->color === "success"){ ?>
<div class="modal fade" id="md_generate_sale" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="form_add_sale">
				<input type="hidden" name="proforma_id" value="<?= $proforma->proforma_id ?>">
				<div class="modal-header">
					<h5 class="modal-title">Generar Venta</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
				</div>
				<div class="modal-body text-start">
					<div class="row g-3">
						<div class="col-md-6">
							<label class="form-label">Medio de Pago</label>
							<select class="form-select" name="payment[payment_method_id]">
								<?php foreach($payment_methods as $p){ ?>
								<option value="<?= $p->payment_method_id ?>"><?= $p->payment_method ?></option>
								<?php } ?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-6">
							<label class="form-label">Recibido</label>
							<div class="input-group has-validation">
								<span class="input-group-text">S/.</span>
								<input type="hidden" id="received" name="payment[received]" value="0.00">
								<input type="text" class="form-control" id="received_txt" name="payment[received_txt]" value="0.00">
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="col-md-6">
							<label class="form-label">Total</label>
							<div class="input-group">
								<span class="input-group-text">S/.</span>
								<input type="hidden" id="total" name="payment[total]" value="<?= $proforma->amount ?>" readonly>
								<input type="text" class="form-control" id="total_txt" value="<?= number_format($proforma->amount, 2) ?>" disabled>
							</div>
						</div>
						<div class="col-md-6">
							<label class="form-label">Vuelto</label>
							<div class="input-group">
								<span class="input-group-text">S/.</span>
								<input type="hidden"id="change" name="payment[change]" value="0.00" readonly>
								<input type="text" class="form-control" id="change_txt" value="0.00" disabled>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" id="btn_add_sale">Agregar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>