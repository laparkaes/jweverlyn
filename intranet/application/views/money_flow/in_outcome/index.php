<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Ingreso y Egreso</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Flujo de Caja</li>
					<li class="breadcrumb-item active">Ingreso y Egreso</li>
				</ol>
			</nav>
		</div>
		<div>
			<?php if ($is_filtered){ $btn_search = "btn-outline-primary"; $bl_search = "";
			}else{ $btn_search = "btn-primary"; $bl_search = "d-none"; } ?>
			<button type="button" class="btn <?= $btn_search ?>" id="btn_search_index">
				<i class="bi bi-funnel-fill"></i>
			</button>
			<button type="button" class="btn btn-primary" id="btn_category_admin">
				<i class="bi bi-tags-fill"></i>
			</button>
			<a href="<?= base_url() ?>money_flow/in_outcome/register" type="button" class="btn btn-success">
				<i class="bi bi-plus-lg"></i>
			</a>
		</div>
	</div>
</div>
<section class="section">
	<div class="row">
		<div class="col">
			<div class="card d-none" id="bl_cat_admin">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<h5 class="card-title">Gestión de Categorías</h5>
						</div>
					</div>
					<ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
						<li class="nav-item" role="category">
							<button class="nav-link active" id="add_category-tab" data-bs-toggle="tab" data-bs-target="#bordered-add_category" type="button" role="tab" aria-controls="add_category" aria-selected="true">Agregar</button>
						</li>
						<?php if ($categories){ ?>
						<li class="nav-item" role="category">
							<button class="nav-link" id="delete_category-tab" data-bs-toggle="tab" data-bs-target="#bordered-delete_category" type="button" role="tab" aria-controls="delete_category" aria-selected="false" tabindex="-1">Eliminar</button>
						</li>
						<?php } ?>
					</ul>
					<div class="tab-content pt-3">
						<div class="tab-pane fade show active" id="bordered-add_category" role="tabpanel" aria-labelledby="add_category-tab">
							<form class="row g-3" id="form_add_category">
								<div class="col-md-4">
									<label class="form-label">Tipo</label>
									<select class="form-select" name="type_id">
										<option value="">Elegir</option>
										<?php foreach($types as $t){ ?>
										<option value="<?= $t->type_id ?>"><?= $t->type ?></option>
										<?php } ?>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="col-md-8">
									<label class="form-label">Nombre de Categoría</label>
									<input type="text" class="form-control" name="category">
									<div class="invalid-feedback"></div>
								</div>
								<div class="text-center pt-3">
									<button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg"></i></button>
									<button type="button" class="btn btn-secondary btn_close_cat_admin"><i class="bi bi-x-lg"></i></button>
								</div>
							</form>
						</div>
						<?php if ($categories){ ?>
						<div class="tab-pane fade" id="bordered-delete_category" role="tabpanel" aria-labelledby="delete_category-tab">
							<form class="row g-3" id="form_delete_category">
								<div class="col-12">
									<label class="form-label">Categoría</label>
									<select class="form-select" name="category_id">
										<option value="">Elegir</option>
										<?php foreach($categories as $c){ ?>
										<option value="<?= $c->category_id ?>"><?= $c->category ?></option>
										<?php } ?>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="text-center pt-3">
									<button type="submit" class="btn btn-danger"><i class="bi bi-eraser"></i></button>
									<button type="button" class="btn btn-secondary btn_close_cat_admin"><i class="bi bi-x-lg"></i></button>
								</div>
							</form>
						</div>
						<?php } ?>
					</div>
				
				</div>
			</div>
			<div class="card <?= $bl_search ?>" id="bl_search_index">
				<div class="card-body">
					<h5 class="card-title">Filtros</h5>
					<form class="row g-3">
						<div class="col-md-12 col-12">
							<label class="form-label">Descripción</label>
							<input type="text" class="form-control enter_on" name="description" value="<?= $params["description"] ?>">
						</div>
						<div class="col-md-6 col-12">
							<label class="form-label">Tipo</label>
							<select class="form-select" name="type" id="type_id">
								<option value="">Elegir</option>
								<?php foreach($types as $t){ if ($params["type"] == $t->type_id) $s = "selected"; else $s = ""; ?>
								<option value="<?= $t->type_id ?>" <?= $s ?>><?= $t->type ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-6 col-12">
							<label class="form-label">Categoría</label>
							<select class="form-select" name="category" id="category_id">
								<option value="">Elegir</option>
								<?php 
								foreach($categories as $c){
									if ($c->type_id == $params["type"]) $d = ""; else $d = "d-none";
									if ($c->category_id == $params["category"]) $s = "selected"; else $s = "";
								?>
								<option class="sl_cat sl_cat_<?= $c->type_id ?> <?= $d ?>" value="<?= $c->category_id ?>" <?= $s ?>><?= $c->category ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-6 col-12">
							<label class="form-label">Fecha</label>
							<div class="input-group">
								<input type="text" class="form-control" id="f_from" name="from" value="<?= $params["from"] ?>">
								<span class="input-group-text">~</span>
								<input type="text" class="form-control" id="f_to" name="to" value="<?= $params["to"] ?>">
							</div>
						</div>
						<div class="col-md-6 col-12">
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
							<a href="<?= base_url() ?>money_flow/in_outcome" class="btn btn-danger"><i class="bi bi-eraser"></i></a>
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
									<th scope="col">Tipo</th>
									<th scope="col">Descripción</th>
									<th scope="col" class="text-end">Monto</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php $base_page = ($params["page"] - 1) * 25; foreach($in_outs as $i_io => $io){ ?>
								<tr>
									<th scope="row"><?= $base_page + $i_io + 1 ?></th>
									<td><?= $io->date ?></td>
									<td class="text-<?= $io->color ?>"><?= $io->type ?></td>
									<td><?= $io->description ?><br/>> <?= $io->category ?></td>
									<td class="text-end">S/ <?= number_format($io->amount, 2) ?></td>
									<td class="text-end">
										<button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_io" value="<?= $io->in_outcome_id  ?>">
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
				<?php $base_link = base_url()."money_flow/in_outcome?"; 
				foreach($paging as $p){ 
					$params["page"] = $p[0];
					$link = $base_link.http_build_query($params); ?>
				<li class="page-item <?= $p[2] ?>"><a class="page-link" href="<?= $link ?>"><?= $p[1] ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</section>