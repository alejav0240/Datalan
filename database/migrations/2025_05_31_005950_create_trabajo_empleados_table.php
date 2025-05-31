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
        Schema::create('trabajo_empleados', function (Blueprint $table) {
            $table->unsignedBigInteger('id_trabajo');
            $table->unsignedBigInteger('id_empleado');

            $table->primary(['id_trabajo', 'id_empleado']);

            $table->foreign('id_trabajo')
                  ->references('id_trabajo')
                  ->on('trabajos')
                  ->onDelete('cascade');

            $table->foreign('id_empleado')
                  ->references('id_empleado')
                  ->on('empleados')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajo_empleados');
    }
};
