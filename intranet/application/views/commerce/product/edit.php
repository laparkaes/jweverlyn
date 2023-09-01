<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Detalle de Role</h1>
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
				<h5 class="card-title">Actualizar Rol</h5>
				<form class="row g-3" id="form_update_role">
					<input type="hidden" name="role_id" id="role_id" value="<?= $role->role_id ?>">
					<div class="col-12">
						<label for="inputRole" class="form-label">Nombre de Rol</label>
						<input type="text" class="form-control" id="inputRole" name="role" value="<?= $role->role ?>">
						<div class="invalid-feedback"></div>
					</div>
					<div class="text-center pt-3">
						<button type="submit" class="btn btn-primary">Actualizar</button>
					</div>
				</form>
			</div>
		</div>
		<?php if ($accounts){ ?>
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Lista de Usuarios</h5>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Usuario</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($accounts as $i => $a){ ?>
						<tr>
							<th scope="row"><?= $i + 1 ?></th>
							<td><?= $a->username ?></td>
							<td class="text-end">
								<a href="<?= base_url() ?>authentication/account/edit/<?= $a->account_id ?>" type="button" class="btn btn-outline-primary btn-sm border-0">
									<i class="bi bi-pencil-fill"></i>
								</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				
			</div>
		</div>
		<?php } ?>
	</div>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Accesos</h5>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Módulo</th>
							<th scope="col">Acción</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($modules as $i_m => $m){ ?>
						<tr>
							<th scope="row"><?= $i_m + 1 ?></th>
							<th><?= $m->module ?></th>
							<td></td>
							<td></td>
						</tr>
						<?php $access = $m->access; foreach($access as $i_a => $a){ 
						if (in_array($a->access_id, $access_ids)) $ch = "checked"; else $ch = ""; ?>
						<tr>
							<td scope="row"><?= $i_m + 1 ?>.<?= $i_a + 1 ?></td>
							<td><?= $m->module ?></td>
							<td><?= $a->access ?></td>
							<td class="text-end">
								<div class="form-check form-switch">
									<input class="form-check-input mx-0 btn_assign_access" type="checkbox" value="<?= $a->access_id ?>" <?= $ch ?>>
								</div>
							</td>
						</tr>
						<?php }} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>