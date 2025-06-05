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
        // Crear administradores
        User::factory()->count(2)->create(['role' => 'administrador']);

        // Crear empleados con usuarios
        $empleados = collect();
        for ($i = 0; $i < 15; $i++) {
            $user = User::factory()->create(['role' => 'empleado']);
            $empleados->push(Empleado::factory()->create(['user_id' => $user->id]));
        }

        // Crear clientes y reportes de fallas
        for ($i = 0; $i < 10; $i++) {
            $clienteUser = User::factory()->create(['role' => 'cliente']);
            $cliente = Cliente::factory()->create(['user_id' => $clienteUser->id]);

            // Crear direcciones adicionales
            DireccionAdicional::factory()->count(2)->create(['id_cliente' => $cliente->id]);

            // Crear 2 reportes por cliente
            for ($j = 0; $j < 2; $j++) {
                $reporte = ReporteFalla::factory()->create(['cliente_id' => $cliente->id]);

                // Crear trabajo relacionado con el reporte
                $trabajo = Trabajo::factory()->create([
                    'reporte_id' => $reporte->id,
                ]);

                // Asignar de 2 a 4 empleados a este trabajo
                $empleadosAsignados = $empleados->random(rand(2, 4))->values();

                foreach ($empleadosAsignados as $index => $empleado) {
                    Equipo::create([
                        'empleado_id' => $empleado->id,
                        'trabajo_id' => $trabajo->id,
                        'is_encargado' => $index === 0, // solo el primero es el encargado
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // Crear permisos de ausencia para algunos empleados
        $empleados->random(5)->each(function ($empleado) {
            Permiso::factory()->create(['empleado_id' => $empleado->id]);
        });
    }
}
