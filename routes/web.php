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
use App\Http\Livewire\Metricas\Excel;
use App\Http\Livewire\Perfil;
use App\Models\Capitan;
use App\Http\Controllers\ResetPasswordController;
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

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


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
    Route::get('bitacoras/delete/{id}',[BitacorasController::class,'destroy']);
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
        $capitanes = array();

        foreach($_SESSION['capitanes'] as $capitan){
            $capitanes[] = Capitan::find($capitan);
        }

        return response()->json([ 'id' => $_SESSION['capitanes'], 'capitanes' => $capitanes],200);
    });

    Route::get('capitan/{cuil}', [CapitanesController::class, 'filterCapitan']);

    Route::get('especies/{cant}',[BitacorasController::class,'getCantEspecies']);

    Route::get('metricas',Excel::class);
    Route::get('profile/username',Perfil::class);
    Route::post('storeKey/{id}', [CapitanesController::class,'storeKey']);

});


Route::get('solicitud/{token}', [CapitanesController::class,'solicitud']);