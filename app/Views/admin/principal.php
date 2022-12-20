<?php $this->extend('plantillas/main') ?>

<?php $this->section('title') ?>
Entrar
<?php $this->endSection() ?>

<?php $this->section('contenido') ?>
<h2 class="h2 text-center">¡Hola <?= $nombre ?>!</h2>
<p class="lead text-center">Bievenido al panel del administrador</p>
<p class="lead">Seleccione la pestaña que desea para la acción que desea</p>
<ul class="nav nav-tabs">
	<li class="nav-item">
		<a href="<?= url_to('adminInicio') ?>"
			class="nav-link <?= url_is(route_to('adminInicio')) ? 'active' : '' ?>"
		>Jugadores</a>
	</li>
	<li class="nav-item">
		<a href="<?= url_to('jugadoresEliminados') ?>"
			class="nav-link <?= url_is(route_to('jugadoresEliminados')) ? 'active' : '' ?>"
		>Jugadores eliminados</a>
	</li>
</ul>
<div class="mt-3">
	<?= $this->renderSection('jugadores') ?>
</div>
<?php $this->endSection() ?>