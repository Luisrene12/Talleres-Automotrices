<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
=======
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'idCliente';
    public $timestamps = false;

    protected $fillable = [
        'idUsuario',
        'nombreCompleto',
        'ci_nit',
        'telefono',
        'direccion',
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'idCliente', 'idCliente');
    }

    public function ordenesTrabajo()
    {
        return $this->hasMany(OrdenTrabajo::class, 'idCliente', 'idCliente');
    }
<<<<<<< HEAD

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario', 'idUsuario');
    }
=======
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
}
