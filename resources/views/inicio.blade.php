<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datalan Bolivia - Soluciones en Telecomunicaciones</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js'></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        primaryDark: '#1d4ed8',
                        primaryLight: '#dbeafe',
                        secondary: '#64748b',
                        success: '#10b981',
                        danger: '#ef4444',
                        warning: '#f59e0b',
                        light: '#f8fafc',
                        dark: '#1e293b',
                    },
                    borderRadius: {
                        xl: '16px',
                    },
                    boxShadow: {
                        card: '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05)',
                        button: '0 4px 6px -1px rgba(37, 99, 235, 0.3), 0 2px 4px -1px rgba(37, 99, 235, 0.1)',
                        buttonHover: '0 10px 15px -3px rgba(37, 99, 235, 0.3), 0 4px 6px -2px rgba(37, 99, 235, 0.15)',
                        map: '0 4px 6px -1px rgba(0, 0, 0, 0.05)',
                        notification: '0 10px 25px -5px rgba(0, 0, 0, 0.1)',
                    },
                    transitionProperty: {
                        'all': 'all',
                    },
                }
            }
        }
    </script>
    <style>
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading-spinner {
            border: 3px solid rgba(59, 130, 246, 0.2);
            border-top-color: #3b82f6;
            animation: spin 1s linear infinite;
        }

        .notification {
            transform: translateX(150%);
            transition: transform 0.4s ease;
        }

        .notification.show {
            transform: translateX(0);
        }

        .map-overlay {
            backdrop-filter: blur(4px);
        }
    </style>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

</head>

<body class="bg-white text-gray-900">

    <!-- ENCABEZADO -->
    <x-info.info-header :cliente="$cliente ?? null" :direcciones="$direcciones ?? collect()" :reportes="$reportes ?? collect()" />

    <!-- SECCIÓN HERO -->
    <x-info.info-hero />

    <!-- SECCIÓN PARA INFORMACIÓN EXTRA -->
@auth
    @if(Auth::user()->role == 'cliente')
        <div class="w-full flex flex-col md:flex-row gap-4 px-4 sm:px-6 lg:px-8 py-6">
            <div class="w-full md:w-1/2">
                <x-info.info-direcciones />
            </div>
            <div class="w-full md:w-1/2">
                <x-info.info-reportes :direcciones="$direcciones ?? collect()" />
            </div>
        </div>
    @endif
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

    @if (session('error'))
        <div id="toastError"
            class="fixed bottom-6 right-6 z-50 bg-red-700 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 animate-slide-in">
            <i class="fas fa-exclamation-circle text-xl"></i>
            <span class="font-semibold">{{ session('error') }}</span>
        </div>

        <script>
            // Ocultar automáticamente después de 4 segundos
            setTimeout(() => {
                const toast = document.getElementById('toastError');
                if (toast) {
                    toast.classList.add('opacity-0', 'translate-y-4');
                    setTimeout(() => toast.remove(), 500);
                }
            }, 4000);
        </script>
    @endif


</body>

</html>
