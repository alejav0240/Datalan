@php
    $estados = [
        'pendiente' => 'Pendiente',
        'aprobado' => 'Aprobado',
        'rechazado' => 'Rechazado',
    ];
@endphp
<x-app-layout>
    <body class="bg-gradient-to-br from-indigo-50 to-purple-50 min-h-screen">
        <style>
            .form-card {
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                border-radius: 1.5rem;
            }

            .input-error {
                border-color: #f87171;
            }

            .error-message {
                color: #ef4444;
                font-size: 0.875rem;
                margin-top: 0.25rem;
            }

            .input-focus:focus {
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
            }
        </style>
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto">
                <!-- Encabezado -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-indigo-800 mb-3">
                        @if(isset($permiso)) <i class="fas fa-edit mr-2"></i> Editar Permiso @else <i class="fas fa-calendar-check mr-2"></i> Solicitar Nuevo Permiso @endif
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        @if(isset($permiso)) Edita los detalles del permiso. @else Completa el formulario para solicitar un nuevo permiso. @endif
                    </p>
                </div>

                <!-- Tarjeta del Formulario -->
                <div class="form-card dark:bg-gray-800 text-white overflow-hidden">
                    <div class="md:flex">
                        <!-- Panel Lateral Decorativo -->
                        <div class="hidden md:block md:w-1/3 bg-gradient-to-b from-indigo-600 to-purple-700 p-8">
                            <div class="text-white mb-8">
                                <h2 class="text-xl font-bold mb-2">Información Requerida</h2>
                                <p class="text-indigo-200 text-sm">Todos los campos marcados con (*) son obligatorios
                                </p>
                            </div>
                        </div>

                        <!-- Formulario -->
                        <div class="md:w-2/3 p-8">
                            <!-- Acción dinámica dependiendo si es editar o crear -->
                            <form action="{{ isset($permiso) ? route('permisos.update', $permiso->id) : route('permisos.store') }}" method="POST">
                                @csrf
                                @if(isset($permiso))
                                    @method('PUT') <!-- Si es edición, usamos PUT -->
                                @endif

                                <!-- Mensajes de error generales -->
                                @if ($errors->any())
                                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                                        <strong class="font-bold">¡Error!</strong>
                                        <ul class="mt-2 list-disc list-inside">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Sección: Información del Permiso -->
                                <div class="mb-10">
                                    <div class="flex items-center mb-6">
                                        <div class="bg-indigo-100 dark:bg-indigo-700 p-2 rounded-full mr-3">
                                            <i class="fas fa-calendar-check fa-lg text-indigo-600 dark:text-indigo-300"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-black dark:text-white">Información del Permiso</h3>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Motivo -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Motivo <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="motivo" value="{{ old('motivo', isset($permiso) ? $permiso->motivo : '') }}"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('motivo') input-error @enderror"
                                                placeholder="Ej: Necesito un día libre">
                                            @error('motivo')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Fecha de Solicitud -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Fecha de Inicio <span class="text-red-500">*</span>
                                            </label>
                                            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', isset($permiso) ? $permiso->fecha_inicio : '') }}"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('fecha_inicio') input-error @enderror">
                                            @error('fecha_inicio')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Fecha de Fin <span class="text-red-500">*</span>
                                            </label>
                                            <input type="date" name="fecha_fin" value="{{ old('fecha_fin', isset($permiso) ? $permiso->fecha_fin : '') }}"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('fecha_fin') input-error @enderror">
                                            @error('fecha_fin')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Empleado (Campo oculto) -->
                                        <input type="hidden" name="empleado_id" value="{{ Auth::user()->empleado->id }}">

                                    </div>
                                </div>

                                <!-- Botón Enviar -->
                                <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t border-gray-200">
                                    <a href="{{ route('permisos.index') }}"
                                        class="px-6 py-3 text-center bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 transition">
                                        <i class="fas fa-arrow-left mr-2"></i> Cancelar
                                    </a>
                                    <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-700 text-white rounded-lg shadow hover:opacity-90 transition">
                                        @if(isset($permiso)) <i class="fas fa-save mr-2"></i> Actualizar Permiso @else <i class="fas fa-save mr-2"></i> Solicitar Permiso @endif
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    </body>
</x-app-layout>
