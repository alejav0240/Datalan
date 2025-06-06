<form
    action="{{ isset($reporte) ? route('reportes.update', $reporte->id) : route('reportes.store') }}"
    method="POST"
    class="space-y-6 max-w-3xl mx-auto w-full bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700"
>
    @csrf
    @if(isset($reporte))
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
        <!-- Cliente -->
        <div class="col-span-1">
            <label for="cliente_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cliente <span class="text-red-500">*</span></label>
            <select id="cliente_id" name="cliente_id" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id', $reporte->cliente_id ?? '') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
            @error('cliente_id')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tipo de Falla -->
        <div class="col-span-1">
            <label for="tipo_falla" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Falla <span class="text-red-500">*</span></label>
            <select id="tipo_falla" name="tipo_falla" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Seleccione un tipo</option>
                <option value="hardware" {{ old('tipo_falla', $reporte->tipo_falla ?? '') == 'hardware' ? 'selected' : '' }}>Hardware</option>
                <option value="software" {{ old('tipo_falla', $reporte->tipo_falla ?? '') == 'software' ? 'selected' : '' }}>Software</option>
                <option value="conectividad" {{ old('tipo_falla', $reporte->tipo_falla ?? '') == 'conectividad' ? 'selected' : '' }}>Conectividad</option>
                <option value="otro" {{ old('tipo_falla', $reporte->tipo_falla ?? '') == 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
            @error('tipo_falla')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Descripción -->
        <div class="col-span-2">
            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción <span class="text-red-500">*</span></label>
            <textarea id="descripcion" name="descripcion" rows="4" required
                      class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('descripcion', $reporte->descripcion ?? '') }}</textarea>
            @error('descripcion')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Dirección -->
        <div class="col-span-2">
            <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dirección <span class="text-red-500">*</span></label>
            <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $reporte->direccion ?? '') }}" required
                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('direccion')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Estado -->
        @if(isset($reporte))
        <div class="col-span-1">
            <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado</label>
            <select id="estado" name="estado"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="pendiente" {{ old('estado', $reporte->estado ?? '') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en_proceso" {{ old('estado', $reporte->estado ?? '') == 'en_proceso' ? 'selected' : '' }}>En proceso</option>
                <option value="resuelto" {{ old('estado', $reporte->estado ?? '') == 'resuelto' ? 'selected' : '' }}>Resuelto</option>
            </select>
            @error('estado')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        @endif
    </div>

    <!-- Botones de acción -->
    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('reportes.index') }}"
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
            Cancelar
        </a>
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            {{ isset($reporte) ? 'Actualizar' : 'Guardar' }}
        </button>
    </div>
</form>