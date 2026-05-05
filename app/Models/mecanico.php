<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mecanico extends Model
{
    use HasFactory;

    protected $table = 'mecanicos';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'tipo_documento',
        'documento_mecanico',
        'nombre_mecanico',
        'telefono_mecanico',
        'direccion_mecanico',
    ];

    public function citasMecanico()
    {
        return $this->hasMany(Cita_mecanico::class, 'mecanico_id');
    }

    public function serviciosCita()
    {
        return $this->hasManyThrough(
            Servicio_cita::class,
            Cita_mecanico::class,
            'mecanico_id',
            'servicio_cita_id',
            'mecanico_id',
            'servicio_cita_id'
        );
    }
}
