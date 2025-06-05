<div x-data="{ estado: 'activo' }" class="space-y-4">
    <!-- Filtro -->
    <div class="flex justify-between items-center">
        <x-button>
            <a href="{{ route('empleados.create') }}" class="text-white">
                Agregar Empleado
            </a>
        </x-button>
        <select x-model="estado"
                class="border-gray-300 rounded-md shadow-sm ml-2 dark:bg-gray-700 dark:text-white text-sm">
            <option value="todos">Todos</option>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select>
    </div>

    <!-- Tabla -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-x-auto">
        <table class="min-w-full w-full divide-y divide-gray-200 dark:divide-gray-700 text-center">
            <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ID</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nombre Completo</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">CI</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Teléfono</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Email</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Cargo</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Estado</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Acciones</th>
            </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($empleados as $empleado)

                <tr
                    x-show="
                            estado === 'todos' ||
                            (estado === 'activo' && {{ $empleado->user->is_active ? 'true' : 'false' }}) ||
                            (estado === 'inactivo' && {{ $empleado->user->is_active ? 'false' : 'true' }})
                        "
                >
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $empleado->id }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $empleado->user->name }}}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $empleado->ci }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $empleado->telefono }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $empleado->user->email }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $empleado->cargo }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">
                            <span class="{{ $empleado->user->is_active ? 'text-green-500' : 'text-red-500' }}">
                                {{ $empleado->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">
                        <div class="flex flex-wrap gap-2 justify-center">
                            <x-button>
                                <a href="{{ route('empleados.show', $empleado->id) }}" class="text-white">
                                    Ver
                                </a>
                            </x-button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
