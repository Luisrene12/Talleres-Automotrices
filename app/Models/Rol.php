<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
=======
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
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
