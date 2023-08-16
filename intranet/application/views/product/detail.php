<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Detalle de Producto</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Producto</li>
					<li class="breadcrumb-item active">Detalle</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>product" type="button" class="btn btn-success">
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
					<img src="<?= $product->img ?>" alt="Thumb" class="w-100" style="max-width: 80%;">
					<h2><?= $product->product ?></h2>
					<h3><?= $product->category ?></h3>
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
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#options">Opciones</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#images">Imagenes</button>
						</li>
					</ul>
					<div class="tab-content pt-4">
						<div class="tab-pane fade show active profile-overview" id="detail">
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Código</div>
								<div class="col-lg-9 col-md-8"><?= $product->code ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Nombre</div>
								<div class="col-lg-9 col-md-8"><?= $product->product ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Categoría</div>
								<div class="col-lg-9 col-md-8"><?= $product->category ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Precio</div>
								<div class="col-lg-9 col-md-8">S/ <?= number_format($product->price, 2) ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Stock</div>
								<div class="col-lg-9 col-md-8"><?= number_format($product->stock) ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Actualizado</div>
								<div class="col-lg-9 col-md-8"><?= $product->updated_at ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Registrado</div>
								<div class="col-lg-9 col-md-8"><?= $product->registed_at ?></div>
							</div>
						</div>
						<div class="tab-pane fade profile-edit" id="edit">
							<form id="form_update_product">
								<input type="hidden" name="product_id" value="<?= $product->product_id ?>">
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Código</label>
									<div class="col-md-8 col-lg-9">
										<input name="code" type="text" class="form-control" value="<?= $product->code ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Producto</label>
									<div class="col-md-8 col-lg-9">
										<input name="product" type="text" class="form-control" value="<?= $product->product ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Categoría</label>
									<div class="col-md-8 col-lg-9">
										<select class="form-select" name="category_id">
											<option value="">Elegir</option>
											<?php foreach($categories as $c){ 
											if ($c->category_id == $product->category_id) $s = "selected"; else $s = ""; ?>
											<option value="<?= $c->category_id ?>" <?= $s ?>><?= $c->category ?></option>
											<?php } ?>
										</select>
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Precio</label>
									<div class="col-md-8 col-lg-9">
										<div class="input-group">
											<span class="input-group-text" id="basic-addon1">S/</span>
											<input type="text" class="form-control" name="price" value="<?= number_format($product->price, 2) ?>">
											<div class="invalid-feedback"></div>
										</div>
									</div>
								</div>
								<div class="text-center pt-3">
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="options">
							<div class="table-responsive">
								<table class="table align-middle">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Opción</th>
											<th scope="col">Stock</th>
											<th scope="col" class="text-end">
												<button type="button" class="btn btn-success btn-sm border-0" data-bs-toggle="modal" data-bs-target="#md_add_option">
													<i class="bi bi-plus-lg"></i>
												</button>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($options as $i_o => $o){ ?>
										<tr>
											<th scope="row"><?= $i_o + 1 ?></th>
											<td><?= $o->option ?></td>
											<td><?= number_format($o->stock) ?></td>
											<td class="text-end">
												<button type="button" class="btn btn-outline-primary btn-sm border-0 btn_edit_option" data-bs-toggle="modal" data-bs-target="#md_edit_option" value="<?= $o->option_id ?>">
													<i class="bi bi-pencil-fill"></i>
												</button>
												<button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_option" value="<?= $o->option_id ?>">
													<i class="bi bi-x-lg"></i>
												</button>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane fade" id="images">
							<h5 class="card-title pt-0">Imagen Principal</h5>
							<form class="row">
								<div class="col">
									<div class="input-group mb-3">
										<input class="form-control" type="file" name="filename">
										<button class="btn btn-primary" type="submit">Agregar</button>
									</div>
								</div>
							</form>
							<div class="row">
								<?php for($i = 1; $i < 10; $i++){ ?>
								<div class="col-auto mb-3">
									<img src="https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2014/02/281537-critica-lego-pelicula.jpg?tf=3840x" style="height: 80px;">
								</div>
								<?php } ?>
							</div>
							<h5 class="card-title">Modo de Uso</h5>
							<form class="row">
								<div class="col">
									<div class="input-group mb-3">
										<input class="form-control" type="file" name="filename">
										<button class="btn btn-primary" type="submit">Agregar</button>
									</div>
								</div>
							</form>
							<div class="row">
								<?php for($i = 1; $i < 10; $i++){ ?>
								<div class="col-auto mb-3">
									<img src="https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2014/02/281537-critica-lego-pelicula.jpg?tf=3840x" style="height: 80px;">
								</div>
								<?php } ?>
							</div>
							<h5 class="card-title">Tallas</h5>
							<form class="row">
								<div class="col">
									<div class="input-group mb-3">
										<input class="form-control" type="file" name="filename">
										<button class="btn btn-primary" type="submit">Agregar</button>
									</div>
								</div>
							</form>
							<div class="row">
								<?php for($i = 1; $i < 10; $i++){ ?>
								<div class="col-auto mb-3">
									<img src="https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2014/02/281537-critica-lego-pelicula.jpg?tf=3840x" style="height: 80px;">
								</div>
								<?php } ?>
							</div>
							<h5 class="card-title">Detalle 1 (3 imagenes por fila)</h5>
							<form class="row">
								<div class="col">
									<div class="input-group mb-3">
										<input class="form-control" type="file" name="filename">
										<button class="btn btn-primary" type="submit">Agregar</button>
									</div>
								</div>
							</form>
							<div class="row">
								<?php for($i = 1; $i < 10; $i++){ ?>
								<div class="col-auto mb-3">
									<img src="https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2014/02/281537-critica-lego-pelicula.jpg?tf=3840x" style="height: 80px;">
								</div>
								<?php } ?>
							</div>
							<h5 class="card-title">Detalle 2 (1 imagen por fila)</h5>
							<form class="row">
								<div class="col">
									<div class="input-group mb-3">
										<input class="form-control" type="file" name="filename">
										<button class="btn btn-primary" type="submit">Agregar</button>
									</div>
								</div>
							</form>
							<div class="row">
								<?php for($i = 1; $i < 10; $i++){ ?>
								<div class="col-auto mb-3">
									<img src="https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2014/02/281537-critica-lego-pelicula.jpg?tf=3840x" style="height: 80px;">
								</div>
								<?php } ?>
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
			<div class="modal-header">
				<h5 class="modal-title">Agregar Opción</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
			</div>
			<div class="modal-body text-start">
				<form class="row g-3" id="form_add_option">
					<input type="hidden" name="product_id" value="<?= $product->product_id ?>">
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
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btn_add_option">Agregar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="md_edit_option" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Editar Opción</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
			</div>
			<div class="modal-body text-start">
				<form class="row g-3" id="form_update_option">
					<input type="hidden" name="option_id">
					<input type="hidden" name="product_id" value="<?= $product->product_id ?>">
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
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btn_update_option">Actualizar</button>
			</div>
		</div>
	</div>
</div>