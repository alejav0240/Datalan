<x-authentication-layout>
    <h1 class="text-3xl text-gray-800 dark:text-gray-100 font-bold mb-6">{{ __('Crear Cuenta') }}</h1>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mensaje de error --}}
    @if (session('error'))
        <div class="mb-4 font-medium text-sm text-red-600">
            {{ session('error') }}
        </div>
    @endif

    {{-- Formulario de registro --}}
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="space-y-4">
            {{-- Tipo de Cliente --}}
            <div>
                <x-label for="tipo_cliente" value="Tipo de cliente *" />
                <select name="tipo_cliente" id="tipo_cliente"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                    required>
                    <option value="" disabled selected>Seleccione un tipo</option>
                    <option value="empresa" {{ old('tipo_cliente') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                    <option value="gobierno" {{ old('tipo_cliente') == 'gobierno' ? 'selected' : '' }}>Gobierno</option>
                    <option value="educacion" {{ old('tipo_cliente') == 'educacion' ? 'selected' : '' }}>Educación</option>
                    <option value="residencial" {{ old('tipo_cliente') == 'residencial' ? 'selected' : '' }}>Residencial</option>
                </select>
                @error('tipo_cliente') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- NIT / CI --}}
            <div>
                <x-label for="nit_ci" value="NIT / CI *" />
                <x-input id="nit_ci" type="text" name="nit_ci" :value="old('nit_ci')" required />
                @error('nit_ci') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Nombre --}}
            <div>
                <x-label for="nombre" value="Nombre completo / Razón social *" />
                <x-input id="nombre" type="text" name="nombre" :value="old('nombre')" required />
                @error('nombre') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Teléfono --}}
            <div>
                <x-label for="telefono" value="Teléfono *" />
                <x-input id="telefono" type="text" name="telefono" :value="old('telefono')" required />
                @error('telefono') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Email --}}
            <div>
                <x-label for="email_acceso" value="Correo electrónico *" />
                <x-input id="email_acceso" type="email" name="email_acceso" :value="old('email_acceso')" required />
                @error('email_acceso') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Contraseña --}}
            <div>
                <x-label for="contrasena" value="Contraseña *" />
                <x-input id="contrasena" type="password" name="contrasena" required />
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Mínimo 6 caracteres</p>
                @error('contrasena') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Botones --}}
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('clientes.index') }}"
                class="text-sm underline hover:no-underline text-gray-600 dark:text-gray-300">
                Cancelar
            </a>
            <x-button type="submit" class="ml-3 bg-amber-200 hover:bg-amber-300 text-black font-semibold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                {{ __('Registrarse') }}
            </x-button>
        </div>
    </form>

    <x-validation-errors class="mt-4" />

    {{-- Footer --}}
    <div class="pt-5 mt-6 border-t border-gray-100 dark:border-gray-700/60">
        <div class="text-sm">
            {{ __('¿Ya tienes una cuenta?') }}
            <a class="font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400" href="{{ route('login') }}">
                {{ __('Iniciar Sesión') }}
            </a>
        </div>
    </div>
</x-authentication-layout>
