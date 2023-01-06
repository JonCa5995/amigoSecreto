<?php $this->extend('plantillas/main') ?>

<?php $this->section('title') ?>
	Entrar
<?php $this->endSection() ?>

<?php $this->section('contenido') ?>
	<h2 id="loginTitle" class="text-center">Inicia sesión para jugar</h2>
	
	<form action="<?= url_to('jugadorEntrar') ?>" method="post" id="loginForm">
		<div class="mb-3">
			<label for="nombre" class="form-label">Nombre</label>
			<input id="nombre" type="text" minlength="3" maxlength="32" name="nombre"
					 required autofocus placeholder="Escriba su nombre..."
					<?= !empty($nombre) ? 'value="' . $nombre . '" readonly' : '' ?>
					 class="form-control <?= session()->errUsu ? 'is-invalid' : '' ?> <?= !empty($nombre) ? 'bg-light' : '' ?>"
			>
		</div>
		<div class="mb-3">
			<label for="clave" class="form-label">Clave</label>
			<input type="password" name="clave" id="clave"
					 required placeholder="Escriba su clave..."
					 class="form-control <?= session()->errUsu || session()->errClave ? 'is-invalid' : '' ?>">
		</div>
		<button type="submit" class="btn btn-primary">Entrar</button>
	</form>
	
	<div hidden="hidden" id="restablece">
		<p class="lead mt-4">
			Escribe tu nombre y confírmalo, luego pulsa el botón
			restablecer y avisa al administrador
		</p>
		<form action="<?= url_to('resetClave') ?>" method="post">
			<div class="mb-3">
				<label for="nombreRecupera" class="form-label">Nombre</label>
				<input id="nombreRecupera" type="text" name="nombre" required class="form-control">
			</div>
			<div class="mb-3">
				<label for="nombreRecupera2" class="form-label">Confirmar nombre</label>
				<input id="nombreRecupera2" type="text" name="nombre2" required class="form-control">
			</div>
			<button type="submit" class="btn btn-warning">Restablecer</button>
		</form>
	</div>
	<div class="container text-center mt-5">
		<button type="button" onclick="toggleRestablece()" id="btnResetClave" class="btn btn-warning">Recuperar clave</button>
	</div>
<?php $this->endSection() ?>