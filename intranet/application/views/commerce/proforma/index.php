<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Proformas</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Proformas</li>
					<li class="breadcrumb-item active">Lista</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>commerce/proforma/register" type="button" class="btn btn-success">
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
						<div class="col-md-6 col-12">
							<h5 class="card-title">Lista de Proformas</h5>
						</div>
						<div class="col-md-6 col-12">
							<form>
								<div class="input-group mt-md-3 mb-3">
									<input type="text" class="form-control datepicker" id="f_from" name="from" placeholder="Desde" value="<?= $params["from"] ?>">
									<input type="text" class="form-control datepicker" id="f_to" name="to" placeholder="Hasta" value="<?= $params["to"] ?>">
									<input type="text" class="form-control" name="client" placeholder="Cliente" value="<?= $params["client"] ?>">
									<button type="submit" class="btn btn-primary"><i class="bi bi-funnel-fill"></i></button>
								</div>
							</form>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table align-middle">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Fecha</th>
									<th scope="col">Vigencia</th>
									<th scope="col">Cliente</th>
									<th scope="col">Monto</th>
									<th scope="col"></th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php $base_page = ($params["page"] - 1) * 25; foreach($proformas as $i_p => $p){ ?>
								<tr>
									<th scope="row"><?= $base_page + $i_p + 1 ?></th>
									<td><?= $p->registed_at ?></td>
									<td><?= $p->validity ?></td>
									<td><?= $p->client ?></td>
									<td class="text-nowrap text-end">S/ <?= number_format($p->amount, 2) ?></td>
									<td class="text-end">
										<a href="<?= base_url() ?>commerce/proforma/detail/<?= $p->proforma_id ?>" type="button" class="btn btn-outline-primary btn-sm border-0">
											<i class="bi bi-search"></i>
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
				<?php $base_link = base_url()."commerce/proforma?"; 
				foreach($paging as $p){ 
					$params["page"] = $p[0];
					$link = $base_link.http_build_query($params); ?>
				<li class="page-item <?= $p[2] ?>"><a class="page-link" href="<?= $link ?>"><?= $p[1] ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</section>