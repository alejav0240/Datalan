<div x-data="{ open: {{ $errors->any() ? 'true' : 'false' }} }">

    <!-- Botón para abrir el modal -->
    <x-button @click="open = true" class="bg-blue-600 text-white hover:bg-blue-700 hover:cursor-pointer rounded-lg px-4 py-2 shadow">
        <i class="fas fa-plus"></i> Agregar Cliente
    </x-button>

    <!-- Modal fondo -->
    <div
        x-show="open"
        class="fixed inset-0 flex items-center justify-center z-50 bg-black/70">
        <!-- Modal contenido -->
        <div @click.away="open = false" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-2xl w-full p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Agregar Cliente</h2>

            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Tipo de Cliente -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left">Tipo de Cliente</label>
                        <select name="tipo_cliente" class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                            <option value="empresa" {{ old('tipo_cliente') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                            <option value="gobierno" {{ old('tipo_cliente') == 'gobierno' ? 'selected' : '' }}>Gobierno</option>
                            <option value="educacion" {{ old('tipo_cliente') == 'educacion' ? 'selected' : '' }}>Educación</option>
                            <option value="residencial" {{ old('tipo_cliente') == 'residencial' ? 'selected' : '' }}>Residencial</option>
                        </select>
                        @error('tipo_cliente') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left">Nombre</label>
                        <input type="text" name="nombre_cliente" value="{{ old('nombre_cliente') }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('nombre_cliente') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- NIT/CI -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left">NIT/CI</label>
                        <input type="text" name="nit_ci" value="{{ old('nit_ci') }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('nit_ci') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Rubro -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left">Rubro</label>
                        <input type="text" name="rubro" value="{{ old('rubro') }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('rubro') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Dirección -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left">Dirección</label>
                        <textarea name="direccion_principal" rows="2" class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">{{ old('direccion_principal') }}</textarea>
                        @error('direccion_principal') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left">Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono') }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('telefono') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Celular -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left">Celular</label>
                        <input type="text" name="celular" value="{{ old('celular') }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('celular') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left">Email</label>
                        <input type="email" name="email_acceso" value="{{ old('email_acceso') }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('email_acceso') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left">Contraseña</label>
                        <input type="password" name="contrasena" class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('contrasena') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Referencia -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left">Referencia</label>
                        <select name="referencia" class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                            <option value="">Seleccione</option>
                            <option value="recomendacion" {{ old('referencia') == 'recomendacion' ? 'selected' : '' }}>Recomendación</option>
                            <option value="publicidad" {{ old('referencia') == 'publicidad' ? 'selected' : '' }}>Publicidad</option>
                            <option value="busqueda" {{ old('referencia') == 'busqueda' ? 'selected' : '' }}>Búsqueda</option>
                            <option value="redes" {{ old('referencia') == 'redes' ? 'selected' : '' }}>Redes Sociales</option>
                            <option value="otro" {{ old('referencia') == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('referencia') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Observaciones -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 text-left">Observaciones</label>
                        <textarea name="observaciones" rows="2" class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">{{ old('observaciones') }}</textarea>
                        @error('observaciones') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <x-button type="submit" class="bg-green-700 text-white hover:bg-green-600 hover:cursor-pointer transition-all duration-200 mr-2 px-3 py-2 rounded-md text-lg">Guardar</x-button>
                    <x-button @click="open = false" type="button" class="bg-red-700 text-white hover:bg-red-600 hover:cursor-pointer transition-all duration-200 px-3 py-2 rounded-md text-lg">Cancelar</x-button>
                </div>
            </form>
        </div>
    </div>
</div>
