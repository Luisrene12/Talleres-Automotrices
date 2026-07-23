<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoServicioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\MecanicoController;
use App\Http\Controllers\RepuestoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MovimientoInventarioController;

// ─────────────────────────────────────────────────────────────────
// Rate Limiter: máximo 5 intentos de login por minuto por IP
// ─────────────────────────────────────────────────────────────────
RateLimiter::for('login-attempts', function (Request $request) {
    return \Illuminate\Cache\RateLimiting\Limit::perMinute(5)->by($request->ip());
});

// ─────────────────────────────────────────────────────────────────
// SPA Entry Points — devuelven el blade principal (welcome.blade)
// ─────────────────────────────────────────────────────────────────
Route::get('/', function () {
    // Auto-seed roles and users if database is empty
    if (\App\Models\Rol::count() === 0) {
        // Admin
        $rolAdmin = \App\Models\Rol::create([
            'nombre'      => 'Administrador',
            'descripcion' => 'Acceso total al sistema'
        ]);

        \App\Models\Usuario::create([
            'idRol'         => $rolAdmin->idRol,
            'nombreUsuario' => 'admin',
            'email'         => 'admin@empresa.com',
            'contrasena'    => \Illuminate\Support\Facades\Hash::make('Admin@2024'),
            'estado'        => 1
        ]);

        // Encargado
        $rolEncargado = \App\Models\Rol::create([
            'nombre'      => 'Encargado',
            'descripcion' => 'Gestión y control operativo'
        ]);

        \App\Models\Usuario::create([
            'idRol'         => $rolEncargado->idRol,
            'nombreUsuario' => 'encargado',
            'email'         => 'encargado@empresa.com',
            'contrasena'    => \Illuminate\Support\Facades\Hash::make('Encargado@2024'),
            'estado'        => 1
        ]);
    }
    return view('welcome');
});

// Ruta /login: si ya está autenticado redirige al inicio
Route::get('/login', function () {
    return view('welcome');
});

// Rutas SPA del panel administrativo
Route::get('/{view}', function () {
    return view('welcome');
})->where('view', 'panel|usuarios|roles|permisos|servicios|tipos-servicio|proveedores|clientes|vehiculos|citas|mecanicos|repuestos|inventario|movimientos-inventario');

// ─────────────────────────────────────────────────────────────────
// API Routes
// ─────────────────────────────────────────────────────────────────
Route::prefix('api')->group(function () {

    // ── CU01: Auth (rutas públicas) ────────────────────────────
    Route::post('/login',  [AuthController::class, 'login'])->middleware('throttle:login-attempts');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    // ── Rutas protegidas (requieren sesión activa) ─────────────
    Route::middleware('auth.session')->group(function () {

        // CU02: Usuarios, Roles, Permisos
        Route::apiResource('permisos', PermisoController::class);
        Route::apiResource('roles', RolController::class);
        Route::get('roles/{id}/permisos', [RolController::class, 'getRolPermisos']);
        Route::apiResource('usuarios', UsuarioController::class);

        // CU03: Servicios y Tipo de Servicios
        Route::apiResource('tipos-servicio', TipoServicioController::class);
        Route::apiResource('servicios', ServicioController::class);

        // CU04: Proveedores
        Route::apiResource('proveedores', ProveedorController::class);

        // CU06-CU09: Clientes, Vehículos, Citas
        Route::apiResource('clientes', ClienteController::class);
        Route::apiResource('vehiculos', VehiculoController::class);
        Route::get('/modelos-vehiculo', fn () => response()->json(\App\Models\ModeloVehiculo::with('marca')->get()));
        Route::apiResource('citas', CitaController::class);

        // CU11: Mecánicos
        Route::apiResource('mecanicos', MecanicoController::class);
        Route::get('/sucursales', fn () => response()->json(\App\Models\Sucursal::all()));
        Route::get('/especialidades', fn () => response()->json(\App\Models\Especialidad::all()));

        // CU05, CU16, CU17: Repuestos e Inventario
        Route::apiResource('repuestos', RepuestoController::class);
        Route::apiResource('inventario', InventarioController::class);
        Route::apiResource('movimientos-inventario', MovimientoInventarioController::class)->except(['update']);

        // Portal del Cliente
        Route::get('/client/profile',      [\App\Http\Controllers\ClientePortalController::class, 'getProfile']);
        Route::put('/client/profile',      [\App\Http\Controllers\ClientePortalController::class, 'updateProfile']);
        Route::get('/client/catalogo',     [\App\Http\Controllers\ClientePortalController::class, 'getCatalogo']);
        Route::get('/client/solicitudes',  [\App\Http\Controllers\ClientePortalController::class, 'getSolicitudes']);
        Route::post('/client/solicitudes', [\App\Http\Controllers\ClientePortalController::class, 'createSolicitud']);
    });
});


