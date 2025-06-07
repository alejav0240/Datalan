@php
    $tipo_clientes = [
        'empresa' => 'Empresa',
        'gobierno' => 'Gobierno',
        'educacion' => 'Educación',
        'residencial' => 'Residencial',
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
                        @if(isset($cliente)) <i class="fas fa-edit mr-2"></i> Editar Cliente @else <i class="fas fa-user-plus mr-2"></i> Registrar Nuevo Cliente @endif
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        @if(isset($cliente)) Edita los detalles del cliente. @else Completa el formulario para agregar un nuevo cliente. @endif
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
                            <div class="mt-16">
                                <div class="flex items-center mb-6">
                                    <div class="bg-indigo-500 rounded-full p-4 mr-4">
                                        <i class="fas fa-id-card fa-lg"></i>
                                    </div>
                                    <p class="text-indigo-200 text-lg">Datos personales y contacto</p>
                                </div>
                                <div class="flex items-center mb-6">
                                    <div class="bg-indigo-500 rounded-full p-4 mr-4">
                                        <i class="fa-solid fa-briefcase fa-lg"></i>
                                    </div>
                                    <p class="text-indigo-200 text-lg">Información del cliente</p>
                                </div>
                            </div>
                        </div>

                        <!-- Formulario -->
                        <div class="md:w-2/3 p-8">
                            <!-- Acción dinámica dependiendo si es editar o crear -->
                            <form action="{{ isset($cliente) ? route('clientes.update', $cliente->id) : route('clientes.store') }}" method="POST">
                                @csrf
                                @if(isset($cliente))
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

                                <!-- Sección: Información Personal -->
                                <div class="mb-10">
                                    <div class="flex items-center mb-6">
                                        <div class="bg-indigo-100 dark:bg-indigo-700 p-2 rounded-full mr-3">
                                            <i class="fas fa-id-card fa-lg text-indigo-600 dark:text-indigo-300"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-black dark:text-white">Información del Cliente</h3>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Nombre -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Nombre Completo <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="nombre" value="{{ old('nombre', isset($cliente) ? $cliente->nombre : '') }}"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('nombre') input-error @enderror"
                                                placeholder="Ej: Juan Pérez">
                                            @error('nombre')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- NIT/CI -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                NIT/CI <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="nit_ci" value="{{ old('nit_ci', isset($cliente) ? $cliente->nit_ci : '') }}"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('nit_ci') input-error @enderror"
                                                placeholder="Ej: 1234567">
                                            @error('nit_ci')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Correo Electrónico <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="email_acceso" value="{{ old('email_acceso', isset($cliente) ? $cliente->user->email : '') }}"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('email_acceso') input-error @enderror"
                                                placeholder="juan@gmail.com">
                                            @error('email_acceso')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Teléfono -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Teléfono <span class="text-red-500">*</span>
                                            </label>
                                            <input type="tel" name="telefono" value="{{ old('telefono', isset($cliente) ? $cliente->telefono : '') }}"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('telefono') input-error @enderror"
                                                placeholder="Ej: 77712345">
                                            @error('telefono')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Tipo de Cliente -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Tipo de Cliente <span class="text-red-500">*</span>
                                            </label>
                                            <select name="tipo_cliente"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('tipo_cliente') input-error @enderror">
                                                <option value="" class="text-gray-500 dark:text-gray-400">Seleccione...</option>
                                                @foreach($tipo_clientes as $key => $tipo)
                                                    <option value="{{ $key }}" @selected(old('tipo_cliente', isset($cliente) ? $cliente->tipo_cliente : '') == $key)>{{ $tipo }}</option>
                                                @endforeach
                                            </select>
                                            @error('tipo_cliente')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Contraseña (Solo cuando se crea un cliente) -->
                                        @if(!isset($cliente))
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Contraseña <span class="text-red-500">*</span>
                                            </label>
                                            <input type="password" name="contrasena" value="{{ old('contrasena') }}"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('contrasena') input-error @enderror"
                                                placeholder="***********">
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Botón Enviar -->
                                <div
                                    class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t border-gray-200">
                                    <a href="{{ route('clientes.index') }}"
                                        class="px-6 py-3 text-center bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 transition">
                                        <i class="fas fa-arrow-left mr-2"></i> Cancelar
                                    </a>
                                    <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-700 text-white rounded-lg shadow hover:opacity-90 transition">
                                        @if(isset($cliente)) <i class="fas fa-save mr-2"></i> Actualizar Cliente @else <i class="fas fa-save mr-2"></i> Registrar Cliente @endif
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
