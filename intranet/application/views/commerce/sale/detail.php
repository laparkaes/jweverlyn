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
						<?php if ($invoice){ ?>
						<li class="list-group-item">
							<div class="text-start"><strong>Sunat</strong></div>
							<div class="text-end">
								<a href="<?= base_url() ?>/uploads/sunat/<?= $invoice->file_xml ?>" download="<?= $invoice->file_xml ?>" class="btn btn-outline-success btn-sm" target="_blank">XML</a>
								<a href="<?= base_url() ?>/uploads/sunat/<?= $invoice->file_cdr ?>" download="<?= $invoice->file_cdr ?>" class="btn btn-outline-success btn-sm" target="_blank">CDR</a>
								<button type="button" class="btn btn-outline-danger btn-sm" id="btn_void_invoice" value="<?= $invoice->invoice_id ?>">Anular</button>
							</div>
						</li>
						<?php } ?>
					</ul>
					
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-body pt-3">
					<?php if ($sale->valid){ ?>
					<div class="row">
						<div class="col-md-4 d-grid">
							<?php if ($invoice){ ?>
							<a href="<?= base_url()?>commerce/sale/view_invoice/<?= $invoice->invoice_id ?>" class="btn btn-success mb-3" target="_blank">
								<i class="bi bi-file-earmark-text-fill" style="font-size: 2rem;"></i><br/><?= $invoice->type ?>
							</a>
							<?php }else{ if ($sale->balance) $d = "disabled"; else $d = ""; ?>
							<button type="button" class="btn btn-success mb-3" <?= $d ?> data-bs-toggle="modal" data-bs-target="#md_issue_invoice">
								<i class="bi bi-file-earmark-text-fill" style="font-size: 2rem;"></i><br/>Comprobante
							</button>
							<?php } ?>
						</div>
						<div class="col-md-4 d-grid">
							<?php if ($sale->balance) $d = ""; else $d = "disabled"; ?>
							<button type="button" class="btn btn-primary mb-3" <?= $d ?> data-bs-toggle="modal" data-bs-target="#md_add_payment">
								<i class="bi bi-piggy-bank-fill" style="font-size: 2rem;"></i><br/>Agregar Pago
							</button>
						</div>
						<div class="col-md-4 d-grid">
							<button type="button" class="btn btn-outline-danger mb-3" id="btn_cancel_sale" value="<?= $sale->sale_id ?>">
								<i class="bi bi-trash" style="font-size: 2rem;"></i><br/>Cancelar Venta
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
											<th scope="col">Metodo / Fecha</th>
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
											<td class="text-nowrap text-end">S/ <?= number_format($p->received, 2) ?></td>
											<td class="text-nowrap text-end">S/ <?= number_format($p->change, 2) ?></td>
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

<!-- modals -->
<?php if ($sale->balance){ ?>
<div class="modal fade" id="md_add_payment" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="form_add_payment">
				<input type="hidden" name="sale_id" value="<?= $sale->sale_id ?>">
				<div class="modal-header">
					<h5 class="modal-title">Agregar Pago</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
				</div>
				<div class="modal-body text-start">
					<div class="row g-3">
						<div class="col-md-6">
							<label class="form-label">Medio de Pago</label>
							<select class="form-select" name="payment_method_id">
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
								<input type="hidden" id="received" name="received" value="0.00">
								<input type="text" class="form-control" id="received_txt" name="received_txt" value="0.00">
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="col-md-6">
							<label class="form-label">Total</label>
							<div class="input-group">
								<span class="input-group-text">S/.</span>
								<input type="hidden" id="total" name="total" value="<?= $sale->balance ?>" readonly>
								<input type="text" class="form-control" id="total_txt" value="<?= number_format($sale->balance, 2) ?>" disabled>
							</div>
						</div>
						<div class="col-md-6">
							<label class="form-label">Vuelto</label>
							<div class="input-group">
								<span class="input-group-text">S/.</span>
								<input type="hidden"id="change" name="change" value="0.00" readonly>
								<input type="text" class="form-control" id="change_txt" value="0.00" disabled>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" id="btn_add_payment">Agregar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php }else{ ?>
<div class="modal fade" id="md_issue_invoice" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="form_issue_invoice">
				<input type="hidden" name="invoice[sale_id]" value="<?= $sale->sale_id ?>">
				<div class="modal-header">
					<h5 class="modal-title">Emitir Comprobante</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
				</div>
				<div class="modal-body text-start">
					<div class="row g-3">
						<div class="col-md-6">
							<label class="form-label">Serie</label>
							<select class="form-select" name="invoice[serie_id]">
								<?php foreach($invoice_series as $is){ ?>
								<option value="<?= $is->serie_id ?>"><?= $is->serie." - ".$is->description ?></option>
								<?php } ?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-6">
							<label class="form-label">Tipo</label>
							<select class="form-select" name="invoice[type_id]" id="invoice_type_id">
								<?php foreach($invoice_types as $it){ ?>
								<option value="<?= $it->type_id ?>"><?= $it->type ?></option>
								<?php } ?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-6">
							<label class="form-label">Documento</label>
							<select class="form-select" name="client[doc_type_id]" id="doc_type_id">
								<?php foreach($client_doc_types as $dt){ 
								if ($client){
									if ($client->doc_type_id == $dt->doc_type_id) $s = "selected";
									else $s = "";
								}else $s = ""; ?>
								<option value="<?= $dt->doc_type_id ?>" <?= $s ?>><?= $dt->doc_type ?></option>
								<?php } ?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
						<?php if ($client){
							$doc_number = $client->doc_number;
							$name = $client->name;
							$d = "";
						}else{
							$doc_number = $name = "";
							$d = "disabled";
						} ?>
						<div class="col-md-6">
							<label class="form-label">Número</label>
							<div class="input-group has-validation">
								<input type="text" class="form-control" name="client[doc_number]" id="doc_number" value="<?= $doc_number ?>" <?= $d ?>>
								<button type="button" class="btn btn-primary" id="btn_search_person" <?= $d ?>>
									<i class="bi bi-search"></i>
								</button>
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="col-md-12">
							<label class="form-label">Nombre</label>
							<input type="text" class="form-control" name="client[name]" id="client_name" value="<?= $name ?>" <?= $d ?>>
							<div class="invalid-feedback"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" id="btn_issue_invoice">Emitir</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>