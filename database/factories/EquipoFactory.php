<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\Trabajo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class EquipoFactory extends Factory
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
            'trabajo_id' => Trabajo::factory(),
            'is_encargado' => $this->faker->boolean(20), // 20% probabilidad de ser encargado
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
