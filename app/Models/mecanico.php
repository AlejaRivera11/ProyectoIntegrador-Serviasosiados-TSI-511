<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mecanico extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'tipo_documento',
        'documento_mecanico',
        'nombre_mecanico',
        'telefono_mecanico',
        'direccion_mecanico',
    ];

}
