<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Nuevo Cliente</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Comercio</li>
					<li class="breadcrumb-item">Clientes</li>
					<li class="breadcrumb-item active">Nuevo</li>
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
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Agregar Cliente</h5>
				<form class="row g-3" id="form_add_client">
					<div class="col-md-8">
						<label class="form-label">Documento</label>
						<select class="form-select" name="client[doc_type_id]" id="doc_type_id">
							<?php foreach($doc_types as $dt){ if ($dt->sunat !== "0"){ ?>
							<option value="<?= $dt->doc_type_id ?>"><?= $dt->doc_type ?></option>
							<?php }} ?>
						</select>
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-4">
						<label class="form-label">Número</label>
						<div class="input-group has-validation">
							<input type="text" class="form-control" name="client[doc_number]" id="doc_number">
							<button type="button" class="btn btn-primary" id="btn_search_person">
								<i class="bi bi-search"></i>
							</button>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-12">
						<label class="form-label">Nombre</label>
						<input type="text" class="form-control" name="client[name]" id="client_name">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-6">
						<label class="form-label">Telefono</label>
						<input type="text" class="form-control" name="client[tel]">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-6">
						<label class="form-label">Celular</label>
						<input type="text" class="form-control" name="client[mobile]">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-12">
						<label class="form-label">Correo Electrónico</label>
						<input type="text" class="form-control" name="client[email]">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-12">
						<label class="form-label">Dirección</label>
						<input type="text" class="form-control" name="client[address]">
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