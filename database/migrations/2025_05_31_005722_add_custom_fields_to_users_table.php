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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_empleado')->nullable()->after('id');
            $table->enum('nivel_acceso', ['empleado', 'supervisor', 'administrador'])->default('empleado')->after('password');
            $table->dateTime('ultimo_login')->nullable()->after('nivel_acceso');
            $table->boolean('activo')->default(true)->after('ultimo_login');
        
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_empleado']);
            $table->dropColumn(['id_empleado', 'nivel_acceso', 'ultimo_login', 'activo']);
        });
    }
};
