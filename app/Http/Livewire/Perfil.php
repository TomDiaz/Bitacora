<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Perfil extends Component
{

    public $nombre, $apellido, $email;
    public $v_nombre, $v_apellido, $v_email;

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
       

        $usuario -> save();
        $this -> actualizar();
    }

}
