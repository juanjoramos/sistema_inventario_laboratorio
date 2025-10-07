<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Reporte extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'tipo',
        'periodo',
        'fecha',
        'formato',
        'ruta_archivo',
        'user_id',
        'estadisticas',
    ];

    // Convertir 'estadisticas' automáticamente a array
    protected $casts = [
        'estadisticas' => 'array',
        'fecha' => 'date',
    ];

    // Relación: un reporte pertenece a un usuario (generalmente admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
