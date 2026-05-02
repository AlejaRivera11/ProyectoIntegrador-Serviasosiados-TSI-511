<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita_mecanico extends Model
{
    use HasFactory;

    protected $table = 'cita_mecanicos'; // AJUSTA si tu tabla es diferente
    protected $primaryKey = 'cita_mecanico_id';
    public $timestamps = false;

    protected $fillable = [
        'mecanico_id',
        'servicio_cita_id'
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