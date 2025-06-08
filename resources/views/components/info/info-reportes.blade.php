<section class="py-20 bg-gradient-to-br from-blue-50 via-white to-blue-100" id="reportar-falla">
  <div class="container mx-auto max-w-3xl px-6">
    <div class="bg-white rounded-2xl shadow-xl p-10 border border-gray-200">
      
      <h2 class="text-4xl font-bold text-center text-blue-700 mb-10">
        Reportar una Falla
      </h2>

      <form action="{{ route('reportes.cliente.store') }}" method="POST" class="space-y-8">
        @csrf

        <!-- Tipo de Falla -->
        <div>
          <label for="tipo_falla" class="block text-lg font-semibold text-gray-800 mb-2">Tipo de Falla</label>
          <select id="tipo_falla" name="tipo_falla" required
                  class="p-4 rounded-xl w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm transition-all duration-300">
            <option value="">Seleccione un tipo</option>
            <option value="hardware" {{ old('tipo_falla') == 'hardware' ? 'selected' : '' }}>Hardware</option>
            <option value="software" {{ old('tipo_falla') == 'software' ? 'selected' : '' }}>Software</option>
            <option value="conectividad" {{ old('tipo_falla') == 'conectividad' ? 'selected' : '' }}>Conectividad</option>
            <option value="otro" {{ old('tipo_falla') == 'otro' ? 'selected' : '' }}>Otro</option>
          </select>
          @error('tipo_falla')
            <p class="text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Dirección -->
        <div>
          <label for="direccion_adicional_id" class="block text-lg font-semibold text-gray-800 mb-2">Dirección</label>
          <select id="direccion_adicional_id" name="direccion_adicional_id" required
                  class="p-4 rounded-xl w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm transition-all duration-300">
            <option value="">Seleccione una dirección</option>
            @foreach($direcciones as $direccion)
              <option value="{{ $direccion->id }}" {{ old('direccion_adicional_id') == $direccion->id ? 'selected' : '' }}>
                {{ $direccion->direccion }}
              </option>
            @endforeach
          </select>
          @error('direccion_adicional_id')
            <p class="text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Descripción -->
        <div>
          <label for="descripcion" class="block text-lg font-semibold text-gray-800 mb-2">Descripción</label>
          <textarea id="descripcion" name="descripcion" rows="4" required
                    placeholder="Describa el problema que está experimentando"
                    class="p-4 rounded-xl w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm transition-all duration-300">{{ old('descripcion') }}</textarea>
          @error('descripcion')
            <p class="text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Botón -->
        <div>
          <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 w-full rounded-xl shadow-md transition duration-300">
            <i class="fas fa-exclamation-triangle mr-2"></i> Reportar Falla
          </button>
        </div>

      </form>
    </div>
  </div>
</section>