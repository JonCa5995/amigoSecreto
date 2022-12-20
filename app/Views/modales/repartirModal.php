<!--<div id="repartirModal" class="modal fade show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="repartirModalEtiqueta" style="display: block;" aria-modal="true" role="dialog">
	<div class="modal-dialog">
		<div class="modal-dialog">
			<div class="modal-header">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="repartirModalEtiqueta">Repartir amigos</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="<?php /*= url_to('repartir') */?>" method="post">
					<div class="modal-body">
						<p class="lead mb-3">
							Una vez se pulse el botón de repartir, los jugadores que no estén activos no podrán jugar
						</p>
						<p class="lead">¿Permitir ciclos en el juego?</p>
						<label class="form-check-label" for="cicloSi">Sí</label>
						<input type="radio"
								 name="ciclos"
								 id="cicloSi"
								 value="1"
								 class="form-check-input"
						>
						<label class="form-check-label" for="cicloNo">No</label>
						<input type="radio"
								 name="ciclos"
								 id="cicloNo"
								 value="0"
								 checked
								 class="form-check-input"
						>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Repartir</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>-->

<div class="modal fade" id="repartirModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="repartirModalEtiqueta" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="repartirModalEtiqueta">Repartir jugadores</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= url_to('repartir') ?>" method="post">
			<div class="modal-body">
				<p class="lead mb-3">
					Una vez se pulse el botón de repartir, los jugadores que no estén activos no podrán jugar
				</p>
				<p class="lead">¿Permitir ciclos en el juego?</p>
				<label class="form-check-label" for="cicloSi">Sí</label>
				<input type="radio"
						 name="ciclos"
						 id="cicloSi"
						 value="1"
						 class="form-check-input"
				>
				<label class="form-check-label" for="cicloNo">No</label>
				<input type="radio"
						 name="ciclos"
						 id="cicloNo"
						 value="0"
						 checked
						 class="form-check-input"
				>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Repartir</button>
			</div>
			</form>
		</div>
	</div>
</div>
