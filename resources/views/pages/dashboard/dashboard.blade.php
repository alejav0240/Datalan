<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Dashboard</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
{{--                <x-dropdown-filter align="right" />--}}

{{--                <!-- Datepicker built with flatpickr -->--}}
{{--                <x-datepicker />--}}

{{--                <!-- Add view button -->--}}
{{--                <button class="btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">--}}
{{--                    <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">--}}
{{--                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />--}}
{{--                  </svg>--}}
{{--                  <span> Agregar Tarjeta </span>--}}
{{--                </button>--}}

            </div>

        </div>


        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl shadow-lg p-6">
                <div class="text-3xl font-bold">{{ $totalEmpleados }}</div>
                <div class="opacity-80">Total Empleados</div>
            </div>
            <div class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-2xl shadow-lg p-6">
                <div class="text-3xl font-bold">{{ $totalClientes }}</div>
                <div class="opacity-80">Total Clientes</div>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow-lg p-6">
                <div class="text-3xl font-bold">{{ $totalPermisos }}</div>
                <div class="opacity-80">Total de Permisos </div>
            </div>
            <div class="bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-2xl shadow-lg p-6">
                <div class="text-3xl font-bold">{{ $totalTrabajos }}</div>
                <div class="opacity-80">Total Trabajos</div>
            </div>

            <div class="bg-gradient-to-r from-fuchsia-500 to-purple-600 text-white rounded-2xl shadow-lg p-6">
                <div class="text-3xl font-bold">{{ $totalReportes }}</div>
                <div class="opacity-80">Total Reportes</div>
            </div>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">



            <!-- Line chart (Acme Plus) -->
            <x-dashboard.dashboard-card-01 :trabajosPorMes="$trabajosPorMes" />

            <!-- Line chart (Acme Advanced) -->
{{--            <x-dashboard.dashboard-card-02 />--}}

{{--            <!-- Line chart (Acme Professional) -->--}}
{{--            <x-dashboard.dashboard-card-03 :dataFeed="$dataFeed" />--}}

            <!-- Bar chart (Direct vs Indirect) -->
{{--            <x-dashboard.dashboard-card-04 />--}}

{{--            <!-- Line chart (Real Time Value) -->--}}
{{--            <x-dashboard.dashboard-card-05 />--}}

{{--            <!-- Doughnut chart (Top Countries) -->--}}
{{--            <x-dashboard.dashboard-card-06 />--}}

{{--            <!-- Table (Top Channels) -->--}}
{{--            <x-dashboard.dashboard-card-07 />--}}

{{--            <!-- Line chart (Sales Over Time) -->--}}
{{--            <x-dashboard.dashboard-card-08 />--}}

{{--            <!-- Stacked bar chart (Sales VS Refunds) -->--}}
{{--            <x-dashboard.dashboard-card-09 />--}}

{{--            <!-- Card (Customers) -->--}}
{{--            <x-dashboard.dashboard-card-10 />--}}

{{--            <!-- Card (Reasons for Refunds) -->--}}
{{--            <x-dashboard.dashboard-card-11 />--}}

{{--            <!-- Card (Recent Activity) -->--}}
{{--            <x-dashboard.dashboard-card-12 />--}}

{{--            <!-- Card (Income/Expenses) -->--}}
{{--            <x-dashboard.dashboard-card-13 />--}}

        </div>

    </div>
</x-app-layout>
