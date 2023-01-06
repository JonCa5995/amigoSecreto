<?php

namespace App\Entities;

use App\Models\JugadorModel;
use CodeIgniter\Entity\Entity;

class Deseo extends Entity
{
	
	 protected $attributes = [
		 'id'				=> null,
		 'descripcion'	=> null,
		 'id_jugador'	=> null,
		 'created_at'	=> null,
		 'updated_at'	=> null,
		 'deleted_at'	=> null
	 ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
		 'id'				=> 'integer',
		 'descripcion'	=> 'string',
		 'id_jugador'	=> 'integer',
	 ];
	 
	 protected function setJugador($jugador) {
		 $this->attributes['id_jugador'] = $jugador->id;
	 }
	 
	 protected function getJugador(): object|array|null
	 {
		 $jugadorModel = new JugadorModel();
		 return $jugadorModel->find($this->attributes['id_jugador']);
	 }
}
