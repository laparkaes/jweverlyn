<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Nuevo Ingreso / Egreso</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Flujo de Caja</li>
					<li class="breadcrumb-item">Ingreso y Egreso</li>
					<li class="breadcrumb-item active">Nuevo</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>money_flow/in_outcome" type="button" class="btn btn-success">
				<i class="bi bi-arrow-left"></i>
			</a>
		</div>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Agregar Ingreso / Egreso</h5>
				<form class="row g-3" id="form_add_in_outcome">
					<div class="col-md-6">
						<label class="form-label">Monto</label>
						<div class="input-group has-validation">
							<span class="input-group-text">S/</span>
							<input type="text" class="form-control" name="amount" id="amount" value="0.00">
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-6">
						<label class="form-label">Fecha</label>
						<input type="text" class="form-control datepicker" name="date" value="<?= date("Y-m-d") ?>">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-4">
						<label class="form-label">Tipo</label>
						<select class="form-select" name="type_id" id="type_id">
							<option value="">Elegir</option>
							<?php foreach($types as $t){ ?>
							<option value="<?= $t->type_id ?>"><?= $t->type ?></option>
							<?php } ?>
						</select>
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-8">
						<label class="form-label">Categoría</label>
						<select class="form-select" name="category_id" id="category_id">
							<option value="">Elegir</option>
							<?php foreach($categories as $c){ ?>
							<option class="sl_cat sl_cat_<?= $c->type_id ?> d-none" value="<?= $c->category_id ?>"><?= $c->category ?></option>
							<?php } ?>
						</select>
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-12">
						<label class="form-label">Descripción</label>
						<input type="text" class="form-control" name="description">
						<div class="invalid-feedback"></div>
					</div>
					<div class="text-center pt-3">
						<button type="submit" class="btn btn-primary">Agregar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>