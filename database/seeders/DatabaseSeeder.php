<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\User;
=======
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        $this->call([
            RolSeeder::class,
            PermisoSeeder::class,
            SucursalSeeder::class,
            UsuarioSeeder::class,
            ClienteSeeder::class,
            MecanicoSeeder::class,
            EspecialidadSeeder::class,
            MecanicoEspecialidadSeeder::class,
            TipoServicioSeeder::class,
            ServicioSeeder::class,
            ProveedorSeeder::class,
            RepuestoSeeder::class,
            MarcaVehiculoSeeder::class,
            ModeloVehiculoSeeder::class,
            VehiculoSeeder::class,
            InventarioSeeder::class,
            MetodoPagoSeeder::class,
            CitaSeeder::class,
            OrdenTrabajoSeeder::class,
            DetalleOrdenTrabajoSeeder::class,
            DiagnosticoSeeder::class,
            FacturaSeeder::class,
            PagoSeeder::class,
            MovimientoInventarioSeeder::class,
        ]);
=======
        // Seeders del proyecto van aquí
>>>>>>> 43ff2de7940d8b9d579126fd0270cc0bea397d44
    }
}
