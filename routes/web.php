<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CapitanesController;
use App\Http\Controllers\EmbarcacionesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BitacorasController;
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

    Route::resource('capitanes',CapitanesController::class);

    Route::resource('embarcaciones',EmbarcacionesController::class);

    Route::get('bitacoras',[BitacorasController::class,'index']);


});