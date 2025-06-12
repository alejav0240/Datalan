<section class="py-20 bg-gradient-to-br from-blue-50 via-white to-blue-100" id="reportar-falla">
    <!-- Notificación -->
    <div id="notification"
         class="notification fixed top-5 right-5 p-4 rounded-xl bg-white shadow-lg flex items-center gap-3 z-50 border-l-4 border-success opacity-0 pointer-events-none transition-opacity duration-300"
         role="alert" aria-live="polite">
        <i class="fas fa-check-circle text-success text-xl"></i>
        <div>
            <h3 class="font-semibold text-gray-800">¡Dirección guardada!</h3>
            <p class="text-sm text-secondary">Tu ubicación se ha registrado correctamente.</p>
        </div>
    </div>

    <div class="container mx-auto max-w-3xl">
        <div class="bg-white rounded-2xl shadow-card overflow-hidden border border-gray-200 transition hover:shadow-lg">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary to-blue-500 py-8 px-6 text-center">
                <h1 class="text-3xl font-bold text-white mb-2 flex items-center justify-center">
                    <i class="fa-solid fa-location-dot mr-3"></i>
                    Registrar una Dirección
                </h1>
                <p class="text-blue-100 text-base">Selecciona tu ubicación en el mapa y completa los detalles</p>
            </div>

            <!-- Formulario -->
            <div class="p-6 md:p-8">
                <form id="direccion-form" action="{{ route('direcciones.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Mapa -->
                    <div>
                        <label class="block text-lg font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-map-marked-alt text-primary mr-2"></i>
                            Ubicación en el Mapa
                        </label>

                        <div class="relative rounded-xl border-2 border-gray-200 shadow-map h-80 md:h-96 mb-3 overflow-hidden">
                            <div id="map" class="w-full h-full" role="application" aria-label="Mapa para seleccionar ubicación"></div>
                            <div class="absolute top-4 left-4 bg-white/90 py-2 px-4 rounded-full shadow flex items-center gap-2 text-sm text-primary">
                                <i class="fas fa-info-circle"></i>
                                Haz clic en el mapa para seleccionar tu ubicación
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div class="bg-primaryLight p-4 rounded-lg">
                                <div class="text-primaryDark font-semibold flex items-center gap-2 mb-2">
                                    <i class="fas fa-latitude"></i> Latitud
                                </div>
                                <div id="lat-display" class="font-mono text-lg">-16.5000</div>
                            </div>
                            <div class="bg-primaryLight p-4 rounded-lg">
                                <div class="text-primaryDark font-semibold flex items-center gap-2 mb-2">
                                    <i class="fas fa-longitude"></i> Longitud
                                </div>
                                <div id="lng-display" class="font-mono text-lg">-68.1193</div>
                            </div>
                        </div>

                        <input type="hidden" id="latitud" name="latitud" value="-16.5000">
                        <input type="hidden" id="longitud" name="longitud" value="-68.1193">
                        <input type="hidden" id="nombre_cliente" name="nombre_cliente" value="{{ Auth::user()->name }}">
                    </div>

                    <!-- Dirección -->
                    <div>
                        <label for="direccion" class="block text-lg font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                            Dirección Completa
                        </label>

                        <div class="relative">
                            <i class="fas fa-location-dot text-primary absolute left-4 top-1/2 transform -translate-y-1/2"></i>
                            <input type="text" id="direccion" name="direccion" required
                                   placeholder="Ej: Av. Las Américas Nro. 1250, La Paz"
                                   class="w-full p-4 pl-12 rounded-xl border-2 border-gray-200 bg-gray-50 focus:ring-2 focus:ring-primary focus:outline-none transition-all duration-300">
                            <div id="address-loading" class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 loading-spinner rounded-full hidden"></div>
                        </div>

                        <div id="error-direccion" class="text-danger text-sm mt-2 hidden flex items-center gap-2">
                            <i class="fas fa-exclamation-circle"></i>
                            Ingrese una dirección válida (mín. 10 caracteres).
                        </div>
                    </div>

                    <!-- Botón -->
                    <div class="pt-4">
                        <button type="submit" id="submit-btn"
                                class="w-full bg-gradient-to-r from-primary to-blue-500 hover:from-primaryDark hover:to-blue-600 text-white font-semibold py-4 px-6 rounded-xl shadow-button hover:shadow-buttonHover transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center">
                            <span class="btn-text flex items-center">
                                <i class="fas fa-save mr-2"></i> Guardar Dirección
                            </span>
                            <span class="loading-spinner w-5 h-5 border-2 rounded-full hidden ml-2"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Map & Lógica -->
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiaGVucnJ5ZGcyNCIsImEiOiJjbHVscTdkdnowamF3MmlsbGgxMTlsdm90In0.gBaopfRF0dmSrl-ZcM_BVw';

        const form = document.getElementById('direccion-form');
        const btn = document.getElementById('submit-btn');
        const spinner = btn.querySelector('.loading-spinner');
        const btnText = btn.querySelector('.btn-text');
        const direccionInput = document.getElementById('direccion');
        const error = document.getElementById('error-direccion');
        const notification = document.getElementById('notification');

        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [-68.1193, -16.5000],
            zoom: 17
        });

        map.addControl(new mapboxgl.NavigationControl());
        map.addControl(new mapboxgl.GeolocateControl({
            positionOptions: { enableHighAccuracy: true },
            trackUserLocation: true,
            showUserHeading: true
        }));

        const marker = new mapboxgl.Marker({ color: '#3b82f6', draggable: true })
            .setLngLat([-68.1193, -16.5000])
            .addTo(map);

        function updateMarkerPosition(lng, lat) {
            marker.setLngLat([lng, lat]);
            document.getElementById('latitud').value = lat;
            document.getElementById('longitud').value = lng;
            document.getElementById('lat-display').textContent = lat.toFixed(6);
            document.getElementById('lng-display').textContent = lng.toFixed(6);
        }

        function reverseGeocode(lng, lat) {
            const loading = document.getElementById('address-loading');
            loading.classList.remove('hidden');
            fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?access_token=${mapboxgl.accessToken}&language=es`)
                .then(res => res.json())
                .then(data => {
                    const place = data.features?.[0]?.place_name || 'Dirección no encontrada';
                    direccionInput.value = place;
                })
                .catch(() => direccionInput.value = 'Error al obtener dirección')
                .finally(() => loading.classList.add('hidden'));
        }

        map.on('click', e => {
            const { lng, lat } = e.lngLat;
            updateMarkerPosition(lng, lat);
            reverseGeocode(lng, lat);
        });

        marker.on('dragend', () => {
            const { lng, lat } = marker.getLngLat();
            updateMarkerPosition(lng, lat);
            reverseGeocode(lng, lat);
        });

        form.addEventListener('submit', async (e) => {
            const direccionVal = direccionInput.value.trim();

            if (direccionVal.length < 10) {
                error.classList.remove('hidden');
                direccionInput.classList.add('border-danger');
                direccionInput.focus();
                return;
            }

            error.classList.add('hidden');
            direccionInput.classList.remove('border-danger');

            btn.disabled = true;
            btnText.classList.add('opacity-50');
            spinner.classList.remove('hidden');

            // Simulación de envío real
            await new Promise(res => setTimeout(res, 1500));

            btn.disabled = false;
            btnText.classList.remove('opacity-50');
            spinner.classList.add('hidden');

            // Notificación
            notification.classList.remove('opacity-0', 'pointer-events-none');
            setTimeout(() => notification.classList.add('opacity-0', 'pointer-events-none'), 3000);
        });
    </script>
</section>
