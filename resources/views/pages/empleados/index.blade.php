@php
    $cargos = ['Gerente', 'Desarrollador', 'Diseñador', 'Analista', 'Administrador'];
    $totalEmpleados = $empleados->count();
    $salarioPromedio = $empleados->avg('salario');
    $totalCasados = $empleados->where('estado_civil', 'Casado/a')->count();
    $totalConExperiencia = $empleados->where('experiencia', '>', 5)->count();
@endphp

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

    <body class="bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4 py-8" x-data="{ openFilters: false }">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-indigo-700 dark:text-indigo-300">
                    <i class="fas fa-users mr-2"></i> Gestión de Empleados
                </h1>
                <div class="mt-4 md:mt-0">
                    <button @click="openFilters = !openFilters"
                        class="bg-white dark:bg-gray-800 text-indigo-600 dark:text-indigo-400 px-4 py-2 rounded-lg shadow mr-3 hover:bg-indigo-50 dark:hover:bg-gray-700">
                        <i class="fas fa-filter mr-1"></i> Filtros
                    </button>
                    <a href="{{route('empleados.create')}}"
                        class="bg-indigo-600 dark:bg-indigo-500 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 dark:hover:bg-indigo-600">
                        <i class="fas fa-plus mr-1"></i> Nuevo Empleado
                    </a>
                </div>
            </div>

            <!-- Filtros -->
            <div x-show="openFilters"
                class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 mb-8 transition-all duration-300">
                <form action="{{ route('empleados.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cargo</label>
                            <select name="cargo"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm dark:bg-gray-700 dark:text-gray-300">
                                <option value="">Todos</option>
                                @foreach($cargos as $cargo)
                                    <option value="{{ $cargo }}">{{ $cargo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado
                                Civil</label>
                            <select name="estado_civil"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm dark:bg-gray-700 dark:text-gray-300">
                                <option value="">Todos</option>
                                <option value="Soltero/a">Soltero/a</option>
                                <option value="Casado/a">Casado/a</option>
                                <option value="Divorciado/a">Divorciado/a</option>
                                <option value="Viudo/a">Viudo/a</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Salario
                                Mínimo</label>
                            <input type="number" name="salario_min"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm dark:bg-gray-700 dark:text-gray-300">
                        </div>
                        <div class="flex items-end">
                            <button type="submit"
                                class="bg-indigo-600 dark:bg-indigo-500 text-white w-full py-2 rounded-lg shadow hover:bg-indigo-700 dark:hover:bg-indigo-600">
                                Aplicar Filtros
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Buscador -->
            <div class="mb-8">
                <form action="{{ route('empleados.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Buscar empleados..."
                            class="w-full p-4 rounded-xl shadow-lg border-0 focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-300"
                            value="{{ request('search') }}">
                        <button type="submit" class="absolute right-3 top-3.5 text-indigo-600 dark:text-indigo-400">
                            <i class="fas fa-search fa-lg"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl shadow-lg p-6">
                    <div class="text-3xl font-bold">{{ $totalEmpleados }}</div>
                    <div class="opacity-80">Total Empleados</div>
                </div>
                <div class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-2xl shadow-lg p-6">
                    <div class="text-3xl font-bold">Bs. {{ number_format($salarioPromedio, 2) }}</div>
                    <div class="opacity-80">Salario Promedio</div>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow-lg p-6">
                    <div class="text-3xl font-bold">{{ $totalCasados }}</div>
                    <div class="opacity-80">Casados</div>
                </div>
                <div class="bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-2xl shadow-lg p-6">
                    <div class="text-3xl font-bold">{{ $totalConExperiencia }}</div>
                    <div class="opacity-80">+5 años Exp.</div>
                </div>
            </div>

            <!-- Listado de Empleados -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach($empleados as $empleado)
                    <x-card-item :item="$empleado" type="empleados" />
                @endforeach
            </div>


            <!-- Paginación -->
            <div class="mt-8">
                {{ $empleados->links() }}
            </div>
        </div>

        <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    </body>
</x-app-layout>