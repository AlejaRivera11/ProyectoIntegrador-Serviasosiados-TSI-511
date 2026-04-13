<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'referencia',
        'color',
        'kilometraje',
        'cliente_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class); // es la relacion que indica que un vehiculo le pertece a un cliente
    }
}
