@props(['cliente'])

<div x-data="{ open: false, direcciones: [] }" class="relative">
    <!-- Botón para abrir el modal - Versión mejorada -->
    <x-button
        @click="fetch(`/clientes/{{ $cliente->id }}/direcciones`)
                .then(res => res.json())
                .then(data => { direcciones = data; open = true; })"
        class="bg-blue-800 text-white hover:bg-blue-700 text-xs py-2 px-4 rounded-lg shadow-md transition-all duration-300 flex items-center space-x-2"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span>Extras</span>
    </x-button>

    <!-- Modal Overlay -->
    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <!-- Modal Content -->
        <div
            @click.away="open = false"
            x-show="open"
            x-transition
            class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-sm mx-4 overflow-hidden relative"
        >
            <!-- Header -->
            <div class="border-b border-gray-200 dark:border-gray-700 p-5">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white text-center">
                    Direcciones de
                </h2>
                <p class="text-gray-600 dark:text-gray-300 font-medium text-center mt-1 truncate">{{ $cliente->nombre }}</p>
            </div>

            <!-- Body -->
            <div class="p-5 max-h-[60vh] overflow-y-auto">
                <!-- Empty state -->
                <template x-if="direcciones.length === 0">
                    <div class="py-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 mt-3">No hay direcciones adicionales</p>
                    </div>
                </template>

                <!-- Lista de Direcciones -->
                <ul class="divide-y divide-gray-200 dark:divide-gray-700" x-show="direcciones.length > 0">
                    <template x-for="direccion in direcciones" :key="direccion.id">
                        <li class="py-3">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-5 w-5 text-gray-400 mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200" x-text="direccion.direccion"></p>
                                    </div>
                                </div>
                
                                <!-- Link a Google Maps -->
                                <div class="ml-4">
                                    <a
                                        :href="`https://www.google.com/maps?q=${direccion.latitud},${direccion.longitud}`"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="text-blue-600 hover:underline text-sm font-semibold flex items-center"
                                        title="Ver en Google Maps"
                                    >
                                        <i class="fas fa-map-marker-alt mr-1"></i> Mapa
                                    </a>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>
                
            </div>

            <!-- Footer -->
            <div class="border-t border-gray-200 dark:border-gray-700 px-5 py-4 flex justify-center">
                <x-button
                    @click="open = false"
                    class="text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 px-4 py-2 rounded-md text-sm font-medium transition-colors"
                >
                    Cerrar
                </x-button>
            </div>
        </div>
    </div>
</div>