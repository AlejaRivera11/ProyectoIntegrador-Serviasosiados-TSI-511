<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio_cita extends Model
{
    use HasFactory;

    protected $table = 'servicio_citas'; // AJUSTA si es diferente

    protected $primaryKey = 'id'; // AJUSTA si es diferente

    public $timestamps = true;

    protected $fillable = [
        'fecha_inicio',
        'fecha_final',
        'servicio_id',
        'cita_id',
    ];

    /*
    RELACIONES
    */

    public function servicio()
    {
        return $this->belongsTo(servicio::class, 'servicio_id');
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'cita_id');
    }


    public function citaMecanicos()
    {
        return $this->hasOne(Cita_mecanico::class, 'servicio_cita_id');
    }
}
