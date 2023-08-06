<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Bienvenido a JW Everlyn !!!</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="resources/assets/img/favicon.png" rel="icon">
	<link href="resources/assets/img/favicon.png" rel="apple-touch-icon">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
	<link href="resources/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="resources/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="resources/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
	<link href="resources/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="resources/assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="resources/assets/css/main_new.css" rel="stylesheet">
</head>
<body>
	<header id="header" class="header d-flex align-items-center fixed-top">
		<div class="container-fluid d-flex align-items-center justify-content-between">
			<a href="./" class="logo d-flex align-items-center me-auto me-lg-0 w-lg-25">
				<img src="resources/assets/img/logo.svg" alt="">
				<h1 class="text-nowrap">JW Everlyn</h1>
			</a>
			<nav id="navbar" class="navbar">
				<ul>
					<li><a href="./" class="active">Inicio</a></li>
				</ul>
			</nav>
			<div class="header-social-links">
				<a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
				<a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
				<a href="#" class="tiktok"><i class="bi bi-tiktok"></i></i></a>
			</div>
			<i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
			<i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
		</div>
	</header>
	<?php $this->load->view('product/'.$this->input->get("c")); ?>
	<div class="page-header d-flex align-items-center">
		<div class="container position-relative">
			<div class="row d-flex justify-content-center">
				<div class="col-lg-6 text-center">
					<img src="resources/assets/img/make_in_korea.png" style="width:300px;" />
				</div>
			</div>
		</div>
	</div>
    <?php $this->load->view('products_detail'); ?>
	<?php $this->load->view('footer'); ?>
</body>
</html>