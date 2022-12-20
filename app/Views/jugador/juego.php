<?php $this->extend('plantillas/main') ?>

<?php $this->section('title') ?>
Entrar
<?php $this->endSection() ?>

<?php $this->section('contenido') ?>
<h2 class="h4 text-center">¡Bienvenido <span class="h2"><?= $nombre ?></span>!</h2>

<div class="container">
	<?php if (!empty($regala)) : ?>
		<p class="lead mt-4">
			¿Quién te tiene que regalar a ti? Eso es secreto, por ahora tienes que saber que a tú regalas a
			<span class="h5"><?= $regala ?></b></span>
		</p>
	<?php elseif ($activado) : ?>
		<p class="lead mt-4">
			Todavía no se han repartido las papeletas, ¡Que nervios!, ¿A quién te tocará dar un regalo?
		</p>
	<?php else : ?>
		<p class="lead mt-4">
			¡Ups! Parece que todavía no has activado tu cuenta, activa el interruptor para poder jugar :)
		</p>
		<form action="<?= url_to('jugadorActiva') ?>" method="post">
			<input type="hidden"
					 name="id"
					 value="<?= session()->id ?>"
			>
			<div class="form-check form-switch">
				<input type="checkbox"
						 name="activado"
						 id="activado"
						 onclick="submit()"
						class="form-check-input"
						 role="switch"
				>
				<label for="activado" class="form-check-label">
					Activar para jugar
				</label>
			</div>
		</form>
	<?php endif ?>
</div>

<?php $this->endSection() ?>