<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // Relación con roles
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación con la tabla roles
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Accesor para obtener el nombre del rol directamente
     */
    public function getRoleNameAttribute()
    {
        return $this->role ? $this->role->name : null;
    }

    /**
     * Asignar rol automáticamente según el correo institucional
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            $email = $user->email;

            // 🎓 Estudiante: nombre.apellido###@pascualbravo.edu.co
            if (preg_match('/^[a-zA-Z]+\.[a-zA-Z]+\d{3}@pascualbravo\.edu\.co$/i', $email)) {
                $user->role_id = Role::where('name', 'estudiante')->value('id');
            } else {
                // 👨‍🏫 Profesor: cualquier otro correo institucional
                $user->role_id = Role::where('name', 'profesor')->value('id');
            }
        });
    }
}
