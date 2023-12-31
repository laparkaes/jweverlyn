<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Proformas</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Comercio</li>
					<li class="breadcrumb-item active">Proformas</li>
				</ol>
			</nav>
		</div>
		<div>
			<?php if ($is_filtered){ $btn_search = "btn-outline-primary"; $bl_search = "";
			}else{ $btn_search = "btn-primary"; $bl_search = "d-none"; } ?>
			<button type="button" class="btn <?= $btn_search ?>" id="btn_search_index">
				<i class="bi bi-funnel-fill"></i>
			</button>
			<a href="<?= base_url() ?>commerce/proforma/register" type="button" class="btn btn-success">
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
							<label class="form-label">Emision</label>
							<div class="input-group">
								<input type="text" class="form-control" id="f_i_from" name="i_from" value="<?= $params["i_from"] ?>">
								<span class="input-group-text">~</span>
								<input type="text" class="form-control" id="f_i_to" name="i_to" value="<?= $params["i_to"] ?>">
							</div>
						</div>
						<div class="col-md-4 col-12">
							<label class="form-label">Vigencia</label>
							<div class="input-group">
								<input type="text" class="form-control" id="f_v_from" name="v_from" value="<?= $params["v_from"] ?>">
								<span class="input-group-text">~</span>
								<input type="text" class="form-control" id="f_v_to" name="v_to" value="<?= $params["v_to"] ?>">
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
						<div class="text-center pt-3">
							<button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
							<a href="<?= base_url() ?>commerce/proforma" class="btn btn-danger"><i class="bi bi-eraser"></i></a>
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
									<th scope="col">Emisión</th>
									<th scope="col">Vigencia</th>
									<th scope="col">Cliente</th>
									<th scope="col" class="text-end">Monto</th>
									<th scope="col"></th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php $base_page = ($params["page"] - 1) * 25; foreach($proformas as $i_p => $p){ ?>
								<tr>
									<th scope="row"><?= $base_page + $i_p + 1 ?></th>
									<td><?= date("Y-m-d", strtotime($p->registed_at)) ?></td>
									<td><?= $p->validity ?></td>
									<td><?= $p->client ?></td>
									<td class="text-nowrap text-end">S/ <?= number_format($p->amount, 2) ?></td>
									<td class="text-center"><i class="bi bi-circle-fill text-<?= $p->color ?>"></i></td>
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