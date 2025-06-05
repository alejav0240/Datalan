<section class="py-16 bg-gradient-to-r from-blue-100 to-white" id="agregar-direccion">
  <div class="container mx-auto text-center">
    <h2 class="text-5xl font-bold mb-12 text-blue-900">Información Adicional</h2>
    <form action="{{ route('direcciones.store') }}" method="POST" class="mx-auto w-full max-w-2xl bg-white p-8 rounded-xl shadow-lg space-y-6 text-left border border-gray-200">
      <h2 class="text-4xl text-center font-bold text-blue-600 mb-8">Agregar Dirección</h2>
      @csrf
  
    <div>
      <input type="hidden" id="nombre_cliente" name="nombre_cliente" value="{{ Auth::user()->name }}" />
      @error('cliente')
      <p class="text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>
  
    <div>
      <label for="direccion" class="block text-lg font-semibold text-gray-800 mb-2">Dirección</label>
      <input type="text" id="direccion" name="direccion" required
      placeholder="Dirección adicional"
      class="form-control p-4 rounded-lg w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all duration-200" />
      @error('direccion')
      <p class="text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>
  
    <button type="submit"
      class="btn bg-blue-500 text-white py-3 px-6 w-full rounded-lg hover:bg-blue-600 transition-all duration-200 shadow-md">
      Guardar Dirección
    </button>
    </form>
  </div>
</section>
  