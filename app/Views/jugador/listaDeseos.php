<div class="mt-3 py-3">
	<?php if (!count($deseos)) : ?>
		<p class="lead mt-2">¡Ups! Todavía nadie ha pedido ningún deseo, ve a la sección de deseos en el menú y pide el tuyo.</p>
	<?php else : ?>
		<div class="row">
			<?php foreach ($deseos as $deseo) : ?>
				
				<?= view('modales/deseoCard', ['deseo' => $deseo]) ?>
			
			<?php endforeach ?>
		</div>

	<?php endif ?>
</div>

