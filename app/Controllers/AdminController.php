<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Jugador;
use App\Models\JugadorModel;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

class AdminController extends BaseController
{
	private JugadorModel $jugadorModel;
	
	public function __construct() {
		$this->jugadorModel = new JugadorModel();
	}
	
    public function index(): string
    {
			$admin = $this->jugadorModel->find(session()->id);
			$jugadores = $this->jugadorModel->paginate();
			return view('admin/jugadores', [
				'nombre' => $admin->nombre,
				'jugadores' => $jugadores,
				'pager' => $this->jugadorModel->pager
			]);
			}
	 
	 public function eliminados(): string
     {
			$admin = $this->jugadorModel->find(session()->id);
			$jugadores = $this->jugadorModel->onlyDeleted()->paginate();
			return view('admin/eliminados', [
				'nombre' => $admin->nombre,
				'jugadores' => $jugadores,
				'pager' => $this->jugadorModel->pager
			]);
	 }
	 
	 public function eliminar($id): RedirectResponse
     {
         $err = [];
         $msg = [];
         if ($this->jugadorModel->delete($id)) {
             $msg[] = 'El jugador ha sido eliminado';
         } else {
             $err[] = 'No se ha podido eliminar el jugador';
         }
         return redirect()->back()->with('errores', $err)->with('msg', $msg);
	 }
	 
	 public function recuperar($id): RedirectResponse
     {
         $err = [];
         $msg = [];
         if ($this->jugadorModel->recuperar($id)) {
             $msg[] = 'Se ha recuperado al jugador';
         } else {
             $err[] = 'No se ha podido recuperar al jugador';
         }
         return redirect()->back()->with('errores', $err)->with('msg', $msg);
	 }
	
	public function restablecerClave($id): RedirectResponse
    {
        $err = [];
        $msg = [];
        if ($this->jugadorModel->restablecerClave($id)) {
            $msg[] = 'Se ha restablecido la clave del jugador';
        } else {
            $err[] = 'No se ha podido restablecer la clave';
        }
        return redirect()->back()->with('errores', $err)->with('msg', $msg);
	}
	
	public function guardarJugador(): RedirectResponse
    {
		if (!$this->request->getMethod() == 'post') return redirect()->back();
		
		$reglas = [
			'nombre' => 'required|min_length[3]|max_length[32]'
		];
		if (!$this->validate($reglas)) {
			redirect()->back()->with('errores', $this->validator->getErrors());
		}
		$jugador = new Jugador($this->request->getPost());

        $err = [];
		$msg = [];
		try {
			if ($this->jugadorModel->buscarPor('nombre', $jugador->nombreEncriptado)) {
				$err[] = 'Ya existe un jugador con ese nombre, por favor, pruebe con otro nombre';
			} else {
				$this->jugadorModel->save($jugador);
                $msg[] = 'Jugador agregado correctamente';
			}
		} catch (ReflectionException $e) {
			$err[] = 'No se ha podido registrar el jugador';
		} finally {
			return redirect('adminInicio')->with('errores', $err)->with('msg', $msg);
		}
	}
	
	public function repartir(): RedirectResponse
    {
		$ciclos = $this->request->getVar('ciclos');
		$jugadores = $this->jugadorModel->obtenerJugadoresActivados();
		$jugadoresAsignados = [];
		$primerJugador = null;
		$jugador = null;
		$index = -1;
		$msg = [];
		$err = [];
		
		if (count($jugadores) < 2) {
			$msg[] = 'Tienen que estar activado al menos 2 jugadores';
		} else {
			if (!$ciclos) {
				$index = array_rand($jugadores);
				$jugador = $primerJugador = $jugadores[$index];
				
				while (count($jugadores)) {
					$jugadoresAsignados[] = $jugador;
					unset($jugadores[$index]);
					if (count($jugadores)) {
						$index = array_rand($jugadores);
						$jugador->regala = $jugadores[$index]->id;
						$jugador = $jugadores[$index];
					} else {
						$jugador->regala = $primerJugador->id;
					}
	
				}
			} else {
				while (count($jugadores)) {
					if ($primerJugador == null) {
						$index = array_rand($jugadores);
						$jugador = $primerJugador = $jugadores[$index];
					}
					if ($jugador != $primerJugador) {
						$jugadoresAsignados[] = $jugador;
						unset($jugadores[$index]);
					}
					
					if (count($jugadores) > 2) {
						$index = array_rand($jugadores);
						if ($jugador != $jugadores[$index]) {
							$jugador->regala = $jugadores[$index]->id;
							$jugador = $jugadores[$index];
							if ($primerJugador == $jugadores[$index]) {
								$jugadoresAsignados[] = $primerJugador;
								$primerJugador = null;
								unset($jugadores[$index]);
							}
						}
					} else {
						$primero = $jugadores[array_key_first($jugadores)];
						$ultimo = $jugadores[array_key_last($jugadores)];
						if ($primero == $primerJugador) {
							$jugador->regala = $ultimo->id;
							$ultimo->regala = $primerJugador->id;
						} else {
							$jugador->regala = $primero->id;
							$primero->regala = $primerJugador->id;
						}
						$jugadoresAsignados[] = $primero;
						$jugadoresAsignados[] = $ultimo;
						
						unset($jugadores[array_key_first($jugadores)]);
						unset($jugadores[array_key_last($jugadores)]);
					}
				}
			}
			
			try {
				$this->jugadorModel->actualizarJugadores($jugadoresAsignados);
				$msg[] = 'Cambios guardados correctamente';
				$msg[] = 'Se han repartido ' . count($jugadoresAsignados) . ' jugadores';
			} catch (ReflectionException $e) {
				$err[] = 'No se han podido guardar los cambios';
			}
		}

		return redirect('adminInicio')->with('msg', $msg)->with('errores', $err);
	}
}
