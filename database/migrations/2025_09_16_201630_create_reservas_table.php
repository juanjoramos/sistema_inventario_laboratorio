<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('reservas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('item_id')->constrained()->onDelete('cascade');
        $table->unsignedInteger('cantidad')->default(1);
        $table->enum('estado', ['pendiente', 'prestado', 'cancelado', 'devuelto'])->default('pendiente');
        $table->date('fecha_prestamo')->nullable();
        $table->date('fecha_devolucion_prevista')->nullable();
        $table->string('motivo')->nullable();

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
