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
		<div>
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
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Balance de <?= $s_date ?></h5>
					<div class="table-responsive">
						<div><?php print_r($years); ?></div>
						<div><?php print_r($months); ?></div>
						<table class="table align-middle">
							<thead>
								<tr>
									<th scope="col">Resultado</th>
									<th scope="col" class="text-end text-<?= $balance["color"] ?>">S/ <?= number_format(abs($balance["total"]), 2) ?></th>
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
									<th class="text-end text-<?= $t->color ?>">S/ <?= number_format($t->total, 2) ?></th>
								</tr>
								<tr class="table-<?= $t->color ?> t_row_<?= $t->type_id ?>">
									<td class="ps-3">
										<button type="button" class="btn btn-outline-dark btn-sm border-0 me-1"><i class="bi bi-dot"></i></button>
										<span><?= $other[$t->type]["description"] ?></span>
									</td>
									<td class="text-end">S/ <?= number_format($other[$t->type]["total"], 2) ?></td>
								</tr>
								<?php $categories = $t->categories; foreach($categories as $c_i => $c){ ?>
								<tr class="table-<?= $t->color ?> t_row_<?= $t->type_id ?>">
									<td class="ps-3">
										<button type="button" class="btn btn-outline-dark btn-sm border-0 me-1 btn_control_by_category" value="<?= $c->category_id ?>">
											<i class="bi bi-caret-right-fill"></i>
										</button>
										<span><?= $c->category ?></span>
									</td>
									<td class="text-end">S/ <?= number_format($c->total, 2) ?></td>
								</tr>
								<?php $ios = $c->ios; foreach($ios as $io_i => $io){ ?>
								<tr class="c_row_<?= $c->category_id ?> d-none">
									<td class="ps-5"><?= $io->date ?> / <?= $io->description ?></td>
									<td class="text-end">S/ <?= number_format($io->amount, 2) ?></td>
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