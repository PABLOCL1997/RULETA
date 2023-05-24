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
        $laPremio = DB::select('SELECT p.*, m.NOMBRE as MERCADO, m.CIUDAD, m.DIRECCION, mp.CANTIDAD_MAX_SALIDAS, mp.CANTIDAD_ENTREGADO_DIARIO FROM MERCADO_PREMIO mp
                                INNER JOIN PREMIO p ON mp.ID_PREMIO = p.ID_PREMIO
                                INNER JOIN MERCADO m ON m.ID_MERCADO = mp.ID_MERCADO
                                WHERE mp.ID_MERCADO = 1 AND p.ESTADO = "H"');
        
        $laDatosView['premio'] = $laPremio;
        return view('ruleta/index', ['laDatosView' => $laDatosView]);
    }
}
