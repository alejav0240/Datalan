<div class="col-span-full xl:col-span-6 bg-white dark:bg-gray-800 shadow-xs rounded-xl">
    <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60">
        <h2 class="font-semibold text-gray-800 dark:text-gray-100">Top Empleados con mas Trabajos en el mes </h2>
    </header>
    <div class="p-3">

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <!-- Table header -->
                <thead class="text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Nombre</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Email</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Trabajo</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Cargo</div>
                        </th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-700/60">
                @foreach ($empleadosConMasTrabajos as $empleado)
                    <tr>
                        <td class="p-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                                    <i class="fas fa-user-cog text-4xl text-green-600 dark:text-green-400"></i>
                                 </div>
                                <div class="font-medium text-gray-800 dark:text-gray-300">{{ $empleado->user->name ?? 'Sin nombre' }}</div>
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left">{{ $empleado->user->email ?? 'Sin correo' }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left font-medium text-green-500">{{ $empleado->cantidad_trabajos }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-sm text-center">{{ $empleado->cargo }}</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>
</div>
