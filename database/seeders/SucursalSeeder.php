<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    public function run(): void
    {
        $sucursales = [
            ['nombre' => 'Sucursal Central', 'direccion' => 'Av. Principal #123', 'telefono' => '2244-5566', 'ciudad' => 'Santa Cruz'],
            ['nombre' => 'Sucursal Norte', 'direccion' => 'Calle Norte #456', 'telefono' => '2244-7788', 'ciudad' => 'Santa Cruz'],
        ];

        foreach ($sucursales as $sucursal) {
            Sucursal::firstOrCreate(['nombre' => $sucursal['nombre']], $sucursal);
        }
    }
}
