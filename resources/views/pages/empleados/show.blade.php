<x-app-layout>
    <body class="bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
        <style>
            .employee-card {
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            font-weight: 500;

            .info-label {
                @apply text-gray-600 dark:text-gray-300 font-semibold;
            }

            .info-value {
                @apply text-gray-800 dark:text-gray-100 font-medium;
            }

            .role-badge {
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
            }

            .status-badge {
                padding: 0.25rem 0.75rem;
                border-radius: 0.25rem;
                font-size: 0.75rem;
                font-weight: 600;
            }

            .tab-content {
                display: none;
            }

            .tab-content.active {
                display: block;
                animation: fadeIn 0.3s ease-in;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }
        </style>
        <div class="min-h-screen flex flex-col">

            <!-- Main Content -->
            <main class="flex-grow container mx-auto px-4 py-8">

                <div class="bg-white dark:bg-gray-800 rounded-xl employee-card overflow-hidden">

                    <!-- Employee Header -->
                    <div
                        class="bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-700 dark:to-blue-900 text-white p-6 flex flex-col md:flex-row items-center">
                        <div
                            class="w-24 h-24 rounded-full bg-white dark:bg-gray-800 flex items-center justify-center mb-4 md:mb-0 md:mr-6">
                            <i class="fas fa-user text-blue-600 dark:text-blue-400 text-4xl"></i>
                        </div>
                        <div class="text-center md:text-left">
                            <h3 class="text-2xl font-bold">{{ $empleado->user->name }}</h3>
                            <div class="flex flex-wrap items-center justify-center md:justify-start mt-2">
                                @php
                                    $roleColors = [
                                        'empleado' => 'bg-cyan-600 dark:bg-cyan-500',
                                        'supervisor' => 'bg-yellow-500 dark:bg-yellow-600',
                                        'administrador' => 'bg-red-500 dark:bg-red-600',
                                    ];
                                @endphp
                                <span
                                    class="role-badge {{ $roleColors[$empleado->user->role] ?? 'bg-gray-500 dark:bg-gray-600' }} text-white mr-2">
                                    {{ ucfirst($empleado->user->role) }}
                                </span>
                                <span class="status-badge bg-green-700  text-white">Activo</span>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Tabs -->
                    <div class="border-b">
                        <ul class="flex flex-wrap -mb-px">
                            <li class="mr-2">
                                <button data-tab="personal"
                                    class="tab-link inline-block py-4 px-4 text-sm font-medium text-center border-b-2 border-transparent rounded-t-lg hover:text-blue-600 hover:border-blue-600 active">
                                    <i class="fas fa-user mr-2"></i>Información Personal
                                </button>
                            </li>
                            <li class="mr-2">
                                <button data-tab="professional"
                                    class="tab-link inline-block py-4 px-4 text-sm font-medium text-center border-b-2 border-transparent rounded-t-lg hover:text-blue-600 hover:border-blue-600">
                                    <i class="fas fa-briefcase mr-2"></i>Información Profesional
                                </button>
                            </li>
                            <li class="mr-2">
                                <button data-tab="trabajos"
                                    class="tab-link inline-block py-4 px-4 text-sm font-medium text-center border-b-2 border-transparent rounded-t-lg hover:text-blue-600 hover:border-blue-600">
                                    <i class="fas fa-tasks mr-2"></i>Trabajos Asignados
                                </button>
                            </li>
                            <li class="mr-2">
                                <button data-tab="permisos"
                                    class="tab-link inline-block py-4 px-4 text-sm font-medium text-center border-b-2 border-transparent rounded-t-lg hover:text-blue-600 hover:border-blue-600">
                                    <i class="fas fa-file-alt mr-2"></i>Permisos
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Contents -->
                    <div class="p-6">
                        <!-- Personal Information Tab -->
                        <div id="personal" class="tab-content active">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Nombre
                                        Completo</div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ $empleado->user->name }}</div>
                                </div>

                                <div>
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Email</div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ $empleado->user->email }}</div>
                                </div>

                                <div>
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Teléfono
                                    </div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ $empleado->telefono }}</div>
                                </div>

                                <div>
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Cédula de
                                        Identidad</div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ $empleado->ci }}</div>
                                </div>

                                <div>
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Estado Civil
                                    </div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ ucfirst($empleado->estado_civil) }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information Tab -->
                        <div id="professional" class="tab-content">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Cargo</div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ $empleado->cargo }}</div>
                                </div>

                                <div>
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Rol</div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ ucfirst($empleado->user->role) }}</div>
                                </div>

                                <div>
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Salario</div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">Bs.
                                        {{ number_format($empleado->salario, 2, ',', '.') }}</div>
                                </div>

                                <div class="md:col-span-2">
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Experiencia
                                    </div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ $empleado->experiencia . ' año/s' ?? 'No se ha registrado información sobre experiencia' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Trabajos Asignados Tab -->
                        <div id="trabajos" class="tab-content">
                            @if($empleado->trabajos->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                        <tr>
                                            @foreach(['Trabajo', 'Estado', 'Fecha Inicio', 'Fecha Fin', 'Rol'] as $header)
                                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                                    {{ $header }}
                                                </th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($empleado->trabajos as $trabajo)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="font-medium text-gray-900 dark:text-gray-100">{{ $trabajo->nombre }}</div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $trabajo->descripcion }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @switch($trabajo->estado)
                                        @case('completado') bg-green-100 text-green-800 dark:bg-green-200/10 dark:text-green-400 @break
                                        @case('en_progreso') bg-blue-100 text-blue-800 dark:bg-blue-200/10 dark:text-blue-400 @break
                                        @default bg-yellow-100 text-yellow-800 dark:bg-yellow-200/10 dark:text-yellow-400
                                    @endswitch">
                                    {{ ucfirst(str_replace('_', ' ', $trabajo->estado)) }}
                                </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $trabajo->created_at->format('d M Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $trabajo->updated_at ? $trabajo->updated_at->format('d M Y') : 'En curso' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    @if($trabajo->pivot->is_encargado)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-200/10 dark:text-purple-400">
                                        Encargado
                                    </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-200/10 dark:text-gray-400">
                                        Miembro
                                    </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-tasks text-4xl text-gray-300 dark:text-gray-600 mb-4"></i>
                                    <p class="text-gray-500 dark:text-gray-400">Este empleado no tiene trabajos asignados</p>
                                </div>
                            @endif
                        </div>

                        <!-- Permisos Tab -->
                        <div id="permisos" class="tab-content">
                            @if($empleado->permisos->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="w-full divide-y divide-gray-200 dark:divide-gray-700 rounded-lg overflow-hidden shadow-lg">
                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                            <tr class="text-center">
                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Motivo
                                                </th>
                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Fecha Inicio
                                                </th>
                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Fecha Fin
                                                </th>
                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Estado
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($empleado->permisos as $permiso)
                                                <tr class="text-center">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $permiso->motivo }}</div>
                                                    </td>
                                                    <td class="font-medium text-gray-900 dark:text-gray-100">
                                                        {{ \Carbon\Carbon::parse($permiso->fecha_inicio)->format('d/m/Y') }}
                                                    </td>
                                                    <td class="font-medium text-gray-900 dark:text-gray-100">
                                                        {{ \Carbon\Carbon::parse($permiso->fecha_fin)->format('d/m/Y') }}
                                                    </td>
                                                    <td class="font-medium text-gray-900 dark:text-gray-100">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                            {{ $permiso->estado == 'aprobado' ? 'bg-green-100 text-green-800' :
                                                            ($permiso->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                            {{ ucfirst($permiso->estado) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-file-alt text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-gray-500">Este empleado no tiene permisos registrados</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="p-6 border-t">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Fecha de Registro
                                </div>
                                <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                    {{ $empleado->created_at->format('d M, Y') }}</div>
                            </div>

                            <div>
                                <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Última
                                    Actualización</div>
                                <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                    {{ $empleado->updated_at->format('d M, Y') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="p-6 border-t flex justify-between">
                        <a href="{{ route('empleados.index') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                            <i class="fas fa-arrow-left"></i>Volver a la lista
                        </a>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('empleados.edit', $empleado->id) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                                <i class="fas fa-edit"></i>Editar
                            </a>
                            <button
                                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition flex items-center"
                                onclick="window.print()">
                                <i class="fas fa-print"></i>Imprimir
                            </button>
                            <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro de eliminar este empleado?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                                    <i class="fas fa-trash-alt"></i>Eliminar
                                </button>
                            </form>
                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                                <i class="fas fa-download mr-2"></i>Descargar PDF
                            </button>
                        </div>
                    </div>
                </div>
            </main>


        </div>

        <script>
            // Tab Navigation
            document.addEventListener('DOMContentLoaded', function () {
                const tabLinks = document.querySelectorAll('.tab-link');
                const tabContents = document.querySelectorAll('.tab-content');

                tabLinks.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();

                        // Get target tab ID
                        const tabId = this.getAttribute('data-tab');

                        // Remove active class from all tabs
                        tabLinks.forEach(l => l.classList.remove('active'));
                        tabContents.forEach(c => c.classList.remove('active'));

                        // Add active class to current tab
                        this.classList.add('active');
                        document.getElementById(tabId).classList.add('active');
                    });
                });

                // Format phone number if needed
                const phoneElement = document.querySelector('[data-phone]');
                if (phoneElement) {
                    const phone = phoneElement.textContent.trim();
                    // Add formatting logic if needed
                }
            });
        </script>
    </body>
</x-app-layout>
