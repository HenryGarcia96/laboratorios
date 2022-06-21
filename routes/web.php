<?php

use App\Http\Controllers\CajaController;
use App\Http\Controllers\IndexController;
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
 
// Route::get('books',['as'=>'books.index','uses'=>'BOOKController@index']);
 
// Route::post('books/create',['as'=>'books.store','uses'=>'BOOKController@store']);
 
// Route::get('books/edit/{id}',['as'=>'books.edit','uses'=>'BOOKController@edit']);
 
// Route::patch('books/{id}',['as'=>'books.update','uses'=>'BOOKController@update']);
 
// Route::delete('books/{id}',['as'=>'books.destroy','uses'=>'BOOKController@destroy']);
 
// Route::get('books/{id}',['as'=>'books.view','uses'=>'BOOKController@view']);



// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [IndexController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('caja', CajaController::class);
});

