<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Empresa</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Ajuste</li>
					<li class="breadcrumb-item active">Empresa</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<section class="section">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Datos</h5>
					<form class="row g-3" id="form_save_company_info">
						<div class="col-md-4">
							<label for="ip_ruc" class="form-label d-flex justify-content-between">
								<span>RUC</span>
								<i class="bi bi-search text-success" id="btn_search_company"></i>
							</label>
							<input type="text" class="form-control" id="ip_ruc" name="ruc" value="<?= $company->ruc ?>">
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-8">
							<label for="ip_company" class="form-label">Empresa</label>
							<input type="text" class="form-control" id="ip_company" name="company" value="<?= $company->company ?>">
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-6">
							<label for="ip_tel" class="form-label">Teléfono</label>
							<input type="text" class="form-control" id="ip_tel" name="tel" value="<?= $company->tel ?>">
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-6">
							<label for="ip_email" class="form-label">Correo Electrónico</label>
							<input type="email" class="form-control" id="ip_email" name="email" value="<?= $company->email ?>">
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-12">
							<label for="ip_address" class="form-label">Dirección</label>
							<input type="text" class="form-control" id="ip_address" name="address" value="<?= $company->address ?>">
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-4">
							<label for="sl_department" class="form-label">Departamento</label>
							<select class="form-select" id="sl_department" name="department_id">
								<option value="">Elegir...</option>
								<?php foreach($departments as $d){ 
								if ($company->department_id == $d->department_id) $s = "selected"; else $s = ""; ?>
								<option value="<?= $d->department_id ?>" <?= $s ?>><?= $d->department ?></option>
								<?php } ?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-4">
							<label for="ip_province" class="form-label">Provincia</label>
							<select class="form-select" id="sl_province" name="province_id">
								<option value="">Elegir...</option>
								<?php foreach($provinces as $p){ 
								if ($company->province_id == $p->province_id) $s = "selected"; else $s = ""; ?>
								<option value="<?= $p->province_id ?>" <?= $s ?>><?= $p->province ?></option>
								<?php } ?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-4">
							<label for="ip_district" class="form-label">Distrito</label>
							<select class="form-select" id="sl_district" name="district_id">
								<option value="">Elegir...</option>
								<?php foreach($districts as $d){ 
								if ($company->district_id == $d->district_id) $s = "selected"; else $s = ""; ?>
								<option value="<?= $d->district_id ?>" <?= $s ?>><?= $d->district ?></option>
								<?php } ?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
						<div class="text-center pt-3">
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Sunat</h5>
					<form class="row g-3">
						<div class="col-12">
							<label for="ip_sunat_ruc" class="form-label">RUC</label>
							<input type="text" class="form-control" id="ip_sunat_ruc" value="" disabled>
						</div>
						<div class="col-12">
							<label for="ip_sunat_account" class="form-label">Usuario</label>
							<input type="text" class="form-control" id="ip_sunat_account" value="">
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-12">
							<label for="ip_sunat_password" class="form-label">Clave Sol</label>
							<input type="text" class="form-control" id="ip_sunat_password" value="">
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-12">
							<label for="ip_sunat_cert" class="form-label">Certificado</label>
							<input type="file" class="form-control" id="ip_sunat_cert" value="">
							<div class="invalid-feedback"></div>
						</div>
						
						<div class="text-center pt-3">
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>