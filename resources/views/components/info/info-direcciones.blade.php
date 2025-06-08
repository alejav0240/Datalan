<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Dirección</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js'></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        primaryDark: '#1d4ed8',
                        primaryLight: '#dbeafe',
                        secondary: '#64748b',
                        success: '#10b981',
                        danger: '#ef4444',
                        warning: '#f59e0b',
                        light: '#f8fafc',
                        dark: '#1e293b',
                    },
                    borderRadius: {
                        xl: '16px',
                    },
                    boxShadow: {
                        card: '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05)',
                        button: '0 4px 6px -1px rgba(37, 99, 235, 0.3), 0 2px 4px -1px rgba(37, 99, 235, 0.1)',
                        buttonHover: '0 10px 15px -3px rgba(37, 99, 235, 0.3), 0 4px 6px -2px rgba(37, 99, 235, 0.15)',
                        map: '0 4px 6px -1px rgba(0, 0, 0, 0.05)',
                        notification: '0 10px 25px -5px rgba(0, 0, 0, 0.1)',
                    },
                    transitionProperty: {
                        'all': 'all',
                    },
                }
            }
        }
    </script>
    <style>
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading-spinner {
            border: 3px solid rgba(59, 130, 246, 0.2);
            border-top-color: #3b82f6;
            animation: spin 1s linear infinite;
        }

        .notification {
            transform: translateX(150%);
            transition: transform 0.4s ease;
        }

        .notification.show {
            transform: translateX(0);
        }

        .map-overlay {
            backdrop-filter: blur(4px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen flex items-center justify-center p-4 md:p-6">
<!-- Notificación -->
<div class="notification fixed top-5 right-5 p-4 rounded-xl bg-white shadow-notification flex items-center gap-3 z-50 border-l-4 border-success">
    <i class="fas fa-check-circle text-success text-xl"></i>
    <div>
        <h3 class="font-semibold text-gray-800">¡Dirección guardada!</h3>
        <p class="text-sm text-secondary">Tu ubicación se ha registrado correctamente.</p>
    </div>
</div>

<div class="container mx-auto max-w-3xl">
    <div class="bg-white rounded-2xl shadow-card overflow-hidden border border-gray-200 transition-all duration-300 hover:shadow-lg">
        <!-- Encabezado -->
        <div class="bg-gradient-to-r from-primary to-blue-500 py-8 px-6 text-center">
            <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">Registrar una Dirección</h1>
            <p class="text-blue-100 text-sm md:text-base">Selecciona tu ubicación en el mapa y completa los detalles</p>
        </div>

        <!-- Cuerpo -->
        <div class="p-6 md:p-8">
            <form action="{{ route('direcciones.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Mapa y coordenadas -->
                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-map-marked-alt text-primary mr-2"></i>
                        Ubicación en el Mapa
                    </label>

                    <div class="relative rounded-xl border-2 border-gray-200 shadow-map h-80 md:h-96 mb-3 overflow-hidden">
                        <div id="map" class="w-full h-full"></div>
                        <div class="map-overlay absolute top-4 left-4 bg-white/90 py-2 px-4 rounded-full shadow flex items-center gap-2">
                            <i class="fas fa-info-circle text-primary"></i>
                            <span class="text-sm">Haz clic en el mapa para seleccionar tu ubicación</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="bg-primaryLight p-4 rounded-lg">
                            <div class="text-primaryDark font-semibold flex items-center gap-2 mb-2">
                                <i class="fas fa-latitude"></i>
                                <span>Latitud</span>
                            </div>
                            <div id="lat-display" class="font-mono text-lg">-16.5000</div>
                        </div>

                        <div class="bg-primaryLight p-4 rounded-lg">
                            <div class="text-primaryDark font-semibold flex items-center gap-2 mb-2">
                                <i class="fas fa-longitude"></i>
                                <span>Longitud</span>
                            </div>
                            <div id="lng-display" class="font-mono text-lg">-68.1193</div>
                        </div>
                    </div>

                    <input type="hidden" id="latitud" name="latitud" value="-16.5000">
                    <input type="hidden" id="longitud" name="longitud" value="-68.1193">
                    <input type="hidden" id="nombre_cliente" name="nombre_cliente" value="{{ Auth::user()->name }}" />
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

                    <div class="error-message text-danger flex items-center gap-2 mt-2 hidden">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Por favor ingresa una dirección válida</span>
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

<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiaGVucnJ5ZGcyNCIsImEiOiJjbHVscTdkdnowamF3MmlsbGgxMTlsdm90In0.gBaopfRF0dmSrl-ZcM_BVw';

    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [-68.1193, -16.5000],
        zoom: 13
    });

    map.addControl(new mapboxgl.NavigationControl());
    map.addControl(new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true,
        showUserHeading: true
    }));

    let marker = new mapboxgl.Marker({
        color: '#3b82f6',
        draggable: true
    })
        .setLngLat([-68.1193, -16.5000])
        .addTo(map);

    // Función para obtener la dirección a partir de coordenadas
    function reverseGeocode(lng, lat) {
        const loadingSpinner = document.getElementById('address-loading');
        loadingSpinner.classList.remove('hidden');

        fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?access_token=${mapboxgl.accessToken}&language=es`)
            .then(response => response.json())
            .then(data => {
                if (data.features && data.features.length > 0) {
                    document.getElementById('direccion').value = data.features[0].place_name;
                } else {
                    document.getElementById('direccion').value = 'Dirección no encontrada';
                }
                loadingSpinner.classList.add('hidden');
            })
            .catch(error => {
                console.error('Error al obtener la dirección:', error);
                document.getElementById('direccion').value = 'Error al obtener dirección';
                loadingSpinner.classList.add('hidden');
            });
    }

    // Actualizar coordenadas al hacer clic en el mapa
    map.on('click', function(e) {
        const { lng, lat } = e.lngLat;
        updateMarkerPosition(lng, lat);
        reverseGeocode(lng, lat);
    });

    // Actualizar coordenadas al arrastrar el marcador
    marker.on('dragend', function() {
        const lngLat = marker.getLngLat();
        updateMarkerPosition(lngLat.lng, lngLat.lat);
        reverseGeocode(lngLat.lng, lngLat.lat);
    });

    function updateMarkerPosition(lng, lat) {
        marker.setLngLat([lng, lat]);
        document.getElementById('latitud').value = lat;
        document.getElementById('longitud').value = lng;
        document.getElementById('lat-display').textContent = lat.toFixed(6);
        document.getElementById('lng-display').textContent = lng.toFixed(6);
    }

    // Mostrar notificación
    function showNotification(message, type) {
        const notification = document.querySelector('.notification');
        const icon = notification.querySelector('i');
        const title = notification.querySelector('h3');

        // Actualizar estilos según tipo
        notification.className = `notification fixed top-5 right-5 p-4 rounded-xl bg-white shadow-notification flex items-center gap-3 z-50 border-l-4 ${type === 'success' ? 'border-success' : 'border-danger'}`;
        icon.className = `fas ${type === 'success' ? 'fa-check-circle text-success' : 'fa-exclamation-circle text-danger'} text-xl`;
        title.textContent = message;

        notification.classList.add('show');

        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }

    // Manejar envío del formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();

        const btn = document.getElementById('submit-btn');
        const spinner = btn.querySelector('.loading-spinner');
        const btnText = btn.querySelector('.btn-text');
        const direccion = document.getElementById('direccion');
        const error = document.querySelector('.error-message');

        // Validación
        if(direccion.value.trim().length < 10) {
            error.classList.remove('hidden');
            direccion.classList.add('border-danger');
            direccion.focus();
            return;
        } else {
            error.classList.add('hidden');
            direccion.classList.remove('border-danger');
        }

        // Mostrar spinner de carga
        btnText.classList.add('opacity-70');
        spinner.classList.remove('hidden');
        btn.disabled = true;

        // Simular envío (en un caso real sería una petición AJAX)
        setTimeout(() => {
            // Ocultar spinner
            btnText.classList.remove('opacity-70');
            spinner.classList.add('hidden');
            btn.disabled = false;

            // Mostrar notificación
            showNotification('¡Dirección guardada con éxito!', 'success');

            // Resetear formulario (opcional)
            // document.querySelector('form').reset();
            // updateMarkerPosition(-68.1193, -16.5000);
        }, 1500);
    });
</script>
</body>
</html>
