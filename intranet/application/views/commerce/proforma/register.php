<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Nueva Proforma</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Comercio</li>
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
<div class="row">
	<div class="col-md-12">
		<div class="card d-none" id="card_select_product">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<h5 class="card-title">Elegir producto</h5>
					<button type="button" class="btn btn-danger btn-sm btn_close_select_product">
						<i class="bi bi-x-lg"></i>
					</button>
				</div>
				<div class="row">
					<div class="col-md-6 col-12">
						<form class="row g-3" id="form_search_product">
							<div class="col">
								<label class="form-label">Palabra de búsqueda</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control enter_on" name="keyword">
									<button class="btn btn-primary" type="submit">
										<i class="bi bi-search"></i>
									</button>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col">
								<div class="mb-3" id="msg_enter_keyword"><?= $this->lang->line("e_enter_keyword") ?></div>
								<div class="overflow-y-auto mb-3 d-none" id="bl_search_result" style="max-height:300px;">
									<div class="list-group" id="search_result"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-12">
						<form class="row g-3 d-none" id="form_select_product">
							<input type="hidden" name="product_id">
							<div class="col-md-12">
								<label class="form-label">Producto</label>
								<input type="text" class="form-control" name="product" readonly>
							</div>
							<div class="col-md-12">
								<label class="form-label">Opción</label>
								<select class="form-select" name="option_id"></select>
							</div>
							<div class="col-md-6">
								<label class="form-label">Precio Unitario</label>
								<div class="input-group">
									<span class="input-group-text">S/</span>
									<input type="text" class="form-control ps_price_qty" name="price" value="0">
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">Cantidad</label>
								<input type="text" class="form-control ps_price_qty" name="qty" value="0">
							</div>
							<div class="col-md-12">
								<label class="form-label">Subtotal</label>
								<div class="input-group">
									<span class="input-group-text">S/</span>
									<input type="text" class="form-control" name="subtotal" value="0" readonly>
								</div>
							</div>
							<div class="col-md-12 pt-3">
								<button type="submit" class="btn btn-primary">Agregar</button>
								<button type="button" class="btn btn-secondary btn_close_select_product">Cerrar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<form class="row" id="form_add_proforma">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<h5 class="card-title">Productos</h5>
					<button type="button" class="btn btn-primary btn-sm" id="btn_open_select_product">
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
									<th scope="col">Opción</th>
									<th scope="col" class="text-end">P/U</th>
									<th scope="col" class="text-end">Cant.</th>
									<th scope="col" class="text-end">Subtotal</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody id="tb_product_list"></tbody>
							<tfoot>
								<tr>
									<th scope="col" colspan="5" class="text-end">Total:</th>
									<th scope="col" class="text-end" id="tb_total">0.00</th>
									<th scope="col"></th>
								</tr>
							</tfoot>
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
						<input type="text" class="form-control" name="proforma[amount]" id="proforma_amount" readonly>
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
						<textarea class="form-control" name="proforma[remark]" rows="3"></textarea>
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
		<button type="submit" class="btn btn-primary btn-lg mb-3">Agregar Proforma</button>
	</div>
</form>