<?php

namespace App\Database\Seeds;

use App\Entities\Jugador;
use App\Models\JugadorModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;
use Faker\Generator;

class AdminSeeder extends Seeder
{
    public function run()
    {
		  $jugadores = [];
        $jugador = new Jugador();
		  $model = new JugadorModel();
		  
		  $jugador->nombre = 'Administrador';
		  $jugador->clave = 'd1n054ur10';
		  $jugador->admin = true;
		  $jugador->activado = false;
		  
		  $jugadores[] = $jugador;
		  
		  for ($i = 0; $i < 30; $i++) {
			  $jugador = new Jugador();
			  $jugador->nombre = Factory::create()->name();
			  $jugadores[] = $jugador;
		  }
		  
		  $model->insertBatch($jugadores);
    }
}
