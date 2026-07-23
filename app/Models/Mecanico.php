<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mecanico extends Model
{
    protected $table = 'mecanico';
    protected $primaryKey = 'idMecanico';
    public $timestamps = false;

    protected $fillable = [
        'nombreCompleto',
        'ci',
        'telefono',
        'idSucursal',
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'idSucursal', 'idSucursal');
    }

    public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'mecanico_especialidad', 'idMecanico', 'idEspecialidad');
    }

    public function ordenesTrabajo()
    {
        return $this->hasMany(OrdenTrabajo::class, 'idMecanico', 'idMecanico');
    }
}
