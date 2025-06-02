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
            'tipo_cliente' => $this->faker->randomElement(['empresa', 'gobierno', 'educacion', 'residencial']),
            'nombre_cliente' => $this->faker->company,
            'nit_ci' => $this->faker->unique()->numerify('##########'),
            'rubro' => $this->faker->optional()->word,
            'direccion_principal' => $this->faker->address,
            'telefono' => $this->faker->numerify('##########'),
            'celular' => $this->faker->optional()->numerify('##########'),
            'email_acceso' => $this->faker->unique()->safeEmail,
            'contrasena' => bcrypt('password'),
            'referencia' => $this->faker->optional()->randomElement(['recomendacion', 'publicidad', 'busqueda', 'redes', 'otro']),
            'observaciones' => $this->faker->optional()->text,
            'fecha_registro' => $this->faker->dateTimeThisYear(),
            'activo' => $this->faker->boolean,
        ];
    }
}
