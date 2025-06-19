@php
    $roles = [
        'empleado' => 'Empleado',
        'supervisor' => 'Supervisor',
        'administrador' => 'Administrador',
        'cliente' => 'Cliente',
    ];
    $estados_civiles = [
        'soltero' => 'Soltero/a',
        'casado' => 'Casado/a',
        'divorciado' => 'Divorciado/a',
        'viudo' => 'Viudo/a'
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
                    <i class="fas fa-user-plus mr-2"></i> Editar Empleado
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Completa el formulario para agregar un nuevo miembro a tu equipo de trabajo
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
                                <p class="text-indigo-200 text-lg">Información laboral</p>
                            </div>
                            <div class="flex items-center mb-6">
                                <div class="bg-indigo-500 rounded-full p-4 mr-4">
                                    <i class="fa-solid fa-money-check-dollar fa-lg"></i>
                                </div>
                                <p class="text-indigo-200 text-lg">Datos contractuales</p>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario -->
                    <div class="md:w-2/3 p-8">
                        <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">

                            @csrf
                            @method('PUT')
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
                                    <h3 class="text-xl font-semibold text-black dark:text-white">Información Personal</h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Nombre -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Nombre Completo <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="name" value="{{ $empleado->user->name ?? old('name') }}"
                                               class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('name') input-error @enderror"
                                               placeholder="Ej: Juan Pérez">
                                        @error('name')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- CI -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Carnet de Identidad <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="ci" value="{{ $empleado->ci ?? old('ci') }}"
                                               class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('ci') input-error @enderror"
                                               placeholder="Ej: 1234567 LP">
                                        @error('ci')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email-->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Correo Electronico <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="email" value="{{ $empleado->user->email ?? old('email') }}"
                                               class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('ci') input-error @enderror"
                                               placeholder="juan@gmail.com">
                                        @error('email')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Teléfono -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Teléfono <span class="text-red-500">*</span>
                                        </label>
                                        <input type="tel" name="telefono" value="{{ $empleado->telefono ?? old('telefono') }}"
                                               class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('telefono') input-error @enderror"
                                               placeholder="Ej: 77712345">
                                        @error('telefono')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Estado Civil -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Estado Civil <span class="text-red-500">*</span>
                                        </label>
                                        <select name="estado_civil"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('estado_civil') input-error @enderror">
                                            <option value="" class="text-gray-500 dark:text-gray-400">Seleccione...</option>
                                            @foreach($estados_civiles as $key => $estado)
                                                <option value="{{ $key }}" @selected($empleado->estado_civil == $key || old('estado_civil') == $key)>
                                                    {{ $estado }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('estado_civil')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Sección: Información Laboral -->
                            <div class="mb-10">
                                <div class="flex items-center mb-6">
                                    <div class="bg-indigo-100 dark:bg-indigo-700 p-2 rounded-full mr-3">
                                        <i class="fas fa-briefcase fa-lg text-indigo-600 dark:text-indigo-300"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-black dark:text-white">Información Laboral</h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Cargo -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Cargo <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="cargo" value="{{ $empleado->cargo ?? old('cargo') }}"
                                               class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('cargo') input-error @enderror"
                                               placeholder="Ej: Desarrollador Frontend">
                                        @error('cargo')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Experiencia -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Experiencia (años)
                                        </label>
                                        <input type="number" name="experiencia" value="{{ $empleado->experiencia ?? old('experiencia') }}"
                                               min="0"
                                               class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('experiencia') input-error @enderror"
                                               placeholder="Ej: 5">
                                        @error('experiencia')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Fecha de Contratación -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Fecha de Contratación <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" enabled name="created_at" value="{{ $empleado->created_at ? $empleado->created_at->format('Y-m-d') : old('created_at') }}"
                                               class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('created_at') input-error @enderror">
                                        @error('created_at')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <!-- Rol -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Rol <span class="text-red-500">*</span>
                                        </label>
                                        <select name="role"
                                                class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white @error('role') input-error @enderror">
                                            <option value="">Seleccione un Rol</option>
                                            @foreach($roles as $key => $rol)
                                                <option value="{{ $key }}" @selected($empleado->user->role == $key || old('role') == $key)>
                                                    {{ $rol }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Sección: Datos Contractuales -->
                            <div class="mb-10">
                                <div class="flex items-center mb-6">
                                    <div class="bg-indigo-100 dark:bg-indigo-700 p-2 rounded-full mr-3">
                                        <i class="fas fa-money-check-dollar fa-lg text-indigo-600 dark:text-indigo-300"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-black dark:text-white">Datos Contractuales</h3>
                                </div>

                                <div class="grid grid-cols-1 gap-6">
                                    <!-- Salario -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Salario (Bs) <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500">Bs.</span>
                                            </div>
                                            <input type="number" name="salario" value="{{ $empleado->salario }}" min="0"
                                                   step="0.01"
                                                   class="w-full rounded-lg shadow-sm input-focus py-3 px-4 bg-white dark:bg-gray-700 text-black dark:text-white pl-12 @error('salario') input-error @enderror"
                                                   placeholder="Ej: 8500.00">
                                        </div>
                                        @error('salario')
                                        <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div
                                class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t border-gray-200">
                                <a href="{{ route('empleados.index') }}"
                                   class="px-6 py-3 text-center bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 transition">
                                    <i class="fas fa-arrow-left mr-2"></i> Cancelar
                                </a>
                                <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-700 text-white rounded-lg shadow hover:opacity-90 transition">
                                    <i class="fas fa-save mr-2"></i> Editar Empleado
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mensaje Informativo -->
            <div class="mt-8 text-center text-sm text-gray-500">
                <p>Toda la información proporcionada será protegida según nuestras políticas de privacidad.</p>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    </body>
</x-app-layout>
