<?php

use App\Http\Controllers\CajaController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\EmpresasController;
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


// Todas las rutas (Dashboard) (Caja) (Recepción) (Catalogos) 
// Donde los usuarios esten autenticados
Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified' ])->group(function () {

    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    
    // Recepcion
    Route::name('recepcion.')->prefix('recepcion')->group(function(){
        // Recepcion - nuevo
        Route::get('/index', [RecepcionsController::class, 'index'])->name('index');
        Route::post('/guardar', [RecepcionsController::class, 'guardar']); 

        // Recepcion -  captura de resultados
        Route::get('/captura', [RecepcionsController::class, 'recepcion_captura_index'])->name('captura');
        
    });
    
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
        // Catalogo - verifica clave
        Route::post('/verifyKey', [CatalogoController::class, 'catalogo_verify_key'])->name('verifyKey');
        // Catalogo - agrega imagen
        Route::post('/store-imagen-analito', [CatalogoController::class, 'catalogo_store_imagen_referencia'])->name('store-imagen-analito');
        // Catalogo - store-referencias
        Route::post('/store-referencia', [CatalogoController::class, 'catalogo_referencia_store'])->name('store-referencia');
        // Eliminar referencia
        Route::post('/eliminaReferencia', [CatalogoController::class, 'catalogo_referencia_delete'])->name('eliminaReferencia');
        // Catalogo - analitos - buscar estudio
        Route::get('/getEstudios', [CatalogoController::class, 'get_estudios'])->name('getEstudios');
        // Checa analitos y los asigna 
        Route::post('/checkAnalitos', [CatalogoController::class, 'get_check_analitos'])->name('checkAnalitos');
        // Catalogo  - analito - buscar analito
        Route::get('/getAnalito', [CatalogoController::class, 'get_analitos'])->name('getAnalito');
        // Catalogo - elimina analito que viene con estudio
        Route::post('/eliminaAnalito', [CatalogoController::class, 'delete_analito_estudio'])->name('eliminaAnalito');
        // Catalogo - asignar analitos a estudios
        Route::post('/asignAnalitos', [CatalogoController::class, 'asign_estudio_analitos'])->name('asignAnalitos');
        
        // Catalogo - areas.index - Demás areas
        Route::get('/areas', [CatalogoController::class, 'catalogo_area_index'])->name('areas');
        // Catalogo - areas-store
        Route::post('/store-area', [CatalogoController::class, 'catalogo_area_store'])->name('store-area');
        // Catalogo - metodos-store
        Route::post('/store-metodo', [CatalogoController::class, 'catalogo_metodo_store'])->name('store-metodo');
        // Catalogo - recipientes-store
        Route::post('/store-recipiente', [CatalogoController::class, 'catalogo_recipiente_store'])->name('store-recipiente');
        // Catalogo - muestras-store
        Route::post('/store-muestra', [CatalogoController::class, 'catalogo_muestra_store'])->name('store-muestra');
       // Catalogo - tecnicas-store
        Route::post('/store-tecnica', [CatalogoController::class, 'catalogo_tecnica_store'])->name('store-tecnica');
        
        // Catalogo - precios.index
        Route::get('/precios', [CatalogoController::class, 'catalogo_precio_index'])->name('precios');
        // Catalogo  - precios-store -Guardar lista
        Route::post('/store-list', [CatalogoController::class, 'catalogo_store_list'])->name('store-list');
        // Catalogo - estudios_has_precios
        Route::post('/store-precio-estudios', [CatalogoController::class, 'catalogo_precios_estudios'])->name('store-precio-estudios');
        // Catalogo - rellenar tabla
        Route::post('/get-estudios-asignados', [CatalogoController::class, 'catalogo_tabla_precios_estudios'])->name('get-estudios-asignados');
        // Settear seleccion para agregar
        Route::post('/set-estudios-for-precios', [CatalogoController::class, 'catalogo_set_position'])->name('set-estudios-for-precios');
        //Catalogo - doctores.index 
        Route::get('/doctores', [DoctoresController::class, 'doctores_index'])->name('doctores');
        //Catalogo - doctores.guardar
        Route::post('/doctores_guardar', [DoctoresController::class, 'doctores_guardar'])->name('doctores_guardar');
        //Catalogo - doctor.editar
        Route::post('/getDoctor', [DoctoresController::class, 'get_doctor_edit'])->name('getDoctor');
        //Catalogo - doctor.actualizar
        Route::post('/doctor_actualizar', [DoctoresController::class, 'doctor_actualizar'])->name('doctor_actualizar');
        //Catalogo - doctor.elimiar
        Route::get('/doctor_eliminar/{id}', [DoctoresController::class, 'doctor_eliminar'])->name('doctor_eliminar');

        //Catalogo - pacientes.index
        Route::get('/pacientes',[PacienteController::class, 'paciente_index'])->name('pacientes');

        //Catalogo - pacientes.guardar
        Route::post('/paciente_guardar', [PacienteController::class, 'paciente_guardar'])->name('paciente_guardar');
        //Catalogo - pacientes.eliminar
        Route::get('/paciente_eliminar/{id}', [PacienteController::class, 'paciente_eliminar'])->name('paciente_eliminar');
        //Catalogo - pacientes.editar
        Route::post('/getPaciente', [PacienteController::class, 'get_paciente_edit'])->name('getPaciente');
        //Catalogo - paciente.actualizar
        Route::post('/paciente_actualizar', [PacienteController::class, 'paciente_actualizar'])->name('paciente_actualizar');

        //Catalogo - empresas.index
        Route::get('/empresas',[EmpresasController::class, 'empresa_index'])->name('empresas');
        //Catalogo - empresas.guardar
        Route::post('/empresa_guardar', [EmpresasController::class, 'empresa_guardar'])->name('empresa_guardar');
        //Catalogo - empresa.eliminar
        Route::get('/empresa_eliminar/{id}', [EmpresasController::class, 'empresa_eliminar'])->name('empresa_eliminar');

        //Catalogo - empresa.editar
        Route::post('/getEmpresa', [EmpresasController::class, 'get_empresa_edit'])->name('getEmpresa');
        //Catalogo - empresa.actualizar
        Route::post('/empresa_actualizar', [EmpresasController::class, 'empresa_actualizar'])->name('empresa_actualizar');        


    });

});