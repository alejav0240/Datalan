<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    protected $model = Empleado::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('es_ES'); // Spanish locale for more realistic data
        return [
            'nombres' => $faker->firstNameMale(),
            'apellidos' => $faker->lastName() ,
            'ci' => $this->faker->unique()->numerify('########'),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '-18 years'),
            'genero' => $this->faker->randomElement(['masculino', 'femenino', 'otro']),
            'estado_civil' => $this->faker->randomElement(['soltero', 'casado', 'divorciado', 'viudo']),
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'contacto_emergencia' => $this->faker->name,
            'telefono_emergencia' => $this->faker->phoneNumber,
            'cargo' => $this->faker->jobTitle,
            'departamento' => $this->faker->word,
            'fecha_ingreso' => $this->faker->date('Y-m-d'),
            'salario' => $this->faker->randomFloat(2, 3000, 10000),
            'tipo_contrato' => $this->faker->randomElement(['indefinido', 'temporal', 'prueba', 'obra']),
            'habilidades' => $this->faker->words(5, true),
            'observaciones' => $this->faker->sentence,
            'activo' => $this->faker->boolean,
        ];
    }
}
