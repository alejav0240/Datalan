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
            $table->id('id_trabajo');
            $table->unsignedBigInteger('id_cliente');
            $table->enum('tipo_trabajo', ['instalacion', 'mantenimiento', 'reparacion', 'configuracion', 'otro']);
            $table->string('otro_tipo', 100)->nullable();
            $table->text('descripcion');

            // Ubicación origen
            $table->string('origen_nombre', 100);
            $table->text('origen_direccion');
            $table->decimal('origen_lat', 10, 7)->nullable();
            $table->decimal('origen_lng', 10, 7)->nullable();

            // Ubicación destino
            $table->string('destino_nombre', 100);
            $table->text('destino_direccion');
            $table->decimal('destino_lat', 10, 7)->nullable();
            $table->decimal('destino_lng', 10, 7)->nullable();

            // Programación
            $table->date('fecha_trabajo');
            $table->time('hora_inicio');
            $table->time('hora_fin')->nullable();
            $table->enum('prioridad', ['normal', 'alta', 'urgente'])->default('normal');
            $table->text('observaciones_tiempo')->nullable();

            // Supervisor
            $table->unsignedBigInteger('id_supervisor');

            // Materiales
            $table->json('materiales_json')->nullable();
            $table->text('observaciones_materiales')->nullable();

            // Registro
            $table->timestamp('fecha_registro')->useCurrent();

            // Foreign keys
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->foreign('id_supervisor')->references('id_empleado')->on('empleados')->onDelete('cascade');
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
