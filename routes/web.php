<?php

use App\Http\Controllers\CajaController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RecepcionsController;
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
// Catalogo -analito - settear analito
Route::post('/setAnalito', [CatalogoController::class, 'set_analito'])->name('setAnalito');


// Todas las rutas (Dashboard) (Caja) donde los usuarios esten autenticados
Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified' ])
        ->group(function () {

    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    
    // Caja
    Route::resource('recepcion', RecepcionsController::class);
    Route::get('for', [RecepcionsController::class, 'index']);
    Route::post('guardar', [RecepcionsController::class, 'guardar']); 
    
    // Caja
    Route::resource('caja', CajaController::class);

    // Catalogos
    Route::name('catalogo.')->prefix('catalogo')->group(function(){
                
        // Catalogo - estudios.index
        Route::get('/estudios', [CatalogoController::class, 'catalogo_estudio_index'])->name('estudios');
        // Catalogo - estudios-store
        Route::post('/store-studio', [CatalogoController::class, 'catalogo_estudio_store'])->name('store-studio');

        // Catalogo - analitos.index
        Route::get('/analitos', [CatalogoController::class, 'catalogo_analito_index'])->name('analitos');
        // Catalogo - analitos-store
        Route::post('/store-analito', [CatalogoController::class, 'catalogo_analito_store'])->name('store-analito');
        // Catalogo - store-referencias
        Route::post('/store-referencia', [CatalogoController::class, 'catalogo_referencia_store'])->name('store-referencia');
        // Catalogo -analitos - buscar estudio
        Route::get('/getEstudios', [CatalogoController::class, 'get_estudios'])->name('getEstudios');
        // Catalogo  -analito - buscar analito
        Route::get('/getAnalito', [CatalogoController::class, 'get_analitos'])->name('getAnalito');
        
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

        // Catalogo - tecnicas.index
        Route::get('/tecnicas', [CatalogoController::class, 'catalogo_tecnica_index'])->name('tecnicas');
        // Catalogo - tecnicas-store
        Route::post('/store-tecnica', [CatalogoController::class, 'catalogo_tecnica_store'])->name('store-tecnica');
        
        // Catalogo - equipos.index
        Route::get('/equipos', [CatalogoController::class, 'catalogo_equipo_index'])->name('equipos');
        // Catalogo - equipos-store
        Route::post('/store-equipo', [CatalogoController::class, 'catalogo_equipo_store'])->name('store-equipo');


        //Catalogo - doctores.index 
        Route::get('/doctores', [DoctoresController::class, 'doctores_index'])->name('doctores');
        //Catalogo - doctores.guardar
        Route::post('/doctores_guardar', [DoctoresController::class, 'doctores_guardar'])->name('doctores_guardar');
        //Catalogo - doctor.editar
        //Route::get('/doctor_editar/{id}', [DoctoresController::class, 'doctor_editar'])->name('doctor_editar');
        //Catalogo - doctor.elimiar
        Route::get('/doctor_eliminar/{id}', [DoctoresController::class, 'doctor_eliminar'])->name('doctor_eliminar');

        //Catalogo - pacientes.index
        Route::get('/pacientes',[PacienteController::class, 'paciente_index'])->name('pacientes');
    });
});



