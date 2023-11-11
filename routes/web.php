<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\EstablecimientoController;
use App\Http\Controllers\InicioController;

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

Route::get('/', InicioController::class)->name('inicio');

//* se agrega para se solicite la verificación del email del usuario
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('/establecimiento/create', [EstablecimientoController::class, 'create'])->name('establecimiento.create')->middleware('revisar');
    Route::post('/establecimiento', [EstablecimientoController::class, 'store'])->name('establecimiento.store');
    Route::get('/establecimiento/edit', [EstablecimientoController::class, 'edit'])->name('establecimiento.edit');
    Route::put('/establecimiento/{establecimiento}', [EstablecimientoController::class, 'update'])->name('establecimiento.update');

    //rutas para el archivo de frontend dropzone.js
    Route::post('/imagenes/store', [ImagenController::class, 'store'])->name('imagenes.store');
    Route::post('/imagenes/destroy', [ImagenController::class, 'destroy'])->name('imagenes.destroy');
   
    

    Route::get('/lectorQR', [EstablecimientoController::class, 'show'])->name('lectorQR.show');
});


