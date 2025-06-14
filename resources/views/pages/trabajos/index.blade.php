<x-app-layout>
    <style>
        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
        }
    </style>

    <div class="container mx-auto px-4 py-8 bg-gray-50 dark:bg-gray-900" x-data="{ openFilters: false }">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <!-- Título -->
            <h1 class="text-3xl font-bold text-indigo-700 dark:text-indigo-300">
                <i class="fas fa-tasks mr-2"></i> Gestión de Trabajos
            </h1>
            <!-- Botones -->
            <div class="mt-4 md:mt-0 flex space-x-3">
                <button @click="openFilters = !openFilters"
                    class="bg-white dark:bg-gray-800 text-indigo-600 dark:text-indigo-400 px-4 py-2 rounded-lg shadow mr-3 hover:bg-indigo-50 dark:hover:bg-gray-700">
                    <i class="fas fa-filter mr-1"></i> Filtros
                </button>
                <a href="{{route('trabajos.create')}}"
                    class="bg-indigo-600 dark:bg-indigo-500 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 dark:hover:bg-indigo-600">
                    <i class="fas fa-plus mr-1"></i> Nuevo Trabajo
                </a>
            </div>
        </div>

        <!-- Filtros -->
        <div x-show="openFilters"
            class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 mb-8 transition-all duration-300">
            <!-- Formulario -->
            <form action="{{ route('trabajos.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prioridad</label>
                        <select name="prioridad"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm dark:bg-gray-700 dark:text-gray-300">
                            <option value="">Todas</option>
                            <option value="normal" {{ request('prioridad') == 'normal' ? 'selected' : '' }}>Normal</option>
                            <option value="alta" {{ request('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
                            <option value="urgente" {{ request('prioridad') == 'urgente' ? 'selected' : '' }}>Urgente</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Trabajo</label>
                        <select name="tipo_trabajo"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm dark:bg-gray-700 dark:text-gray-300">
                            <option value="">Todos</option>
                            <option value="instalacion" {{ request('tipo_trabajo') == 'instalacion' ? 'selected' : '' }}>Instalación</option>
                            <option value="mantenimiento" {{ request('tipo_trabajo') == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                            <option value="reparacion" {{ request('tipo_trabajo') == 'reparacion' ? 'selected' : '' }}>Reparación</option>
                            <option value="configuracion" {{ request('tipo_trabajo') == 'configuracion' ? 'selected' : '' }}>Configuración</option>
                            <option value="otro" {{ request('tipo_trabajo') == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado</label>
                        <select name="estado"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm dark:bg-gray-700 dark:text-gray-300">
                            <option value="">Todos</option>
                            <option value="pendiente" {{ request('estado') === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_proceso" {{ request('estado') === 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="resuelto" {{ request('estado') === 'resuelto' ? 'selected' : '' }}>Resuelto</option>
                        </select>
                    </div>
                    <div class="flex space-x-3">
                        <button type="submit" class="bg-indigo-600 dark:bg-indigo-500 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 dark:hover:bg-indigo-600 h-10 flex items-center">
                            <i class="fas fa-filter mr-1"></i> Aplicar
                        </button>
                        <a href="{{ route('trabajos.index') }}" class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600 h-10 flex items-center">
                            <i class="fas fa-times mr-1"></i> Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Buscador -->
        <div class="mb-8">
            <form action="{{ route('trabajos.index') }}" method="GET">
                <div class="relative">
                    <input type="text" name="search" placeholder="Buscar trabajos por descripción..."
                        class="w-full p-4 rounded-xl shadow-lg border-0 focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-300"
                        value="{{ request('search') }}">
                    <button type="submit" class="absolute right-3 top-3.5 text-indigo-600 dark:text-indigo-400">
                        <i class="fas fa-search fa-lg"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl shadow-lg p-6">
                <div class="text-3xl font-bold">{{ $trabajos->count() }}</div>
                <div class="opacity-80">Total Trabajos</div>
            </div>
            <div class="bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-2xl shadow-lg p-6">
                <div class="text-3xl font-bold">{{ $trabajos->where('prioridad', 'urgente')->count() }}</div>
                <div class="opacity-80">Trabajos Urgentes</div>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-teal-600 text-white rounded-2xl shadow-lg p-6">
                <div class="text-3xl font-bold">{{ $trabajos->filter(function($trabajo) { return $trabajo->reporte->estado == 'resuelto'; })->count() }}</div>
                <div class="opacity-80">Trabajos Resueltos</div>
            </div>
        </div>

        <!-- Listado de Trabajos -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @forelse($trabajos as $trabajo)
                <div class="card-hover bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row">
                        <!-- Icono según prioridad -->
                        <div class="bg-gray-200 dark:bg-gray-700 rounded-xl w-16 h-16 m-6">
                            <div class="flex items-center justify-center h-full">
                                @php
                                    $prioridadIcons = [
                                        'normal' => 'fa-clock text-blue-600 dark:text-blue-400',
                                        'alta' => 'fa-exclamation text-yellow-600 dark:text-yellow-400',
                                        'urgente' => 'fa-exclamation-triangle text-red-600 dark:text-red-400',
                                    ];
                                @endphp
                                <i class="fas {{ $prioridadIcons[$trabajo->prioridad] ?? 'fa-question-circle text-gray-500 dark:text-gray-600' }} text-4xl"></i>
                            </div>
                        </div>
                        
                        <div class="flex-1 p-6">
                            <!-- Detalles principales -->
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                                    {{ ucfirst($trabajo->tipo_trabajo) }} - {{ $trabajo->reporte->cliente->nombre ?? 'N/A' }}
                                </h3>

                                <div class="flex items-center mt-1">
                                    <span class="mr-2">
                                        <i class="fas fa-map-marker-alt mr-1"></i> {{ $trabajo->reporte->direccionAdicional->direccion ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Estado del reporte -->
                            <div class="text-sm font-bold mt-2">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $trabajo->reporte->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100' : '' }}
                                    {{ $trabajo->reporte->estado == 'en_proceso' ? 'bg-blue-100 text-blue-800 dark:bg-blue-700 dark:text-blue-100' : '' }}
                                    {{ $trabajo->reporte->estado == 'resuelto' ? 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100' : '' }}
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $trabajo->reporte->estado)) }}
                                </span>
                            </div>

                            <!-- Información adicional -->
                            <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                    <span>
                                        Registro: {{ $trabajo->created_at->format('d/m/Y') }}
                                    </span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-users text-purple-500 mr-2"></i>
                                    <span>{{ $trabajo->empleados->count() }} empleados</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-tag text-amber-500 mr-2"></i>
                                    <span class="capitalize">{{ $trabajo->prioridad }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-tools text-green-500 mr-2"></i>
                                    <span class="capitalize">{{ $trabajo->tipo_trabajo }}</span>
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="mt-6 flex justify-end space-x-3">
                                <a href="{{ route('trabajos.show', $trabajo) }}" class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-eye fa-lg"></i>
                                </a>
                                <a href="{{ route('trabajos.edit', $trabajo) }}" class="text-yellow-600 hover:text-yellow-800">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>
                                <form action="{{ route('trabajos.destroy', $trabajo) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este trabajo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash fa-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-12 bg-white dark:bg-gray-800 rounded-xl shadow">
                    <i class="fas fa-tasks text-5xl text-gray-300 mb-4"></i>
                    <p class="text-xl text-gray-500">No hay trabajos registrados</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</x-app-layout>
