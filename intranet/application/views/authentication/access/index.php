<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Accesos</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Autenticación</li>
					<li class="breadcrumb-item">Accesos</li>
					<li class="breadcrumb-item active">Lista</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>authentication/access/register" type="button" class="btn btn-success">
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
							<h5 class="card-title">Lista de Accesos</h5>
						</div>
						<div class="col-md-4 col-12">
							<div class="input-group mt-md-3 mb-3">
								<input type="text" class="form-control" placeholder="Keyword">
								<button type="button" class="btn btn-primary"><i class="bi bi-funnel-fill"></i></button>
							</div>
						</div>
					</div>
					<?php print_r($modules); ?>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Módulo</th>
									<th scope="col">Acción</th>
									<th scope="col">Código</th>
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
									<td class="text-end">
										<a href="<?= base_url() ?>authentication/access/register?m_id=<?= $m->module_id ?>" type="button" class="btn btn-success btn-sm">
											<i class="bi bi-plus-lg"></i>
										</a>
										<button type="button" class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i></button>
									</td>
								</tr>
								<?php $access = $m->access; foreach($access as $i_a => $a){ ?>
								<tr>
									<td scope="row"><?= $i_m + 1 ?>. <?= $i_a + 1 ?></td>
									<td><?= $m->module ?></td>
									<td><?= $a->access ?></td>
									<td><?= $a->code ?></td>
									<td class="text-end">
										<button type="button" class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i></button>
									</td>
								</tr>
								<?php }} ?>
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
				<li class="page-item">
				<a class="page-link" href="#" aria-label="Previous">
				<span aria-hidden="true">«</span>
				</a>
				</li>
				<li class="page-item active"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item"><a class="page-link" href="#">4</a></li>
				<li class="page-item"><a class="page-link" href="#">5</a></li>
				<li class="page-item">
				<a class="page-link" href="#" aria-label="Next">
				<span aria-hidden="true">»</span>
				</a>
				</li>
			</ul>
		</div>
	</div>
</section>