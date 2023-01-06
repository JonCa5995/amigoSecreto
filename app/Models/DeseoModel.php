<?php

namespace App\Models;

use App\Entities\Deseo;
use CodeIgniter\Model;

class DeseoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'deseos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Deseo::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
		 'descripcion',
		 'id_jugador'
	 ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
		 'descripcion' => 'required|min_length[3]|max_length[255]',
		 'id_jugador'	=> 'required|is_not_unique[jugadores.id]'
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
	 
	 public function obtenerDeseos($idJugador): array
	 {
		 return $this->where('id_jugador', $idJugador)->orderBy('updated_at', 'desc')->findAll();
	 }
	 
}
