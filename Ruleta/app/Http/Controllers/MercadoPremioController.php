<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Models\MercadoPremio;
use App\Models\Mercado;
use Carbon\Carbon;

class MercadoPremioController extends Controller
{
    public function Index()
    {
        $user_logeado = session('user_logeado')[0]; // Datos usuario logeado
        $laDatosView = array();
        try {

            $laMercado = DB::select('SELECT m.*, c.NOMBRE AS CIUDAD FROM MERCADO m 
                                           INNER JOIN CIUDAD c ON c.ID_CIUDAD  = m.ID_CIUDAD
                                           WHERE m.ESTADO = "H" ORDER BY m.FECHA_CREACION DESC');
            $laPremio = DB::select('SELECT * FROM PREMIO p WHERE p.ESTADO = "H" ORDER BY P.FECHA_CREACION DESC');
            $laMercadoPremio = DB::select("SELECT * FROM MERCADO_PREMIO mp");

            $laDatosView['mercado_premio'] = $laMercado;
            $laDatosView['premio'] = $laPremio;
            $laDatosView['mer_premio'] = $laMercadoPremio;
            return view('mercado_premio/index', ['laDatosView' => $laDatosView]);
        } catch (\Throwable $e) {
            $laDatosView['Error'] = $e->getMessage() + ' Linea: ' + $e->getLine();
            return view('layouts/500', ['laDatosView' => $laDatosView['Error']]);
        }
    }
    public function Create(Request $request)
    {
        $laDatosView = array();
        try {
            $laCiudad = DB::select("SELECT * FROM CIUDAD c WHERE c.ESTADO = 'H' ORDER BY c.FECHA_CREACION DESC");
            $laMercado = DB::select("SELECT * FROM MERCADO_PREMIO mp
                                            ORDER BY mp.FECHA_CREACION DESC");

            $laPremio = DB::select('SELECT * FROM PREMIO p WHERE p.ESTADO = "H" ORDER BY P.FECHA_CREACION DESC');

            $laMercadoPremio = DB::select("SELECT * FROM MERCADO_PREMIO mp");

            $laDatosView['mercado_premio'] = $laMercado;
            $laDatosView['premio'] = $laPremio;
            $laDatosView['mer_premio'] = $laMercadoPremio;
            $laDatosView['ciudad'] = $laCiudad;
            return view('mercado_premio/crear', ['laDatosView' => $laDatosView]);
        } catch (\Throwable $e) {
            $laDatosView['Error'] = $e->getMessage() . ' Linea: ' . $e->getLine();
            return view('layouts/500', ['laDatosView' => $laDatosView]);
        }
    }
    public function Store(Request $request)
    {
        $laDatosView = array();
        try {
            $user_logeado = session('user_logeado')[0] ?? ''; // Datos usuario logeado
            if (empty($user_logeado)) 
                return response()->json(['codError' => '1', 'mensaje' => 'Usuario no logeado'], 500);

            $laDatos = $request->input('valores');
            if (count($laDatos) < 1 || $laDatos == null) 
                return response()->json(['codError' => '1', 'mensaje' => 'Lista de premios vacios'], 500);

            $laDatosMercado = $request->input('valoresMercado');
            if (count($laDatosMercado) < 1 || $laDatosMercado == null) 
                return response()->json(['codError' => '1', 'mensaje' => 'Sin datos para mercado'], 500);

            return response()->json(['message' => 'Datos recibidos correctamente', 'datosMercado' => $laDatosMercado, 'datos' => $laDatos], 200);
            FacadesDB::beginTransaction();
            $loMercado = new Mercado();
            $loMercado->NOMBRE = $laDatosMercado[0]->NOMBRE;
            $loMercado->ID_CIUDAD = $laDatosMercado[0]->ID_CIUDAD;
            $loMercado->DIRECCION = $laDatosMercado[0]->DIRECCION;
            $loMercado->ESTADO = 'H';
            $loMercado->USER_CREACION = $user_logeado->name;
            $loMercado->FECHA_CREACION = Carbon::now('America/La_Paz');
            foreach ($laDatos as $datos) {
                // Crear un nuevo registro si no existe en la tabla
                $loMercadoPremio = new MercadoPremio();
                $loMercadoPremio->ID_MERCADO = $laDatosMercado[0]['ID_MERCADO'];
                $loMercadoPremio->ID_PREMIO = $datos['ID_PREMIO'];
                $loMercadoPremio->CANTIDAD_MAX_SALIDAS = $datos['CANTIDAD_MAX'];
                $loMercadoPremio->CANTIDAD_ENTREGADO_DIARIO = 0;
                $loMercadoPremio->PREMIO_CONSUELO = 'NO';
                $loMercadoPremio->USER_CREACION = $user_logeado->name;
                $loMercadoPremio->FECHA_CREACION = Carbon::now('America/La_Paz');
                // Realizar más actualizaciones según tus necesidades
                $loMercadoPremio->save();
            }
           /* if (count($laDatos) > 0) {
                $lnIdMercado = $laDatos[0]['ID_MERCADO'];
                $laMercadoPremio = MercadoPremio::where('ID_MERCADO', $lnIdMercado)->orderBy('FECHA_CREACION', 'desc')->get();
                $contador = 0;
                $contadorEli = 0;
                $contadorReg = 0;
                if (count($laMercadoPremio) > 0) {
                    foreach ($laMercadoPremio as $registro) {
                        // Verificar si el registro existe en el array
                        if (in_array($registro->ID_MERCADO, array_column($laDatos, 'ID_MERCADO')) && in_array($registro->ID_PREMIO, array_column($laDatos, 'ID_PREMIO'))) {
                            $datosArray = array_filter($laDatos, function ($dato) use ($registro) {
                                return $dato['ID_MERCADO'] == $registro->ID_MERCADO && $dato['ID_PREMIO'] == $registro->ID_PREMIO;
                            });

                            $contador += 1;
                            // Obtener los valores del primer elemento del array $datosArray
                            $datos = reset($datosArray);
                            DB::table('MERCADO_PREMIO')
                                ->where('ID_MERCADO', $registro->ID_MERCADO)
                                ->where('ID_PREMIO', $registro->ID_PREMIO)
                                ->update([
                                    'CANTIDAD_MAX_SALIDAS' => $datos['CANTIDAD_MAX'],
                                    'CANTIDAD_ENTREGADO_DIARIO' => 0,
                                    'PREMIO_CONSUELO' => 'NO'
                                ]);
                            //return response()->json(['message' => 'Datos recibidos correctamente', 'datos' => 'guardar' ], 200);
                        } else {
                            $contadorEli += 1;
                            // Eliminar el registro si no existe en el array
                            DB::table('MERCADO_PREMIO')
                                ->where('ID_MERCADO', $registro->ID_MERCADO)
                                ->where('ID_PREMIO', $registro->ID_PREMIO)
                                ->delete();
                            // return response()->json(['message' => 'Datos recibidos correctamente', 'datos' => 'eliminar' ], 200);
                        }
                    }
                    foreach ($laDatos as $datos) {
                        // Verificar si el registro existe en la tabla
                        $registroExistente = MercadoPremio::where('ID_MERCADO', $datos['ID_MERCADO'])->where('ID_PREMIO', $datos['ID_PREMIO'])->where('PREMIO_CONSUELO', 'NO')->exists();

                        if (!$registroExistente) {
                            $contadorReg += 1;
                            // Crear un nuevo registro si no existe en la tabla
                            $laMercadoPremio = new MercadoPremio();
                            $laMercadoPremio->ID_MERCADO = $datos['ID_MERCADO'];
                            $laMercadoPremio->ID_PREMIO = $datos['ID_PREMIO'];
                            $laMercadoPremio->CANTIDAD_MAX_SALIDAS = $datos['CANTIDAD_MAX'];
                            $laMercadoPremio->CANTIDAD_ENTREGADO_DIARIO = 0;
                            $laMercadoPremio->PREMIO_CONSUELO = 'NO';
                            $laMercadoPremio->USER_CREACION = $user_logeado->name;
                            $laMercadoPremio->FECHA_CREACION = Carbon::now('America/La_Paz');
                            // Realizar más actualizaciones según tus necesidades
                            $laMercadoPremio->save();
                        }
                    }
                } else {
                    foreach ($laDatos as $datos) {
                        // Verificar si el registro existe en la tabla
                        $registroExistente = MercadoPremio::where('ID_MERCADO', $datos['ID_MERCADO'])->where('ID_PREMIO', $datos['ID_PREMIO'])->where('PREMIO_CONSUELO', 'NO')->exists();

                        if (!$registroExistente) {
                            // Crear un nuevo registro si no existe en la tabla
                            $laMercadoPremio = new MercadoPremio();
                            $laMercadoPremio->ID_MERCADO = $datos['ID_MERCADO'];
                            $laMercadoPremio->ID_PREMIO = $datos['ID_PREMIO'];
                            $laMercadoPremio->CANTIDAD_MAX_SALIDAS = $datos['CANTIDAD_MAX'];
                            $laMercadoPremio->CANTIDAD_ENTREGADO_DIARIO = 0;
                            $laMercadoPremio->PREMIO_CONSUELO = 'NO';
                            $laMercadoPremio->USER_CREACION = $user_logeado->name;
                            $laMercadoPremio->FECHA_CREACION = Carbon::now('America/La_Paz');
                            // Realizar más actualizaciones según tus necesidades
                            $laMercadoPremio->save();
                        }
                    }
                }
                return response()->json(['message' => 'Datos recibidos correctamente', 'datosTabla' => $laMercadoPremio, 'datosArray' => $laDatos, 'insert' => $contadorReg, 'update' => $contador, 'eliminar' => $contadorEli], 200);
            } else {
                return view('layouts/500', ['laDatosView' => 'Sin datos seleccionados']);
            }*/
            FacadesDB::commit();
        } catch (\Throwable $e) {
            FacadesDB::rollback();
            $laDatosView['Error'] = $e->getMessage() + ' Linea: ' + $e->getLine();
            return view('layouts/500', ['laDatosView' => $laDatosView['Error']]);
        }
    }
    public function Edit(Request $request, $tnId)
    {
        $laDatosView = array();
        try {
            $laMercado = DB::select("SELECT * FROM MERCADO_PREMIO mp
                                           WHERE mp.ID_MERCADO = $tnId ORDER BY mp.FECHA_CREACION DESC");

            $laPremio = DB::select('SELECT * FROM PREMIO p WHERE p.ESTADO = "H" ORDER BY P.FECHA_CREACION DESC');

            $laMercadoPremio = DB::select("SELECT * FROM MERCADO_PREMIO mp");

            $laDatosView['mercado_premio'] = $laMercado;
            $laDatosView['premio'] = $laPremio;
            $laDatosView['mer_premio'] = $laMercadoPremio;
            $laDatosView['id_premio'] = $tnId;
            return view('mercado_premio/edit', ['laDatosView' => $laDatosView]);
        } catch (\Throwable $e) {
            $laDatosView['Error'] = $e->getMessage() . ' Linea: ' . $e->getLine();
            return view('layouts/500', ['laDatosView' => $laDatosView]);
        }
    }
    public function Update(Request $request)
    {
        $laDatosView = array();
        try {
            $user_logeado = session('user_logeado')[0]; // Datos usuario logeado
            $laDatos = $request->input('valores');
            $laDatosMercado = $request->input('valoresMercado');
            return response()->json(['message' => 'Datos recibidos correctamente', 'datosMercado' => $laDatosMercado, 'datos' => $laDatos], 200);
            if (count($laDatos) > 0) {
                $lnIdMercado = $laDatos[0]['ID_MERCADO'];
                $laMercadoPremio = MercadoPremio::where('ID_MERCADO', $lnIdMercado)->orderBy('FECHA_CREACION', 'desc')->get();
                $contador = 0;
                $contadorEli = 0;
                $contadorReg = 0;
                if (count($laMercadoPremio) > 0) {
                    foreach ($laMercadoPremio as $registro) {
                        // Verificar si el registro existe en el array
                        if (in_array($registro->ID_MERCADO, array_column($laDatos, 'ID_MERCADO')) && in_array($registro->ID_PREMIO, array_column($laDatos, 'ID_PREMIO'))) {
                            $datosArray = array_filter($laDatos, function ($dato) use ($registro) {
                                return $dato['ID_MERCADO'] == $registro->ID_MERCADO && $dato['ID_PREMIO'] == $registro->ID_PREMIO;
                            });

                            $contador += 1;
                            // Obtener los valores del primer elemento del array $datosArray
                            $datos = reset($datosArray);
                            DB::table('MERCADO_PREMIO')
                                ->where('ID_MERCADO', $registro->ID_MERCADO)
                                ->where('ID_PREMIO', $registro->ID_PREMIO)
                                ->update([
                                    'CANTIDAD_MAX_SALIDAS' => $datos['CANTIDAD_MAX'],
                                    'CANTIDAD_ENTREGADO_DIARIO' => 0,
                                    'PREMIO_CONSUELO' => 'NO'
                                ]);
                            //return response()->json(['message' => 'Datos recibidos correctamente', 'datos' => 'guardar' ], 200);
                        } else {
                            $contadorEli += 1;
                            // Eliminar el registro si no existe en el array
                            DB::table('MERCADO_PREMIO')
                                ->where('ID_MERCADO', $registro->ID_MERCADO)
                                ->where('ID_PREMIO', $registro->ID_PREMIO)
                                ->delete();
                            // return response()->json(['message' => 'Datos recibidos correctamente', 'datos' => 'eliminar' ], 200);
                        }
                    }
                    foreach ($laDatos as $datos) {
                        // Verificar si el registro existe en la tabla
                        $registroExistente = MercadoPremio::where('ID_MERCADO', $datos['ID_MERCADO'])->where('ID_PREMIO', $datos['ID_PREMIO'])->where('PREMIO_CONSUELO', 'NO')->exists();

                        if (!$registroExistente) {
                            $contadorReg += 1;
                            // Crear un nuevo registro si no existe en la tabla
                            $laMercadoPremio = new MercadoPremio();
                            $laMercadoPremio->ID_MERCADO = $datos['ID_MERCADO'];
                            $laMercadoPremio->ID_PREMIO = $datos['ID_PREMIO'];
                            $laMercadoPremio->CANTIDAD_MAX_SALIDAS = $datos['CANTIDAD_MAX'];
                            $laMercadoPremio->CANTIDAD_ENTREGADO_DIARIO = 0;
                            $laMercadoPremio->PREMIO_CONSUELO = 'NO';
                            $laMercadoPremio->USER_CREACION = $user_logeado->name;
                            $laMercadoPremio->FECHA_CREACION = Carbon::now('America/La_Paz');
                            // Realizar más actualizaciones según tus necesidades
                            $laMercadoPremio->save();
                        }
                    }
                } else {
                    foreach ($laDatos as $datos) {
                        // Verificar si el registro existe en la tabla
                        $registroExistente = MercadoPremio::where('ID_MERCADO', $datos['ID_MERCADO'])->where('ID_PREMIO', $datos['ID_PREMIO'])->where('PREMIO_CONSUELO', 'NO')->exists();

                        if (!$registroExistente) {
                            // Crear un nuevo registro si no existe en la tabla
                            $laMercadoPremio = new MercadoPremio();
                            $laMercadoPremio->ID_MERCADO = $datos['ID_MERCADO'];
                            $laMercadoPremio->ID_PREMIO = $datos['ID_PREMIO'];
                            $laMercadoPremio->CANTIDAD_MAX_SALIDAS = $datos['CANTIDAD_MAX'];
                            $laMercadoPremio->CANTIDAD_ENTREGADO_DIARIO = 0;
                            $laMercadoPremio->PREMIO_CONSUELO = 'NO';
                            $laMercadoPremio->USER_CREACION = $user_logeado->name;
                            $laMercadoPremio->FECHA_CREACION = Carbon::now('America/La_Paz');
                            // Realizar más actualizaciones según tus necesidades
                            $laMercadoPremio->save();
                        }
                    }
                }
                return response()->json(['message' => 'Datos recibidos correctamente', 'datosTabla' => $laMercadoPremio, 'datosArray' => $laDatos, 'insert' => $contadorReg, 'update' => $contador, 'eliminar' => $contadorEli], 200);
            } else {
                return view('layouts/500', ['laDatosView' => 'Sin datos seleccionados']);
            }

        } catch (\Throwable $e) {
            $laDatosView['Error'] = $e->getMessage() + ' Linea: ' + $e->getLine();
            return view('layouts/500', ['laDatosView' => $laDatosView['Error']]);
        }
    }
    public function obtenerMercado(Request $request)
    {
        $lnMercado = $request->input('lnMercado');
        // Realiza las operaciones necesarias con $lnMercado

        // Devuelve una respuesta si es necesario
        return response()->json(['success' => true]);
    }
}