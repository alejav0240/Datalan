<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReporteFalla>
 */
class ReporteFallaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory(),
            'tipo_fallo' => $this->faker->word,
            'descripcion' => $this->faker->paragraph,
            'estado' => $this->faker->randomElement(['pendiente', 'asignado', 'resuelto']),
            'fecha' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'cordenadas_destino' => $this->faker->latitude . ',' . $this->faker->longitude,
            'cordenadas_origin' => $this->faker->latitude . ',' . $this->faker->longitude,
            'direccion' => $this->faker->address,
        ];
    }
}
