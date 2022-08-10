<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Perfil extends Component
{

    public $nombre, $apellido, $email, $empresa;
    public $v_nombre, $v_apellido, $v_email, $v_empresa;

    public function __construct() {

   
    }

    public function render()
    {

        $this -> actualizar();

        return view('livewire.perfil');
    }

    public function actualizar(){
        
        $this -> v_nombre = auth()->user() -> name;
        $this -> v_apellido = auth()->user() -> last_name;
        $this -> v_email = auth()->user() -> email;
        $this -> v_empresa = auth()->user() -> empresa ? auth()->user() -> empresa : 'Sin empresa asignada';
    }

    public function modificar(){

        $usuario = User::find(auth()->user() -> id);

        if($this -> nombre){
            $usuario -> name =  $this -> nombre;
        }

        if($this -> apellido){
            
            $usuario -> last_name =  $this -> apellido;
        }

        if($this -> email){
            
            $usuario -> email =  $this -> email;
        }

        
        if($this -> empresa){
            
            $usuario -> empresa =  $this -> empresa;
        }
       

        $usuario -> save();
        $this -> actualizar();
    }

}
