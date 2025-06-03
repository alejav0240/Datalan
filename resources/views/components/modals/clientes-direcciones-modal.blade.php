@props(['cliente'])

<div x-data="{ open: false, direcciones: [] }" class="relative">
    <!-- Botón para abrir el modal -->
    <x-button
        @click="fetch(`/clientes/{{ $cliente->id_cliente }}/direcciones`)
                    .then(res => res.json())
                    .then(data => { direcciones = data; open = true; })"
        class="bg-blue-100 dark:bg-blue-700 text-blue-800 dark:text-white hover:bg-blue-200 dark:hover:bg-blue-600 text-xs py-1 px-3 rounded-md shadow-sm transition"
    >
        Extras
    </x-button>

    <!-- Modal Overlay -->
    <div x-show="open" x-transition class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center">
        <!-- Modal Content -->
        <div
            @click.away="open = false"
            x-show="open"
            x-transition
            class="bg-white dark:bg-gray-800 rounded-4xl shadow-xl w-full max-w-sm mx-4 p-6 relative"
        >
            <!-- Header -->
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                Direcciones de {{ $cliente->nombre_cliente }}
            </h2>

            <!-- Lista de Direcciones -->
            <template x-if="direcciones.length === 0">
                <p class="text-base text-gray-600 dark:text-gray-400 text-center">No hay direcciones adicionales registradas.</p>
            </template>

            <ul class="space-y-4" x-show="direcciones.length > 0">
                <template x-for="direccion in direcciones" :key="direccion.id_direccion">
                    <li class="px-5 py-3 bg-gray-200 dark:bg-gray-700 rounded-lg text-base text-gray-900 dark:text-gray-100 shadow-md">
                        <span x-text="direccion.direccion"></span>
                    </li>
                </template>
            </ul>

            <!-- Footer -->
            <div class="flex justify-end mt-6 border-t border-gray-300 dark:border-gray-700 pt-4">
                <x-button
                    @click="open = false"
                    class="bg-red-700 text-white hover:bg-gray-400 dark:hover:bg-gray-600 hover:scale-105 text-sm py-2 px-5 rounded-lg transition shadow-md"
                >
                    Cerrar
                </x-button>
            </div>
        </div>
    </div>
</div>
