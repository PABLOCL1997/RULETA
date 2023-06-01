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

Route::fallback(function () {
    return redirect('/'); // Cambia '/error' por la ruta a la que deseas redireccionar
});


Route::middleware('guest')->group(function () {
    Route::view('/', 'auth/signin')->name('/');
    Route::view('/signup', 'auth/signup')->name('signup');
    Route::view('/signin', 'auth/signin')->name('signin');
    Route::view('/login', 'auth/signin')->name('login');
    // Auth
    Route::post('/inicia-sesion', [AuthController::class, 'login'])->name('inicia-sesion');
    Route::post('/validar-registro', [AuthController::class, 'register'])->name('validar-registro');
});

Route::middleware('auth')->group(function () {
    Route::view('/admin', 'layouts/admin')->name('admin');
    Route::view('/home', 'layouts/admin')->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/submit-form', [UsuarioController::class, 'usuarioNuevo'])->name('submit-form');
    Route::post('/submit-form-update', [UsuarioController::class, 'usuarioEditar'])->name('submit-form-update');
    
    // Ruleta
    Route::get('ruleta','RuletaController@index');
    Route::get('ruletaDatos','RuletaController@RuletaDatos');
    Route::post('ruleta/ninguno/{tnId}/{tnSumar}', 'RuletaController@HabiltarNinguno')->name('ruleta.ninguno');
    
    // Usuario
    Route::get('usuario','UsuarioController@index');
    Route::get('crear-usuario','UsuarioController@crearUsuario');
    // Route::get('editar-usuario','UsuarioController@editarUsuario');
    Route::get('/usuario/{id}/editar', 'UsuarioController@editarUsuario')->name('usuario.editar');

    
    // Cliente Premiado
    Route::post('cliente_premiado/create', 'ClientePremiadoController@create')->name('cliente_premiado.create');
    Route::resource('cliente_premiado', 'ClientePremiadoController',['as' => 'cliente_premiado']);
    Route::post('cliente_premiado/anular/{tnId}', 'ClientePremiadoController@Anular')->name('cliente_premiado.Anular');

    // Mercado Premio
    Route::get('mercado_premio/insert', 'MercadoPremioController@Insert');
    Route::get('mercado_premio/id', 'MercadoPremioController@Mercado');
    Route::resource('mercado_premio', 'MercadoPremioController',['as' => 'mercado_premio']);
    
});
