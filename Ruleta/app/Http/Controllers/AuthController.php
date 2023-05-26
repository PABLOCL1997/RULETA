<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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