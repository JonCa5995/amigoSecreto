
<div class="card col-sm-12 col-md-5">
	<div class="card-header d-flex justify-content-between">
		<strong class="me-auto"><?= $deseo->jugador->nombre ?></strong>
		<span class="text-muted"><?= $deseo->updated_at->humanize() ?></span>
	</div>
	<card-body>
		<p class="card-text"><?= $deseo->descripcion ?></p>
	</card-body>
</div>
