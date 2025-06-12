<section class="py-20 bg-gradient-to-br from-blue-50 via-white to-blue-100" id="reportar-falla">
    <!-- Notificación -->
    <div class="notification fixed top-5 right-5 p-4 rounded-xl bg-white shadow-md flex items-center gap-3 z-50 border-l-4 border-green-500 animate-fade-in">
        <i class="fas fa-check-circle text-green-500 text-xl"></i>
        <div>
            <h3 class="font-semibold text-gray-800">¡Dirección guardada!</h3>
            <p class="text-sm text-gray-600">Tu ubicación se ha registrado correctamente.</p>
        </div>
    </div>

    <!-- Contenedor principal -->
    <div class="container mx-auto max-w-3xl px-4">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 transition-shadow duration-300 hover:shadow-xl overflow-hidden">

            <!-- Encabezado -->
            <header class="bg-gradient-to-r from-blue-600 to-blue-500 py-8 px-6 text-center">
                <h1 class="text-3xl font-bold text-white mb-2 flex items-center justify-center gap-2">
                    <i class="fas fa-exclamation-triangle"></i>
                    Reportar una Falla Técnica
                </h1>
                <p class="text-blue-100 text-sm">Selecciona tu ubicación en el mapa y completa los detalles</p>
            </header>

            <!-- Formulario -->
            <div class="p-10">
                <form action="{{ route('reportes.cliente.store') }}" method="POST" class="space-y-8" aria-label="Formulario para reportar una falla técnica">
                    @csrf

                    <!-- Tipo de Falla -->
                    <div>
                        <label for="tipo_falla" class="block text-lg font-medium text-gray-800 mb-2">Tipo de Falla</label>
                        <select id="tipo_falla" name="tipo_falla" required
                                class="p-4 rounded-xl w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm">
                            <option value="">Seleccione un tipo</option>
                            <option value="hardware" {{ old('tipo_falla') == 'hardware' ? 'selected' : '' }}>Hardware</option>
                            <option value="software" {{ old('tipo_falla') == 'software' ? 'selected' : '' }}>Software</option>
                            <option value="conectividad" {{ old('tipo_falla') == 'conectividad' ? 'selected' : '' }}>Conectividad</option>
                            <option value="otro" {{ old('tipo_falla') == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('tipo_falla')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dirección -->
                    <div>
                        <label for="direccion_adicional_id" class="block text-lg font-medium text-gray-800 mb-2">Dirección</label>
                        <select id="direccion_adicional_id" name="direccion_adicional_id" required
                                class="p-4 rounded-xl w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm">
                            <option value="">Seleccione una dirección</option>
                            @foreach($direcciones as $direccion)
                                <option value="{{ $direccion->id }}" {{ old('direccion_adicional_id') == $direccion->id ? 'selected' : '' }}>
                                    {{ $direccion->direccion }}
                                </option>
                            @endforeach
                        </select>
                        @error('direccion_adicional_id')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label for="descripcion" class="block text-lg font-medium text-gray-800 mb-2">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="4" required
                                  placeholder="Describa el problema que está experimentando"
                                  class="p-4 rounded-xl w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                        <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botón -->
                    <div>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 w-full rounded-xl shadow-md transition duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-exclamation-triangle"></i>
                            Reportar Falla
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
