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

        // Relación con el usuario (quién reserva)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // Relación con el ítem reservado
        $table->foreignId('item_id')->constrained()->onDelete('cascade');

        // Cantidad reservada
        $table->unsignedInteger('cantidad')->default(1);

        // Estado de la reserva (pendiente, entregado, cancelado, devuelto)
        $table->enum('estado', ['pendiente', 'entregado', 'cancelado', 'devuelto'])->default('pendiente');

        // Nuevos campos para controlar préstamo
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
