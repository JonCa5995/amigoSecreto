<?php $this->extend('admin/principal') ?>

<?php $this->section('jugadores') ?>

<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">Nombre</th>
			<th scope="col">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($jugadores as $jugador) : ?>
			<tr>
				<td><?= $jugador->nombre ?></td>
				<td>
					<a href="<?= url_to('recuperarJugador', $jugador->id) ?>">
						<i class="bi bi-arrow-counterclockwise fs-5"></i>
					</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
	<tr>
		<th>Total jugadores Eliminados</th>
		<td><?= $pager->getTotal() ?> </td>
	</tr>
	</tfoot>
</table>
<div class="mx-auto">
	<?= $pager->links() ?>
</div>
<?php $this->endSection() ?>
