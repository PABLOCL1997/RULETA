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

class UsuarioController extends Controller
{

    public function index()
    {
        $DatosView = array();
        $query = FacadesDB::select('SELECT * FROM users');

        $DatosView['usuarios'] = $query;

        
        // $datosSesion = Session::all();
        // Imprimir los datos de la sesión
        // dump($datosSesion);

        return view('usuario/index', ['DatosView' => $DatosView]);
    }

    public function Create()
    {
        return view('usuario/crear');
    }
}
