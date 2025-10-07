<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class MovimientoInventario extends Model
{
    protected $table = 'movimientos_inventario';

    protected $fillable = [
        'item_id',
        'tipo',
        'cantidad',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
