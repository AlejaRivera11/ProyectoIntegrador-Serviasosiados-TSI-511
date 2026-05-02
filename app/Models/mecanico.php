<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mecanico extends Model
{
    use HasFactory;

    protected $table = 'mecanicos'; // ajusta si es diferente
    protected $primaryKey = 'mecanico_id';
    public $timestamps = false;

    protected $fillable = [
        'tipo_documento',
        'documento_mecanico',
        'nombre_mecanico',
        'telefono_mecanico',
        'direccion_mecanico',
    ];

    /*
    RELACIONES
    */

    // Relación con la tabla intermedia
    public function citasMecanico()
    {
        return $this->hasMany(Cita_mecanico::class, 'mecanico_id');
    }

    // Acceso indirecto a servicio_cita (CLAVE)
    public function serviciosCita()
    {
        return $this->hasManyThrough(
            Servicio_cita::class,
            Cita_mecanico::class,
            'mecanico_id',        // FK en cita_mecanico
            'servicio_cita_id',   // FK en servicio_cita
            'mecanico_id',        // PK local
            'servicio_cita_id'    // FK en cita_mecanico
        );
    }
}