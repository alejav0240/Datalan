<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-screen-xl mx-auto">
        <div class="mb-8 text-center">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold mb-2">
                {{ isset($cliente) ? 'Editar Cliente' : 'Registrar Cliente' }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                {{ isset($cliente) ? 'Actualiza la información del cliente' : 'Completa el formulario para registrar un nuevo cliente' }}
            </p>
        </div>
        
        <form
            action="{{ isset($cliente) ? route('clientes.update', $cliente->id) : route('clientes.store') }}"
            method="POST"
            class="space-y-6 max-w-3xl mx-auto w-full bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700"
        >
            @csrf
            @if(isset($cliente))
                @method('PUT')
            @endif

            <!-- Mensajes de alerta -->
            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg" role="alert">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800 dark:text-red-200">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg" role="alert">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Grid de 2 columnas para campos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tipo Cliente -->
                <div class="col-span-1">
                    <label for="tipo_cliente" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de cliente <span class="text-red-500">*</span></label>
                    <select
                        name="tipo_cliente"
                        id="tipo_cliente"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 py-2 px-3 border transition duration-150 ease-in-out"
                    >
                        <option value="" disabled {{ old('tipo_cliente', $cliente->tipo_cliente ?? '') == '' ? 'selected' : '' }}>Seleccione un tipo</option>
                        @foreach(['empresa', 'gobierno', 'educacion', 'residencial'] as $tipo)
                            <option value="{{ $tipo }}" {{ old('tipo_cliente', $cliente->tipo_cliente ?? '') == $tipo ? 'selected' : '' }}>
                                {{ ucfirst($tipo) }}
                            </option>
                        @endforeach
                    </select>
                    @error('tipo_cliente')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NIT / CI -->
                <div class="col-span-1">
                    <label for="nit_ci" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIT / CI <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        name="nit_ci"
                        id="nit_ci"
                        value="{{ old('nit_ci', $cliente->nit_ci ?? '') }}"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 py-2 px-3 border transition duration-150 ease-in-out"
                        placeholder="Ej: 123456789"
                    >
                    @error('nit_ci')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nombre -->
                <div class="col-span-2">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre completo/Razón social <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        name="nombre"
                        id="nombre"
                        value="{{ old('nombre', $cliente->nombre ?? '') }}"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 py-2 px-3 border transition duration-150 ease-in-out"
                        placeholder="Ej: Juan Pérez S.A."
                    >
                    @error('nombre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div class="col-span-1">
                    <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Teléfono <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        name="telefono"
                        id="telefono"
                        value="{{ old('telefono', $cliente->telefono ?? '') }}"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 py-2 px-3 border transition duration-150 ease-in-out"
                        placeholder="Ej: 76543210"
                    >
                    @error('telefono')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-span-1">
                    <label for="email_acceso" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Correo electrónico <span class="text-red-500">*</span></label>
                    <input
                        type="email"
                        name="email_acceso"
                        id="email_acceso"
                        value="{{ old('email_acceso', $cliente->user->email ?? '') }}"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 py-2 px-3 border transition duration-150 ease-in-out"
                        placeholder="Ej: contacto@ejemplo.com"
                    >
                    @error('email_acceso')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contraseña -->
                @if(!isset($cliente))
                <div class="col-span-2">
                    <label for="contrasena" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contraseña <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input
                            type="password"
                            name="contrasena"
                            id="contrasena"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 py-2 px-3 border transition duration-150 ease-in-out pr-10"
                            placeholder="••••••"
                            autocomplete="new-password"
                        >
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Mínimo 6 caracteres</p>
                    @error('contrasena')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('contrasena') }}</p>
                    @enderror
                </div>
                @endif
            </div>

            <!-- Botones -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('clientes.index')}}" class="inline-flex justify-center items-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Volver
                </a>
                <button
                    type="submit"
                    class="inline-flex justify-center items-center rounded-lg border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150 ease-in-out"
                >
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    {{ isset($cliente) ? 'Actualizar Cliente' : 'Registrar Cliente' }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>