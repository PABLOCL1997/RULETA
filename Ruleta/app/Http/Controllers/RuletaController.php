<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class RuletaController extends Controller
{
    public function __construct()
    {

    }
    public function Index()
    {
        $laDatosView = array();
        $laPremio = DB::select('SELECT * FROM PREMIO p WHERE p.ESTADO = "H"');
        
        $laDatosView['premio'] = $laPremio;
        return view('ruleta/index', ['laDatosView' => $laDatosView]);
    }
}
