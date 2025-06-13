@php
    $tipos_trabajo = [
        'instalacion' => 'Instalación',
        'mantenimiento' => 'Mantenimiento',
        'reparacion' => 'Reparación',
        'configuracion' => 'Configuración',
        'otro' => 'Otro'
    ];
    
    $prioridades = [
        'normal' => 'Normal',
        'alta' => 'Alta',
        'urgente' => 'Urgente'
    ];
    
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

        .role-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
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

        .priority-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .work-icon {
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
    </style>
    
    <body class="bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
        <div class="min-h-screen flex flex-col">
            <!-- Main Content -->
            <main class="flex-grow container mx-auto px-4 py-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl employee-card overflow-hidden">
                    <!-- Work Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-700 dark:to-blue-900 text-white p-6 flex flex-col md:flex-row items-center">
                        <div class="work-icon mb-4 md:mb-0 md:mr-6">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-bold">Trabajo #{{ $trabajo->id }}</h3>
                            <h4 class="text-xl mt-1">{{ $tipos_trabajo[$trabajo->tipo_trabajo] ?? $trabajo->tipo_trabajo }}</h4>
                            
                            <div class="flex flex-wrap items-center justify-center md:justify-start mt-3">
                                <span class="priority-badge 
                                    {{ $trabajo->prioridad === 'normal' ? 'bg-emerald-600' : 
                                       ($trabajo->prioridad === 'alta' ? 'bg-amber-600' : 'bg-red-600') }} 
                                    text-white mr-2">
                                    {{ $prioridades[$trabajo->prioridad] ?? ucfirst($trabajo->prioridad) }}
                                </span>
                                
                                <span class="status-badge 
                                    {{ $trabajo->reporte->estado === 'pendiente' ? 'bg-amber-600' : 
                                       ($trabajo->reporte->estado === 'en_proceso' ? 'bg-blue-600' : 'bg-green-600') }} 
                                    text-white">
                                    {{ $estados[$trabajo->reporte->estado] ?? ucfirst(str_replace('_', ' ', $trabajo->reporte->estado)) }}
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
                                <button data-tab="reporte" class="tab-link inline-block py-4 px-4 text-sm font-medium text-center border-b-2 border-transparent rounded-t-lg hover:text-blue-600 hover:border-blue-600">
                                    <i class="fas fa-file-alt mr-2"></i>Reporte de Falla
                                </button>
                            </li>
                            <li class="mr-2">
                                <button data-tab="equipo" class="tab-link inline-block py-4 px-4 text-sm font-medium text-center border-b-2 border-transparent rounded-t-lg hover:text-blue-600 hover:border-blue-600">
                                    <i class="fas fa-users mr-2"></i>Equipo Asignado
                                </button>
                            </li>
                            <li class="mr-2">
                                <button data-tab="materiales" class="tab-link inline-block py-4 px-4 text-sm font-medium text-center border-b-2 border-transparent rounded-t-lg hover:text-blue-600 hover:border-blue-600">
                                    <i class="fas fa-boxes mr-2"></i>Materiales
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Contents -->
                    <div class="p-6">
                        <!-- General Information Tab -->
                        <div id="general" class="tab-content active">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="info-label">Tipo de Trabajo</div>
                                    <div class="info-value">
                                        {{ $tipos_trabajo[$trabajo->tipo_trabajo] ?? $trabajo->tipo_trabajo }}
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="info-label">Prioridad</div>
                                    <div class="info-value flex items-center">
                                        <span class="priority-badge 
                                            {{ $trabajo->prioridad === 'normal' ? 'bg-emerald-100 text-emerald-800' : 
                                               ($trabajo->prioridad === 'alta' ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800') }} 
                                            mr-2">
                                            {{ $prioridades[$trabajo->prioridad] ?? ucfirst($trabajo->prioridad) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="info-label">Estado del Reporte</div>
                                    <div class="info-value">
                                        <span class="status-badge 
                                            {{ $trabajo->reporte->estado === 'pendiente' ? 'bg-amber-100 text-amber-800' : 
                                               ($trabajo->reporte->estado === 'en_proceso' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                            {{ $estados[$trabajo->reporte->estado] ?? ucfirst(str_replace('_', ' ', $trabajo->reporte->estado)) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="info-label">Fecha de Creación</div>
                                    <div class="info-value">
                                        {{ $trabajo->created_at->format('d M, Y h:i A') }}
                                    </div>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <div class="info-label">Descripción</div>
                                    <div class="info-value bg-gray-50 dark:bg-gray-700 p-4 rounded-md mt-1">
                                        {{ $trabajo->descripcion }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reporte de Falla Tab -->
                        <div id="reporte" class="tab-content">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="info-label">Cliente</div>
                                    <div class="info-value">
                                        {{ $trabajo->reporte->cliente->nombre }}
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="info-label">Tipo de Falla</div>
                                    <div class="info-value">
                                        {{ $trabajo->reporte->tipo_falla }}
                                    </div>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <div class="info-label">Dirección</div>
                                    <div class="info-value bg-gray-50 dark:bg-gray-700 p-4 rounded-md mt-1">
                                        {{ $trabajo->reporte->direccionAdicional->direccion }}
                                    </div>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <div class="info-label">Descripción de la Falla</div>
                                    <div class="info-value bg-gray-50 dark:bg-gray-700 p-4 rounded-md mt-1">
                                        {{ $trabajo->reporte->descripcion }}
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="info-label">Fecha del Reporte</div>
                                    <div class="info-value">
                                        {{ $trabajo->reporte->created_at->format('d M, Y') }}
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="info-label">Estado Actual</div>
                                    <div class="info-value">
                                        <span class="status-badge 
                                            {{ $trabajo->reporte->estado === 'pendiente' ? 'bg-amber-100 text-amber-800' : 
                                               ($trabajo->reporte->estado === 'en_proceso' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                            {{ $estados[$trabajo->reporte->estado] ?? ucfirst(str_replace('_', ' ', $trabajo->reporte->estado)) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Equipo Asignado Tab -->
                        <div id="equipo" class="tab-content">
                            @if($trabajo->empleados->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($trabajo->empleados as $empleado)
                                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 flex items-center">
                                            <div class="bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 rounded-full w-12 h-12 flex items-center justify-center mr-4">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="font-bold text-gray-800 dark:text-white">{{ $empleado->user->name }}</h4>
                                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $empleado->cargo }}</p>
                                            </div>
                                            @if($empleado->pivot->is_encargado)
                                                <span class="bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 px-3 py-1 rounded-full text-xs font-bold">
                                                    Encargado
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-users text-4xl text-gray-300 dark:text-gray-600 mb-4"></i>
                                    <p class="text-gray-500 dark:text-gray-400">No se han asignado empleados a este trabajo</p>
                                </div>
                            @endif
                        </div>

                        <!-- Materiales Tab -->
                        <div id="materiales" class="tab-content">
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <div class="info-label">Materiales Requeridos</div>
                                    <div class="info-value bg-gray-50 dark:bg-gray-700 p-4 rounded-md mt-1 whitespace-pre-line">
                                        {{ $trabajo->materiales ?: 'No se han especificado materiales' }}
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="info-label">Observaciones de Materiales</div>
                                    <div class="info-value bg-gray-50 dark:bg-gray-700 p-4 rounded-md mt-1 whitespace-pre-line">
                                        {{ $trabajo->observaciones_materiales ?: 'No hay observaciones adicionales' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="p-6 border-t dark:border-gray-700">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <div class="info-label">Fecha de Creación</div>
                                <div class="info-value">{{ $trabajo->created_at->format('d M, Y h:i A') }}</div>
                            </div>

                            <div>
                                <div class="info-label">Última Actualización</div>
                                <div class="info-value">{{ $trabajo->updated_at->format('d M, Y h:i A') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="p-6 border-t dark:border-gray-700 flex flex-col sm:flex-row justify-between gap-4">
                        <a href="{{ route('trabajos.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>Volver a la lista
                        </a>
                        
                        <div class="flex flex-wrap justify-center gap-2">
                            <a href="{{ route('trabajos.edit', $trabajo->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                                <i class="fas fa-edit mr-2"></i>Editar
                            </a>
                            
                            <form action="{{ route('trabajos.destroy', $trabajo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este trabajo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                                    <i class="fas fa-trash-alt mr-2"></i>Eliminar
                                </button>
                            </form>
                            
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition flex items-center" onclick="window.print()">
                                <i class="fas fa-print mr-2"></i>Imprimir
                            </button>
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