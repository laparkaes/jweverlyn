<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Nuevo Acceso</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Autenticación</li>
					<li class="breadcrumb-item">Accesos</li>
					<li class="breadcrumb-item active">Register</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>authentication/access" type="button" class="btn btn-success">
				<i class="bi bi-arrow-left"></i>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Agregar Módulo</h5>
				<form class="row g-3" id="form_insert_module">
					<div class="col-12">
						<label for="inputModuleName" class="form-label">Nombre de Módulo</label>
						<input type="text" class="form-control" id="inputModuleName" name="module">
						<div class="invalid-feedback"></div>
					</div>
					<div class="pt-3">
						<button type="submit" class="btn btn-primary">Agregar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Agregar Acceso</h5>
				<form class="row g-3" id="form_insert_access">
					<?php $m_id = $this->input->get("m_id"); ?>
					<div class="col-md-6">
						<label for="inputModule" class="form-label">Módulo</label>
						<select id="inputModule" class="form-select" name="module_id">
							<option value="">Elegir...</option>
							<?php foreach($modules as $m){ if ($m_id == $m->module_id) $s = "selected"; else $s = ""; ?>
							<option value="<?= $m->module_id ?>" <?= $s ?>><?= $m->module ?></option>
							<?php } ?>
						</select>
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-6">
						<label for="inputAccess" class="form-label">Nombre de Acceso</label>
						<input type="text" class="form-control" id="inputAccess" name="access">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-12">
						<label for="inputCode" class="form-label">Código</label>
						<input type="text" class="form-control" id="inputCode" name="code">
						<div class="invalid-feedback"></div>
					</div>
					<div class="pt-3">
						<button type="submit" class="btn btn-primary">Agregar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>