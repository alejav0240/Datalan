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
        Schema::create('direcciones_adicionales', function (Blueprint $table) {
            $table->id('id_direccion');
            $table->unsignedBigInteger('id_cliente');
            $table->text('direccion');
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
        Schema::dropIfExists('direcciones_adicionales');
    }
};
