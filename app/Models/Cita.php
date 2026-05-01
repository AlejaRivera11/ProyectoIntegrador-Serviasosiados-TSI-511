<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Estado;
use App\Models\Vehiculo;
use App\Models\User;

class Cita extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'cita_id',
        'fecha_cita',
        'hora_cita',
        'estado_id',
        'placa',
        'user_id'
    ];

    /*public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    } // Relación con el estado de la cita
    */
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'placa', 'placa');
    } // Relación con el vehículo asociado a la cita

    public function user ()
    {
        return $this->belongsTo(User::class, 'documento', 'documento');
    } // Relación con el usuario que registró la cita


}
