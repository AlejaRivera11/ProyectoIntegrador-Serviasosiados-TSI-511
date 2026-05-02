<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'cita_id';
    public $timestamps = false;

    protected $fillable = [
        'fecha_registro_cita',
        'hora_registro_cita',
        'fecha_cita',
        'hora_cita',
        'estado_id',
        'placa',
        'usuario_id'
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
        return $this->belongsTo(Vehiculo::class, 'placa', 'placa');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function servicioCita()
    {
        return $this->hasOne(Servicio_cita::class, 'cita_id');
    }
}