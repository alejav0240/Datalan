<section class="py-20 bg-gradient-to-br from-blue-50 via-white to-blue-100" id="agregar-direccion">
  <div class="container mx-auto max-w-3xl px-6">
    <div class="bg-white rounded-2xl shadow-xl p-10 border border-gray-200">
      
      <h2 class="text-4xl font-bold text-center text-blue-700 mb-10">
        Registrar una Dirección
      </h2>

      <form action="{{ route('direcciones.store') }}" method="POST" class="space-y-8">
        @csrf

        <!-- Mapa y coordenadas -->
        <div>
          <label class="block text-lg font-semibold text-gray-800 mb-3">Ubicación en el Mapa</label>
          <div id="map" class="w-full h-96 rounded-xl border border-gray-300 shadow-sm mb-2"></div>
          <input type="hidden" id="latitud" name="latitud">
          <input type="hidden" id="longitud" name="longitud">
          <input type="hidden" id="nombre_cliente" name="nombre_cliente" value="{{ Auth::user()->name }}" />
          @error('cliente')
            <p class="text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Dirección -->
        <div>
          <label for="direccion" class="block text-lg font-semibold text-gray-800 mb-2">Dirección</label>
          <input type="text" id="direccion" name="direccion" required
            placeholder="Ej. Av. Las Américas Nro. 1250"
            class="p-4 rounded-xl w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm transition-all duration-300" />
          @error('direccion')
            <p class="text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Botón -->
        <div>
          <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 w-full rounded-xl shadow-md transition duration-300">
            <i class="fas fa-map-marker-alt mr-2"></i> Guardar Dirección
          </button>
        </div>

      </form>
    </div>
  </div>
</section>



<script src='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js'></script>

<script>
  mapboxgl.accessToken = 'pk.eyJ1IjoiaGVucnJ5ZGcyNCIsImEiOiJjbHVscTdkdnowamF3MmlsbGgxMTlsdm90In0.gBaopfRF0dmSrl-ZcM_BVw'; // Reemplaza con tu token

  const map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v12',
      center: [-68.1193, -16.5000], // Coordenadas iniciales (La Paz por ejemplo)
      zoom: 13
  });

  let marker = null;

  map.on('click', function (e) {
      const { lng, lat } = e.lngLat;

      // Si ya hay marcador, se mueve. Si no, se crea.
      if (marker) {
          marker.setLngLat([lng, lat]);
      } else {
          marker = new mapboxgl.Marker({ color: 'blue' })
              .setLngLat([lng, lat])
              .addTo(map);
      }

      // Rellenar campos ocultos
      document.getElementById('latitud').value = lat;
      document.getElementById('longitud').value = lng;
  });
</script>