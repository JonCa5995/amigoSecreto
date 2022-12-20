<?php $this->extend('admin/principal') ?>

<?php $this->section('jugadores') ?>
	<form action="<?= url_to('guardarJugador') ?>" method="post" class="mb-3 py-2">
		<div class="mb-3">
			<label for="nombre" class="form-label">Añadir nuevo jugador</label>
			<input id="nombre" type="text" name="nombre"
					 placeholder="Escriba el nombre del jugador..."
					 required autofocus
					 class="form-control <?= session()->errores ? 'is-invalid' : '' ?>">
		</div>
		<div class="d-flex justify-content-between">
			<button type="submit" class="btn btn-primary">Guardar Jugador</button>
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#repartirModal">
				Repartir
			</button>
		</div>
	
	</form>
	<div class="d-flex">
		<div class="p-2 bg-danger">Jugador no activado</div>
		<div class="p-2 bg-warning mx-2">Restablecer clave</div>
		<div class="p-2 bg-success">Regala a alguien</div>
	</div>
	<div>
		<p class="lead" id="url" style="max-width: 80%; word-wrap: anywhere"></p>
		<table class="table table-hover" style="word-wrap: anywhere;">
			<thead>
			<tr>
				<th scope="col">Nombre</th>
				<th scope="col">Acciones</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($jugadores as $jugador) : ?>
				<tr class="table-<?php
					if ($jugador->restablece) echo 'warning';
					elseif (!$jugador->activado) echo 'danger';
					elseif (!empty($jugador->regala)) echo 'success';
					else echo ''
				?>">
					<td onclick="let aux = document.getElementById('url'); aux.innerText = this.nextElementSibling.innerText"><?= $jugador->nombre ?></td>
					<td hidden="hidden"><?= base_url() . '/jugador/' . $jugador->nombreEncriptado ?></td>
					<td>
						<div class="btn-group">
							<?php if ($jugador->regala == null && !$jugador->admin) : ?>
								<a href="<?= url_to('eliminarJugador', $jugador->id) ?>" class="me-2">
									<i class="bi bi-trash text-danger"></i>
								</a>
							<?php endif ?>
							<?php if ($jugador->restablece) : ?>
								<a href="<?= url_to('restablecerClave', $jugador->id) ?>">
									<i class="bi bi-unlock-fill text-success"></i>
								</a>
							<?php endif ?>
						</div>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
			<tfoot>
			<tr>
				<th>Total jugadores</th>
				<td><?= $pager->getTotal() ?> </td>
			</tr>
			<tr>
				<td colspan="5">
					<p>Los jugadores eliminados o desactivados aparecerán en la pestaña de eliminados.</p>
				</td>
			</tr>
			</tfoot>
		</table>
		<div>
			<?= $pager->links() ?>
		</div>
	</div>
	
	<div>
		<?= $this->include('modales/repartirModal') ?>
	</div>
<?php $this->endSection() ?>