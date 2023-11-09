<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>JW Everlyn</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="<?= base_url() ?>assets/img/favicon.png" rel="icon">
	<link href="<?= base_url() ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendor/toastr/toastr.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
</head>
<body>
	<header id="header" class="header fixed-top d-flex align-items-center">
		<div class="d-flex align-items-center justify-content-between">
			<a href="<?= base_url() ?>dashboard" class="logo d-flex align-items-center">
				<img src="<?= base_url() ?>assets/img/logo.png" alt="">
				<span class="d-none d-lg-block">JW Everlyn</span>
			</a>
			<i class="bi bi-list toggle-sidebar-btn"></i>
		</div>
		<div class="search-bar">
			<form class="search-form d-flex align-items-center" method="GET" action="<?= base_url() ?>commerce/client">
				<input type="text" class="enter_on" name="search" placeholder="Buscar cliente">
			<button type="submit" title="Search"><i class="bi bi-search"></i></button>
			</form>
		</div>
		<nav class="header-nav ms-auto">
			<ul class="d-flex align-items-center">
				<li class="nav-item d-block d-lg-none">
					<a class="nav-link nav-icon search-bar-toggle " href="#">
						<i class="bi bi-search"></i>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
						<i class="bi bi-bell"></i>
						<span class="badge bg-danger badge-number">4</span>
					</a>
					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
						<li class="dropdown-header">
							You have 4 new notifications
							<a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li class="notification-item">
							<i class="bi bi-exclamation-circle text-warning"></i>
							<div>
								<h4>Lorem Ipsum</h4>
								<p>Quae dolorem earum veritatis oditseno</p>
								<p>30 min. ago</p>
							</div>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li class="notification-item">
							<i class="bi bi-x-circle text-danger"></i>
							<div>
								<h4>Atque rerum nesciunt</h4>
								<p>Quae dolorem earum veritatis oditseno</p>
								<p>1 hr. ago</p>
							</div>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li class="notification-item">
							<i class="bi bi-check-circle text-success"></i>
							<div>
								<h4>Sit rerum fuga</h4>
								<p>Quae dolorem earum veritatis oditseno</p>
								<p>2 hrs. ago</p>
							</div>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li class="notification-item">
							<i class="bi bi-info-circle text-primary"></i>
							<div>
								<h4>Dicta reprehenderit</h4>
								<p>Quae dolorem earum veritatis oditseno</p>
								<p>4 hrs. ago</p>
							</div>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li class="dropdown-footer">
							<a href="#">Show all notifications</a>
						</li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
						<i class="bi bi-chat-left-text"></i>
						<span class="badge bg-danger badge-number">3</span>
					</a>
					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
						<li class="dropdown-header">
							You have 3 new messages
							<a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li class="message-item">
							<a href="#">
								<img src="<?= base_url() ?>assets/img/messages-1.jpg" alt="" class="rounded-circle">
								<div>
									<h4>Maria Hudson</h4>
									<p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
									<p>4 hrs. ago</p>
								</div>
							</a>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li class="message-item">
							<a href="#">
								<img src="<?= base_url() ?>assets/img/messages-2.jpg" alt="" class="rounded-circle">
								<div>
									<h4>Anna Nelson</h4>
									<p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
									<p>6 hrs. ago</p>
								</div>
							</a>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li class="message-item">
							<a href="#">
								<img src="<?= base_url() ?>assets/img/messages-3.jpg" alt="" class="rounded-circle">
								<div>
									<h4>David Muldon</h4>
									<p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
									<p>8 hrs. ago</p>
								</div>
							</a>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li class="dropdown-footer">
							<a href="#">Show all messages</a>
						</li>
					</ul>
				</li>
				<li class="nav-item dropdown pe-3">
					<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
						<span class="d-none d-md-block dropdown-toggle ps-2"><?= $this->session->userdata('name') ?></span>
					</a>
					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
						<li class="dropdown-header">
							<h6><?= $this->session->userdata('role'); ?></h6>
							<span><?= $this->session->userdata('username'); ?></span>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li>
							<a class="dropdown-item d-flex align-items-center" href="users-profile.html">
								<i class="bi bi-person"></i>
								<span>Perfil</span>
							</a>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li>
							<a class="dropdown-item d-flex align-items-center" href="users-profile.html">
								<i class="bi bi-gear"></i>
								<span>Configuración</span>
							</a>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li>
							<a class="dropdown-item d-flex align-items-center" href="<?= base_url() ?>auth/logout">
								<i class="bi bi-box-arrow-right"></i>
								<span>Salir</span>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</header>
	<aside id="sidebar" class="sidebar">
		<ul class="sidebar-nav" id="sidebar-nav">
			<li class="nav-item">
				<?php if ($this->nav_menu[0] === "dashboard") $c = ""; else $c = "collapsed"; ?>
				<a class="nav-link <?= $c ?>" href="<?= base_url() ?>dashboard">
					<i class="bi bi-grid"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<li class="nav-item">
				<?php if ($this->nav_menu[0] === "stock"){ $c = ""; $c_ul = "show"; }else{ $c = "collapsed"; $c_ul = ""; } ?>
				<a class="nav-link <?= $c ?>" data-bs-target="#stock-nav" data-bs-toggle="collapse" href="#">
					<i class="bi bi-box"></i>
					<span>Stock</span>
					<i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="stock-nav" class="nav-content collapse <?= $c_ul ?>" data-bs-parent="#stock-nav">
					<li>
						<?php if ($this->nav_menu[1] === "purchase") $c1 = "active"; else $c1 = ""; ?>
						<a href="<?= base_url() ?>stock/purchase" class="<?= $c1 ?>">
							<i class="bi bi-circle"></i><span>Compras</span>
						</a>
					</li>
					<li>
						<?php if ($this->nav_menu[1] === "product") $c1 = "active"; else $c1 = ""; ?>
						<a href="<?= base_url() ?>stock/product" class="<?= $c1 ?>">
							<i class="bi bi-circle"></i><span>Productos</span>
						</a>
					</li>
					<li>
						<?php if ($this->nav_menu[1] === "provider") $c1 = "active"; else $c1 = ""; ?>
						<a href="<?= base_url() ?>stock/provider" class="<?= $c1 ?>">
							<i class="bi bi-circle"></i><span>Proveedores</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item">
				<?php if ($this->nav_menu[0] === "commerce"){ $c = ""; $c_ul = "show"; }else{ $c = "collapsed"; $c_ul = ""; } ?>
				<a class="nav-link <?= $c ?>" data-bs-target="#commerce-nav" data-bs-toggle="collapse" href="#">
					<i class="bi bi-shop"></i>
					<span>Comercio</span>
					<i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="commerce-nav" class="nav-content collapse <?= $c_ul ?>" data-bs-parent="#commerce-nav">
					<li>
						<?php if ($this->nav_menu[1] === "sale") $c1 = "active"; else $c1 = ""; ?>
						<a href="<?= base_url() ?>commerce/sale" class="<?= $c1 ?>">
							<i class="bi bi-circle"></i><span>Ventas</span>
						</a>
					</li>
					<li>
						<?php if ($this->nav_menu[1] === "proforma") $c1 = "active"; else $c1 = ""; ?>
						<a href="<?= base_url() ?>commerce/proforma" class="<?= $c1 ?>">
							<i class="bi bi-circle"></i><span>Proformas</span>
						</a>
					</li>
					<li>
						<?php if ($this->nav_menu[1] === "client") $c1 = "active"; else $c1 = ""; ?>
						<a href="<?= base_url() ?>commerce/client" class="<?= $c1 ?>">
							<i class="bi bi-circle"></i><span>Clientes</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item">
				<?php if ($this->nav_menu[0] === "authentication"){ $c = ""; $c_ul = "show"; }else{ $c = "collapsed"; $c_ul = ""; } ?>
				<a class="nav-link <?= $c ?>" data-bs-target="#authentication-nav" data-bs-toggle="collapse" href="#">
					<i class="bi bi-person-vcard"></i>
					<span>Autenticación</span>
					<i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="authentication-nav" class="nav-content collapse <?= $c_ul ?>" data-bs-parent="#authentication-nav">
					<li>
						<?php if ($this->nav_menu[1] === "account") $c1 = "active"; else $c1 = ""; ?>
						<a href="<?= base_url() ?>authentication/account" class="<?= $c1 ?>">
							<i class="bi bi-circle"></i><span>Usuarios</span>
						</a>
					</li>
					<li>
						<?php if ($this->nav_menu[1] === "role") $c1 = "active"; else $c1 = ""; ?>
						<a href="<?= base_url() ?>authentication/role" class="<?= $c1 ?>">
							<i class="bi bi-circle"></i><span>Roles</span>
						</a>
					</li>
					<li>
						<?php if ($this->nav_menu[1] === "access") $c1 = "active"; else $c1 = ""; ?>
						<a href="<?= base_url() ?>authentication/access" class="<?= $c1 ?>">
							<i class="bi bi-circle"></i><span>Accesos</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item">
				<?php if ($this->nav_menu[0] === "setting"){ $c = ""; $c_ul = "show"; }else{ $c = "collapsed"; $c_ul = ""; } ?>
				<a class="nav-link <?= $c ?>" data-bs-target="#setting-nav" data-bs-toggle="collapse" href="#">
					<i class="bi bi-pc-display"></i>
					<span>Ajustes</span>
					<i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="setting-nav" class="nav-content collapse <?= $c_ul ?>" data-bs-parent="#sidebar-nav">
					<li>
						<?php if ($this->nav_menu[1] === "company") $c1 = "active"; else $c1 = ""; ?>
						<a href="<?= base_url() ?>setting/company" class="<?= $c1 ?>">
							<i class="bi bi-circle"></i><span>Empresa</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-heading">Pages</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="users-profile.html">
					<i class="bi bi-person"></i>
					<span>Profile</span>
				</a>
			</li>
		</ul>
	</aside>
	<main id="main" class="main">
		<?php $this->load->view($main); ?>
	</main>
	<footer id="footer" class="footer">
		<div class="copyright">
		&copy; Copyright <strong><span>JW Everlyn S.A.C.</span></strong>. Todos los derechos reservados
		</div>
	</footer>
	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
	
	<script src="<?= base_url() ?>assets/vendor/jquery-3.7.0.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/toastr/toastr.min.js"></script>
	<script src="<?= base_url() ?>assets/js/main.js"></script>
	<script src="<?= base_url() ?>assets/js/func.js"></script>
	<?php if ($this->js_init){ ?>
	<script src="<?= base_url() ?>assets/js/init/<?= $this->js_init ?>"></script>
	<?php } ?>
	
</body>
</html>