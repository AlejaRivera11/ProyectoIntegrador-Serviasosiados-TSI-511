<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'fecha_cita',
        'hora_cita',
        'estado_id',
        'vehiculo_id',
        'user_id',
    ];

    /*
    RELACIONES
    */

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function servicioCita()
    {
        return $this->hasOne(Servicio_cita::class, 'cita_id');
    }

    public function citaMecanico()
    {
        return $this->hasOne(Cita_mecanico::class, 'servicio_cita_id', 'id');
    }
}
