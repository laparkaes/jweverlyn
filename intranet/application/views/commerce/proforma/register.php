<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Nueva Proforma</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Proformas</li>
					<li class="breadcrumb-item active">Nueva</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>commerce/proforma" type="button" class="btn btn-success">
				<i class="bi bi-arrow-left"></i>
			</a>
		</div>
	</div>
</div>
<form class="row" id="form_add_proforma">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<h5 class="card-title">Productos</h5>
					<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#md_add_product">
						<i class="bi bi-plus-lg"></i>
					</button>
				</div>
				<div class="row justify-content-end g-3">
					<div class="col-md-12">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Producto</th>
									<th scope="col" style="width:150px;">P/U</th>
									<th scope="col" style="width:150px;">Opción</th>
									<th scope="col" style="width:100px;">Cant.</th>
									<th scope="col" style="width:100px;">Subtotal</th>
									<th scope="col" style="width:50px;"></th>
								</tr>
							</thead>
							<tbody id="tb_product_list"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Proforma</h5>
				<div class="row g-3">
					<div class="col-md-6">
						<label class="form-label">Monto</label>
						<input type="text" class="form-control" id="proforma_amount_txt" readonly>
						<input type="hidden" name="proforma[amount]" id="proforma_amount" readonly>
					</div>
					<div class="col-md-6">
						<label class="form-label">Vigencia</label>
						<select class="form-select" name="proforma[validity]">
							<?php $today = date("Y-m-d"); ?>
							<option value="<?= $today ?>">Solo hoy</option>
							<?php $aux = date("Y-m-d", strtotime("+1 week", strtotime($today))); ?>
							<option value="<?= $aux ?>">Hasta <?= $aux ?> (una semana)</option>
							<?php $aux = date("Y-m-d", strtotime("+2 week", strtotime($today))); ?>
							<option value="<?= $aux ?>">Hasta <?= $aux ?> (dos semanas)</option>
							<?php $aux = date("Y-m-d", strtotime("+1 month", strtotime($today))); ?>
							<option value="<?= $aux ?>">Hasta <?= $aux ?> (un mes)</option>
							<?php $aux = date("Y-m-d", strtotime("+3 months", strtotime($today))); ?>
							<option value="<?= $aux ?>">Hasta <?= $aux ?> (tres meses)</option>
							<?php $aux = date("Y-m-d", strtotime("+6 months", strtotime($today))); ?>
							<option value="<?= $aux ?>">Hasta <?= $aux ?> (seis meses)</option>
							<?php $aux = date("Y-m-d", strtotime("+1 year", strtotime($today))); ?>
							<option value="<?= $aux ?>">Hasta <?= $aux ?> (un año)</option>
							<option value="">Indefinido</option>
						</select>
					</div>
					<div class="col-md-12">
						<label class="form-label">Observación</label>
						<input type="text" class="form-control" name="proforma[remark]">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Cliente</h5>
				<div class="row g-3">
					<div class="col-md-6">
						<label class="form-label">Documento</label>
						<select class="form-select" name="client[doc_type_id]" id="doc_type_id">
							<?php foreach($client_doc_types as $dt){ ?>
							<option value="<?= $dt->doc_type_id ?>"><?= $dt->doc_type ?></option>
							<?php } ?>
						</select>
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-6">
						<label class="form-label">Número</label>
						<div class="input-group has-validation">
							<input type="text" class="form-control" name="client[doc_number]" id="doc_number" disabled>
							<button type="button" class="btn btn-primary" id="btn_search_person" disabled>
								<i class="bi bi-search"></i>
							</button>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-12">
						<label class="form-label">Nombre</label>
						<input type="text" class="form-control" name="client[name]" id="client_name" disabled>
						<div class="invalid-feedback"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 d-grid">
		<button type="button" class="btn btn-primary btn-lg mb-3" id="btn_add_proforma">Agregar Proforma</button>
	</div>
</form>

<div class="modal fade" id="md_add_product" tabindex="-1">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Agregar Producto</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col">
						<div class="input-group mb-3">
							<input type="text" class="form-control" id="keyword" placeholder="Palabra de búsqueda">
							<button class="btn btn-primary" type="button" id="btn_search_product">
								<i class="bi bi-search"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="list-group" id="search_result">
							<?= $this->lang->line("e_enter_keyword") ?>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>