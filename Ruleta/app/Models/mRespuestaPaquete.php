<?php
namespace App\Models;

use App\Models\mPaqueteMyApps;

class mPaqueteRespuesta
{
    public static function PaqueteExitoso($codigo, $mensaje, $mensajeSistema, $response)
    {
        $loPaquete = new mPaqueteMyApps(0, 200, "iniciando", null);
        $loPaquete->error = 1; // Error Generico
        $loPaquete->codigo = $codigo; // Sucedio un error
        $loPaquete->mensaje = $mensaje;
        $loPaquete->mensajeSistema = $mensajeSistema;
        $loPaquete->response = null;
        return $loPaquete;
    }
    public static function PaqueteFallo($codigo, $mensaje, $mensajeSistema, $response)
    {
        $loPaquete = new mPaqueteMyApps(0, 500, "Error", null);
        $loPaquete->error = 1; // Error Generico
        $loPaquete->codigo = $codigo; // Sucedio un error
        $loPaquete->mensaje = $mensaje;
        $loPaquete->mensajeSistema = $mensajeSistema;
        $loPaquete->response = null;
        return $loPaquete;
    }
}

?>