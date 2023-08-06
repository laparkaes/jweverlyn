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
		<div class="container d-flex align-items-center justify-content-between">
			<i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
			<nav id="navbar" class="navbar">
				<ul>
					<li><a href="#hero" class="active">Inicio</a></li>
					<li><a href="#products">Productos</a></li>
					<li><a href="#contact">Contacto</a></li>
				</ul>
			</nav>
			<div class="header-social-links">
				<a href="https://www.facebook.com/profile.php?id=100095467445720" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
				<a href="https://www.instagram.com/jweverlyn" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
				<a href="https://www.tiktok.com/@jw.everlyn" class="tiktok" target="_blank"><i class="bi bi-tiktok"></i></i></a>
			</div>
			<i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
		</div>
	</header>
	<section id="hero" class="hero d-flex flex-column justify-content-center align-items-center">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-6 col-md-6">
					<h2>Bienvenido a <span>JW Everlyn</span><br/><br/>Velamos por su bienestar con la última tecnología coreana.</h2>
					<p>Importamos productos ortopédicos desde Corea del Sur hasta la puerta de su hogar.</p>
					<a href="#products" class="btn-get-started">Ver catálogo de productos</a>
				</div>
				<div class="col-lg-4 col-md-6 d-md-block d-none">
					<img src="resources/assets/img/main.jpg" style="max-width: 100%;">
				</div>
			</div>
		</div>
	</section>
    <?php $this->load->view('products') ?>
	<div id="contact" class="page-header d-flex align-items-center">
		<div class="container position-relative">
			<div class="row d-flex justify-content-center">
				<div class="col-lg-6 text-center">
					<h2>Contacto</h2>
				</div>
			</div>
		</div>
	</div>
	<section class="contact mb-5">
		<div class="container">
			<div class="row gy-4 justify-content-center">
				<div class="col-md-3">
					<div class="info-item d-flex">
						<i class="bi bi-geo-alt flex-shrink-0"></i>
						<div>
							<h4>Ubicacion</h4>
							<p>Lince, Lima</p>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="info-item d-flex">
						<i class="bi bi-whatsapp flex-shrink-0"></i>
						<div>
							<h4>Whatsapp</h4>
							<p>+51 906 208 632</p>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="info-item d-flex">
						<i class="bi bi-envelope flex-shrink-0"></i>
						<div>
							<h4>Email</h4>
							<p>contacto@jweverlyn.com</p>
						</div>
					</div>
				</div>
			</div>
			<form id="send-mail-form" class="php-email-form">
				<div class="row justify-content-center text-primary mt-4">
					<div class="col-md-3 form-group">
						<label>Nombre</label>
						<input type="text" name="name" class="form-control" id="name" required="">
					</div>
					<div class="col-md-3 form-group mt-3 mt-md-0">
						<label>Celular</label>
						<input type="text" class="form-control" name="mobile" id="mobile" required="">
					</div>
					<div class="col-md-3 form-group mt-3 mt-md-0">
						<label>Email</label>
						<input type="email" class="form-control" name="email" id="email" required="">
					</div>
					<div class="col-md-9 form-group mt-3">
						<label>Mensaje</label>
						<textarea class="form-control" name="message" rows="5" required=""></textarea>
					</div>
					<div class="col-lg-8 col-md-10 form-group mt-3 text-center">
						<div class="email-result d-none mb-3"></div>
						<button type="submit" class="btn btn-primary">Enviar Mensaje</button>
					</div>
				</div>
            </form>
		</div>
	</section>
	<div class="row w-100 m-auto mt-5">
		<div class="col-md-2 col-4">
			<img src="resources/assets/img/contact/icon01.png" class="w-100" />
		</div>
		<div class="col-md-2 col-4">
			<img src="resources/assets/img/contact/icon02.png" class="w-100"/>
		</div>
		<div class="col-md-2 col-4">
			<img src="resources/assets/img/contact/icon03.png" class="w-100"/>
		</div>
		<div class="col-md-2 col-4">
			<img src="resources/assets/img/contact/icon04.png" class="w-100"/>
		</div>
		<div class="col-md-2 col-4">
			<img src="resources/assets/img/contact/icon05.png" class="w-100"/>
		</div>
		<div class="col-md-2 col-4">
			<img src="resources/assets/img/contact/icon06.png" class="w-100"/>
		</div>
	</div>
	<?php $this->load->view('footer'); ?>
</body>
</html>