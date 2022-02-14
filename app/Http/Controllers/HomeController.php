<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Embarcacion;
use App\Models\Capitan;

class HomeController extends Controller
{
   public function index(){

       $capitanes = Capitan::where('id_armador', auth()->user() -> id)->count();
       $embarcaciones = Embarcacion::where('IdArmador', auth()->user() -> id)->count();


       return view('home.index', compact('capitanes' , 'embarcaciones'));
   }
}
