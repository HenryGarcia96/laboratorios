<?php

use App\Http\Controllers\CajaController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

// Página principal
Route::get('/', [IndexController::class, 'index']);
// Rutas del registro de usuario y del registro de laboratorio
Route::name('registro.')->prefix('registro')->group(function(){
    Route::get('/index', [RegisterController::class, 'index'])->name('index');
    Route::post('/store', [RegisterController::class, 'store'])->name('store');
    Route::get('/regSucursal', [RegisterController::class, 'regSucursal'])->name('regSucursal');
    Route::post('/regSucursal', [RegisterController::class, 'storeSucursal'])->name('regSucursal');
    
});

// Get de los estados y ciudades para el registro
Route::post('/getStates', [RegisterController::class, 'getStates'])->name('getStates');
Route::post('/getCity', [RegisterController::class, 'getCities'])->name('getCity');


// Todas las rutas (Dashboard) (Caja) donde los usuarios esten autenticados
Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified' ])
        ->group(function () {

    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    
    // Caja
    Route::resource('caja', CajaController::class);

    // Catalogos
    Route::name('catalogo.')->prefix('catalogo')->group(function(){
                
        // Catalogo - estudios.index
        Route::get('/estudios', [CatalogoController::class, 'catalogo_estudio_index'])->name('estudios');
        // Catalogo - estudios-store
        Route::post('/store-studio', [CatalogoController::class, 'catalogo_estudio_store'])->name('store-studio');
        
        // Catalogo - areas.index
        Route::get('/areas', [CatalogoController::class, 'catalogo_area_index'])->name('areas');
        // Catalogo - areas-store
        Route::post('/store-area', [CatalogoController::class, 'catalogo_area_store'])->name('store-area');

        // Catalogo - metodos.index
        Route::get('/metodos', [CatalogoController::class, 'catalogo_metodo_index'])->name('metodos');
        // Catalogo - metodos-store
        Route::post('/store-metodo', [CatalogoController::class, 'catalogo_metodo_store'])->name('store-metodo');

        // Catalogo - recipientes.index
        Route::get('/recipientes', [CatalogoController::class, 'catalogo_recipiente_index'])->name('recipientes');
        // Catalogo - recipientes-store
        Route::post('/store-recipiente', [CatalogoController::class, 'catalogo_recipiente_store'])->name('store-recipiente');
        
        // Catalogo - muestras.index
        Route::get('/muestras', [CatalogoController::class, 'catalogo_muestra_index'])->name('muestras');
        // Catalogo - muestras-store
        Route::post('/store-muestra', [CatalogoController::class, 'catalogo_muestra_store'])->name('store-muestra');
        
        // Catalogo - equipos.index
        Route::get('/equipos', [CatalogoController::class, 'catalogo_equipo_index'])->name('equipos');
        // Catalogo - equipos-store
        Route::post('/store-equipo', [CatalogoController::class, 'catalogo_equipo_store'])->name('store-equipo');
    });
});


