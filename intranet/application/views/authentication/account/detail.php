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
<section class="section profile">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-body profile-card pt-4 d-flex flex-column align-items-center text-center">
					<?php if (!$account->valid){ ?>
					<h1><span class="badge bg-danger">Desactivado</span></h1>
					<?php } ?>
					<img src="<?= base_url() ?>uploads/account/<?= $account->image ?>" id="main_image" alt="Thumb" style="max-width: 80%;">
					<h2><?= $account->name ?></h2>
					<h3 class="mt-3"><?= $account->role ?></h3>
					<h3 class="mt-1"><?= $account->doc_number ?></h3>
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
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#image">Imagen</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#password">Contraseña</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#activation">Activación</button>
						</li>
					</ul>
					<div class="tab-content pt-4">
						<div class="tab-pane fade show active profile-overview" id="detail">
							<div class="row">
								<div class="col-lg-3 col-md-4 label"># Documento</div>
								<div class="col-lg-9 col-md-8"><?= $account->doc_number; ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Nombre</div>
								<div class="col-lg-9 col-md-8"><?= $account->name ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Teléfono</div>
								<div class="col-lg-9 col-md-8"><?= $account->tel ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Celular</div>
								<div class="col-lg-9 col-md-8"><?= $account->mobile ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Correo E.</div>
								<div class="col-lg-9 col-md-8"><?= $account->username ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Dirección</div>
								<div class="col-lg-9 col-md-8"><?= $account->address ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Actualizado</div>
								<div class="col-lg-9 col-md-8"><?= $account->updated_at ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Registrado</div>
								<div class="col-lg-9 col-md-8"><?= $account->registed_at ?></div>
							</div>
						</div>
						<div class="tab-pane fade profile-edit" id="edit">
							<form id="form_update_account">
								<input type="hidden" name="account_id" value="<?= $account->account_id ?>">
								<h5 class="card-title pt-0">Datos</h5>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Rol</label>
									<div class="col-md-8 col-lg-9">
										<select class="form-select" id="slRole" name="role_id">
										<option value="">Elegir</option>
										<?php foreach($roles as $r){ if ($r->role_id == $account->role_id) $s = "selected"; else $s = ""; ?>
										<option value="<?= $r->role_id ?>" <?= $s ?>><?= $r->role ?></option>
										<?php } ?>
									</select>
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label"># Documento</label>
									<div class="col-md-8 col-lg-9">
										<input type="text" class="form-control" name="doc_number" value="<?= $account->doc_number ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Nombre</label>
									<div class="col-md-8 col-lg-9">
										<input type="text" class="form-control" name="name" value="<?= $account->name ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Teléfono</label>
									<div class="col-md-8 col-lg-9">
										<input type="text" class="form-control" name="tel" value="<?= $account->tel ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Celular</label>
									<div class="col-md-8 col-lg-9">
										<input type="text" class="form-control" name="mobile" value="<?= $account->mobile ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Dirección</label>
									<div class="col-md-8 col-lg-9">
										<input type="text" class="form-control" name="address" value="<?= $account->address ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="text-center pt-3">
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</form>
						</div>
						<div class="tab-pane fade profile-edit" id="image">
							<form id="form_update_image">
								<input type="hidden" name="account_id" value="<?= $account->account_id ?>">
								<h5 class="card-title pt-0">Imagen de Usuario</h5>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Archivo</label>
									<div class="col-md-8 col-lg-9">
										<input name="image" type="file" class="form-control" accept="image/*">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="text-center pt-3">
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</form>
						</div>
						<div class="tab-pane fade profile-edit" id="password">
							<form id="form_update_password">
								<input type="hidden" name="account_id" value="<?= $account->account_id ?>">
								<h5 class="card-title pt-0">Cambiar Contraseña</h5>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Contraseña Nueva</label>
									<div class="col-md-8 col-lg-9">
										<input type="password" class="form-control" name="password">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Confirmación</label>
									<div class="col-md-8 col-lg-9">
										<input type="password" class="form-control" name="password_confirm">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="text-center pt-3">
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="activation">
							<?php if ($account->valid){ ?>
							<form class="row g-3" id="form_deactivate_account">
								<input type="hidden" name="account_id" value="<?= $account->account_id ?>">
								<div class="col-md-12">
									<div class="form-check mb-0">
										<input class="form-check-input" type="checkbox" id="is_confirmed" name="is_confirmed">
										<label class="form-check-label" for="is_confirmed">
											Confirmo desactivar este usuario.
										</label>
									</div>
									
								</div>
								<div class="text-center pt-3">
									<button type="submit" class="btn btn-danger">Desactivar</button>
								</div>
							</form>
							<?php }else{ ?>
							<form class="row g-3" id="form_activate_account">
								<input type="hidden" name="account_id" value="<?= $account->account_id ?>">
								<div class="col-md-12">
									<div class="form-check mb-0">
										<input class="form-check-input" type="checkbox" id="is_confirmed" name="is_confirmed">
										<label class="form-check-label" for="is_confirmed">
											Confirmo activar este usuario.
										</label>
									</div>
									
								</div>
								<div class="text-center pt-3">
									<button type="submit" class="btn btn-primary">Activar</button>
								</div>
							</form>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>