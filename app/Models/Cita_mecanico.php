<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Mecanico;
use App\Models\Servicio_cita;

class Cita_mecanico extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'mecanico_id',
        'servicio_cita_id'
    ];

    public function mecanico()
    {
        return $this->belongsTo(Mecanico::class, 'mecanico_id');
    }

    public function servicio_cita()
    {
        return $this->belongsTo(Servicio_cita::class, 'servicio_cita_id');
    }
}
