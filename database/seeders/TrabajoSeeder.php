<?php

namespace Database\Seeders;

use App\Models\Trabajo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trabajo::create([
            'reporte_id' => 1,
            'tipo_trabajo' => 'instalacion',
            'descripcion' => 'Instalación de nueva conexión de fibra óptica para cliente residencial. Incluye tendido de cable, fusión de conectores y configuración de ONT.',
            'origen_nombre' => 'Central El Alto',
            'origen_direccion' => 'Avenida 6 de Marzo, El Alto, La Paz',
            'origen_lat' => -16.5000,
            'origen_lng' => -68.1667,
            'destino_nombre' => 'Residencia Cliente Rodríguez',
            'destino_direccion' => 'Calle 21 de Calacoto, Zona Sur, La Paz',
            'destino_lat' => -16.5560,
            'destino_lng' => -68.0833,
            'prioridad' => 'alta',
            'materiales_json' => json_encode([
                ['material' => 'Cable fibra óptica SM', 'cantidad' => '200m'],
                ['material' => 'ONT', 'cantidad' => '1'],
                ['material' => 'Conectores SC/APC', 'cantidad' => '4']
            ]),
            'observaciones_materiales' => 'Se necesita un rollo de cable de 200m y la ONT modelo Huawei HG8245H.',
        ]);
    }
}
