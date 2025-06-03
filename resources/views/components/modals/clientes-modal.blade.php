@props(['cliente' => null, 'tituloBoton' => null])
<div
    x-data="{ open: {{ session('modal') === 'create' || session('modal') === 'edit' || $errors->any() ? 'true' : 'false' }} }">


    <!-- Botón para abrir el modal (solo si es crear) -->
    <x-button @click="open = true"
        class="{{ isset($cliente) ? 'bg-yellow-100 dark:bg-yellow-700 text-yellow-800 dark:text-white hover:bg-yellow-200 dark:hover:bg-yellow-600 text-xs py-1 px-3 rounded-md shadow-sm transition' : 'bg-blue-600 hover:bg-blue-700 px-4 py-2' }} text-white rounded-lg shadow">
        <i class="fas {{ isset($cliente) ? 'fa-edit' : 'fa-plus' }}"></i>
        {{ $tituloBoton ?? (isset($cliente) ? 'Editar' : 'Agregar Cliente') }}
    </x-button>


    <!-- Fondo del Modal -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50 bg-black/70">
        <!-- Contenido del Modal -->
        <div @click.away="open = false" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-2xl w-full p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 text-left">
                {{ isset($cliente) ? 'Editar Cliente' : 'Agregar Cliente' }}
            </h2>

            <form action="{{ isset($cliente) ? route('clientes.update', ['id_cliente' => $cliente->id_cliente]) : route('clientes.store') }}" method="POST">
                @csrf
                @if(isset($cliente))
                    @method('PUT')
                @endif
            

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Tipo de Cliente -->
                    <div>
                        <label class="block text-sm font-medium">Tipo de Cliente</label>
                        <select name="tipo_cliente"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                            @foreach(['empresa', 'gobierno', 'educacion', 'residencial'] as $tipo)
                                <option value="{{ $tipo }}" {{ old('tipo_cliente', $cliente->tipo_cliente ?? '') == $tipo ? 'selected' : '' }}>
                                    {{ ucfirst($tipo) }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_cliente') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-medium">Nombre</label>
                        <input required type="text" name="nombre_cliente"
                            value="{{ old('nombre_cliente', $cliente->nombre_cliente ?? '') }}"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('nombre_cliente') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- NIT/CI -->
                    <div>
                        <label class="block text-sm font-medium">NIT/CI</label>
                        <input required type="text" name="nit_ci" value="{{ old('nit_ci', $cliente->nit_ci ?? '') }}"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('nit_ci') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Rubro -->
                    <div>
                        <label class="block text-sm font-medium">Rubro</label>
                        <input type="text" name="rubro" value="{{ old('rubro', $cliente->rubro ?? '') }}"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('rubro') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Dirección -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium">Dirección</label>
                        <textarea required name="direccion_principal" rows="2"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">{{ old('direccion_principal', $cliente->direccion_principal ?? '') }}</textarea>
                        @error('direccion_principal') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label class="block text-sm font-medium">Teléfono</label>
                        <input required type="text" name="telefono"
                            value="{{ old('telefono', $cliente->telefono ?? '') }}"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('telefono') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Celular -->
                    <div>
                        <label class="block text-sm font-medium">Celular</label>
                        <input type="text" name="celular" value="{{ old('celular', $cliente->celular ?? '') }}"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('celular') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium">Email</label>
                        <input required type="email" name="email_acceso"
                            value="{{ old('email_acceso', $cliente->email_acceso ?? '') }}"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        @error('email_acceso') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Contraseña -->
                    @if(!isset($cliente))
                    <div>
                        <label class="block text-sm font-medium">Contraseña</label>
                        <input type="password" name="contrasena"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white" required>
                        @error('contrasena')
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('contrasena') }}</p>
                        @enderror
                    </div>
                    @endif

                    <!-- Referencia -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium">Referencia</label>
                        <select name="referencia"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                            @foreach(['recomendacion', 'publicidad', 'busqueda', 'redes', 'otro'] as $ref)
                                <option value="{{ $ref }}" {{ old('referencia', $cliente->referencia ?? '') == $ref ? 'selected' : '' }}>
                                    {{ ucfirst($ref) }}
                                </option>
                            @endforeach
                        </select>
                        @error('referencia') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Observaciones -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium">Observaciones</label>
                        <textarea name="observaciones" rows="2"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">{{ old('observaciones', $cliente->observaciones ?? '') }}</textarea>
                        @error('observaciones') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <x-button type="submit"
                        class="bg-green-700 text-white hover:bg-green-600 px-3 py-2 rounded-md text-lg mr-2">
                        {{ isset($cliente) ? 'Actualizar' : 'Guardar' }}
                    </x-button>
                    <button type="button" @click="open = false"
                        class="bg-red-700 text-white hover:bg-red-600 px-3 py-2 rounded-md text-lg">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>