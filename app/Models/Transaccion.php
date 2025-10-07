<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Transaccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'tipo',
        'cantidad',
        'descripcion',
        'user_id',
    ];

    // Relación: una transacción pertenece a un ítem
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Relación: una transacción pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
