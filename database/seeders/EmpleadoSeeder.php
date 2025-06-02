<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;
use App\Models\User;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            // Crear un empleado
            $empleado = Empleado::factory()->create();

            // Crear un usuario asociado al empleado
            User::create([
                'id_empleado' => $empleado->id,
                'name' => $empleado->nombres . ' ' . $empleado->apellidos,
                'email' => $empleado->email,
                'password' => bcrypt('admin'),
            ]);
        }

    }
}
