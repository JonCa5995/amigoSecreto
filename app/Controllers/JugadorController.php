<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Jugador;
use App\Models\JugadorModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\View\View;
use Config\Services;

class JugadorController extends BaseController
{
	private JugadorModel $jugadorModel;
	
	public function __construct() {
		$this->jugadorModel = new JugadorModel();
	}
	
    public function index(): string|RedirectResponse
    {
		 if (session()->dentro) {
			 return redirect('jugadorJuego');
		 }
		 
		 return view('jugador/inicio');
    }
	 
	 public function inicio($nombre = null): string|RedirectResponse
     {
		 helper('text');
		if ($nombre != null) {
			$nombre = str_replace(' ', '+', $nombre);
			$jugador = $this->jugadorModel->where('nombre', $nombre)->first();
			if ($jugador) {
				if ($jugador->isRegistrado()) {
					$view = 'jugador/inicio';
				} else {
					$view = 'jugador/registro';
				}
				return view($view, [
					'nombre' => $jugador->nombre,
					'claveNombre' => $nombre
				]);
			}
		}
		return redirect('inicio');
	 }
	 
	 public function registro() {
		if (!$this->request->getMethod() == 'post') return redirect()->back();
		
		$reglas = [
			'clave' => 'required|min_length[3]|max_length[32]|matches[clave2]'
		];
		if (!$this->validate($reglas)) {
			return redirect()->back()->with('errores', $this->validator->getErrors());
		}
		
		if (!$jugador = $this->jugadorModel->buscarPor('nombre', $this->request->getVar('nombre'))) {
			return redirect('inicio')->with('errores', ['El jugador indicado no existe en el sistema']);
		}
		$jugador->clave = $this->request->getVar('clave');

        $err = [];
        $msg = [];
		$ruta = 'inicio';
		 try {
			 if ($this->jugadorModel->save($jugador)) {
				 session()->set([
					 'id' => $jugador->id,
					 'dentro' => true,
					 'admin' => $jugador->admin
				 ]);
				 $ruta = 'jugadorJuego';
                 $msg[] = 'Su alta se ha realizado con éxito';
			 } else {
				 $err = ['No se ha podido registrar el jugador'];
			 }
		 } catch (\ReflectionException $e) {
             $err = ['No se ha podido registrar el jugador'];
		 } finally {
			 return redirect($ruta)->with('errores', $err)
                    ->with('msg', $msg);
		 }
	 }
	 
	 public function entrar() {
		 if (!$this->request->getMethod() == 'post') return redirect()->back();
		 
		$reglas = [
			'nombre' => 'required|min_length[3]|max_length[32]',
			'clave' => 'required'
		];
		if (!$this->validate($reglas)) {
			redirect()->back()->with('errores', $this->validator->getErrors());
		}

		$jugador = new Jugador($this->request->getPost());
		if (!$jugador = $this->jugadorModel->buscarPor('nombre', $jugador->nombreEncriptado)) {
			return redirect('inicio')->with('errores', ['No se ha encontrado el jugador en el sistema'])
                ->with('errUsu', true);
		}
		 if (!$jugador->autenticar($this->request->getVar('clave'))) {
			 return redirect('inicio')->back()->with('errores', ['Contraseña incorrecta'])
                 ->with('errClave', true);
		 }
		 
		 session()->set([
			 'id' => $jugador->id,
			 'dentro' => true,
			 'admin' => $jugador->admin
		 ]);
		 
		 return redirect('jugadorJuego')->with('msg', ['Bienvenido de nuevo']);
	 }
	 
	 public function salir() {
		session()->destroy();
		return redirect('inicio');
	 }
	 
	 public function juego(): string
	 {
		$jugador = $this->jugadorModel->find(session()->id);
		return view('jugador/juego', [
			'nombre' => $jugador->nombre,
			'activado' => $jugador->activado,
			'regala' => $jugador->regala
		]);
	 }
	 
	 public function activar(): RedirectResponse
     {
		$jugador = $this->jugadorModel->find($this->request->getVar('id'));
		$jugador->activado = !$jugador->activado;

        $err = [];
        $msg = [];
         try {
             $this->jugadorModel->save($jugador);
             $msg[] = 'Se ha activado el jugador con éxito';
         } catch (\ReflectionException $e) {
             $err[] = 'No se ha podido activar el jugador, pruebe más tarde';
         }
         return redirect('jugadorJuego')->with('errores', $err)
                ->with('msg', $msg);
	 }
	 
	 public function resetClave() {
		 if (!$this->request->getMethod() == 'post') return redirect()->back();
		
		 $reglas = [
			 'nombre' => 'required|min_length[3]|max_length[32]|matches[nombre2]'
		 ];
		 if (!$this->validate($reglas)) {
			 return redirect()->back()->with('errores', $this->validator->getErrors());
		 }
		 $jugador = new Jugador($this->request->getPost());
		
		 $msg = ['Si el nombre está registrado en nuestra base de datos, se le avisará al administrador para que restablezca su clave'];
		 $err = [];
         try {
			 if ($jugador = $this->jugadorModel->buscarPor('nombre', $jugador->nombreEncriptado)) {
				 $jugador->restablece = true;
				 $this->jugadorModel->save($jugador);
			 }
		 } catch (\ReflectionException $e) {
			 $err = ['No se ha podido registrar el jugador'];
		 } finally {
			 return redirect('inicio')->with('errores', $err)->with('msg', $msg);
		 }
	 }
}
