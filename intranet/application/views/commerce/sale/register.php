<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Nueva Venta</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Ventas</li>
					<li class="breadcrumb-item active">Nueva</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>commerce/sale" type="button" class="btn btn-success">
				<i class="bi bi-arrow-left"></i>
			</a>
		</div>
	</div>
</div>
<form class="row" id="form_add_sale">
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
									<th scope="col">P/U</th>
									<th scope="col">Opción</th>
									<th scope="col">Cant.</th>
									<th scope="col">Subtotal</th>
									<th scope="col"></th>
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
				<h5 class="card-title">Pago</h5>
				<div class="row g-3">
					<div class="col-md-6">
						<label class="form-label">Medio de Pago</label>
						<select class="form-select" name="payment[payment_method_id]">
							<?php foreach($payment_methods as $p){ ?>
							<option value="<?= $p->payment_method_id ?>"><?= $p->payment_method ?></option>
							<?php } ?>
						</select>
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-6">
						<label class="form-label">Recibido</label>
						<div class="input-group">
							<span class="input-group-text">S/.</span>
							<input type="text" class="form-control" id="received_txt" value="0.00">
						</div>
						<input type="text" class="form-control d-none" id="received" name="payment[received]" value="0.00">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-6">
						<label class="form-label">Total</label>
						<div class="input-group">
							<span class="input-group-text">S/.</span>
							<input type="text" class="form-control" id="total_txt" value="0.00" disabled>
						</div>
						<input type="text" class="form-control d-none" id="total" name="payment[total]" value="0.00" readonly>
					</div>
					<div class="col-md-6">
						<label class="form-label">Vuelto</label>
						<div class="input-group">
							<span class="input-group-text">S/.</span>
							<input type="text" class="form-control" id="change_txt" value="0.00" disabled>
						</div>
						<input type="text" class="form-control d-none" id="change" name="payment[change]" value="0.00" readonly>
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
							<?php foreach($ident_documents as $i){ ?>
							<option value="<?= $i->identification_document_id ?>"><?= $i->identification_document ?></option>
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
		<button type="button" class="btn btn-primary btn-lg mb-3" id="btn_add_sale">Add Sale</button>
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