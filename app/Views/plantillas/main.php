<?php helper('html'); ?>
<!doctype html>
<html lang="es-es" class="h-100">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Proyecto de aplicación web para jugar al amigo invisible">
	<meta name="author" content="Jonathan Cáceres">
	<title><?= $this->renderSection('title') ?> &nbsp;-&nbsp;Amigo Secreto</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
	<meta name="theme-color" content="#712cf9">
	<?= link_tag('css/estilos.css') ?>
	<?= script_tag('js/script.js') ?>
</head>
<body class="d-flex flex-column h-100">
	<?= $this->include('plantillas/header') ?>
	<main class="flex-shrink-0">
		<div class="container">
			<div class="my-5 py-3">
				<h1 class="text-center">¡Vamos a jugar al amigo invisible!</h1>
			</div>

			<div class="container mx-xxl-5 px-xxl-5 mx-xl-4 px-xl-4 mx-lg-3 px-lg-3 mx-md-2 px-md-2 mx-sm-1 px-sm-1">
				<div class="mx-xxl-5 px-xxl-5 mx-xl-4 px-xl-4 mx-lg-3 px-lg-3 mx-md-2 px-md-2 mx-sm-1 px-sm-1">
					<div class="mx-xxl-5 px-xxl-5 mx-xl-4 px-xl-4 mx-lg-3 px-lg-3 mx-md-2 px-md-2 mx-sm-1 px-sm-1">
						<?php if (session()->errores) : ?>
							<?php foreach (session()->errores as $error) : ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<?= $error ?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php 	endforeach ?>
						<?php	endif ?>

						<?php if (session()->msg) : ?>
							<?php foreach (session()->msg as $mensaje) : ?>
								<div class="alert alert-info alert-dismissible fade show" role="alert">
									<?= $mensaje ?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php 	endforeach ?>
						<?php	endif ?>
						<?= $this->renderSection('contenido') ?>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?= $this->include('plantillas/footer') ?>
</body>
</html>
