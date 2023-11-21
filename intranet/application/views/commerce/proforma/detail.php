<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Detalle de Proforma</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Comercio</li>
					<li class="breadcrumb-item">Ventas</li>
					<li class="breadcrumb-item active">Detalle</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>commerce/proforma" type="button" class="btn btn-success">
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
					<?php if ($client){ ?>
					<h2><?= $client->name ?></h2>
					<h3 class="mt-3 mb-0"><?= $client->doc_type ?></h3>
					<h3 class="mt-1"><?= $client->doc_number ?></h3>
					<?php } ?>
					<ul class="list-group w-100">
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<strong>Monto</strong>
							<span>S/ <?= number_format($proforma->amount, 2) ?></span>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<strong>Estado</strong>
							<span class="text-<?= $proforma->color ?>"><?= $proforma->status ?></span>
						</li>
						<li class="list-group-item">
							<div class="d-flex justify-content-between">
								<strong>Vigencia</strong>
								<?php if ($proforma->valid){ ?>
								<span id="edit_validity"><i class="bi bi-pencil-square text-primary"></i><i class="bi bi-x-lg text-danger d-none"></i></span>
								<?php } ?>
							</div>
							<?php if ($proforma->validity) $aux = "Hasta ".$proforma->validity; else $aux = "Indefinida"; ?>
							<div class="text-end"><span><?= $aux ?></span></div>
							<form id="form_edit_validity" class="mt-3 d-none">
								<input type="hidden" name="proforma_id" value="<?= $proforma->proforma_id ?>">
								<div class="input-group input-group-sm">
									<select class="form-select" name="validity">
										<?php $today = date("Y-m-d"); ?>
										<option value="<?= $today ?>">Solo hoy</option>
										<?php $aux = date("Y-m-d", strtotime("+1 week", strtotime($today))); ?>
										<option value="<?= $aux ?>">Hasta <?= $aux ?> (una semana)</option>
										<?php $aux = date("Y-m-d", strtotime("+2 week", strtotime($today))); ?>
										<option value="<?= $aux ?>">Hasta <?= $aux ?> (dos semanas)</option>
										<?php $aux = date("Y-m-d", strtotime("+1 month", strtotime($today))); ?>
										<option value="<?= $aux ?>">Hasta <?= $aux ?> (un mes)</option>
										<?php $aux = date("Y-m-d", strtotime("+3 months", strtotime($today))); ?>
										<option value="<?= $aux ?>">Hasta <?= $aux ?> (tres meses)</option>
										<?php $aux = date("Y-m-d", strtotime("+6 months", strtotime($today))); ?>
										<option value="<?= $aux ?>">Hasta <?= $aux ?> (seis meses)</option>
										<?php $aux = date("Y-m-d", strtotime("+1 year", strtotime($today))); ?>
										<option value="<?= $aux ?>">Hasta <?= $aux ?> (un año)</option>
										<option value="">Indefinido</option>
									</select>
									<button class="btn btn-success" type="submit"><i class="bi bi-check2"></i></button>
								</div>
							</form>
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
			<?php if ($proforma->valid){ ?>
			<div class="card">
				<div class="card-body pt-3">
					<div class="row">
						<div class="col-md-4 d-grid">
							<?php if ($proforma->color === "success") $d = ""; else $d = "disabled"; ?>
							<button type="button" class="btn btn-success mb-md-0 mb-3"  id="btn_open_gs" <?= $d ?>>
								<i class="bi bi-coin" style="font-size: 2rem;"></i><br/>Generar Venta
							</button>
						</div>
						<div class="col-md-4 d-grid">
							<a href="<?= base_url()?>commerce/proforma/view/<?= $proforma->proforma_id ?>" class="btn btn-primary  mb-md-0 mb-3" target="_blank">
								<i class="bi bi-file-earmark-pdf" style="font-size: 2rem;"></i><br/>PDF
							</a>
						</div>
						<div class="col-md-4 d-grid">
							<button type="button" class="btn btn-outline-danger" id="btn_void_proforma" value="<?= $proforma->proforma_id ?>">
								<i class="bi bi-trash" style="font-size: 2rem;"></i><br/>Anular Proforma
							</button>
						</div>
					</div>
				</div>
			</div>
			<?php if ($proforma->color === "success"){ ?>
			<div class="card d-none" id="card_generate_sale">
				<div class="card-body">
					<h5 class="card-title">Generar Venta</h5>
					<form id="form_add_sale">
						<input type="hidden" name="proforma_id" value="<?= $proforma->proforma_id ?>">
						<div class="row g-3">
							<div class="col-md-12">
								<label class="form-label">Recibido</label>
								<div class="input-group has-validation">
									<span class="input-group-text border-primary">S/</span>
									<input type="text" class="form-control border-primary" id="pay_received" name="payment[received]" value="0.00">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="col-md-4">
								<label class="form-label">Total</label>
								<div class="input-group">
									<span class="input-group-text">S/</span>
									<input type="text" class="form-control" id="pay_total" name="payment[total]" value="<?= number_format($proforma->amount, 2) ?>" readonly>
								</div>
							</div>
							<div class="col-md-4">
								<label class="form-label">Vuelto</label>
								<div class="input-group">
									<span class="input-group-text">S/</span>
									<input type="text" class="form-control" id="pay_change" name="payment[change]" value="0.00" readonly>
								</div>
							</div>
							<div class="col-md-4">
								<label class="form-label">Medio de Pago</label>
								<select class="form-select" name="payment[payment_method_id]">
									<?php foreach($payment_methods as $p){ ?>
									<option value="<?= $p->payment_method_id ?>"><?= $p->payment_method ?></option>
									<?php } ?>
								</select>
								<div class="invalid-feedback"></div>
							</div>
							<div class="col-md-12 pt-3 text-center">
								<button type="button" class="btn btn-secondary" id="btn_close_gs">Cerrar</button>
								<button type="submit" class="btn btn-primary">Generar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php }} ?>
			<div class="card">
				<div class="card-body pt-3">
					<table class="table align-middle pt-4">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Producto</th>
								<th scope="col">Cant.</th>
								<th scope="col" class="text-end">P/U</th>
								<th scope="col" class="text-end">Subtotal</th>
								<th scope="col"></th>
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
								<td class="text-nowrap text-end">
									<a href="<?= base_url() ?>stock/product/detail/<?= $p->product_id ?>" class="btn btn-outline-primary btn-sm border-0" target="_blank"><i class="bi bi-search"></i></a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>