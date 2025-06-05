<?php

namespace Database\Factories;

use App\Models\Equipo;
use App\Models\ReporteFalla;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trabajo>
 */
class TrabajoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reporte_id' => ReporteFalla::factory(),
            'equipo_id' => Equipo::factory(),
            'estado' => $this->faker->randomElement(['pendiente', 'en_proceso', 'completado']),
            'fecha_asignacion' => now(),
            'fecha_resolucion' => now()->addDays(rand(1, 7)),
        ];
    }
}
