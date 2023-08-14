<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Nuevo Usuario</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Autenticación</li>
					<li class="breadcrumb-item">Usuarios</li>
					<li class="breadcrumb-item active">Nuevo</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>authentication/account" type="button" class="btn btn-success">
				<i class="bi bi-arrow-left"></i>
			</a>
		</div>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Agregar Usuario</h5>
				<form class="row g-3" id="form_add_account">
					<div class="col-4">
						<label for="slRole" class="form-label">Rol</label>
						<select class="form-select" id="slRole" name="role_id">
							<option value="">Elegir</option>
							<?php foreach($roles as $r){ ?>
							<option value="<?= $r->role_id ?>"><?= $r->role ?></option>
							<?php } ?>
						</select>
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-8">
						<label for="inputName" class="form-label">Nombre</label>
						<input type="text" class="form-control" id="inputName" name="name">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-12">
						<label for="inputUsername" class="form-label">Usuario</label>
						<input type="email" class="form-control" id="inputUsername" name="username">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-6">
						<label for="inputPassword" class="form-label">Contraseña</label>
						<input type="password" class="form-control" id="inputPassword" name="password">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-6">
						<label for="inputPasswordConfirm" class="form-label">Confirmacion de Contraseña</label>
						<input type="password" class="form-control" id="inputPasswordConfirm" name="password_confirm">
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