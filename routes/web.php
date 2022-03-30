<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CapitanesController;
use App\Http\Controllers\EmbarcacionesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BitacorasController;
use App\Http\Controllers\LancesController;
use App\Http\Controllers\MetricasController;
use Illuminate\Http\Request;
use App\Http\Livewire\Metricas\Graficos;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/perfil', function () {
        return view('profile.show');
    })->name('perfil');


    Route::get('/about', function () {
        return view('home.about');
    });

    Route::resource('capitanes',CapitanesController::class);

    Route::resource('embarcaciones',EmbarcacionesController::class);

    Route::get('bitacoras',[BitacorasController::class,'index']);
    Route::get('pdf/parte_de_pesca/{id}',[BitacorasController::class,'PDF_PartePesca']);
    Route::get('pdf/general/{id}',[BitacorasController::class,'PDF_General']);
    Route::get('lances',[LancesController::class,'index']);
    Route::post('capchecked',function(Request $req){
        session_start();

        
        $_SESSION['capitanes'] = $req -> capitanes; 

        return response()->json(["msj" => "Capitan agregado con exito!!", "type" => $req -> capitanes],201);

    });
    Route::get('capchecked',function(Request $req){
        session_start();
        return response()->json($_SESSION['capitanes'],200);
    });

    Route::get('especies/{cant}',[BitacorasController::class,'getCantEspecies']);

    Route::get('metricas',Graficos::class);
 
});