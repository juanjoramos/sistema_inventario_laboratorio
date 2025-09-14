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
        Schema::create('transaccions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')
                  ->constrained('items')
                  ->onDelete('cascade');
            $table->enum('tipo', ['entrada', 'salida']); // Tipo de movimiento
            $table->integer('cantidad'); // Cuánto entra o sale
            $table->text('descripcion')->nullable(); // Motivo u observación
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaccions');
    }
};
