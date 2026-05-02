<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    use HasFactory; //

    protected $fillable = [
        'tipo_documento',
        'documento',
        'nombre_cliente',
        'telefono_cliente',
        'correo_cliente',
        'direccion_cliente',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // es la relacion que indica que un cliente le pertece a un usuario
    }

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class); // es la relacion que indica que un cliente puede tener muchos vehiculos
    }
}
