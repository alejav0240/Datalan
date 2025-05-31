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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('id_empleado');
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('ci', 20)->unique();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['masculino', 'femenino', 'otro']);
            $table->enum('estado_civil', ['soltero', 'casado', 'divorciado', 'viudo']);
            $table->text('direccion');
            $table->string('telefono', 20);
            $table->string('email', 100)->unique();
            $table->string('contacto_emergencia', 100)->nullable();
            $table->string('telefono_emergencia', 20)->nullable();
            $table->string('cargo', 50);
            $table->string('departamento', 50);
            $table->date('fecha_ingreso');
            $table->decimal('salario', 10, 2);
            $table->enum('tipo_contrato', ['indefinido', 'temporal', 'prueba', 'obra']);
            $table->text('habilidades')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->boolean('activo')->default(true);
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
