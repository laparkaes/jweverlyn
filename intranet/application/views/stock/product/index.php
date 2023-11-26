<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Productos</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Stock</li>
					<li class="breadcrumb-item active">Productos</li>
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
			<a href="<?= base_url() ?>stock/product/register" type="button" class="btn btn-success">
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
						<li class="nav-item" role="category">
							<button class="nav-link" id="move_category-tab" data-bs-toggle="tab" data-bs-target="#bordered-move_category" type="button" role="tab" aria-controls="move_category" aria-selected="false" tabindex="-1">Mover</button>
						</li>
						<?php } ?>
					</ul>
					<div class="tab-content pt-3">
						<div class="tab-pane fade show active" id="bordered-add_category" role="tabpanel" aria-labelledby="add_category-tab">
							<form class="row g-3" id="form_add_category">
								<div class="col-12">
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
						<div class="tab-pane fade" id="bordered-move_category" role="tabpanel" aria-labelledby="move_category-tab">
							<form class="row g-3" id="form_move_category">
								<div class="col-md-6 col-12">
									<label class="form-label">De</label>
									<select class="form-select" name="from_id">
										<option value="">Elegir</option>
										<?php foreach($categories as $c){ ?>
										<option value="<?= $c->category_id ?>"><?= $c->category ?></option>
										<?php } ?>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="col-md-6 col-12">
									<label class="form-label">A</label>
									<select class="form-select" name="to_id">
										<option value="">Elegir</option>
										<?php foreach($categories as $c){ ?>
										<option value="<?= $c->category_id ?>"><?= $c->category ?></option>
										<?php } ?>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="col-12 text-center pt-3">
									<button type="submit" class="btn btn-primary"><i class="bi bi-arrow-right"></i></button>
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
						<div class="col-md-3 col-12">
							<label class="form-label">Categoría</label>
							<select class="form-select" name="category">
								<option value="">Categoría</option>
								<?php 
								$c_id = $this->input->get("category");
								foreach($categories as $c){ if ($c_id == $c->category_id) $s = "selected"; else $s = ""; ?>
								<option value="<?= $c->category_id ?>" <?= $s ?>><?= $c->category ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-3 col-12">
							<label class="form-label">Tipo</label>
							<select class="form-select" name="type">
								<option value="">Tipo</option>
								<?php 
								$t_id = $this->input->get("type");
								foreach($types as $t){ if ($t_id == $t->type_id) $s = "selected"; else $s = ""; ?>
								<option value="<?= $t->type_id ?>" <?= $s ?>><?= $t->type ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-6 col-12">
							<label class="form-label">Producto</label>
							<input type="text" class="form-control enter_on" name="product" value="<?= $params["product"] ?>">
						</div>
						<div class="text-center pt-3">
							<button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
							<a href="<?= base_url() ?>stock/product" class="btn btn-danger"><i class="bi bi-eraser"></i></a>
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
									<th scope="col">Tipo</th>
									<th scope="col">Producto</th>
									<th scope="col" class="text-end">Stock</th>
									<th scope="col" class="text-end">Precio</th>
									<th scope="col"></th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php $base_page = ($params["page"] - 1) * 25; foreach($products as $i_p => $p){ ?>
								<tr>
									<th scope="row"><?= $base_page + $i_p + 1 ?></th>
									<td><img src="<?= base_url() ?>uploads/prod/<?= $p->image ?>" style="height: 60px;"></td>
									<td><?= $p->type ?></td>
									<td><?= $p->product ?><br/>> <?= $p->category ?></td>
									<td class="text-end"><?= ($p->stock > 0) ? number_format($p->stock) : "-" ?></td>
									<td class="text-nowrap text-end">S/ <?= number_format($p->price, 2) ?></td>
									<td><i class="bi bi-circle-fill text-<?= $p->color ?>"></i></td>
									<td class="text-end">
										<a href="<?= base_url() ?>stock/product/detail/<?= $p->product_id ?>" type="button" class="btn btn-outline-primary btn-sm border-0">
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
				<?php $base_link = base_url()."stock/product?"; 
				foreach($paging as $p){ 
					$params["page"] = $p[0];
					$link = $base_link.http_build_query($params); ?>
				<li class="page-item <?= $p[2] ?>"><a class="page-link" href="<?= $link ?>"><?= $p[1] ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</section>