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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente'); // AUTO_INCREMENT, PRIMARY KEY
            $table->enum('tipo_cliente', ['empresa', 'gobierno', 'educacion', 'residencial']);
            $table->string('nombre_cliente', 100);
            $table->string('nit_ci', 20)->unique();
            $table->string('rubro', 100)->nullable();
            $table->text('direccion_principal');
            $table->string('telefono', 20);
            $table->string('celular', 20)->nullable();
            $table->string('email_acceso', 100)->unique();
            $table->string('contrasena', 255);
            $table->enum('referencia', ['recomendacion', 'publicidad', 'busqueda', 'redes', 'otro'])->nullable();
            $table->text('observaciones')->nullable();
            $table->dateTime('fecha_registro')->useCurrent();
            $table->boolean('activo')->default(true);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
