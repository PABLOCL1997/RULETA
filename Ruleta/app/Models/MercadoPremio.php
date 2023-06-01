<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MercadoPremio extends Model
{
    use HasFactory;
    protected $table = 'MERCADO_PREMIO';
    protected $primaryKey = 'ID_MERCADO_PREMIO';

    public $timestamps=false;
    protected $fillable=[
        'ID_MERCADO',
    	'ID_PREMIO',
    	'CANTIDAD_MAX_SALIDAS',
    	'CANTIDAD_ENTREGADO_DIARIO',
    	'PREMIO_CONSUELO',
    	'FECHA_NACIMIENTO',
    	'USER_CREACION',
    	'FECHA_CREACION'
    ];
    protected $guarded=[

    ];
}
