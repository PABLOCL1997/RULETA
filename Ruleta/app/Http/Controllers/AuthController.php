<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersRoles as UserRol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
USE DB;
// protected $table = 'usuario';
class AuthController extends Controller
{

    public function register(Request $request){
        // Validando datos 
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        // Encriptando contraseña
        $user->password = Hash::make($request->password);
        $user->save();
        $userId = $user->id;

        $userRol = new UserRol;
        $userRol->id = $userId;
        $userRol->id_rol = '1';
        $userRol->save();

        Auth::login($user);
        return redirect(route('admin'));
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember = ($request->has('remember') ? true : false);

        if (Auth::attempt($credentials, $remember)) {
            // El usuario ha iniciado sesión correctamente
            $request->session()->regenerate();
            $columnaData  = UserRol::pluck('id_rol');

            // Obtener datos del usuario autenticado
            $idUser = Auth::id();
            $dataUser = DB::select("SELECT u.id, u.name, u.email, u.nombres, u.apellidos, u.id_mercado, m.ID_CIUDAD as id_ciudad, u.id_rol 
                                    FROM USERS u JOIN MERCADO m ON u.ID_MERCADO = m.ID_MERCADO WHERE u.ID = $idUser");

            // Guardar los datos en la sesión
            Session::put('id_rol', $columnaData );
            Session::put('user_logeado', $dataUser);
            return redirect()->intended(route('admin'));
            // return back()->with('message', 'Bienvenido');
        } else {
            // Las credenciales no son válidas
            return back()->with('message', 'Email o contraseña incorrectos');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}