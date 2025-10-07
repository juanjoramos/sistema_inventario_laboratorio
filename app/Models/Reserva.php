<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'cantidad',
        'estado',
        'fecha_prestamo',
        'fecha_devolucion_prevista',
        'fecha_devolucion_real',
        'motivo',
    ];

    /**Castea fechas automáticamente a objetos Carbon*/
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'fecha_prestamo' => 'datetime',
        'fecha_devolucion_prevista' => 'datetime',
        'fecha_devolucion_real' => 'datetime',
    ];

    /**Usuario que hizo la reserva*/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**Ítem reservado*/
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
