<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Detalle de Producto</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Producto</li>
					<li class="breadcrumb-item active">Detalle</li>
				</ol>
			</nav>
		</div>
		<div>
			<a href="<?= base_url() ?>product" type="button" class="btn btn-success">
				<i class="bi bi-arrow-left"></i>
			</a>
		</div>
	</div>
</div>
<section class="section profile">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-body profile-card pt-4 d-flex flex-column align-items-center text-center">
					<?php  ?>
					<img src="<?= $product->img ?>" alt="Thumb" class="w-100" style="max-width: 80%;">
					<h2><?= $product->product ?></h2>
					<h3><?= $product->category ?></h3>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-body pt-3">
					<ul class="nav nav-tabs nav-tabs-bordered">
						<li class="nav-item">
							<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#detail">Resumen</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#edit">Editar</button>
						</li>
						<li class="nav-item">
							<button class="nav-link" data-bs-toggle="tab" data-bs-target="#options">Opciones</button>
						</li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

					</ul>
					<div class="tab-content pt-2">
						<div class="tab-pane fade show active profile-overview" id="detail">
							<h5 class="card-title">Detalle de Producto</h5>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Nombre</div>
								<div class="col-lg-9 col-md-8"><?= $product->product ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Categoría</div>
								<div class="col-lg-9 col-md-8"><?= $product->category ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Precio</div>
								<div class="col-lg-9 col-md-8">S/ <?= number_format($product->price, 2) ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Stock</div>
								<div class="col-lg-9 col-md-8"><?= number_format($product->stock) ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Actualizado</div>
								<div class="col-lg-9 col-md-8"><?= $product->updated_at ?></div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-md-4 label">Registrado</div>
								<div class="col-lg-9 col-md-8"><?= $product->registed_at ?></div>
							</div>
						</div>
						<div class="tab-pane fade profile-edit" id="edit">
							<form id="form_update_product">
								<input type="hidden" name="product_id" value="<?= $product->product_id ?>">
								<div class="row pt-3 mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Producto</label>
									<div class="col-md-8 col-lg-9">
										<input name="product" type="text" class="form-control" value="<?= $product->product ?>">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Categoría</label>
									<div class="col-md-8 col-lg-9">
										<select class="form-select" name="category_id">
											<option value="">Elegir</option>
											<?php foreach($categories as $c){ 
											if ($c->category_id == $product->category_id) $s = "selected"; else $s = ""; ?>
											<option value="<?= $c->category_id ?>" <?= $s ?>><?= $c->category ?></option>
											<?php } ?>
										</select>
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-md-4 col-lg-3 col-form-label">Precio</label>
									<div class="col-md-8 col-lg-9">
										<div class="input-group">
											<span class="input-group-text" id="basic-addon1">S/</span>
											<input type="text" class="form-control" name="price" value="<?= number_format($product->price, 2) ?>">
											<div class="invalid-feedback"></div>
										</div>
									</div>
								</div>
								<div class="text-center pt-3">
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="options">
							<div class="row">
								<div class="col">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Opción</th>
													<th scope="col">Stock</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
												<form id="form_add_option">
													<tr>
														<th scope="row"></th>
														<td>
															<input type="text" class="form-control form-control-sm" name="option" placeholder="Nombre">
															<div class="invalid-feedback"></div>
														</td>
														<td>
															<input type="text" class="form-control form-control-sm" name="stock" placeholder="Stock">
															<div class="invalid-feedback"></div>
														</td>
														<td class="text-end">
															<button type="submit" class="btn btn-primary btn-sm">
																<i class="bi bi-plus-lg"></i>
															</button>
														</td>
													</tr>
												</form>
												<?php foreach($options as $i_o => $o){ ?>
												<tr>
													<th scope="row"><?= $i_o + 1 ?></th>
													<td><?= $o->option ?></td>
													<td><?= $o->stock ?></td>
													<td class="text-end">
														<button type="button" class="btn btn-outline-primary btn-sm border-0">
															<i class="bi bi-pencil-fill"></i>
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

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
