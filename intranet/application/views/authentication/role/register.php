<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Nuevo Role</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Autenticación</li>
					<li class="breadcrumb-item">Roles</li>
					<li class="breadcrumb-item active">Nuevo</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>authentication/role" type="button" class="btn btn-success">
				<i class="bi bi-arrow-left"></i>
			</a>
		</div>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Agregar Rol</h5>
				<form class="row g-3" id="form_add_role">
					<div class="col-12">
						<label for="inputModuleName" class="form-label">Nombre de Rol</label>
						<input type="text" class="form-control" id="inputModuleName" name="role">
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