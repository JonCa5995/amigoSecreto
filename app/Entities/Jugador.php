<?php

namespace App\Entities;

use App\Models\DeseoModel;
use App\Models\JugadorModel;
use CodeIgniter\Entity\Entity;

class Jugador extends Entity
{
	
	 protected $attributes = [
		 'id'				=> null,
		 'nombre'		=> null,
		 'clave'			=> null,
		 'admin'			=> false,
		 'activado'		=> false,
		 'restablece'	=> false,
		 'regala'		=> null,
		 'created_at'	=> null,
		 'updated_at'	=> null,
		 'deleted_at'	=> null,
		 'deseos'		=> []
	 ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
		 'id'				=> 'integer',
		 'nombre'		=> 'string',
		 'clave'			=> '?string',
		 'admin'			=> 'boolean',
		 'activado'		=> 'boolean',
		 'restablece'	=> 'boolean',
		 'deseos'		=> 'array'
	 ];
	
	protected function setNombre($nombre) {
		 $this->attributes['nombre'] = base64_encode(convert_uuencode($nombre));
	 }
	 
	 protected function getNombre(): bool|string
	 {
		 return convert_uudecode(base64_decode($this->attributes['nombre']));
	 }
	 
	 protected function getNombreEncriptado(): string {
		 return $this->attributes['nombre'];
	 }
	 protected function setClave($clave) {
		 $this->attributes['clave'] = password_hash($clave, PASSWORD_DEFAULT);
	 }
	 
	 public function autenticar($clave): bool
	 {
		 return password_verify($clave, $this->attributes['clave']);
	 }
	 
	 protected function setAdmin(string|bool|int $admin) {
		 $this->attributes['admin'] = $admin == 'on' || $admin == 1 || $admin;
	 }
	
	protected function setRestablece(string|bool|int $admin) {
		$this->attributes['restablece'] = $admin == 'on' || $admin == 1 || $admin;
	}
	 
	 protected function setActivado(string|bool|int $activado) {
		 $this->attributes['activado'] = $activado == 'on' || $activado == 1 || $activado;
	 }
	 
	 protected function getRegala(): object|array|null
	 {
		 if ($this->attributes['regala'] == null) return null;
		 $jugadorModel = new JugadorModel();
		 return $jugadorModel->withDeleted()->find($this->attributes['regala']);
	 }
	 
	 public function isRegistrado(): bool
	 {
		 return $this->attributes['clave'] != null;
	 }

	 public function setDeseo(Deseo $deseo) {
		 $deseo->id_jugador = $this->attributes['id'];
		 $deseosModel = new DeseoModel();
		 $deseosModel->save($deseo);
	 }
	 
	 public function getDeseos(): array
	 {
		 $deseosModel = new DeseoModel();
		 return $deseosModel->obtenerDeseos($this->attributes['id']);
	 }
}
