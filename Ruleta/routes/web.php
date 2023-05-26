<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::view('/', 'auth/signin')->name('/')->middleware('guest');
Route::view('/signup', 'auth/signup')->name('signup')->middleware('guest');
Route::view('/signin', 'auth/signin')->name('signin')->middleware('guest');
Route::view('/admin', 'layouts/admin')->middleware('auth')->name('admin');
Route::view('/home', 'layouts/admin')->name('home')->middleware('auth');

// Auth
Route::post('/validar-registro', [AuthController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [AuthController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruleta
Route::get('ruleta','RuletaController@index');

// Usuario
Route::get('usuario','UsuarioController@Create');

// Cliente Premiado
Route::post('cliente_premiado/create', 'ClientePremiadoController@create')->name('cliente_premiado.create');
Route::resource('cliente_premiado', 'ClientePremiadoController',['as' => 'cliente_premiado']);
//Route::post('cliente_premiado/create/{id}', 'ClientePremiadoController@create')->name('cliente_premiado.create');
//Route::match(['get', 'post'], 'cliente_premiado/create', 'ClientePremiadoController@create')->name('cliente_premiado.create');
//Route::resource('cliente_premiado', 'ClientePremiadoController');
