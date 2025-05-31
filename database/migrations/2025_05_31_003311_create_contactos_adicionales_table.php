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
        Schema::create('contactos_adicionales', function (Blueprint $table) {
            $table->id('id_contacto');
            $table->unsignedBigInteger('id_cliente');
            $table->string('nombre_completo', 100);
            $table->string('cargo', 100)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email', 100)->nullable();
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
        Schema::dropIfExists('contactos_adicionales');
    }
};
