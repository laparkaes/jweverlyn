<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Detalle de Cliente</h1>
			<nav>
				<ol class="breadcrumb">
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
					<?php  ?>
					<img src="<?= $client->thumb ?>" id="main_image" alt="Thumb" style="max-width: 80%;">
					<h2><?= $client->name ?></h2>
					<h3 class="mt-1"><?= $client->doc_type ?><br/><?= $client->doc_number ?></h3>
				</div>
			</div>
		</div>
		<div class="col-md-8">
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
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#sales">Ventas</button>
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
							<form id="form_update_client_data">
								<h5 class="card-title pt-0">Datos</h5>
								<input type="hidden" name="client_id" value="<?= $client->client_id ?>">
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Nombre</label>
									<div class="col-md-8 col-lg-9">
										<input name="name" type="text" class="form-control" value="<?= $client->name ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
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
									<label class="col-md-4 col-lg-3 col-form-label">Address</label>
									<div class="col-md-8 col-lg-9">
										<input name="address" type="text" class="form-control" value="<?= $client->address ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="text-center pt-3">
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</form>
							<hr>
							<form id="form_update_client_image">
								<h5 class="card-title">Imagen</h5>
								<input type="hidden" name="client_id" value="<?= $client->client_id ?>">
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Archivo</label>
									<div class="col-md-8 col-lg-9">
										<input name="image" type="file" class="form-control">
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
											<th scope="col">Pago</th>
											<th scope="col">Saldo</th>
											<th scope="col">Total</th>
											<th scope="col" class="text-end">
												<button type="button" class="btn btn-success btn-sm border-0" data-bs-toggle="modal" data-bs-target="#md_add_option">
													<i class="bi bi-plus-lg"></i>
												</button>
											</th>
										</tr>
									</thead>
									<tbody id="tbody_options">
										<?php foreach($sales as $i_s => $s){ ?>
										<tr>
											<th scope="row"><?= $i_s + 1 ?></th>
											<!-- td><?= date("y").str_pad($s->proforma_id, 4, '0', STR_PAD_LEFT) ?></td -->
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
						</div>
						<div class="tab-pane fade" id="images">
							<div class="table-responsive">
								<table class="table align-middle">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Imagen</th>
											<th scope="col">Ruta</th>
											<th scope="col" class="text-end">
												<button type="button" class="btn btn-success btn-sm border-0" data-bs-toggle="modal" data-bs-target="#md_add_image">
													<i class="bi bi-plus-lg"></i>
												</button>
											</th>
										</tr>
									</thead>
									<tbody id="tbody_images">
										<?php foreach($images as $i_i => $i){ ?>
										<tr>
											<th scope="row"><?= $i_i + 1 ?></th>
											<td><img src="<?= $i->thumb ?>" alt="Thumb" style="max-height: 80px;"></td>
											<td><?= $i->image_path ?></td>
											<td class="text-end">
												<button type="button" class="btn btn-outline-primary btn-sm border-0 btn_edit_image" value="<?= $i->image_id ?>">
													<i class="bi bi-image"></i>
												</button>
												<button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_image" value="<?= $i->image_id ?>">
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
				<input type="hidden" name="client_id" value="<?= $client->client_id ?>">
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
<div class="modal fade" id="md_add_image" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="form_add_image">
				<input type="hidden" name="client_id" value="<?= $client->client_id ?>">
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