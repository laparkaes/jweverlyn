<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Roles</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Autenticación</li>
					<li class="breadcrumb-item active">Roles</li>
				</ol>
			</nav>
		</div>
		<div>
			<?php if ($is_filtered){ $btn_search = "btn-outline-primary"; $bl_search = "";
			}else{ $btn_search = "btn-primary"; $bl_search = "d-none"; } ?>
			<button type="submit" class="btn <?= $btn_search ?>" id="btn_search_index">
				<i class="bi bi-funnel-fill"></i>
			</button>
			<a href="<?= base_url() ?>authentication/role/register" type="button" class="btn btn-success">
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
						<div class="col-md-12 col-12">
							<label class="form-label">Rol</label>
							<input type="text" class="form-control enter_on" name="role" value="<?= $params["role"] ?>">
						</div>
						<div class="text-center pt-3">
							<button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
							<a href="<?= base_url() ?>authentication/role" class="btn btn-danger"><i class="bi bi-eraser"></i></a>
							<button type="button" class="btn btn-secondary" id="btn_close_search_index"><i class="bi bi-x-lg"></i></button>
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
									<th scope="col">Módulo</th>
									<th scope="col" class="text-end">Usuarios</th>
									<th scope="col" class="text-end">Accesos</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php $base_page = ($params["page"] - 1) * 25; foreach($roles as $i_r => $r){ ?>
								<tr>
									<th scope="row"><?= $base_page + $i_r + 1 ?></th>
									<td><?= $r->role ?></td>
									<td class="text-end"><?= number_format($r->account_qty) ?></td>
									<td class="text-end"><?= number_format($r->access_qty) ?></td>
									<td class="text-end">
										<a href="<?= base_url() ?>authentication/role/detail/<?= $r->role_id ?>" type="button" class="btn btn-outline-primary btn-sm border-0">
											<i class="bi bi-search"></i>
										</a>
										<button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_role" value="<?= $r->role_id ?>">
											<i class="bi bi-x-lg"></i>
										</button>
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
				<?php $base_link = base_url()."authentication/role?"; 
				foreach($paging as $p){ 
					$params["page"] = $p[0];
					$link = $base_link.http_build_query($params); ?>
				<li class="page-item <?= $p[2] ?>"><a class="page-link" href="<?= $link ?>"><?= $p[1] ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</section>