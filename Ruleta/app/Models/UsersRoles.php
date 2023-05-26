<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersRoles extends Model
{
    use HasFactory;
    protected $table = 'users_roles';
    protected $primaryKey = 'id_user_rol';

    public $timestamps=false;
    protected $fillable = [
        'id_user_rol',
        'id',
        'id_rol',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('id_user_rol', 'LIKE', "%$search%")
                ->orWhere('id', 'LIKE', "%$search%")
                ->orWhere('id_rol', 'LIKE', "%$search%");
        }
    }

}
