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
        User::create([
            'name' => 'Juan Pérez',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$y6EpF8XefmhPkxx9b1oHgOH380.xBL5ig7KBXVr9jSpdBWW.g/18a',
            'role' => 'administrador',
        ]);
        Empleado::create([
            'user_id' => 1,
            'cargo' => 'Administrador',
            'experiencia' => 5,
            'telefono' => '123456789',
            'ci' => '12345678',
            'salario' => 8000,
            'estado_civil' => 'soltero',
        ]);

//        for ($i = 1; $i <= 11; $i++) {
//            $user = User::create([
//                'name' => "Empleado $i",
//                'email' => "empleado$i@example.com",
//                'password' => bcrypt('password123'),
//                'role' => 'empleado',
//            ]);
//
//            Empleado::create([
//                'user_id' => $user->id,
//                'cargo' => 'Desarrollador',
//                'experiencia' => rand(1, 10),
//                'telefono' => '123456789',
//                'ci' => str_pad($i, 8, '0', STR_PAD_LEFT),
//                'salario' => rand(3000, 10000),
//                'estado_civil' => 'soltero',
//            ]);
//        }
    }
}
