<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mercado extends Model
{
    use HasFactory;
    protected $table = 'MERCADO';
    protected $primaryKey = 'ID_MERCADO';

    public $timestamps=false;
    protected $fillable=[
        'NOMBRE',
    	'ID_CIUDAD',
    	'DIRECCION',
		'ESTADO',
    	'USER_CREACION',
    	'FECHA_CREACION'
    ];
    protected $guarded=[

    ];
}
