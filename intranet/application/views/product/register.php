<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Nuevo Producto</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Producto</li>
					<li class="breadcrumb-item active">Nuevo</li>
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
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Agregar Producto</h5>
				<form class="row g-3" id="form_add_product">
					<div class="col-6">
						<label class="form-label">Categoría</label>
						<select class="form-select" name="category_id">
							<option value="">Elegir</option>
							<?php foreach($categories as $c){ ?>
							<option value="<?= $c->category_id ?>"><?= $c->category ?></option>
							<?php } ?>
						</select>
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-6">
						<label class="form-label">Precio</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">S/</span>
							<input type="text" class="form-control" name="price">
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label">Producto</label>
						<input type="text" class="form-control" name="product">
						<div class="invalid-feedback"></div>
					</div>
					<div class="text-center pt-3">
						<button type="submit" class="btn btn-primary">Agregar</button>
					</div>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Gestión de Categorias</h5>
				<ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
					<li class="nav-item" role="category">
						<button class="nav-link active" id="add_category-tab" data-bs-toggle="tab" data-bs-target="#bordered-add_category" type="button" role="tab" aria-controls="add_category" aria-selected="true">Agregar</button>
					</li>
					<?php if ($categories){ ?>
					<li class="nav-item" role="category">
						<button class="nav-link" id="delete_category-tab" data-bs-toggle="tab" data-bs-target="#bordered-delete_category" type="button" role="tab" aria-controls="delete_category" aria-selected="false" tabindex="-1">Eliminar</button>
					</li>
					<li class="nav-item" role="category">
						<button class="nav-link" id="move_category-tab" data-bs-toggle="tab" data-bs-target="#bordered-move_category" type="button" role="tab" aria-controls="move_category" aria-selected="false" tabindex="-1">Mover</button>
					</li>
					<?php } ?>
				</ul>
				<div class="tab-content pt-3">
					<div class="tab-pane fade show active" id="bordered-add_category" role="tabpanel" aria-labelledby="add_category-tab">
						<form class="row g-3" id="form_add_category">
							<div class="col-12">
								<label class="form-label">Nombre de Categoría</label>
								<input type="text" class="form-control" name="category">
								<div class="invalid-feedback"></div>
							</div>
							<div class="text-center pt-3">
								<button type="submit" class="btn btn-primary">Agregar</button>
							</div>
						</form>
					</div>
					<?php if ($categories){ ?>
					<div class="tab-pane fade" id="bordered-delete_category" role="tabpanel" aria-labelledby="delete_category-tab">
						<form class="row g-3" id="form_delete_category">
							<div class="col-12">
								<label class="form-label">Categoría</label>
								<select class="form-select" name="category_id">
									<option value="">Elegir</option>
									<?php foreach($categories as $c){ ?>
									<option value="<?= $c->category_id ?>"><?= $c->category ?></option>
									<?php } ?>
								</select>
								<div class="invalid-feedback"></div>
							</div>
							<div class="text-center pt-3">
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</div>
						</form>
					</div>
					<div class="tab-pane fade" id="bordered-move_category" role="tabpanel" aria-labelledby="move_category-tab">
						<form class="row g-3" id="form_move_category">
							<div class="col-12">
								<label class="form-label">De</label>
								<select class="form-select" name="from_id">
									<option value="">Elegir</option>
									<?php foreach($categories as $c){ ?>
									<option value="<?= $c->category_id ?>"><?= $c->category ?></option>
									<?php } ?>
								</select>
								<div class="invalid-feedback"></div>
							</div>
							<div class="col-12">
								<label class="form-label">A</label>
								<select class="form-select" name="to_id">
									<option value="">Elegir</option>
									<?php foreach($categories as $c){ ?>
									<option value="<?= $c->category_id ?>"><?= $c->category ?></option>
									<?php } ?>
								</select>
								<div class="invalid-feedback"></div>
							</div>
							<div class="text-center pt-3">
								<button type="submit" class="btn btn-primary">Mover</button>
							</div>
						</form>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>