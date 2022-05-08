<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnidadMedidaController;

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
    return view('welcome');
});

Auth::routes(["register" => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin','middleware' => ['auth']], function() {
    Route::resource('rol', RoleController::class);
    Route::resource('usuario', UserController::class);
});

Route::group(['prefix' => 'cotizador','middleware' => ['auth']], function() {
    Route::get('unidad-medida', [UnidadMedidaController::class, 'index'])->name('unidad-medida');
    Route::post('unidad-medida', [UnidadMedidaController::class, 'store'])->name('unidad-medida-guardar');
    Route::post('unidad-medida-eliminar', [UnidadMedidaController::class, 'destroy'])->name('unidad-medida-eliminar');
    Route::get('unidad-medida-editar', [UnidadMedidaController::class, 'edit'])->name('unidad-medida-editar');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/acercade',function(){
        return view('acceso.acerca');
     })->name('acercade');
     Route::get('/escritorio',function(){
        return view('escritorio.index');
    })->name('escritorio');
});
