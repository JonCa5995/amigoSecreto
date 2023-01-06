<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('JugadorController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'JugadorController::index', ['as' => 'inicio']);
$routes->get('jugador/(:segment)', 'JugadorController::inicio/$1', ['as' => 'jugadorInicio']);
$routes->post('registro', 'JugadorController::registro', ['as' => 'jugadorRegistro']);
$routes->post('entrar', 'JugadorController::entrar', ['as' => 'jugadorEntrar']);
$routes->get('salir', 'JugadorController::salir', ['as' => 'salir']);
$routes->get('juego', 'JugadorController::juego', ['as' => 'jugadorJuego', 'filter' => 'auth']);
$routes->post('activa', 'JugadorController::activar', ['as' => 'jugadorActiva']);
$routes->post('resetClave', 'JugadorController::resetClave', ['as' => 'resetClave']);

$routes->group('deseos', ['filter' => 'auth'], function($routes) {
	$routes->match(['get', 'post'], '/', 'JugadorController::deseos', ['as' => 'deseos']);
	$routes->get('eliminar/(:num)', 'JugadorController::eliminarDeseo/$1', ['as' => 'eliminarDeseo']);
});

$routes->group('admin', ['filter' => 'auth'], function($routes) {
	$routes->get('/', 'AdminController::index', ['as' => 'adminInicio']);
	$routes->get('eliminados', 'AdminController::eliminados', ['as' => 'jugadoresEliminados']);
	$routes->get('eliminar/(:num)', 'AdminController::eliminar/$1', ['as' => 'eliminarJugador']);
	$routes->get('recuperar/(:num)', 'AdminController::recuperar/$1', ['as' => 'recuperarJugador']);
	$routes->get('restablecer/(:num)', 'AdminController::restablecerClave/$1', ['as' => 'restablecerClave']);
	$routes->post('guardarJugador', 'AdminController::guardarJugador', ['as' => 'guardarJugador']);
	$routes->post('repartir', 'AdminController::repartir', ['as' => 'repartir']);
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
