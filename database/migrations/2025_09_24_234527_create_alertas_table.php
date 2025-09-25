<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->onDelete('cascade'); // Relación con ítems
            $table->integer('cantidad'); // cantidad en el momento de la alerta
            $table->enum('estado', ['pendiente', 'atendida'])->default('pendiente'); // estado de la alerta
            $table->timestamps(); // created_at = fecha de alerta, updated_at = última actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};
