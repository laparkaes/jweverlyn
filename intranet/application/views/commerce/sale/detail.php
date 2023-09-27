<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Detalle de Venta</h1>
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
							<strong>Estado</strong>
							<span class="text-<?= $sale->color ?>"><?= $sale->status ?></span>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<strong>Monto</strong>
							<span>S/. <?= number_format($sale->amount, 2) ?></span>
						</li>
						<?php if ($sale->balance){ ?>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<strong>Saldo</strong>
							<span>S/. <?= number_format($sale->balance, 2) ?></span>
						</li>
						<?php } ?>
						<li class="list-group-item">
							<div class="text-start"><strong>Fecha de Registro</strong></div>
							<div class="text-end"><span><?= $sale->registed_at ?></span></div>
						</li>
						<li class="list-group-item">
							<div class="text-start"><strong>Última Actualización</strong></div>
							<div class="text-end"><span><?= $sale->updated_at ?></span></div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-body pt-3">
					<div class="row">
						<div class="col-md-4 d-grid">
							<button type="button" class="btn btn-success mb-3">
								<i class="bi bi-file-earmark-text-fill" style="font-size: 2rem;"></i><br/>Comprobante
							</button>
						</div>
						<div class="col-md-4 d-grid">
							<?php if ($sale->balance) $d = ""; else $d = "disabled"; ?>
							<button type="button" class="btn btn-primary mb-3" <?= $d ?>>
								<i class="bi bi-piggy-bank-fill" style="font-size: 2rem;"></i><br/>Agregar Pago
							</button>
						</div>
						<div class="col-md-4 d-grid">
							<button type="button" class="btn btn-outline-danger mb-3">
								<i class="bi bi-trash" style="font-size: 2rem;"></i><br/>Anular Venta
							</button>
						</div>
					</div>
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
											<th scope="col">Metodo / Fecha</th>
											<th scope="col">Total</th>
											<th scope="col">Recibido</th>
											<th scope="col">Vuelto</th>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody id="tbody_images">
										<?php foreach($payments as $p_i => $p){ ?>
										<tr>
											<th scope="row"><?= number_format($p_i + 1) ?></th>
											<td><?= $p->payment_method ?><br/><?= $p->registed_at ?></td>
											<td class="text-nowrap text-end">S/ <?= number_format($p->total, 2) ?></td>
											<td class="text-nowrap text-end">S/ <?= number_format($p->received, 2) ?></td>
											<td class="text-nowrap text-end">S/ <?= number_format($p->change, 2) ?></td>
											<td class="text-end">
												<button type="button" class="btn btn-outline-danger btn-sm border-0">
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

<!-- modals -->
<div class="modal fade" id="md_add_option" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="form_add_option">
				<input type="hidden" name="product_id" value="<?="aa" //$product->product_id ?>">
				<div class="modal-header">
					<h5 class="modal-title">Agregar Opción</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
				</div>
				<div class="modal-body text-start">
					<div class="row g-3">
						<div class="col-6">
							<label class="form-label">Opción</label>
							<input type="text" class="form-control" name="option">
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-6">
							<label class="form-label">Stock</label>
							<input type="text" class="form-control" name="stock">
							<div class="invalid-feedback"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Agregar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="md_edit_option" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="form_update_option">
				<input type="hidden" name="option_id">
				<input type="hidden" name="product_id" value="<?="aa" //$product->product_id ?>">
				<div class="modal-header">
					<h5 class="modal-title">Editar Opción</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
				</div>
				<div class="modal-body text-start">
					<div class="row g-3">
						<div class="col-6">
							<label class="form-label">Opción</label>
							<input type="text" class="form-control" name="option">
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-6">
							<label class="form-label">Stock</label>
							<input type="text" class="form-control" name="stock">
							<div class="invalid-feedback"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Actualizar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="md_add_image" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="form_add_image">
				<input type="hidden" name="product_id" value="<?="aa" //$product->product_id ?>">
				<div class="modal-header">
					<h5 class="modal-title">Agregar Imagen</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
				</div>
				<div class="modal-body text-start">
					<div class="row g-3">
						<div class="col-12">
							<label class="form-label">Imagen</label>
							<input type="file" class="form-control" name="image" accept=".jpg, .jpeg, .png, .gif">
							<div class="invalid-feedback"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Agregar</button>
				</div>
			</form>
		</div>
	</div>
</div>