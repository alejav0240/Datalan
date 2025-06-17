@php
    $estados = [
        'pendiente' => 'Pendiente',
        'en_proceso' => 'En Proceso',
        'resuelto' => 'Resuelto'
    ];
@endphp

<x-app-layout>
    <style>
        .employee-card {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .info-label {
            @apply text-gray-600 dark:text-gray-300 font-semibold;
        }

        .info-value {
            @apply text-gray-800 dark:text-gray-100 font-medium;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .report-icon {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            border-radius: 0.75rem;
            width: 5rem;
            height: 5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
    
    <body class="bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
        <div class="min-h-screen flex flex-col">
            <!-- Main Content -->
            <main class="flex-grow container mx-auto px-4 py-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl employee-card overflow-hidden">
                    <!-- Report Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-700 dark:to-blue-900 text-white p-6 flex flex-col md:flex-row items-center">
                        <div class="report-icon mb-4 md:mb-0 md:mr-6">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-bold">Reporte #{{ $reporte->id }}</h3>
                            <h4 class="text-xl mt-1">{{ ucfirst($reporte->tipo_falla) }}</h4>
                            
                            <div class="flex flex-wrap items-center justify-center md:justify-start mt-3">
                                <span class="status-badge 
                                    {{ $reporte->estado === 'pendiente' ? 'bg-amber-600' : 
                                       ($reporte->estado === 'en_proceso' ? 'bg-blue-600' : 'bg-green-600') }} 
                                    text-white">
                                    {{ $estados[$reporte->estado] ?? ucfirst(str_replace('_', ' ', $reporte->estado)) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Tabs -->
                    <div class="border-b dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px">
                            <li class="mr-2">
                                <button data-tab="general" class="tab-link inline-block py-4 px-4 text-sm font-medium text-center border-b-2 border-blue-600 text-blue-600 rounded-t-lg active">
                                    <i class="fas fa-info-circle mr-2"></i>Información General
                                </button>
                            </li>
                            <li class="mr-2">
                                <button data-tab="cliente" class="tab-link inline-block py-4 px-4 text-sm font-medium text-center border-b-2 border-transparent rounded-t-lg hover:text-blue-600 hover:border-blue-600">
                                    <i class="fas fa-user mr-2"></i>Información del Cliente
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- General Information Tab -->
                        <div id="general" class="tab-content active">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="info-label">Tipo de Falla</div>
                                    <div class="info-value bg-gray-50 dark:bg-gray-700 p-4 rounded-md mt-1">
                                        {{ ucfirst($reporte->tipo_falla) }}
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="info-label">Estado Actual</div>
                                    <div class="info-value bg-gray-50 dark:bg-gray-700 p-4 rounded-md mt-1">
                                        <span class="status-badge 
                                            {{ $reporte->estado === 'pendiente' ? 'bg-amber-100 text-amber-800' : 
                                               ($reporte->estado === 'en_proceso' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                            {{ $estados[$reporte->estado] ?? ucfirst(str_replace('_', ' ', $reporte->estado)) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <div class="info-label">Descripción de la Falla</div>
                                    <div class="info-value bg-gray-50 dark:bg-gray-700 p-4 rounded-md mt-1">
                                        {{ $reporte->descripcion }}
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="info-label">Fecha del Reporte</div>
                                    <div class="info-value bg-gray-50 dark:bg-gray-700 p-4 rounded-md mt-1">
                                        {{ $reporte->created_at->format('d M, Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cliente Information Tab -->
                        <div id="cliente" class="tab-content">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="info-label">Nombre del Cliente</div>
                                    <div class="info-value bg-gray-50 dark:bg-gray-700 p-4 rounded-md mt-1">
                                        {{ $reporte->cliente->nombre }}
                                    </div>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <div class="info-label">Dirección</div>
                                    <div class="info-value bg-gray-50 dark:bg-gray-700 p-4 rounded-md mt-1">
                                        {{ $reporte->direccionAdicional->direccion }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="mt-8 flex flex-col sm:flex-row justify-between gap-4">
                            <a href="{{ route('reportes.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center justify-center">
                                <i class="fas fa-arrow-left mr-2"></i>Volver a la lista
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
        <script>
            // Tab Navigation
            document.addEventListener('DOMContentLoaded', function () {
                const tabLinks = document.querySelectorAll('.tab-link');
                const tabContents = document.querySelectorAll('.tab-content');

                tabLinks.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();

                        // Get target tab ID
                        const tabId = this.getAttribute('data-tab');

                        // Remove active class from all tabs
                        tabLinks.forEach(l => l.classList.remove('active', 'border-blue-600', 'text-blue-600'));
                        tabContents.forEach(c => c.classList.remove('active'));

                        // Add active class to current tab
                        this.classList.add('active', 'border-blue-600', 'text-blue-600');
                        document.getElementById(tabId).classList.add('active');
                    });
                });
            });
        </script>
    </body>
</x-app-layout>