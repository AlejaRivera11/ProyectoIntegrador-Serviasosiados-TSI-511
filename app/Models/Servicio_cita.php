<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Servicio;
use App\Models\Cita;

class Servicio_cita extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'fecha_inicio',
        'fecha_final',
        'servicio_id',
        'cita_id'
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    } // Relación con el servicio asociado a la cita

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'cita_id');
    } // Relación con la cita asociada al servicio

}
