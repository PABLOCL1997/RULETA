<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientePremiado extends Model
{
    use HasFactory;
    protected $table = 'CLIENTE_PREMIADO';
    protected $primaryKey = 'ID_CLIENTE_PREMIEADO';

    public $timestamps=false;
    protected $fillable=[
        'NOMBRES',
    	'APELLIDOS',
    	'CARNET_IDENTIDAD',
    	'TELEFONO',
    	'ID_CIUDAD',
    	'FECHA_NACIMIENTO',
    	'NRO_TICKET',
		'ESTADO',
    	'ID_MERCADO',
    	'ID_PREMIO',
    	'USER_CREACION',
    	'FECHA_CREACION'
    ];
    protected $guarded=[

    ];
}
