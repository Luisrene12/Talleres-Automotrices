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

        // Cliente
        $rolCliente = \App\Models\Rol::create([
            'nombre'      => 'Cliente',
            'descripcion' => 'Acceso al portal de cliente'
        ]);

        $usuarioCliente = \App\Models\Usuario::create([
            'idRol'         => $rolCliente->idRol,
            'nombreUsuario' => 'cliente1',
            'email'         => 'cliente@correo.com',
            'contrasena'    => \Illuminate\Support\Facades\Hash::make('Cliente123'),
            'estado'        => 1
        ]);

        \App\Models\Cliente::create([
            'idUsuario'      => $usuarioCliente->idUsuario,
            'nombreCompleto' => 'Juan Pérez (Cliente Demo)',
            'ci_nit'         => '1234567',
            'telefono'       => '70000000',
            'direccion'      => 'Av. Principal #123'
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
})->where('view', 'panel|usuarios|roles|permisos|servicios|tipos-servicio|proveedores');

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

        // Portal del Cliente
        Route::get('/client/profile',      [\App\Http\Controllers\ClientePortalController::class, 'getProfile']);
        Route::put('/client/profile',      [\App\Http\Controllers\ClientePortalController::class, 'updateProfile']);
        Route::get('/client/catalogo',     [\App\Http\Controllers\ClientePortalController::class, 'getCatalogo']);
        Route::get('/client/solicitudes',  [\App\Http\Controllers\ClientePortalController::class, 'getSolicitudes']);
        Route::post('/client/solicitudes', [\App\Http\Controllers\ClientePortalController::class, 'createSolicitud']);
    });
});


