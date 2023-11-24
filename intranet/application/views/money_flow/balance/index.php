<div class="pagetitle">
	<div class="d-flex justify-content-between align-items-start">
		<div>
			<h1>Balance</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Flujo de Caja</li>
					<li class="breadcrumb-item active">Balance</li>
				</ol>
			</nav>
		</div>
	</div>
</div>	
<section class="section">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-between">
						<div class="col-md-6">
							<h5 class="card-title">Balance de <?= $params["bp"] ?></h5>
						</div>
						<div class="col-md-4">
							<form class="row" id="form_balane_filter">
								<div class="col">
									<div class="input-group mt-md-3 mb-md-0 mb-3">
										<select class="form-select" id="sl_bt" name="bt">
											<option value="">Tipo</option>
											<option value="m" <?= ($params["bt"] === "m") ? "selected" : "" ?>>Mensual</option>
											<option value="y" <?= ($params["bt"] === "y") ? "selected" : "" ?>>Anual</option>
										</select>
										<select class="form-select" id="sl_bp" name="bp">
											<option value="">Periodo</option>
											<?php $d = ($params["bt"] === "y") ? "" : "d-none"; foreach($years as $y){ ?>
											<option class="bt bt_y <?= $d ?>" value="<?= $y ?>" <?= ($y === $params["bp"]) ? "selected" : "" ?>><?= $y ?></option>
											<?php } $d = ($params["bt"] === "m") ? "" : "d-none"; foreach($months as $m){ ?>
											<option class="bt bt_m <?= $d ?>" value="<?= $m ?>" <?= ($m === $params["bp"]) ? "selected" : "" ?>><?= $m ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table align-middle">
							<thead>
								<tr>
									<th scope="col">Resultado</th>
									<th scope="col" class="text-end text-<?= $balance["color"] ?> text-nowrap">S/ <?= number_format(abs($balance["total"]), 2) ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($types as $t_i => $t){ ?>
								<tr class="table-<?= $t->color ?>">
									<th class="text-<?= $t->color ?>">
										<button type="button" class="btn btn-outline-<?= $t->color ?> btn-sm border-0 me-1 btn_control_by_type" value="<?= $t->type_id ?>">
											<i class="bi bi-caret-down-fill"></i>
										</button>
										<span style="width: 150px;"><?= $t->type ?></span>
									</th>
									<th class="text-end text-<?= $t->color ?> text-nowrap">S/ <?= number_format($t->total, 2) ?></th>
								</tr>
								<tr class="table-<?= $t->color ?> t_row_<?= $t->type_id ?>">
									<td class="ps-3">
										<button type="button" class="btn btn-outline-dark btn-sm border-0 me-1"><i class="bi bi-dot"></i></button>
										<span><?= $other[$t->type]["description"] ?></span>
									</td>
									<td class="text-end text-nowrap">S/ <?= number_format($other[$t->type]["total"], 2) ?></td>
								</tr>
								<?php $categories = $t->categories; foreach($categories as $c_i => $c){ ?>
								<tr class="table-<?= $t->color ?> t_row_<?= $t->type_id ?>">
									<td class="ps-3">
										<button type="button" class="btn btn-outline-dark btn-sm border-0 me-1 btn_control_by_category" value="<?= $c->category_id ?>">
											<i class="bi bi-caret-right-fill"></i>
										</button>
										<span><?= $c->category ?></span>
									</td>
									<td class="text-end text-nowrap">S/ <?= number_format($c->total, 2) ?></td>
								</tr>
								<?php $ios = $c->ios; foreach($ios as $io_i => $io){ ?>
								<tr class="c_row_<?= $c->category_id ?> d-none">
									<td class="ps-5"><?= $io->date ?> / <?= $io->description ?></td>
									<td class="text-end text-nowrap">S/ <?= number_format($io->amount, 2) ?></td>
								</tr>
								<?php }}} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>