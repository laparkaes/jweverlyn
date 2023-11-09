<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Nuevo Producto</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Productos</li>
					<li class="breadcrumb-item active">Nuevo</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>stock/product" type="button" class="btn btn-success">
				<i class="bi bi-arrow-left"></i>
			</a>
		</div>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Agregar Producto</h5>
				<form class="row g-3" id="form_add_product">
					<div class="col-md-8">
						<label class="form-label">Producto</label>
						<input type="text" class="form-control" name="product">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-4">
						<label class="form-label">Código</label>
						<input type="text" class="form-control" name="code">
						<div class="invalid-feedback"></div>
					</div>
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
					<div class="text-center pt-3">
						<button type="submit" class="btn btn-primary">Agregar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>