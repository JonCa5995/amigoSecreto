<header>
	<!-- Fixed navbar -->
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark p-3">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?= url_to('inicio') ?>">
				<!--<img src="/images/logo.png" alt="Iglesia Bethel" width="38" height="30" class="me-3">-->
				El Edison Secreto
			</a>
			<?php if (session()->dentro ) : ?>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav me-auto mb-2 mb-md-0">
					<li class="nav-item">
						<a class="nav-link <?= url_is(route_to('jugadorJuego')) ? 'active' : '' ?>"
							href="<?= url_to('jugadorJuego') ?>">
							Mi juego
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= url_is(route_to('deseos')) ? 'active' : '' ?>"
							href="<?= url_to('deseos') ?>">
							Deseos
						</a>
					</li>
					<?php if (session()->admin ) : ?>
					<li class="nav-item">
						<a class="nav-link <?= url_is(route_to('adminInicio') . '*') ? 'active' : '' ?>"
							href="<?= url_to('adminInicio') ?>">
							Panel Administrador
						</a>
					</li>
					<?php endif ?>
				</ul>
				<div class="d-flex">
					<a class="btn btn-outline-danger" href="<?= url_to('salir') ?>">Salir</a>
				</div>
			</div>
			<?php endif ?>
		</div>
	</nav>
</header>
