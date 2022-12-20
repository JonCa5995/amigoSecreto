<?php $this->extend('plantillas/main') ?>

<?php $this->section('title') ?>
Primer acceso
<?php $this->endSection() ?>

<?php $this->section('contenido') ?>
<p class="lead text-center">Hola <span class="h2"><?= $nombre ?></span> :)</p>
<p class="lead mt-4">
	Si estás aquí es porque todavía no tienes clave :( crea una para empezar
</p>
<form action="<?= url_to('jugadorRegistro') ?>" method="post">
	<input type="hidden" name="nombre" value="<?= $claveNombre ?>">
	<div class="mb-3">
		<label for="clave" class="form-label">Clave</label>
		<input type="password" name="clave" id="clave"
				 minlength="3" maxlength="32" required
				 class="form-control"
				 autofocus
		>
	</div>
	<div class="mb-3">
		<label for="clave2" class="form-label">Verifica clave</label>
		<input type="password" name="clave2" id="clave2" required class="form-control">
	</div>
	<button type="submit" class="btn btn-success">Empezar</button>
</form>
<?php $this->endSection() ?>