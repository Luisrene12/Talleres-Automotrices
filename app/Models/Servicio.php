<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
=======
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
class Servicio extends Model
{
    protected $table = 'servicio';
    protected $primaryKey = 'idServicio';
    public $timestamps = false;

    protected $fillable = [
        'idTipoServicio',
        'nombre',
        'precioBase',
        'duracionEstimada',
    ];

    public function tipoServicio()
    {
        return $this->belongsTo(TipoServicio::class, 'idTipoServicio', 'idTipoServicio');
    }
}
