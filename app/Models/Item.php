<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'codigo',
        'categoria',
        'cantidad',
        'ubicacion',
        'proveedor',
        'fecha_vencimiento',
        'umbral_minimo',
    ];

    // Relación: un Item tiene muchas transacciones
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

}
