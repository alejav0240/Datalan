<?php

namespace Database\Seeders;

use App\Models\DireccionAdicional;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\ReporteFalla;
use App\Models\Trabajo;
use App\Models\Equipo;
use App\Models\Permiso;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear empleados
        $this->call(EmpleadoSeeder::class);

        // Crear clientes
        $this->call(ClienteSeeder::class);

//        // Crear reportes de falla
//        $this->call(ReporteFallaSeeder::class);
//
//        // Crear trabajos
//        $this->call(TrabajoSeeder::class);
//
//        // Crear equipos
//        $this->call(EquipoSeeder::class);
//
//        // Crear permisos
//        $this->call(PermisoSeeder::class);
//
//        // Crear direcciones adicionales para clientes
//        $this->call(DireccionAdicionalSeeder::class);
    }
}
