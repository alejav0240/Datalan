<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datalan Bolivia - Soluciones en Telecomunicaciones</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }   
    </style>
</head>
<script src="{{ mix('js/app.js') }}"></script>

<body class="bg-white text-gray-900">

    <!-- ENCABEZADO -->
    <x-info.info-header />

    <!-- SECCIÓN HERO -->
    <x-info.info-hero />

    <!-- SECCIÓN PARA INFORMACIÓN EXTRA -->
    @auth
        <x-info.info-direcciones/>
    @endauth

    <!-- SECCIÓN EMPRESA -->
    <x-info.info-empresa />

    <!-- SECCIÓN SERVICIOS -->
    <x-info.info-servicios />

    <!-- SECCIÓN PRODUCTOS -->
    <x-info.info-productos />

    <!-- SECCIÓN CONTACTO -->
    <x-info.info-contacto />



    <!-- PIE DE PÁGINA -->
    <x-info.info-footer />

</body>

</html>