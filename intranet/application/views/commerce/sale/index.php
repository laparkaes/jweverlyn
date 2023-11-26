<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Ventas</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Comercio</li>
					<li class="breadcrumb-item active">Ventas</li>
				</ol>
			</nav>
		</div>
		<div>
			<?php if ($is_filtered){ $btn_search = "btn-outline-primary"; $bl_search = "";
			}else{ $btn_search = "btn-primary"; $bl_search = "d-none"; } ?>
			<button type="button" class="btn <?= $btn_search ?>" id="btn_search_index">
				<i class="bi bi-funnel-fill"></i>
			</button>
			<a href="<?= base_url() ?>commerce/sale/register" type="button" class="btn btn-success">
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
							<label class="form-label">Cliente</label>
							<input type="text" class="form-control enter_on" name="client" value="<?= $params["client"] ?>">
						</div>
						<div class="col-md-4 col-12">
							<label class="form-label">Fecha</label>
							<div class="input-group">
								<input type="text" class="form-control" id="f_from" name="from" value="<?= $params["from"] ?>">
								<span class="input-group-text">~</span>
								<input type="text" class="form-control" id="f_to" name="to" value="<?= $params["to"] ?>">
							</div>
						</div>
						<div class="col-md-4 col-12">
							<label class="form-label">Monto</label>
							<div class="input-group">
								<span class="input-group-text">S/</span>
								<input type="text" class="form-control enter_on" name="a_min" value="<?= $params["a_min"] ?>">
								<span class="input-group-text">~</span>
								<input type="text" class="form-control enter_on" name="a_max" value="<?= $params["a_max"] ?>">
							</div>
						</div>
						<div class="col-md-4 col-12">
							<label class="form-label">Saldo</label>
							<div class="input-group">
								<span class="input-group-text">S/</span>
								<input type="text" class="form-control enter_on" name="b_min" value="<?= $params["b_min"] ?>">
								<span class="input-group-text">~</span>
								<input type="text" class="form-control enter_on" name="b_max" value="<?= $params["b_max"] ?>">
							</div>
						</div>
						<div class="text-center pt-3">
							<button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
							<a href="<?= base_url() ?>commerce/sale" class="btn btn-danger"><i class="bi bi-eraser"></i></a>
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
									<th scope="col">Fecha</th>
									<th scope="col">Cliente</th>
									<th scope="col" class="text-end">Monto</th>
									<th scope="col" class="text-end">Saldo</th>
									<th scope="col"></th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php $base_page = ($params["page"] - 1) * 25; foreach($sales as $i_s => $s){ ?>
								<tr>
									<th scope="row"><?= $base_page + $i_s + 1 ?></th>
									<td><?= date("Y-m-d", strtotime($s->registed_at)) ?></td>
									<td><?= $s->client ?></td>
									<td class="text-nowrap text-end">S/ <?= number_format($s->amount, 2) ?></td>
									<td class="text-nowrap text-end">
										<?php echo ($s->balance > 0) ? "S/ ".number_format($s->balance, 2) : "-"; ?>
									</td>
									<td class="text-center"><i class="bi bi-circle-fill text-<?= $s->color ?>"></i></td>
									<td class="text-end">
										<a href="<?= base_url() ?>commerce/sale/detail/<?= $s->sale_id ?>" type="button" class="btn btn-outline-primary btn-sm border-0">
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
				<?php $base_link = base_url()."commerce/sale?"; 
				foreach($paging as $p){ 
					$params["page"] = $p[0];
					$link = $base_link.http_build_query($params); ?>
				<li class="page-item <?= $p[2] ?>"><a class="page-link" href="<?= $link ?>"><?= $p[1] ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</section>