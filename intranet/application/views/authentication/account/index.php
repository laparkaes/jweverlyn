<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Usuarios</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Autenticación</li>
					<li class="breadcrumb-item">Usuarios</li>
					<li class="breadcrumb-item active">Lista</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>authentication/account/register" type="button" class="btn btn-success">
				<i class="bi bi-plus-lg"></i>
			</a>
		</div>
	</div>
</div>
<section class="section">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-8 col-12">
							<h5 class="card-title">Lista de Usuarios</h5>
						</div>
						<div class="col-md-4 col-12">
							<form>
								<div class="input-group mt-md-3 mb-3">
									<input type="text" class="form-control" name="search" placeholder="Buscar" value="<?= $this->input->get("search") ?>">
									<button type="button" class="btn btn-primary"><i class="bi bi-funnel"></i></button>
								</div>
							</form>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Usuario</th>
									<th scope="col">Encargado</th>
									<th scope="col">Rol</th>
									<th scope="col">Desde</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php $base_page = ($params["page"] - 1) * 25; foreach($accounts as $i_a => $a){ ?>
								<tr>
									<th scope="row"><?= $base_page + $i_a + 1 ?></th>
									<td><?= $a->username ?></td>
									<td><?= $a->name ?></td>
									<td><?= $a->role ?></td>
									<td><?= date("Y-m-d", strtotime($a->registed_at)) ?></td>
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