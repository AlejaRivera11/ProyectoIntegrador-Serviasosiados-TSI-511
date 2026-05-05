<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio_cita extends Model
{
    use HasFactory;

    protected $table = 'servicio_citas';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'fecha_inicio',
        'fecha_final',
        'servicio_id',
        'cita_id',
    ];

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
