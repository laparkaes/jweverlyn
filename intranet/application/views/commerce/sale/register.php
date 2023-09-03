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
<div class="row">
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
									<th scope="col">Name</th>
									<th scope="col">Position</th>
									<th scope="col">Age</th>
									<th scope="col">Start Date</th>
								</tr>
							</thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td>35</td>
                    <td>2014-12-05</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Ashleigh Langosh</td>
                    <td>Finance</td>
                    <td>45</td>
                    <td>2011-08-12</td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Angus Grady</td>
                    <td>HR</td>
                    <td>34</td>
                    <td>2012-06-11</td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Raheem Lehner</td>
                    <td>Dynamic Division Officer</td>
                    <td>47</td>
                    <td>2011-04-19</td>
                  </tr>
                </tbody>
              </table>
					
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Pago</h5>
				<div class="row g-3">
					<div class="col-12">
						<label class="form-label">Medio de Pago</label>
						<select class="form-select" name="category_id">
							<?php foreach($payment_methods as $p){ ?>
							<option value="<?= $p->payment_method_id ?>"><?= $p->payment_method ?></option>
							<?php } ?>
						</select>
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-12">
						<label class="form-label">Monto</label>
						<input type="text" class="form-control" name="product">
						<div class="invalid-feedback"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Cliente</h5>
				<div class="row g-3">
					<div class="col-md-6">
						<label class="form-label">Documento</label>
						<select class="form-select" name="category_id">
							<?php foreach($ident_documents as $i){ ?>
							<option value="<?= $i->identification_document_id ?>"><?= $i->identification_document ?></option>
							<?php } ?>
						</select>
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-6">
						<label class="form-label">Número</label>
						<input type="text" class="form-control" name="product">
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-12">
						<label class="form-label">Nombre</label>
						<input type="text" class="form-control" name="price">
						<div class="invalid-feedback"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="md_add_product" tabindex="-1">
	<div class="modal-dialog">
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
							<button class="list-group-item list-group-item-action">
								<div class="d-flex w-100 justify-content-between">
									<h5 class="mb-1">List group item heading</h5>
									<small>3 days ago</small>
								</div>
								<p class="mb-1">Some placeholder content in a paragraph.</p>
								<small>And some small print.</small>
							</button>
  <a href="#" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">List group item heading</h5>
      <small class="text-body-secondary">3 days ago</small>
    </div>
    <p class="mb-1">Some placeholder content in a paragraph.</p>
    <small class="text-body-secondary">And some muted small print.</small>
  </a>
  <a href="#" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">List group item heading</h5>
      <small class="text-body-secondary">3 days ago</small>
    </div>
    <p class="mb-1">Some placeholder content in a paragraph.</p>
    <small class="text-body-secondary">And some muted small print.</small>
  </a>
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