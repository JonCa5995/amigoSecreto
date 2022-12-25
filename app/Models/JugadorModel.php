<?php

namespace App\Models;

use App\Entities\Jugador;
use CodeIgniter\Model;
use ReflectionException;

class JugadorModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jugadores';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Jugador::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
		 'nombre',
		 'clave',
		 'admin',
		 'activado',
		 'regala',
		 'restablece',
		 'deleted_at'
	 ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
		 'nombre' => 'required|is_unique[jugadores.nombre]'
	 ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
	 
	 public function buscarPor($columna, $valor): Jugador|array|null
	 {
		 return $this->where($columna, $valor) ->first();
	 }
	 
	 public function recuperar($id) {
		 return $this->update($id, ['deleted_at' => null]);
	 }
	 
	 public function restablecerClave($id) {
		 return $this->update($id, [
			 'clave'			=> null,
			 'restablece'	=> false
		 ]);
	 }
	 
	 public function obtenerJugadoresActivados(): array
	 {
		 return $this->where('activado', true)
			 			 ->where('regala is null')
			 			 ->findAll();
	 }
	
	/**
	 * @throws ReflectionException
	 */
	public function actualizarJugadores(array $jugadores) {
		 $this->updateBatch($jugadores, 'id');
	 }
	 
	 public function countPorColumna(string $columna) {
		$model = 'regala' === $columna ? $this->where('regala IS NOT NULL') : $this->where($columna, true);
		return $model->countAllResults();
	 }
}
