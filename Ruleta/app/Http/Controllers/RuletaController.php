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
        $user_logeado = session('user_logeado')[0]; // Datos usuario logeado
        $laDatosView = array();
        $laPremio = DB::select("SELECT p.*, m.NOMBRE as MERCADO,(mp.CANTIDAD_MAX_SALIDAS - mp.CANTIDAD_ENTREGADO_DIARIO) as CANTIDAD_MAX_SALIDAS
                                , m.ID_CIUDAD, m.DIRECCION, mp.CANTIDAD_MAX_SALIDAS as TOTAL_MAX_ENTREGA, mp.CANTIDAD_ENTREGADO_DIARIO FROM MERCADO_PREMIO mp
                                INNER JOIN PREMIO p ON mp.ID_PREMIO = p.ID_PREMIO
                                INNER JOIN MERCADO m ON m.ID_MERCADO = mp.ID_MERCADO
                                WHERE mp.ID_MERCADO = $user_logeado->id_mercado AND p.ESTADO = 'H'");
        
        $laDatosView['premio'] = $laPremio;
        return view('ruleta/index', ['laDatosView' => $laDatosView]);
    }
}
