<div class="card col-sm-12 col-md-6">
	<div class="card-header d-flex justify-content-between">
		<?= $deseo->jugador->nombre ?>
		<span class="text-muted"><?= $deseo->updated_at->humanize() ?></span>
	</div>
	<card-body>
		<p class="card-text"><?= $deseo->descripcion ?></p>
	</card-body>
</div>
