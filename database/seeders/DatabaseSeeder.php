<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear roles si no existen
        $roles = ['admin', 'profesor', 'estudiante'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Crear usuario admin por defecto
        $admin = User::firstOrCreate(
            ['email' => 'admin@pascualbravo.edu.co'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'), 
            ]
        );

        // Asignar rol de admin
        $admin->role_id = Role::where('name', 'admin')->first()->id;
        $admin->save();
    }
}
