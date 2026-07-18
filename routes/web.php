<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoServicioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ProveedorController;

Route::get('/', function () {
    // Auto-seed roles and users if database is empty
    if (\App\Models\Rol::count() === 0) {
        // Admin
        $rolAdmin = \App\Models\Rol::create([
            'nombre' => 'Administrador',
            'descripcion' => 'Acceso total al sistema'
        ]);
        
        \App\Models\Usuario::create([
            'idRol' => $rolAdmin->idRol,
            'nombreUsuario' => 'admin',
            'email' => 'admin@empresa.com',
            'contrasena' => \Illuminate\Support\Facades\Hash::make('Admin@2024'),
            'estado' => 1
        ]);

        // Encargado
        $rolEncargado = \App\Models\Rol::create([
            'nombre' => 'Encargado',
            'descripcion' => 'Gestión y control operativo'
        ]);

        \App\Models\Usuario::create([
            'idRol' => $rolEncargado->idRol,
            'nombreUsuario' => 'encargado',
            'email' => 'encargado@empresa.com',
            'contrasena' => \Illuminate\Support\Facades\Hash::make('Encargado@2024'),
            'estado' => 1
        ]);
    }
    return view('welcome');
});

Route::prefix('api')->group(function () {
    // CU01: Auth
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

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

    // Client Portal
    Route::get('/client/profile', [\App\Http\Controllers\ClientePortalController::class, 'getProfile']);
    Route::put('/client/profile', [\App\Http\Controllers\ClientePortalController::class, 'updateProfile']);
    Route::get('/client/catalogo', [\App\Http\Controllers\ClientePortalController::class, 'getCatalogo']);
    Route::get('/client/solicitudes', [\App\Http\Controllers\ClientePortalController::class, 'getSolicitudes']);
    Route::post('/client/solicitudes', [\App\Http\Controllers\ClientePortalController::class, 'createSolicitud']);
});

Route::get('/setup-client', function () {
    $cliente = \App\Models\Cliente::first();
    if (!$cliente) {
        return 'No hay clientes creados. Ve al sistema y crea uno primero en la base de datos (o haz un INSERT) para probar.';
    }

    $rolCliente = \App\Models\Rol::firstOrCreate(
        ['nombre' => 'Cliente'],
        ['descripcion' => 'Acceso al portal de cliente']
    );

    $usuario = \App\Models\Usuario::where('email', 'cliente@correo.com')->first();
    if (!$usuario) {
        $usuario = \App\Models\Usuario::create([
            'idRol' => $rolCliente->idRol,
            'nombreUsuario' => 'cliente1',
            'email' => 'cliente@correo.com',
            'contrasena' => \Illuminate\Support\Facades\Hash::make('Cliente123'),
            'estado' => 1
        ]);
    }

    $cliente->idUsuario = $usuario->idUsuario;
    $cliente->save();

    return '¡Usuario cliente configurado! Ahora puedes iniciar sesión con cliente@correo.com y contraseña Cliente123';
});

