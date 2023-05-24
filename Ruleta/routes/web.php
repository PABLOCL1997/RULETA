<?php

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

Route::get('/', function () {
    return view('layouts.admin');
});

// Ruleta
Route::get('ruleta','RuletaController@index');

// Usuario
Route::get('usuario','UsuarioController@Create');

// Cliente Premiado
//Route::get('cliente_premiado','ClientePremiadoController@index');
//Route::get('crear','ClientePremiadoController@Create');
Route::resource('cliente_premiado', 'ClientePremiadoController',['as' => 'cliente_premiado']);
