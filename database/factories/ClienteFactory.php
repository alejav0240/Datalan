<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'tipo_cliente' => $this->faker->randomElement(['empresa', 'gobierno', 'educacion', 'residencial']),
            'nombre' => $this->faker->name,
            'empresa' => $this->faker->company,
            'razon_social' => $this->faker->randomNumber(5),
            'telefono' => $this->faker->phoneNumber
        ];
    }
}
