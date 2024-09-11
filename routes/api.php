<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecursosController;
use App\Http\Controllers\Api\BitacorasController;
use App\Http\Controllers\BitacorasController as Bitacora;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\CapitanesController;
use App\Http\Controllers\EmbarcacionesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    
   

});

Route::post('login',[LoginController::class,'login']);
Route::get('recursos',[RecursosController::class,'index']);
Route::get('mayu',[RecursosController::class,'mayu']);
Route::post('especies',[RecursosController::class,'importEspecies']);
Route::post('bitacora',[BitacorasController::class,'store']);
Route::post('bitacora/exportar',[BitacorasController::class,'exportar']);
Route::get('historial/{id}',[BitacorasController::class,'historial']);

Route::get('pdf/parte_de_pesca/{id}',[Bitacora::class,'PDF_PartePesca']);
Route::get('pdf/general/{id}',[Bitacora::class,'PDF_General']);

Route::post('embarcacion',[EmbarcacionesController::class, 'store_api']);
Route::post('capitanes', [ CapitanesController::class, 'store_api' ]);

Route::get('sendemail/{id}',[BitacorasController::class,'apiEmailCapitan']);
