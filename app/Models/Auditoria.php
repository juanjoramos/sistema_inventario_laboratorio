<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Auditoria extends Model
{
    use HasFactory;

    protected $table = 'auditorias';

    protected $fillable = [
        'user_id',
        'accion',
        'descripcion',
        'modelo_afectado',
        'modelo_id',
        'datos_anteriores',
        'datos_nuevos',
    ];

    protected $casts = [
        'datos_anteriores' => 'array',
        'datos_nuevos'     => 'array',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
