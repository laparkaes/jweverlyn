<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Detalle de Usuario</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Autenticación</li>
					<li class="breadcrumb-item">Usuarios</li>
					<li class="breadcrumb-item active">Detalle</li>
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
				<h5 class="card-title">Datos de Usuario</h5>
				<form class="row g-3" id="form_update_account">
					<input type="hidden" name="account_id" value="<?= $account->account_id ?>">
					<div class="col-md-6">
						<label for="slRole" class="form-label">Rol</label>
						<select class="form-select" id="slRole" name="role_id">
							<option value="">Elegir</option>
							<?php foreach($roles as $r){ if ($r->role_id == $account->role_id) $s = "selected"; else $s = ""; ?>
							<option value="<?= $r->role_id ?>" <?= $s ?>><?= $r->role ?></option>
							<?php } ?>
						</select>
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-6">
						<label for="inputName" class="form-label">Nombre</label>
						<input type="text" class="form-control" id="inputName" name="name" value="<?= $account->name ?>">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-12">
						<label for="inputUsername" class="form-label">Usuario</label>
						<input type="email" class="form-control" id="inputUsername" value="<?= $account->username ?>" disabled>
						<div class="invalid-feedback"></div>
					</div>
					<div class="text-center pt-3">
						<button type="submit" class="btn btn-primary">Actualizar</button>
					</div>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Cambiar Contraseña</h5>
				<form class="row g-3" id="form_update_password">
					<input type="hidden" name="account_id" value="<?= $account->account_id ?>">
					<div class="col-6">
						<label for="inputPasswordNew" class="form-label">Contraseña Nueva</label>
						<input type="password" class="form-control" id="inputPasswordNew" name="password">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-6">
						<label for="inputPasswordConfirm" class="form-label">Confirmación</label>
						<input type="password" class="form-control" id="inputPasswordConfirm" name="password_confirm">
						<div class="invalid-feedback"></div>
					</div>
					<div class="text-center pt-3">
						<button type="submit" class="btn btn-primary">Actualizar</button>
					</div>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Eliminar Usuario</h5>
				<form class="row g-3" id="form_delete_account">
					<input type="hidden" name="account_id" value="<?= $account->account_id ?>">
					<div class="col-md-12">
						<div class="form-check mb-0">
							<input class="form-check-input" type="checkbox" id="chkConfirm">
							<label class="form-check-label" for="chkConfirm">
								Confirmo eliminar este usuario.
							</label>
						</div>
					</div>
					<div class="text-center pt-3">
						<button type="submit" class="btn btn-danger">Eliminar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>