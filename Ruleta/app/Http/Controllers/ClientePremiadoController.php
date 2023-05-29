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
use App\Models\mPaqueteRespuesta;

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
                                INNER JOIN CIUDAD c ON c.ID_CIUDAD = cp.ID_CIUDAD
                                WHERE cp.ESTADO = "G" ORDER BY cp.FECHA_CREACION DESC');

        $laDatosView['cliente_premiado'] = $laPremio;
        return view('cliente_premiado/index', ['laDatosView' => $laDatosView]);
    }
    public function Create(Request $request)
    {
        $id = $request->input('ID'); // ID PREMIO ENVIADO DESDE LA RULETA
        $user_logeado = session('user_logeado')[0]; // Datos usuario logeado
        $laDatosView = array();
        //$laDatosMercado = FacadesDB::select('SELECT * FROM MERCADO m WHERE m.ESTADO = "H"');
        $laDatosPremio = FacadesDB::select("SELECT p.* FROM MERCADO_PREMIO mp 
                                            INNER JOIN PREMIO p ON p.ID_PREMIO = mp.ID_PREMIO                                  
                                            WHERE mp.ID_MERCADO = (select u.id_mercado 
                                                                from users u 
                                                                where u.id = $user_logeado->id) 
                                            AND p.ESTADO = 'H'");
        if ($id != null || $id > 0) {
            $laDatosPremio = FacadesDB::select("SELECT p.* FROM MERCADO_PREMIO mp INNER JOIN PREMIO p ON p.ID_PREMIO = mp.ID_PREMIO 
                                            WHERE mp.ID_MERCADO = (select u.id_mercado 
                                                                from users u 
                                                                where u.id = $user_logeado->id)  
                                            AND mp.ID_PREMIO = $id AND p.ESTADO = 'H'");
        }
        //$laDatosCiudad = FacadesDB::select('SELECT * FROM CIUDAD m WHERE m.ESTADO = "H"');
        //$laDatosView['mercado'] = $laDatosMercado;
        $laDatosView['premio'] = $laDatosPremio;
        //$laDatosView['ciudad'] = $laDatosCiudad;
        return view("cliente_premiado/crear", ['laDatosView' => $laDatosView]);
    }
    public function Store(Request $request)
    {
        //return response()->json($request);
        $loPaquete = new mPaqueteMyApps(0, 200, "iniciando", null);
        $user_logeado = session('user_logeado')[0]; // Datos usuario logeado
        $lnIdMercado = FacadesDB::select("SELECT u.id_mercado FROM users u WHERE u.id = $user_logeado->id");
        $lnIdMercado = $lnIdMercado[0]->id_mercado;
        try {
            FacadesDB::beginTransaction();
            $loCantEntreActual = FacadesDB::select("SELECT mp.CANTIDAD_ENTREGADO_DIARIO FROM MERCADO_PREMIO mp WHERE mp.ID_MERCADO = $lnIdMercado AND mp.ID_PREMIO = $request->ID_PREMIO");
            if (count($loCantEntreActual) > 0) {
                $result = FacadesDB::table('MERCADO_PREMIO')
                    ->where('ID_MERCADO', $lnIdMercado)
                    ->where('ID_PREMIO', $request->ID_PREMIO)
                    ->update(['CANTIDAD_ENTREGADO_DIARIO' => intval($loCantEntreActual[0]->CANTIDAD_ENTREGADO_DIARIO) + 1]);
                if ($result > 0) {
                    $loClientePremiado = new ClientePremiado();

                    $loClientePremiado->NOMBRES = $request->NOMBRES;
                    $loClientePremiado->APELLIDOS = $request->APELLIDOS;
                    $loClientePremiado->CARNET_IDENTIDAD = $request->CARNET_IDENTIDAD;
                    $loClientePremiado->TELEFONO = $request->TELEFONO;
                    $loClientePremiado->ID_CIUDAD = $user_logeado->id_ciudad;
                    $loClientePremiado->FECHA_NACIMIENTO = Carbon::createFromFormat('d/m/Y', $request->FECHA_NACIMIENTO)->format('Y-m-d');
                    $loClientePremiado->NRO_TICKET = $request->NRO_TICKET;
                    $loClientePremiado->ESTADO = 'G';
                    $loClientePremiado->ID_MERCADO = $user_logeado->id_mercado;
                    $loClientePremiado->ID_PREMIO = $request->ID_PREMIO;
                    $loClientePremiado->USER_CREACION = $user_logeado->name;
                    $loClientePremiado->FECHA_CREACION = Carbon::now('America/La_Paz');
                    //return $loClientePremiado;
                    $loClientePremiado->save();

                    //if (is_null($loClientePremiado->ID_CLIENTE_PREMIADO))
                    //  DB::rollback();
                }
            }
            FacadesDB::commit();
        } catch (\Throwable $e) {
            // Hubo un error, deshacer la transacción
            DB::rollback();
            $loPaquete->error = 1; // Error Generico
            $loPaquete->codigo = 500; // Sucedio un error
            $loPaquete->mensaje = 'Error al insertar registro';
            $loPaquete->mensajeSistema = 'Mensaje: ' + $e->getMessage() + ' Linea: ' + $e->getLine();
            $loPaquete->response = null;
            return response()->json($loPaquete);
        }
        return Redirect::to('ruleta');
    }
    public function Edit($tnId)
    {
        $user_logeado = session('user_logeado')[0]; // Datos usuario logeado
        $laDatosView = array();
        $laDatosPremio = FacadesDB::select("SELECT p.* FROM MERCADO_PREMIO mp INNER JOIN PREMIO p ON p.ID_PREMIO = mp.ID_PREMIO 
                                            WHERE mp.ID_MERCADO = (select u.id_mercado 
                                                                from users u 
                                                                where u.id = $user_logeado->id)  
                                            AND p.ESTADO = 'H'");
        $laDatosView['premio'] = $laDatosPremio;
        $laDatosView['cliente_premiado'] = ClientePremiado::findOrFail($tnId);
        $lnIdPremio = $laDatosView['cliente_premiado']->ID_PREMIO;
        $laNombrePremio = FacadesDB::select("SELECT p.NOMBRE FROM PREMIO p WHERE p.ID_PREMIO = $lnIdPremio");
        $laDatosView['nombre_premio'] = $laNombrePremio[0];
        return view("cliente_premiado.edit", ["laDatosView" => $laDatosView]);
    }
    public function Update(Request $request, $tnId)
    {
        $user_logeado = session('user_logeado')[0]; // Datos usuario logeado
        $loPaquete = new mPaqueteMyApps(0, 200, "iniciando", null);
        try {
            FacadesDB::beginTransaction();
            $loClientePremiado = ClientePremiado::findOrFail($tnId);
            $loClientePremiado->NOMBRES = $request->NOMBRES;
            $loClientePremiado->APELLIDOS = $request->APELLIDOS;
            $loClientePremiado->CARNET_IDENTIDAD = $request->CARNET_IDENTIDAD;
            $loClientePremiado->TELEFONO = $request->TELEFONO;
            $loClientePremiado->ID_CIUDAD = $user_logeado->id_ciudad;
            $loClientePremiado->FECHA_NACIMIENTO = $request->FECHA_NACIMIENTO;
            $loClientePremiado->NRO_TICKET = $request->NRO_TICKET;
            $loClientePremiado->ID_MERCADO = $user_logeado->id_mercado;
            $loClientePremiado->ID_PREMIO = $request->ID_PREMIO;
            $loClientePremiado->USER_CREACION = "admin";
            $loClientePremiado->update();
            FacadesDB::commit();
        } catch (\Throwable $e) {
            // Hubo un error, deshacer la transacción
            DB::rollback();
            return response()->json(mPaqueteRespuesta::PaqueteFallo(500, 'Error al editar', 'Mensaje: ' + $e->getMessage() + ' Linea: ' + $e->getLine(), NULL));
        }
        return Redirect::to('cliente_premiado');
    }
    public function Anular($tnId)
    {
        try {
            $loCasoPrueba = ClientePremiado::findOrFail($tnId);
            $loCasoPrueba->Estado = 'A';
            $loCasoPrueba->update();

            return response()->json(['error' => 0, 'message' => 'Registro anulado correctamente']);
        } catch (\Throwable $e) {
            return response()->json(['error' => 1, 'message' => 'Error al anular registro: ' . $e->getMessage() . ' Linea: ' . $e->getLine()]);
        }
    }
}