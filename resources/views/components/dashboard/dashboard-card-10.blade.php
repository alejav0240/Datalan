<div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-lg rounded-2xl overflow-hidden">
    <!-- Header -->
    <header class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Top Empleados con más Trabajos en el Mes
        </h2>
    </header>

    <!-- Table -->
    <div class="p-4 overflow-x-auto">
        <table class="min-w-full table-auto">
            <!-- Table Header -->
            <thead class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700">
            <tr>
                <th class="px-4 py-3 text-left">Nombre</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">Trabajos</th>
                <th class="px-4 py-3 text-center">Cargo</th>
            </tr>
            </thead>

            <!-- Table Body -->
            <tbody class="text-sm divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($empleadosConMasTrabajos as $empleado)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                    <!-- Nombre + Icono -->
                    <td class="px-4 py-3 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-600/20 flex items-center justify-center">
                                <i class="fas fa-user-cog text-green-600 dark:text-green-400 text-xl"></i>
                            </div>
                            <span class="font-medium text-gray-800 dark:text-gray-200">
                {{ $empleado->user->name ?? 'Sin nombre' }}
              </span>
                        </div>
                    </td>

                    <!-- Email -->
                    <td class="px-4 py-3 whitespace-nowrap text-gray-700 dark:text-gray-300">
                        {{ $empleado->user->email ?? 'Sin correo' }}
                    </td>

                    <!-- Trabajos -->
                    <td class="px-4 py-3 whitespace-nowrap">
            <span class="font-semibold text-green-600 dark:text-green-400">
              {{ $empleado->cantidad_trabajos }}
            </span>
                    </td>

                    <!-- Cargo -->
                    <td class="px-4 py-3 text-center text-gray-600 dark:text-gray-300">
                        {{ $empleado->cargo }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
