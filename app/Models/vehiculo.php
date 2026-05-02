<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos'; // ajusta si es diferente
    protected $primaryKey = 'placa';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'referencia',
        'color',
        'kilometraje',
        'cliente_id',
    ];

    /*
    RELACIONES
    */

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'placa', 'placa');
    }
}