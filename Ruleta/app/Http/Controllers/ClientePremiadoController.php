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

class ClientePremiadoController extends Controller
{
    public function __construct()
    {

    }
    public function Index()
    {
        $laDatosView = array();
        $laPremio = FacadesDB::select('SELECT cp.*, m.NOMBRE as MERCADO, p.NOMBRE as PREMIO, c.NOMBRE as CIUDAD FROM CLIENTE_PREMIADO cp
                                INNER JOIN MERCADO m ON cp.ID_MERCADO = m.ID_MERCADO
                                INNER JOIN PREMIO p ON cp.ID_PREMIO = p.ID_PREMIO
                                INNER JOIN CIUDAD c ON c.ID_CIUDAD = cp.ID_CIUDAD');

        $laDatosView['cliente_premiado'] = $laPremio;
        return view('cliente_premiado/index', ['laDatosView' => $laDatosView]);
    }
    public function Create()
    {

        $laDatosView = array();
        $laDatosMercado = FacadesDB::select('SELECT * FROM MERCADO m WHERE m.ESTADO = "H"');
        $laDatosPremio = FacadesDB::select('SELECT p.* FROM MERCADO_PREMIO mp INNER JOIN PREMIO p ON p.ID_PREMIO = mp.ID_PREMIO WHERE mp.ID_MERCADO = 3 AND p.ESTADO = "H"');
        $laDatosCiudad = FacadesDB::select('SELECT * FROM CIUDAD m WHERE m.ESTADO = "H"');
        $laDatosView['mercado'] = $laDatosMercado;
        $laDatosView['premio'] = $laDatosPremio;
        $laDatosView['ciudad'] = $laDatosCiudad;
        return view("cliente_premiado/crear", ['laDatosView' => $laDatosView]);
    }
    public function Store(Request $request)
    {
        //return response()->json($request);
        $loPaquete = new mPaqueteMyApps(0, 200, "iniciando", null);
        try {
            FacadesDB::beginTransaction();
            $loCantEntreActual = FacadesDB::select("SELECT mp.CANTIDAD_ENTREGADO_DIARIO FROM MERCADO_PREMIO mp WHERE mp.ID_MERCADO = 3 AND mp.ID_PREMIO = $request->ID_PREMIO");
            if (count($loCantEntreActual) > 0) {
                $result = FacadesDB::table('MERCADO_PREMIO')
                    ->where('ID_MERCADO', 3)
                    ->where('ID_PREMIO', $request->ID_PREMIO)
                    ->update(['CANTIDAD_ENTREGADO_DIARIO' => intval($loCantEntreActual[0]->CANTIDAD_ENTREGADO_DIARIO) + 1]);
                if ($result > 0) {
                    $loClientePremiado = new ClientePremiado();
                    
                    $loClientePremiado->NOMBRES = $request->NOMBRES;
                    $loClientePremiado->APELLIDOS = $request->APELLIDOS;
                    $loClientePremiado->CARNET_IDENTIDAD = $request->CARNET_IDENTIDAD;
                    $loClientePremiado->TELEFONO = $request->TELEFONO;
                    
                    $loClientePremiado->ID_CIUDAD = 1;
                    
                    $loClientePremiado->FECHA_NACIMIENTO = Carbon::createFromFormat('d/m/Y', $request->FECHA_NACIMIENTO)->format('Y-m-d');
                    $loClientePremiado->NRO_TICKET = $request->NRO_TICKET;
                    $loClientePremiado->ID_MERCADO = 3;
                    $loClientePremiado->ID_PREMIO = $request->ID_PREMIO;
                    $loClientePremiado->USER_CREACION = "admin";
                    $loClientePremiado->FECHA_CREACION = Carbon::now('America/La_Paz');
                    $loClientePremiado->save();
                   // DB::table('CLIENTE_PREMIADO')->insert($loClientePremiado);
                    //if (is_null($loClientePremiado->ID_CLIENTE_PREMIADO))
                      //  DB::rollback();
                }
            }
            FacadesDB::commit();
        } catch (\Throwable $e) {
            // Hubo un error, deshacer la transacción
            DB::rollback();
            $loPaquete->error = 1; // Error Generico
            $loPaquete->codigo = 400; // Sucedio un error
            $loPaquete->mensaje = 'Error al insertar registro';
            $loPaquete->mensajeSistema = 'Mensaje: ' + $e->getMessage() + ' Linea: ' + $e->getLine();
            $loPaquete->response = null;  
            return response()->json($loPaquete);
        }
        return Redirect::to('ruleta');
    }
}