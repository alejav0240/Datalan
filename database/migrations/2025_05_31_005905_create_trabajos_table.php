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
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporte_id')->constrained('reporte_fallas')->onDelete('cascade');
            $table->enum('tipo_trabajo', ['instalacion', 'mantenimiento', 'reparacion', 'configuracion', 'otro']);
            $table->text('descripcion')->nullable();

            // Programación
            $table->enum('prioridad', ['normal', 'alta', 'urgente'])->default('normal');

            // Materiales
            $table->text('materiales')->nullable();
            $table->text('observaciones_materiales')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajos');
    }
};
