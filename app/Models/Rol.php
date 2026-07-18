<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';
    protected $primaryKey = 'idRol';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'idRol', 'idRol');
    }

    public function permisos()
    {
        return $this->hasMany(Permiso::class, 'idRol', 'idRol');
    }
}
