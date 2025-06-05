<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\User;
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
        $data = [
            'user_id' => $this->faker->numberBetween(1, 10),
            'cargo' => $this->faker->jobTitle,
            'experiencia' => $this->faker->numberBetween(1, 10),
            'equipo_id' => Equipo::factory(),
            'telefono' => $this->faker->phoneNumber,
            'ci' => $this->faker->unique()->numerify('########'),
            'salario' => $this->faker->randomFloat(2, 3000, 10000),
            'estado_civil' => $this->faker->randomElement(['soltero', 'casado', 'divorciado', 'viudo']),
        ];

        print "ID Factory".$data['user_id'] . "\n";
        return $data;
    }
}
