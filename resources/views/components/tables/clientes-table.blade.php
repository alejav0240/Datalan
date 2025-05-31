<div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-x-auto">
    <table class="min-w-full w-full divide-y divide-gray-200 dark:divide-gray-700 text-center">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nombre</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tipo</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">NIT/CI</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Direccion</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Teléfono</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Celular</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Email</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Estado</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Acciones</th>
                <th class="px-4 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Extras</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($clientes as $cliente)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $cliente->nombre_cliente }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $cliente->tipo_cliente }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $cliente->nit_ci }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $cliente->direccion_principal }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $cliente->telefono }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $cliente->celular }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $cliente->email_acceso }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">
                        <span class="{{ $cliente->activo ? 'text-green-500' : 'text-red-500' }}">
                            {{ $cliente->activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">
                        <div class="flex flex-wrap gap-2 justify-center">
                            <x-button class="bg-indigo-100 dark:bg-indigo-700 text-indigo-800 dark:text-white hover:bg-indigo-200 dark:hover:bg-indigo-600 text-xs py-1 px-3 rounded-md shadow-sm transition">Editar</x-button>
                            <x-button class="bg-red-100 dark:bg-red-700 text-red-800 dark:text-white hover:bg-red-200 dark:hover:bg-red-600 text-xs py-1 px-3 rounded-md shadow-sm transition">Eliminar</x-button>
                        </div>
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">
                        <div class="flex flex-wrap gap-2 justify-center">
                            <x-button class="bg-blue-100 dark:bg-blue-700 text-blue-800 dark:text-white hover:bg-blue-200 dark:hover:bg-blue-600 text-xs py-1 px-3 rounded-md shadow-sm transition">Extras</x-button>
                            <x-button class="bg-green-100 dark:bg-green-700 text-green-800 dark:text-white hover:bg-green-200 dark:hover:bg-green-600 text-xs py-1 px-3 rounded-md shadow-sm transition">Servicios</x-button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
