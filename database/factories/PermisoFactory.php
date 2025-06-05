<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permiso>
 */
class PermisoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'empleado_id' => Empleado::factory(),
            'motivo' => $this->faker->sentence,
            'estado' => $this->faker->randomElement(['pendiente', 'aprobado', 'rechazado']),
            'fecha_solicitud' => now(),
        ];
    }
}
