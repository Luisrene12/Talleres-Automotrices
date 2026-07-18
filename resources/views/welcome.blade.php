<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SisGest Pro - Taller Automotriz</title>

    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Estilos del Dashboard -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client.css') }}">
</head>
<body>

    {{-- ================================================
         PANTALLA DE LOGIN
    ================================================ --}}
    @include('partials.login')

    {{-- ================================================
         BARRA LATERAL DE NAVEGACIÓN
    ================================================ --}}
    @include('partials.sidebar')

    {{-- ================================================
         CONTENIDO PRINCIPAL DEL DASHBOARD (ADMIN)
    ================================================ --}}
    @include('partials.dashboard')

    {{-- ================================================
         PORTAL DEL CLIENTE
    ================================================ --}}
    @include('partials.client_dashboard')

    {{-- ================================================
         MODALES Y NOTIFICACIONES
    ================================================ --}}
    @include('partials.modals')

    <!-- Lógica principal de la aplicación -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/client.js') }}"></script>

</body>
</html>
