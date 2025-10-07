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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', [
                'stock',
                'prestamos',
                'consumo_reactivos',
                'equipos_usados'
            ]);            // Periodo: diario, semanal, etc.
            $table->enum('periodo', ['diario', 'semanal', 'mensual', 'personalizado']);
            $table->date('fecha');
            $table->string('formato')->default('pdf');
            $table->string('ruta_archivo')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('estadisticas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
