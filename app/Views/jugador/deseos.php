<?php $this->extend('plantillas/main') ?>

<?php $this->section('title') ?>
Entrar
<?php $this->endSection() ?>

<?php $this->section('contenido') ?>
<h2 class="h4 text-center">¡Hola <span class="h2"><?= $jugador->nombre ?></span>! Aquí podrás pedir un deseo</h2>

<div class="container">
	<p class="lead mt-4">
		Aquí no hay genios de la lámpara ni esto es un pozo de los deseos, pero si escribes aquí lo que te
		gustaría recibir, quizás alguien te lo de.
	</p>
	
	<form action="<?= url_to('deseos') ?>" method="post" class="mb-3 py-2" id="deseoForm">
		<input type="hidden" value="" disabled name="id" id="id">
		<div class="mb-3">
			<label for="descripcion" class="form-label">Escribe lo que te gustaría que te regalen</label>
			<input id="descripcion" type="text" name="descripcion"
					 placeholder="Pide un deseo..."
					 required autofocus
					 minlength="3" maxlength="255"
					 class="form-control <?= session()->errores ? 'is-invalid' : '' ?>">
		</div>
		<div class="d-flex justify-content-between">
			<button type="submit" class="btn btn-primary">Guardar Deseo</button>
		</div>
	
	</form>
	
	<div>
		<p class="h4">Mis deseos</p>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Deseo</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($jugador->deseos as $deseo): ?>
					<tr>
						<td hidden="hidden"><?= $deseo->id ?></td>
						<td><?= $deseo->descripcion ?></td>
						<td>
							<div class="btn-group">
								<a href="<?= url_to('eliminarDeseo', $deseo->id) ?>" class="me-2">
									<i class="bi bi-trash text-danger"></i>
								</a>
								<a class="me-2" href="#" onclick="editarDeseo(event)">
									<i class="bi bi-pencil-square text-warning"></i>
								</a>
							</div>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	
	<?php $regala = $jugador->regala;
		if (empty($regala)) : ?>
		<p class="lead mt-4">
			Todavía no se han repartido los amigos, pero cuando tengas uno, aquí saldrán sus deseos.
		</p>
	<?php elseif (!count($jugador->regala->deseos)) : ?>
		<p class="lead mt-4">
			<?= $jugador->regala->nombre ?> todavía no ha pedido nada, cuando tenga algún deseo te aparecerá aquí.
		</p>
	<?php else : ?>
		<p class="lead mt-4">
			Si no sabes qué regalar a <?= $jugador->regala->nombre ?>, aquí tienes una lista de las cosas que ha pedido.
		</p>
		<?= view('jugador/listaDeseos', [
				'deseos' => $jugador->regala->deseos
			]) ?>
	<?php endif ?>
</div>

<?php $this->endSection() ?>