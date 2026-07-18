<?php
// Script temporal para crear usuario cliente de prueba
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

// 1. Crear/buscar el rol Cliente
$rol = Rol::where('nombre', 'Cliente')->first();
if (!$rol) {
    $rol = Rol::create(['nombre' => 'Cliente', 'descripcion' => 'Acceso al portal de cliente']);
    echo "Rol 'Cliente' creado (ID: {$rol->idRol})\n";
} else {
    echo "Rol 'Cliente' encontrado (ID: {$rol->idRol})\n";
}

// 2. Crear/buscar el usuario cliente
$usuario = Usuario::where('email', 'cliente@correo.com')->first();
if (!$usuario) {
    $usuario = Usuario::create([
        'idRol'        => $rol->idRol,
        'nombreUsuario' => 'cliente1',
        'email'        => 'cliente@correo.com',
        'contrasena'   => Hash::make('Cliente123'),
        'estado'       => 1,
    ]);
    echo "Usuario creado: {$usuario->email} (ID: {$usuario->idUsuario})\n";
} else {
    // Actualizar contraseña de todas formas
    $usuario->contrasena = Hash::make('Cliente123');
    $usuario->save();
    echo "Usuario ya existia: {$usuario->email} (ID: {$usuario->idUsuario}) - contraseña actualizada\n";
}

// 3. Enlazar con el primer cliente en la BD
$cliente = Cliente::first();
if ($cliente) {
    $cliente->idUsuario = $usuario->idUsuario;
    $cliente->save();
    echo "Cliente '{$cliente->nombreCompleto}' enlazado al usuario.\n";
} else {
    echo "ADVERTENCIA: No hay registros en la tabla 'cliente'. Ingresa al sistema como admin y crea un cliente primero.\n";
}

echo "\n=== LISTO ===\n";
echo "Puedes iniciar sesion con:\n";
echo "  Email:     cliente\@correo.com\n";
echo "  Contraseña: Cliente123\n";
