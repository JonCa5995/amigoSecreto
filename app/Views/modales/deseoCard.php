<div class="card col-sm-12 col-md-6">
	<div class="card-header"><?= $deseo->jugador->nombre ?></div>
	<card-body>
		<p class="card-text"><?= $deseo->descripcion ?></p>
	</card-body>
	<div class="card-footer text-muted"><?= $deseo->updated_at->humanize() ?></div>
</div>
