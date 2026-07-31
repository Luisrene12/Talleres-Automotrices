<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
=======
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
class OrdenTrabajo extends Model
{
    protected $table = 'ordentrabajo';
    protected $primaryKey = 'idOrden';
    public $timestamps = false;

    protected $fillable = [
        'idCliente',
        'idVehiculo',
        'idMecanico',
        'fechaIngreso',
        'fechaEntrega',
        'estado',
        'diagnostico',
        'total',
<<<<<<< HEAD
        'horaInicio',
        'horaFinEstimada',
        'horaFinReal',
        'etapa',
        'sucursal',
        'servicioSolicitado'
=======
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente', 'idCliente');
    }

    public function mecanico()
    {
        return $this->belongsTo(Mecanico::class, 'idMecanico', 'idMecanico');
    }
<<<<<<< HEAD

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'idVehiculo', 'idVehiculo');
    }
=======
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
}
