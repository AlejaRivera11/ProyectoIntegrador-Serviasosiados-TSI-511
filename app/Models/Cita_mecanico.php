<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita_mecanico extends Model
{
    use HasFactory;

    protected $table = 'cita_mecanicos'; // AJUSTA si tu tabla es diferente

    protected $primaryKey = 'id'; // AJUSTA si tu PK es diferente

    public $timestamps = false;

    protected $fillable = [
        'mecanico_id',
        'servicio_cita_id',
    ];

    /*
    RELACIONES
    */

    public function mecanico()
    {
        return $this->belongsTo(mecanico::class, 'mecanico_id');
    }

    public function servicioCita()
    {
        return $this->belongsTo(Servicio_cita::class, 'servicio_cita_id');
    }
}
