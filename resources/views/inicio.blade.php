<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datalan Bolivia - Soluciones en Telecomunicaciones</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css' rel='stylesheet' />

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

</head>

<body class="bg-white text-gray-900">

    <!-- ENCABEZADO -->
    <x-info.info-header />

    <!-- SECCIÓN HERO -->
    <x-info.info-hero />

    <!-- SECCIÓN PARA INFORMACIÓN EXTRA -->
    @auth
        <x-info.info-direcciones />
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

    @if (session('success'))
        <div id="toastSuccess"
            class="fixed bottom-6 right-6 z-50 bg-green-700 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 animate-slide-in">
            <i class="fas fa-check-circle text-xl"></i>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>

        <script>
            // Ocultar automáticamente después de 4 segundos
            setTimeout(() => {
                const toast = document.getElementById('toastSuccess');
                if (toast) {
                    toast.classList.add('opacity-0', 'translate-y-4');
                    setTimeout(() => toast.remove(), 500);
                }
            }, 4000);
        </script>
    @endif


</body>

</html>