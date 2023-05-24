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
class ClientePremiadoController extends Controller
{
    public function __construct()
    {

    }
    public function Index()
    {
        $laDatosView = array();
        $laPremio = FacadesDB::select('SELECT cp.*, m.NOMBRE as MERCADO, p.NOMBRE as PREMIO FROM CLIENTE_PREMIADO cp
                                INNER JOIN MERCADO m ON cp.ID_MERCADO = m.ID_MERCADO
                                INNER JOIN PREMIO p ON cp.ID_PREMIO = p.ID_PREMIO');
        
        $laDatosView['cliente_premiado'] = $laPremio;
        return view('cliente_premiado/index', ['laDatosView' => $laDatosView]);
    }
    public function Create()
    {
        
        $laDatosView = array();
        $laDatosMercado=FacadesDB::select('SELECT * FROM MERCADO m WHERE m.ESTADO = "H"');
        $laDatosPremio=FacadesDB::select('SELECT p.* FROM MERCADO_PREMIO mp INNER JOIN PREMIO p ON p.ID_PREMIO = mp.ID_PREMIO WHERE mp.ID_MERCADO = 1 AND p.ESTADO = "H"');
        $laDatosCiudad=FacadesDB::select('SELECT * FROM CIUDAD m WHERE m.ESTADO = "H"');
        $laDatosView['mercado'] = $laDatosMercado;
        $laDatosView['premio'] = $laDatosPremio;
        $laDatosView['ciudad'] = $laDatosCiudad;
    	return view("cliente_premiado/crear", ['laDatosView' => $laDatosView]);
    }
    public function Store(Request $request){
        try {
       
            FacadesDB::beginTransaction();
            $loClientePremiado = new ClientePremiado();
            $loClientePremiado->NOMBRES = $request->NOMBRES;
            $loClientePremiado->APELLIDOS = $request->APELLIDOS;
            $loClientePremiado->CARNET_IDENTIDAD = $request->CARNET_IDENTIDAD;
            $loClientePremiado->TELEFONO = $request->TELEFONO;
            $loClientePremiado->CIUDAD = "Santa Cruz";
            $loClientePremiado->FECHA_NACIMIENTO = Carbon::now('America/La_Paz');
            $loClientePremiado->NRO_TICKET = $request->NRO_TICKET;
            $loClientePremiado->ID_MERCADO = 1;
            $loClientePremiado->ID_PREMIO = 1;
            $loClientePremiado->USER_CREACION = "admin";
            $loClientePremiado->FECHA_CREACION = Carbon::now('America/La_Paz');
            $loClientePremiado->save();
            FacadesDB::commit();
        } catch (\Throwable $th) {
            FacadesDB::rollback();
        }
        //return Index();
        return Redirect::to('cliente_premiado'); 
    }
}