<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientePremiado;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Models\mPaqueteMyApps;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function index()
    {
        $DatosView = array();
        $query = FacadesDB::select('SELECT *, roles.nombre AS nombre_rol, users.estado AS estado_usuario FROM users INNER JOIN users_roles ON users.id = users_roles.id INNER JOIN roles ON users_roles.id_rol = roles.id_rol LEFT JOIN MERCADO ON users.id_mercado = MERCADO.ID_MERCADO');
        $queryRol = FacadesDB::select('SELECT * FROM roles WHERE estado = ?', ['A']);
        $queryMercado = FacadesDB::select('SELECT * FROM mercado WHERE estado = ?', ['H']);

        $DatosView['usuarios'] = $query;
        $DatosView['roles'] = $queryRol;
        $DatosView['mercado'] = $queryMercado;
       
        $datosSesion = Session::all();
        // Imprimir los datos de la sesión
        dump($datosSesion);

        return view('usuario/index', ['DatosView' => $DatosView]);
    }

    public function Create()
    {
        return view('usuario/crear');
    }

    public function usuarioNuevo(Request $request)
    {
        // recibiendo datos del formulario
        $roles = $request->input('roles');
        $name = $request->input('name');
        $nombres = $request->input('nombres');
        $apellidos = $request->input('apellidos');
        $email = $request->input('email');
        $mercado = $request->input('mercado');
        $estado = 'activo';
        $userPassword = $name.'-sofia*2023';

        $password = Hash::make($userPassword);

        // consulta user
        $queryUser = FacadesDB::select('SELECT * FROM users WHERE email = ?', [$email]);
        if ($queryUser) {
            return response()->json([
                'message' => '<div class="alert alert-outline-warning d-flex align-items-center" role="alert"><span class="fas fa-info-circle text-warning fs-3 me-3"></span><p class="mb-0 flex-1">El email de usuario ya se encuentra en uso!</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div>',
                'status' => 'error'
            ]);
        }
        
        // insertando datos en la base de datos
        $query = FacadesDB::insert('INSERT INTO users (name, email, password, nombres, apellidos, estado, id_mercado, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$name, $email, $password, $nombres, $apellidos, $estado, $mercado, Carbon::now(), Carbon::now()]);
        // recuperar el id del usuario insertado
        $idUsuario = FacadesDB::getPdo()->lastInsertId();
        $queryRol = FacadesDB::insert('INSERT INTO users_roles (id, id_rol) VALUES (?, ?)', [$idUsuario, $roles]);
        
        return response()->json(['message' => '<div class="alert alert-outline-success d-flex align-items-center" role="alert"><span class="fas fa-check-circle text-success fs-3 me-3"></span><p class="mb-0 flex-1">Registro exitoso...</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div>',
        'status' => 'success']);
    }
}
