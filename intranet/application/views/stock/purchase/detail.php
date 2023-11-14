<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Detalle de Compra</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Stock</li>
					<li class="breadcrumb-item">Compras</li>
					<li class="breadcrumb-item active">Detalle</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>stock/purchase" type="button" class="btn btn-success">
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
					<?php if ($provider){ ?><h2 class="mb-5"><?= $provider->name ?></h2><?php } ?>
					<ul class="list-group w-100">
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<strong>Estado</strong>
							<span class="text-<?= $purchase->color ?>"><?= $purchase->status ?></span>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<strong>Monto</strong>
							<span>S/ <?= number_format($purchase->amount, 2) ?></span>
						</li>
						<?php if ($purchase->balance){ ?>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<strong>Saldo</strong>
							<span>S/ <?= number_format($purchase->balance, 2) ?></span>
						</li>
						<?php } ?>
						<li class="list-group-item">
							<div class="text-start"><strong>Fecha de Registro</strong></div>
							<div class="text-end"><span><?= $purchase->registed_at ?></span></div>
						</li>
						<li class="list-group-item">
							<div class="text-start"><strong>Última Actualización</strong></div>
							<div class="text-end"><span><?= $purchase->updated_at ?></span></div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card d-none" id="card_file_upload">
				<div class="card-body">
					<h5 class="card-title">Subir Archivo</h5>
					<form id="form_file_upload">
						<input type="hidden" name="purchase_id" value="<?= $purchase->purchase_id ?>">
						<div class="row g-3">
							<div class="col-md-12">
								<label class="form-label">Nombre</label>
								<input type="text" class="form-control" name="filename">
								<div class="invalid-feedback"></div>
							</div>
							<div class="col-md-12">
								<label class="form-label">Archivo</label>
								<input type="file" class="form-control" name="filename">
								<div class="invalid-feedback"></div>
							</div>
							<div class="col-md-12 pt-3 text-center">
								<button type="button" class="btn btn-secondary" id="btn_close_cfu">Cerrar</button>
								<button type="submit" class="btn btn-primary">Subir</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php if ($purchase->balance){ ?>
			<div class="card d-none" id="card_add_payment">
				<div class="card-body">
					<h5 class="card-title">Agregar Pago</h5>
					<form id="form_add_payment" class="row g-3">
						<input type="hidden" name="purchase_id" value="<?= $purchase->purchase_id ?>">
						<div class="col-md-12">
							<label class="form-label">Pagado</label>
							<div class="input-group has-validation">
								<span class="input-group-text border-primary">S/</span>
								<input type="text" class="form-control border-primary" id="pay_paid" name="paid" value="0.00">
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="col-md-4">
							<label class="form-label">Total</label>
							<div class="input-group">
								<span class="input-group-text">S/</span>
								<input type="text" class="form-control" id="pay_total" name="total" value="<?= number_format($purchase->balance, 2) ?>" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<label class="form-label">Saldo</label>
							<div class="input-group">
								<span class="input-group-text">S/.</span>
								<input type="text" class="form-control" id="pay_balance" name="balance" value="0.00" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<label class="form-label">Medio de Pago</label>
							<select class="form-select" name="payment_method_id">
								<?php foreach($payment_methods as $p){ ?>
								<option value="<?= $p->payment_method_id ?>"><?= $p->payment_method ?></option>
								<?php } ?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-12 pt-3 text-center">
							<button type="button" class="btn btn-secondary" id="btn_close_ap">Cerrar</button>
							<button type="submit" class="btn btn-primary">Agregar</button>
						</div>
					</form>
				</div>
			</div>
			<?php } ?>
			<div class="card d-none" id="card_add_note">
				<div class="card-body">
					<h5 class="card-title">Agregar Nota</h5>
					<form id="form_add_note">
						<input type="hidden" name="purchase_id" value="<?= $purchase->purchase_id ?>">
						<div class="row g-3">
							<div class="col-md-12">
								<label class="form-label">Nota</label>
								<textarea class="form-control" name="note" rows="5"></textarea>
								<div class="invalid-feedback"></div>
							</div>
							<div class="col-md-12 pt-3 text-center">
								<button type="button" class="btn btn-secondary" id="btn_close_an">Cerrar</button>
								<button type="submit" class="btn btn-primary">Agregar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="card">
				<div class="card-body pt-3">
					<?php if ($purchase->valid){ ?>
					<div class="row">
						<div class="col-md-3 d-grid">
							<button type="button" class="btn btn-success mb-3" id="btn_file_upload">
								<i class="bi bi-upload" style="font-size: 2rem;"></i><br/>Archivo
							</button>
						</div>
						<div class="col-md-3 d-grid">
							<?php if ($purchase->balance) $d = ""; else $d = "disabled"; ?>
							<button type="button" class="btn btn-primary mb-3" <?= $d ?> id="btn_add_payment">
								<i class="bi bi-credit-card" style="font-size: 2rem;"></i><br/>Pago
							</button>
						</div>
						<div class="col-md-3 d-grid">
							<button type="button" class="btn btn-primary mb-3" id="btn_add_note">
								<i class="bi bi-journal-check" style="font-size: 2rem;"></i><br/>Nota
							</button>
						</div>
						<div class="col-md-3 d-grid">
							<button type="button" class="btn btn-outline-danger mb-3" id="btn_cancel_purchase" value="<?= $purchase->purchase_id ?>">
								<i class="bi bi-trash" style="font-size: 2rem;"></i><br/>Anular
							</button>
						</div>
					</div>
					<?php } ?>
					<ul class="nav nav-tabs nav-tabs-bordered">
						<li class="nav-item">
							<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#products">Productos</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#payments">Pagos</button>
						</li>
					</ul>
					<div class="tab-content pt-4">
						<div class="tab-pane fade show active" id="products">
							<div class="table-responsive">
								<table class="table align-middle">
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
											<td class="text-nowrap text-end">S/ <?= number_format($p->subtotal, 2) ?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane fade" id="payments">
							<div class="table-responsive">
								<table class="table align-middle">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Fecha</th>
											<th scope="col">Metodo</th>
											<th scope="col" class="text-end">Monto</th>
											<th scope="col" class="text-end">Balance</th>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody id="tbody_images">
										<?php foreach($payments as $p_i => $p){ ?>
										<tr>
											<th scope="row"><?= number_format($p_i + 1) ?></th>
											<td><?= $p->registed_at ?></td>
											<td><?= $p->payment_method ?></td>
											<td class="text-nowrap text-end">S/ <?= number_format($p->paid, 2) ?></td>
											<td class="text-nowrap text-end">S/ <?= number_format($p->balance, 2) ?></td>
											<td class="text-end">
												<button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_payment" value="<?= $p->payment_id ?>">
													<i class="bi bi-x-lg"></i>
												</button>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>