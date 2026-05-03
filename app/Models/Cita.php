<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $primaryKey = 'id';

    public $timestamps = false;

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
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id', 'vehiculo_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function servicioCita()
    {
        return $this->hasOne(Servicio_cita::class, 'cita_id');
    }
}
