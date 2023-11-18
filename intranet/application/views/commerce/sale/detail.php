<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Detalle de Venta</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Comercio</li>
					<li class="breadcrumb-item">Ventas</li>
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
					<?php if ($client){ ?>
					<h2><?= $client->name ?></h2>
					<h3 class="mt-3 mb-0"><?= $client->doc_type ?></h3>
					<h3 class="mt-1"><?= $client->doc_number ?></h3>
					<?php } ?>
					<?php if ($sale->proforma_id){ ?>
					<div class="d-grid gap-2 w-100 mb-3">
						<a href="<?= base_url() ?>commerce/proforma/detail/<?= $sale->proforma_id ?>" class="btn btn-primary" target="_blank">
							Ver Proforma
						</a>
					</div>
					<?php } ?>
					<div class="d-grid gap-2 w-100 mb-3">
						<?php if ($invoice){ ?>
						<a href="<?= base_url()?>commerce/sale/view_invoice/<?= $invoice->invoice_id ?>" class="btn btn-success" target="_blank">
							Ver <?= $invoice->type ?>
						</a>
						<?php }else{ if ($sale->balance) $d = "disabled"; else $d = ""; ?>
						<button type="button" class="btn btn-success" <?= $d ?> id="btn_open_ii">
							Comprobante
						</button>
						<?php } ?>
					</div>
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
							<div class="text-start"><strong>Comprobante</strong></div>
							<div class="text-end">
								<?php if ($invoice->is_sent_sunat){ ?>
								<button type="button" class="btn btn-outline-danger btn-sm" id="btn_void_invoice" value="<?= $invoice->invoice_id ?>">Anular <?= $invoice->type ?></button>
								<?php }else{ ?>
								<button type="button" class="btn btn-outline-primary btn-sm" id="btn_send_invoice" value="<?= $invoice->invoice_id ?>">Enviar a Sunat</button>
								<?php } ?>
							</div>
						</li>
						<?php } if ($sunat_files){ ?>
						<li class="list-group-item">
							<div class="text-start"><strong>Archivos de Sunat</strong></div>
							<div class="text-end">
								<?php foreach($sunat_files as $f){ ?>
								<div class="d-flex justify-content-between align-items-center mt-1">
									<span><?= date("Y-m-d", strtotime($f->registed_at)) ?></span>
									<div>
									<?php if ($f->xml){ ?>
										<a href="<?= base_url() ?>/uploads/sunat/<?= $f->xml ?>" download="<?= $f->xml ?>" class="btn btn-outline-success btn-sm" target="_blank">XML</a>
										<?php } if ($f->cdr){ ?>
										<a href="<?= base_url() ?>/uploads/sunat/<?= $f->cdr ?>" download="<?= $f->cdr ?>" class="btn btn-outline-success btn-sm" target="_blank">CDR</a>
										<?php } ?>
									</div>
								</div>
								<?php } ?>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<?php if ($sale->valid){ ?>
			<div class="card">
				<div class="card-body pt-3">
					<div class="row">
						<div class="col-md-3 d-grid">
							<button type="button" class="btn btn-success mb-md-0 mb-3" id="btn_file_upload">
								<i class="bi bi-upload" style="font-size: 2rem;"></i><br/>Archivo
							</button>
						</div>
						<div class="col-md-3 d-grid">
							<?php if ($sale->balance) $d = ""; else $d = "disabled"; ?>
							<button type="button" class="btn btn-primary mb-md-0 mb-3" <?= $d ?> id="btn_open_ap">
								<i class="bi bi-credit-card" style="font-size: 2rem;"></i><br/>Pago
							</button>
						</div>
						<div class="col-md-3 d-grid">
							<button type="button" class="btn btn-primary mb-md-0 mb-3" id="btn_open_an">
								<i class="bi bi-journal-check" style="font-size: 2rem;"></i><br/>Nota
							</button>
						</div>
						<div class="col-md-3 d-grid">
							<button type="button" class="btn btn-outline-danger" id="btn_cancel_sale" value="<?= $sale->sale_id ?>">
								<i class="bi bi-trash" style="font-size: 2rem;"></i><br/>Anular
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="card d-none" id="card_file_upload">
				<div class="card-body">
					<h5 class="card-title">Subir Archivo</h5>
					<form id="form_file_upload">
						<input type="hidden" name="sale_id" value="<?= $sale->sale_id ?>">
						<div class="row g-3">
							<div class="col-12">
								<label class="form-label">Descripción</label>
								<input type="text" class="form-control" name="description">
								<div class="invalid-feedback"></div>
							</div>
							<div class="col-12">
								<label class="form-label">Archivo</label>
								<input type="file" class="form-control" name="upload">
								<div class="invalid-feedback"></div>
							</div>
							<div class="col-12 pt-3 text-center">
								<button type="button" class="btn btn-secondary" id="btn_close_cfu">Cerrar</button>
								<button type="submit" class="btn btn-primary">Subir</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php if ($sale->balance){ ?>
			<div class="card d-none" id="card_add_payment">
				<div class="card-body">
					<h5 class="card-title">Agregar Pago</h5>
					<form id="form_add_payment">
						<input type="hidden" name="sale_id" value="<?= $sale->sale_id ?>">
						<div class="row g-3">
							<div class="col-md-12">
								<label class="form-label">Recibido</label>
								<div class="input-group has-validation">
									<span class="input-group-text border-primary">S/</span>
									<input type="text" class="form-control border-primary" id="pay_received" name="received" value="0.00">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="col-md-4">
								<label class="form-label">Total</label>
								<div class="input-group">
									<span class="input-group-text">S/</span>
									<input type="text" class="form-control" id="pay_total" name="total" value="<?= number_format($sale->balance, 2) ?>" readonly>
								</div>
							</div>
							<div class="col-md-4">
								<label class="form-label">Vuelto</label>
								<div class="input-group">
									<span class="input-group-text">S/</span>
									<input type="text" class="form-control" id="pay_change" name="change" value="0.00" readonly>
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
							<div class="col-md-12 pt-3 text-center">
								<button type="button" class="btn btn-secondary" id="btn_close_ap">Cerrar</button>
								<button type="submit" class="btn btn-primary">Agregar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php }else{ ?>
			<div class="card d-none" id="card_issue_invoice">
				<div class="card-body">
					<h5 class="card-title">Emitir Comprobante</h5>
					<form id="form_issue_invoice">
						<input type="hidden" name="invoice[sale_id]" value="<?= $sale->sale_id ?>">
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
							<div class="col-md-12 pt-3 text-center">
								<button type="button" class="btn btn-secondary" id="btn_close_ii">Cerrar</button>
								<button type="submit" class="btn btn-primary">Emitir</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php } ?>
			<div class="card d-none" id="card_add_note">
				<div class="card-body">
					<h5 class="card-title">Agregar Nota</h5>
					<form id="form_add_note">
						<input type="hidden" name="sale_id" value="<?= $sale->sale_id ?>">
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
			<?php } ?>
			<div class="card">
				<div class="card-body pt-3">
					<ul class="nav nav-tabs nav-tabs-bordered">
						<li class="nav-item">
							<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#products">Productos</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#files">Archivos</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#payments">Pagos</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#notes">Notas</button>
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
											<th scope="col" class="text-end">P/U</th>
											<th scope="col" class="text-end">Subtotal</th>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody id="tbody_images">
										<?php foreach($products as $p_i => $p){ ?>
										<tr>
											<th scope="row"><?= number_format($p_i + 1) ?></th>
											<td>
												<?= $p->prod->product ?><br>
												<?php if ($p->option_id){ ?>
												<small><?= $p->op->option ?></small>
												<?php } ?>
											</td>
											<td><?= number_format($p->qty) ?></td>
											<td class="text-nowrap text-end">S/ <?= number_format($p->price, 2) ?></td>
											<td class="text-nowrap text-end">S/ <?= number_format($p->subtotal, 2) ?></td>
											<td class="text-nowrap text-end">
												<a href="<?= base_url() ?>stock/product/detail/<?= $p->product_id ?>" class="btn btn-outline-primary btn-sm border-0" target="_blank"><i class="bi bi-search"></i></a>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane fade" id="files">
							<div class="table-responsive">
								<table class="table align-middle">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Fecha</th>
											<th scope="col">Descripción</th>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody id="tbody_images">
										<?php foreach($files as $f_i => $f){ ?>
										<tr>
											<th scope="row"><?= number_format($f_i + 1) ?></th>
											<td><?= $f->registed_at ?></td>
											<td><?= $f->description ?></td>
											<td class="text-end">
												<a href="<?= base_url() ?>/uploads/sale/<?= $sale->sale_id ?>/<?= $f->filename ?>" download="<?= $f->description."_".$f->filename ?>" class="btn btn-outline-success btn-sm border-0"><i class="bi bi-download"></i></a>
												<button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_file" value="<?= $f->file_id ?>">
													<i class="bi bi-x-lg"></i>
												</button>
											</td>
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
											<th scope="col" class="text-end">Recibido</th>
											<th scope="col" class="text-end">Vuelto</th>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody id="tbody_images">
										<?php foreach($payments as $p_i => $p){ ?>
										<tr>
											<th scope="row"><?= number_format($p_i + 1) ?></th>
											<td><?= $p->registed_at ?></td>
											<td><?= $p->payment_method ?></td>
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
						<div class="tab-pane fade" id="notes">
							<div class="table-responsive">
								<table class="table align-middle">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Fecha</th>
											<th scope="col">Nota</th>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody id="tbody_images">
										<?php foreach($notes as $n_i => $n){ ?>
										<tr>
											<th scope="row"><?= number_format($n_i + 1) ?></th>
											<td><?= $n->registed_at ?></td>
											<td style="white-space: pre-line;"><?= $n->note ?></td>
											<td class="text-end">
												<button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_note" value="<?= $n->note_id ?>">
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