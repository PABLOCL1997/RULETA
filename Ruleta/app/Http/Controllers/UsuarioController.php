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
        $sesionRol = Session::get('id_rol');
        if ($sesionRol != 1) {
            return redirect()->route('ruleta');
        }
        $DatosView = array();
        $query = FacadesDB::select('SELECT *, roles.nombre AS nombre_rol, users.estado AS estado_usuario FROM users INNER JOIN users_roles ON users.id = users_roles.id INNER JOIN roles ON users_roles.id_rol = roles.id_rol LEFT JOIN MERCADO ON users.id_mercado = MERCADO.ID_MERCADO');
        $queryRol = FacadesDB::select('SELECT * FROM roles WHERE estado = ?', ['A']);
        $queryMercado = FacadesDB::select('SELECT * FROM mercado WHERE estado = ?', ['H']);

        $DatosView['usuarios'] = $query;
        $DatosView['roles'] = $queryRol;
        $DatosView['mercado'] = $queryMercado;

        return view('usuario/index', ['DatosView' => $DatosView]);
    }

    public function crearUsuario()
    {
        $sesionRol = Session::get('id_rol');
        if ($sesionRol != 1) {
            return redirect()->route('ruleta');
        }
        $DatosView = array();
        $query = FacadesDB::select('SELECT *, roles.nombre AS nombre_rol, users.estado AS estado_usuario FROM users INNER JOIN users_roles ON users.id = users_roles.id INNER JOIN roles ON users_roles.id_rol = roles.id_rol LEFT JOIN MERCADO ON users.id_mercado = MERCADO.ID_MERCADO');
        $queryRol = FacadesDB::select('SELECT * FROM roles WHERE estado = ?', ['A']);
        $queryMercado = FacadesDB::select('SELECT * FROM mercado WHERE estado = ?', ['H']);

        $DatosView['usuarios'] = $query;
        $DatosView['roles'] = $queryRol;
        $DatosView['mercado'] = $queryMercado;

        return view('usuario/crear', ['DatosView' => $DatosView]);
    }
    
    public function editarUsuario(Request $request, $id)
    {
        
        $sesionRol = Session::get('id_rol');
        if ($sesionRol != 1) {
            return redirect()->route('ruleta');
        }

        $queryRol = FacadesDB::select('SELECT * FROM roles WHERE estado = ?', ['A']);
        $queryMercado = FacadesDB::select('SELECT * FROM mercado WHERE estado = ?', ['H']);

        $DatosView['roles'] = $queryRol;
        $DatosView['mercado'] = $queryMercado;
        
        $usuario = DB::selectOne('SELECT *, roles.nombre AS nombre_rol, users.estado AS estado_usuario FROM users INNER JOIN users_roles ON users.id = users_roles.id INNER JOIN roles ON users_roles.id_rol = roles.id_rol LEFT JOIN MERCADO ON users.id_mercado = MERCADO.ID_MERCADO WHERE users.id = ?', [$id]);

        return view('usuario/editar', ['DatosView' => $DatosView, 'usuario' => $usuario]);
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

    public function usuarioEditar(Request $request)
    {
        // Recibiendo datos del formulario
        $id = $request->input('id');
        $roles = $request->input('roles');
        $name = $request->input('name');
        $nombres = $request->input('nombres');
        $apellidos = $request->input('apellidos');
        $email = $request->input('email');
        $mercado = $request->input('mercado');
        $estado = 'activo';
        $userPassword = $request->input('password');

        $password = Hash::make($userPassword);

        // Consulta user
        $queryUser = DB::select('SELECT * FROM users WHERE email = ? AND id != ?', [$email, $id]);
        if ($queryUser) {
            return response()->json([
                'message' => '<div class="alert alert-outline-warning d-flex align-items-center" role="alert"><span class="fas fa-info-circle text-warning fs-3 me-3"></span><p class="mb-0 flex-1">El email de usuario ya se encuentra en uso!</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div>',
                'status' => 'error'
            ]);
        }
        
        // Actualizando datos en la base de datos
        $query = DB::update('UPDATE users SET name = ?, email = ?, password = ?, nombres = ?, apellidos = ?, estado = ?, id_mercado = ?, updated_at = ? WHERE id = ?', [$name, $email, $password, $nombres, $apellidos, $estado, $mercado, Carbon::now(), $id]);
        
        // Actualizando el rol del usuario
        $queryRol = DB::update('UPDATE users_roles SET id_rol = ? WHERE id = ?', [$roles, $id]);
        
        return response()->json([
            'message' => '<div class="alert alert-outline-success d-flex align-items-center" role="alert"><span class="fas fa-check-circle text-success fs-3 me-3"></span><p class="mb-0 flex-1">Actualización exitosa...</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div>',
            'status' => 'success'
        ]);
    }

}
