<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
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


Route::middleware('guest')->group(function () {
    Route::view('/', 'auth/signin')->name('/');
    Route::view('/signup', 'auth/signup')->name('signup');
    Route::view('/signin', 'auth/signin')->name('signin');
});

Route::middleware('auth')->group(function () {
    Route::view('/admin', 'layouts/admin')->name('admin');
    Route::view('/home', 'layouts/admin')->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Auth
Route::post('/validar-registro', [AuthController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [AuthController::class, 'login'])->name('inicia-sesion');
Route::post('/submit-form', [UsuarioController::class, 'usuarioNuevo'])->name('submit-form');


// Ruleta
Route::get('ruleta','RuletaController@index');

// Usuario
Route::get('usuario','UsuarioController@index');

// Cliente Premiado
Route::post('cliente_premiado/create', 'ClientePremiadoController@create')->name('cliente_premiado.create');
Route::resource('cliente_premiado', 'ClientePremiadoController',['as' => 'cliente_premiado']);
Route::post('cliente_premiado/anular/{tnId}', 'ClientePremiadoController@Anular')->name('cliente_premiado.Anular');
