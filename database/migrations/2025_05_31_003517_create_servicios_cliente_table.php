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
        Schema::create('servicios_cliente', function (Blueprint $table) {
            $table->id('id_servicio_cliente');
            $table->unsignedBigInteger('id_cliente');
            $table->enum('servicio', ['fibra', 'redes', 'cableado', 'telefonia']);
            $table->dateTime('fecha_registro')->useCurrent();
        
            $table->foreign('id_cliente')
                  ->references('id_cliente')
                  ->on('clientes')
                  ->onDelete('cascade');
        
            $table->index('id_cliente');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios_cliente');
    }
};
