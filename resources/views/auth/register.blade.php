<x-authentication-layout>
    <h1 class="text-3xl text-gray-800 dark:text-gray-100 font-bold mb-6">{{ __('Crear Cuenta') }}</h1>
    
    <!-- Formulario de Registro -->
    <form method="POST" action="{{ route('clientes.store') }}">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Nombre Completo -->
            <div>
                <label class="block text-sm font-medium">Nombre<span class="text-red-500">*</span></label>
                <input id="nombre_cliente" type="text" name="nombre_cliente" value="{{ old('nombre_cliente') }}" required autofocus autocomplete="name" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                @error('nombre_cliente') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium">Correo Electrónico <span class="text-red-500">*</span></label>
                <input id="email_acceso" type="email" name="email_acceso" value="{{ old('email_acceso') }}" required 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                @error('email_acceso') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- NIT/CI -->
            <div>
                <label class="block text-sm font-medium">NIT/CI <span class="text-red-500">*</span></label>
                <input id="nit_ci" type="text" name="nit_ci" value="{{ old('nit_ci') }}" required 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                @error('nit_ci') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Teléfono -->
            <div>
                <label class="block text-sm font-medium">Teléfono <span class="text-red-500">*</span></label>
                <input id="telefono" type="text" name="telefono" value="{{ old('telefono') }}" required 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                @error('telefono') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Celular -->
            <div>
                <label class="block text-sm font-medium">Celular</label>
                <input id="celular" type="text" name="celular" value="{{ old('celular') }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                @error('celular') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Dirección -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium">Dirección <span class="text-red-500">*</span></label>
                <textarea id="direccion_principal" name="direccion_principal" rows="2" required 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">{{ old('direccion_principal') }}</textarea>
                @error('direccion_principal') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Tipo de Cliente -->
            <div>
                <label class="block text-sm font-medium">Tipo de Cliente <span class="text-red-500">*</span></label>
                <select name="tipo_cliente" required 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                    <option value="empresa" {{ old('tipo_cliente') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                    <option value="gobierno" {{ old('tipo_cliente') == 'gobierno' ? 'selected' : '' }}>Gobierno</option>
                    <option value="educacion" {{ old('tipo_cliente') == 'educacion' ? 'selected' : '' }}>Educación</option>
                    <option value="residencial" {{ old('tipo_cliente') == 'residencial' ? 'selected' : '' }}>Residencial</option>
                </select>
                @error('tipo_cliente') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Rubro -->
            <div>
                <label class="block text-sm font-medium">Rubro</label>
                <input id="rubro" type="text" name="rubro" value="{{ old('rubro') }}" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                @error('rubro') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label class="block text-sm font-medium">Contraseña <span class="text-red-500">*</span></label>
                <input type="password" name="contrasena" required 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                @error('contrasena') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Referencia -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium">Referencia</label>
                <select name="referencia" 
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                    <option value="recomendacion" {{ old('referencia') == 'recomendacion' ? 'selected' : '' }}>Recomendación</option>
                    <option value="publicidad" {{ old('referencia') == 'publicidad' ? 'selected' : '' }}>Publicidad</option>
                    <option value="busqueda" {{ old('referencia') == 'busqueda' ? 'selected' : '' }}>Búsqueda</option>
                    <option value="redes" {{ old('referencia') == 'redes' ? 'selected' : '' }}>Redes Sociales</option>
                    <option value="otro" {{ old('referencia') == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('referencia') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

        </div>

        <!-- Botón de Enviar -->
        <div class="flex items-center justify-between mt-6">
            <x-button type="submit" class="bg-amber-200 hover:bg-amber-300 text-black font-semibold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                {{ __('Guardar') }}
            </x-button>
        </div>
    </form>

    <div class="pt-5 mt-6 border-t border-gray-100 dark:border-gray-700/60">
        <div class="text-sm">
            {{ __('¿Ya tienes una cuenta?') }} <a class="font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
        </div>
    </div>
</x-authentication-layout>
