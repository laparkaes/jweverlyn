<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Usuarios</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Autenticación</li>
					<li class="breadcrumb-item active">Usuarios</li>
				</ol>
			</nav>
		</div>
		<div>
			<?php if ($is_filtered){ $btn_search = "btn-outline-primary"; $bl_search = "";
			}else{ $btn_search = "btn-primary"; $bl_search = "d-none"; } ?>
			<button type="submit" class="btn <?= $btn_search ?>" id="btn_search_index">
				<i class="bi bi-funnel-fill"></i>
			</button>
			<a href="<?= base_url() ?>authentication/account/register" type="button" class="btn btn-success">
				<i class="bi bi-plus-lg"></i>
			</a>
		</div>
	</div>
</div>
<section class="section">
	<div class="row">
		<div class="col">
			<div class="card <?= $bl_search ?>" id="bl_search_index">
				<div class="card-body">
					<h5 class="card-title">Filtros</h5>
					<form class="row g-3">
						<div class="col-md-4 col-12">
							<label class="form-label">Rol</label>
							<select class="form-select" name="rid">
								<option value="">Elegir</option>
								<?php foreach($roles as $r){ if ($r->role_id == $params["rid"]) $s = "selected"; else $s = ""; ?>
								<option value="<?= $r->role_id ?>" <?= $s ?>><?= $r->role ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-4 col-12">
							<label class="form-label">Usuario</label>
							<input type="text" class="form-control enter_on" name="u" value="<?= $params["u"] ?>">
						</div>
						<div class="col-md-4 col-12">
							<label class="form-label">Nombre</label>
							<input type="text" class="form-control enter_on" name="n" value="<?= $params["n"] ?>">
						</div>
						<div class="text-center pt-3">
							<button type="button" class="btn btn-secondary" id="btn_close_search_index">Cerrar</button>
							<a href="<?= base_url() ?>authentication/account" class="btn btn-danger">Remover</a>
							<button type="submit" class="btn btn-primary">Buscar</button>
						</div>
					</form>
				</div>
			</div>
			<div class="card">
				<div class="card-body pt-3">
					<div class="table-responsive">
						<table class="table align-middle">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Rol</th>
									<th scope="col">Usuario</th>
									<th scope="col">Nombre</th>
									<th scope="col"></th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php $base_page = ($params["page"] - 1) * 25; foreach($accounts as $i_a => $a){ ?>
								<tr>
									<th scope="row"><?= $base_page + $i_a + 1 ?></th>
									<td><?= $a->role ?></td>
									<td><?= $a->username ?></td>
									<td><?= $a->name ?></td>
									<td><i class="bi bi-circle-fill text-<?= $a->color ?>"></i></td>
									<td class="text-end">
										<a href="<?= base_url() ?>authentication/account/detail/<?= $a->account_id ?>" type="button" class="btn btn-outline-primary btn-sm border-0">
											<i class="bi bi-pencil-fill"></i>
										</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<ul class="pagination">
				<?php $base_link = base_url()."authentication/account?"; 
				foreach($paging as $p){ 
					$params["page"] = $p[0];
					$link = $base_link.http_build_query($params); ?>
				<li class="page-item <?= $p[2] ?>"><a class="page-link" href="<?= $link ?>"><?= $p[1] ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</section>