<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'tipo',
        'cantidad',
        'descripcion',
    ];

    // Relación: una transacción pertenece a un ítem
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
