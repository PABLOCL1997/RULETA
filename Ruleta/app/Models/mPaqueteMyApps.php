<?php

namespace App\Models;

class mPaqueteMyApps
{
    public $error; 
    public $codigo;
    public $mensaje="";
    public $mensajeSistema="";
    public $response;

    function __construct2()
    {
        $this->error = 0;
        $this->codigo = 1;
        $this->mensaje = "Exito";
    }

    function __construct($tnError, $tnCodigo, $tcMensaje, $tcResponse)
    {
        $this->error = $tnError;
        $this->codigo = $tnCodigo;
        $this->mensaje = $tcMensaje;
        $this->response = $tcResponse;//tcValues;
    }
}


?>