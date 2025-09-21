<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditoriasTable extends Migration
{
    public function up()
    {
        Schema::create('auditorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // quien hizo la acción
            $table->string('accion'); // ejemplo: 'crear', 'actualizar', 'eliminar', 'asignar_rol'
            $table->text('descripcion'); // descripción del cambio
            $table->string('modelo_afectado')->nullable(); // por ejemplo: User
            $table->unsignedBigInteger('modelo_id')->nullable(); // id del modelo afectado
            $table->json('datos_anteriores')->nullable();
            $table->json('datos_nuevos')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('auditorias');
    }
}
