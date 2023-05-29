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
        $laPremio = DB::select("SELECT p.*, mp.ID_MERCADO_PREMIO, m.NOMBRE as MERCADO,(mp.CANTIDAD_MAX_SALIDAS - mp.CANTIDAD_ENTREGADO_DIARIO) as CANTIDAD_MAX_SALIDAS
                                , m.ID_CIUDAD, m.DIRECCION, mp.CANTIDAD_MAX_SALIDAS as TOTAL_MAX_ENTREGA, mp.CANTIDAD_ENTREGADO_DIARIO FROM MERCADO_PREMIO mp
                                INNER JOIN PREMIO p ON mp.ID_PREMIO = p.ID_PREMIO
                                INNER JOIN MERCADO m ON m.ID_MERCADO = mp.ID_MERCADO
                                WHERE mp.ID_MERCADO = $user_logeado->id_mercado AND p.ESTADO = 'H'");

        $laDatosView['premio'] = $laPremio;
        return view('ruleta/index', ['laDatosView' => $laDatosView]);
    }
    public function RuletaDatos()
    {
        try {
            $user_logeado = session('user_logeado')[0]; // Datos usuario logeado
            $laPremio = DB::select("SELECT p.*, mp.ID_MERCADO_PREMIO, m.NOMBRE as MERCADO,(mp.CANTIDAD_MAX_SALIDAS - mp.CANTIDAD_ENTREGADO_DIARIO) as CANTIDAD_MAX_SALIDAS
                                , m.ID_CIUDAD, m.DIRECCION, mp.CANTIDAD_MAX_SALIDAS as TOTAL_MAX_ENTREGA, mp.CANTIDAD_ENTREGADO_DIARIO FROM MERCADO_PREMIO mp
                                INNER JOIN PREMIO p ON mp.ID_PREMIO = p.ID_PREMIO
                                INNER JOIN MERCADO m ON m.ID_MERCADO = mp.ID_MERCADO
                                WHERE mp.ID_MERCADO = $user_logeado->id_mercado AND p.ESTADO = 'H'");
            if (count($laPremio) > 0)
                return response()->json(['error' => 0, 'message' => 'exitoso', 'datos' => $laPremio]);
            else
                return response()->json(['error' => 1, 'message' => 'Sin datos en la tabla', 'datos' => null]);
        } catch (\Throwable $e) {
            return response()->json(['error' => 1, 'message' => 'Error al actualizar registro: ' . $e->getMessage() . ' Linea: ' . $e->getLine(), 'datos' => null]);
        }
    }
    public function HabiltarNinguno($tnId, $tnSumar)
    {
        //return response()->json(['message' => 'Registro actualizado correctamente']);
        try {
            $result = '';
            if ($tnSumar == 'true') {
                $result = DB::table('MERCADO_PREMIO')
                    ->where('ID_MERCADO_PREMIO', $tnId)
                    ->update(['CANTIDAD_ENTREGADO_DIARIO' => 1]);
            } else {
                $result = DB::table('MERCADO_PREMIO')
                    ->where('ID_MERCADO_PREMIO', $tnId)
                    ->update(['CANTIDAD_ENTREGADO_DIARIO' => 0]);
            }
            if ($result > 0)
                return response()->json(['error' => 0, 'message' => 'Registro actualizado correctamente']);
            else
                return response()->json(['error' => 1, 'message' => 'Error al actualizar registro en BD']);
        } catch (\Throwable $e) {
            return response()->json(['error' => 1, 'message' => 'Error al actualizar registro: ' . $e->getMessage() . ' Linea: ' . $e->getLine()]);
        }
    }
}