
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
                            <h3 class="text-2xl font-bold">{{ $cliente->user->name }}</h3>
                            <div class="flex flex-wrap items-center justify-center md:justify-start mt-2">
                                @php
                                    $roleColors = [
                                        'empleado' => 'bg-cyan-600 dark:bg-cyan-500',
                                        'supervisor' => 'bg-yellow-500 dark:bg-yellow-600',
                                        'administrador' => 'bg-red-500 dark:bg-red-600',
                                    ];
                                @endphp
                                <span
                                    class="role-badge {{ $roleColors[$cliente->user->role] ?? 'bg-gray-500 dark:bg-gray-600' }} text-white mr-2">
                                    {{ ucfirst($cliente->user->role) }}
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
                                <button data-tab="trabajos"
                                    class="tab-link inline-block py-4 px-4 text-sm font-medium text-center border-b-2 border-transparent rounded-t-lg hover:text-blue-600 hover:border-blue-600">
                                    <i class="fas fa-tasks mr-2"></i>Direcciones Registradas
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
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Tipo de Cliente
                                    </div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ ucfirst($cliente->tipo_cliente) }}
                                    </div>
                                </div>

                                <div>
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Nombre</div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ $cliente->user->name }}
                                    </div>
                                </div>

                                <div>
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Email</div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ $cliente->user->email }}
                                    </div>
                                </div>

                                <div>
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Teléfono
                                    </div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ $cliente->telefono }}
                                    </div>
                                </div>

                                <div>
                                    <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">NIT / CI</div>
                                    <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                        {{ $cliente->nit_ci }}
                                    </div>
                                </div>


                            </div>
                        </div>

                
                        <!-- Direcciones Tab -->
                        <div id="trabajos" class="tab-content">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 rounded-lg overflow-hidden shadow-lg">
                                    <thead class="bg-gray-50 dark:bg-gray-800">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Dirección</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Mapa</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($cliente->direcciones as $direccion)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="font-medium text-gray-900 dark:text-gray-100">{{ $direccion->direccion }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <a href="https://www.google.com/maps?q={{ $direccion->latitud }},{{ $direccion->longitud }}" target="_blank"
                                                        class="text-blue-600 dark:text-blue-400 hover:underline">
                                                        Ver en Google Maps
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Permisos Tab -->
                       
                    </div>

                    <!-- Additional Information -->
                    <div class="p-6 border-t">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Fecha de Registro
                                </div>
                                <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                    {{ $cliente->created_at->format('d M, Y') }}
                                </div>
                            </div>

                            <div>
                                <div class="info-label text-gray-400 dark:text-gray-600 font-semibold">Última
                                    Actualización</div>
                                <div class="info-value text-gray-800 dark:text-gray-400 font-medium">
                                    {{ $cliente->updated_at->format('d M, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="p-6 border-t flex justify-between">
                        <a href="{{ route('clientes.index') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                            <i class="fas fa-arrow-left"></i>Volver a la lista
                        </a>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('clientes.edit', $cliente->id) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                                <i class="fas fa-edit"></i>Editar
                            </a>
                            <button
                                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition flex items-center"
                                onclick="window.print()">
                                <i class="fas fa-print"></i>Imprimir
                            </button>
                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
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