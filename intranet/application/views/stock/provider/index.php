<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Proveedores</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Comercio</li>
					<li class="breadcrumb-item active">Proveedores</li>
				</ol>
			</nav>
		</div>
		<div>
			<?php if ($is_filtered){ $btn_search = "btn-outline-primary"; $bl_search = "";
			}else{ $btn_search = "btn-primary"; $bl_search = "d-none"; } ?>
			<button type="submit" class="btn <?= $btn_search ?>" id="btn_search_index">
				<i class="bi bi-funnel-fill"></i>
			</button>
			<a href="<?= base_url() ?>stock/provider/register" type="button" class="btn btn-success">
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
						<div class="col-md-8 col-12">
							<label class="form-label">Proveedor</label>
							<input type="text" class="form-control enter_on" name="provider" value="<?= $params["provider"] ?>">
						</div>
						<div class="col-md-4 col-12">
							<label class="form-label">Documento</label>
							<input type="text" class="form-control enter_on" name="doc" value="<?= $params["doc"] ?>">
						</div>
						<div class="text-center pt-3">
							<button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
							<a href="<?= base_url() ?>stock/provider" class="btn btn-danger"><i class="bi bi-eraser"></i></a>
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
									<th scope="col">Imagen</th>
									<th scope="col">Nombre</th>
									<th scope="col">Documento</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php $base_page = ($params["page"] - 1) * 25; foreach($providers as $i_p => $p){ ?>
								<tr>
									<th scope="row"><?= $base_page + $i_p + 1 ?></th>
									<td><img src="<?= $p->thumb ?>" style="height: 60px;"></td>
									<td><?= $p->name ?></td>
									<td><?= $doc_types_arr[$p->doc_type_id] ?><br/><?= $p->doc_number ?></td>
									<td class="text-end">
										<a href="<?= base_url() ?>stock/provider/detail/<?= $p->provider_id ?>" type="button" class="btn btn-outline-primary btn-sm border-0">
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
				<?php $base_link = base_url()."stock/provider?"; 
				foreach($paging as $p){ 
					$params["page"] = $p[0];
					$link = $base_link.http_build_query($params); ?>
				<li class="page-item <?= $p[2] ?>"><a class="page-link" href="<?= $link ?>"><?= $p[1] ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</section>