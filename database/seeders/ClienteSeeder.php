<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 11; $i++) {
            $user = User::create([
                'name' => "Cliente $i",
                'email' => "cliente$i@example.com",
                'password' => bcrypt('password123'),
                'role' => 'cliente',
            ]);

            Cliente::create([
                'user_id' => $user->id,
                'tipo_cliente' => 'empresa',
                'nombre' => "Cliente $i",
                'nit_ci' => str_pad($i, 8, '0', STR_PAD_LEFT),
                'telefono' => '7234569' . $i,
            ]);
        }
    }
}
