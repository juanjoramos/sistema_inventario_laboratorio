<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;

    /**
     * Los campos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'item_id',
        'cantidad',
        'estado',
    ];

    /**
     * Relación: una alerta pertenece a un ítem.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}