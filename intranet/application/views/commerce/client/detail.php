<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Detalle de Cliente</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Comercio</li>
					<li class="breadcrumb-item">Clientes</li>
					<li class="breadcrumb-item active">Detalle</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>commerce/client" type="button" class="btn btn-success">
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
					<img src="<?= base_url() ?>uploads/client/<?= $client->image ?>" id="main_image" alt="Thumb" style="max-width: 80%;">
					<h2><?= $client->name ?></h2>
					<h3 class="mt-3 mb-0"><?= $client->doc_type ?></h3>
					<h3 class="mt-1"><?= $client->doc_number ?></h3>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card d-none" id="card_add_note">
				<div class="card-body">
					<h5 class="card-title">Agregar Nota</h5>
					<form id="form_add_note">
						<input type="hidden" name="client_id" value="<?= $client->client_id ?>">
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
					<ul class="nav nav-tabs nav-tabs-bordered">
						<li class="nav-item">
							<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#detail">Detalle</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#edit">Editar</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#image">Imagen</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#sales">Ventas</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#notes">Notas</button>
						</li>
					</ul>
					<div class="tab-content pt-4">
						<div class="tab-pane fade show active profile-overview" id="detail">
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Código</div>
								<div class="col-lg-9 col-md-8"><?= $client->doc_number; ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Nombre</div>
								<div class="col-lg-9 col-md-8"><?= $client->name ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Teléfono</div>
								<div class="col-lg-9 col-md-8"><?= $client->tel ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Celular</div>
								<div class="col-lg-9 col-md-8"><?= $client->mobile ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Correo E.</div>
								<div class="col-lg-9 col-md-8"><?= $client->email ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Dirección</div>
								<div class="col-lg-9 col-md-8"><?= $client->address ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Actualizado</div>
								<div class="col-lg-9 col-md-8"><?= $client->updated_at ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Registrado</div>
								<div class="col-lg-9 col-md-8"><?= $client->registed_at ?></div>
							</div>
						</div>
						<div class="tab-pane fade profile-edit" id="edit">
							<form id="form_update_data">
								<input type="hidden" name="client_id" value="<?= $client->client_id ?>">
								<h5 class="card-title pt-0">Datos</h5>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Teléfono</label>
									<div class="col-md-8 col-lg-9">
										<input name="tel" type="text" class="form-control" value="<?= $client->tel ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Celular</label>
									<div class="col-md-8 col-lg-9">
										<input name="mobile" type="text" class="form-control" value="<?= $client->mobile ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Correo Elect.</label>
									<div class="col-md-8 col-lg-9">
										<input name="email" type="text" class="form-control" value="<?= $client->email ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Dirección</label>
									<div class="col-md-8 col-lg-9">
										<input name="address" type="text" class="form-control" value="<?= $client->address ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="text-center pt-3">
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</form>
						</div>
						<div class="tab-pane fade profile-edit" id="image">
							<form id="form_update_image">
								<input type="hidden" name="client_id" value="<?= $client->client_id ?>">
								<h5 class="card-title pt-0">Imagen</h5>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Archivo</label>
									<div class="col-md-8 col-lg-9">
										<input name="image" type="file" class="form-control" accept="image/*">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="text-center pt-3">
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="sales">
							<div class="table-responsive">
								<table class="table align-middle">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Fecha</th>
											<th scope="col">Pago</th>
											<th scope="col">Saldo</th>
											<th scope="col">Total</th>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody id="tbody_options">
										<?php foreach($sales as $i_s => $s){ ?>
										<tr>
											<th scope="row"><?= $i_s + 1 ?></th>
											<td><?= $s->registed_at ?></td>
											<td>S/ <?= number_format($s->paid, 2) ?></td>
											<td><?= ($s->balance > 0) ? "S/ ".number_format($s->balance, 2) : "-" ?></td>
											<td>S/ <?= number_format($s->amount, 2) ?></td>
											<td class="text-end">
												<a href="<?= base_url() ?>commerce/sale/detail/<?= $s->sale_id ?>" class="btn btn-outline-primary btn-sm border-0" value="<?= $s->sale_id ?>">
													<i class="bi bi-search"></i>
												</a>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="mt-3">
								<ul class="pagination" id="sale_pagination">
									<?php foreach($sales_paging as $p){ ?>
									<li class="page-item <?= $p[2] ?>">
										<button class="page-link" value="<?= $p[0] ?>"><?= $p[1] ?></button>
									</li>
									<?php } ?>
								</ul>
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
											<th scope="col" class="text-end">
												<button type="button" class="btn btn-success btn-sm border-0" id="btn_add_note">
													<i class="bi bi-plus-lg"></i>
												</button>
											</th>
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