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

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto bg-gray-50 dark:bg-gray-900">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-700 dark:text-indigo-300">
                <i class="fas fa-users mr-2"></i> Gestión de Clientes
            </h1>
            <div class="mt-4 md:mt-0">
                <a href="{{route('clientes.create')}}"
                    class="bg-indigo-600 dark:bg-indigo-500 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 dark:hover:bg-indigo-600">
                    <i class="fas fa-plus mr-1"></i> Nuevo Cliente
                </a>
            </div>
        </div>

        <!-- Listado de Clientes -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($clientes as $cliente)
                <div class="card-hover bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row">
                        <div class="bg-gray-200 dark:bg-gray-700 border-2 border-dashed rounded-xl w-16 h-16 m-6"></div>
                        <div class="flex-1 p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                                        {{ $cliente->nombre ?? 'N/A' }}</h3>
                                    <div class="flex items-center mt-1">
                                        <span class="mr-2">
                                            <i class="fas fa-briefcase mr-1"></i> {{ $cliente->tipo_cliente ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-indigo-700 dark:text-indigo-500">NIT/CI.
                                        {{($cliente->nit_ci ?? 'N/A') }}</div>
                                    <div
                                        class="text-sm font-bold {{ $cliente->user->is_active ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $cliente->user->is_active ? 'Activo' : 'Inactivo' }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-indigo-500 mr-2"></i>
                                    <span>{{ $cliente->telefono ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                    <span>Registro: {{ $cliente->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa fa-location-arrow text-amber-500 mr-2"></i>
                                    <span>
                                        @if($cliente->direcciones->count() === 0)
                                            Sin direcciones
                                        @elseif($cliente->direcciones->count() === 1)
                                            1 Dirección
                                        @else
                                            {{ $cliente->direcciones->count() }} Direcciones
                                        @endif
                                    </span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa fa-exclamation-triangle text-red-500 mr-2"></i>
                                    <span>
                                        @if($cliente->reportes_falla->count() === 0)
                                            Sin reportes de falla
                                        @elseif($cliente->reportes_falla->count() === 1)
                                            1 Reporte de falla
                                        @else
                                            {{ $cliente->reportes_falla->count() }} Reportes de falla
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end space-x-3">
                                <a href="{{ route('clientes.show', $cliente)}}" class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-eye fa-lg"></i>
                                </a>
                                <a href="{{ route('clientes.edit', $cliente) }}"
                                    class="text-yellow-600 hover:text-yellow-800">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>
                                @if($cliente->user->is_active)
                                    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('clientes.enable', $cliente) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800">
                                            <i class="fas fa-check-circle fa-lg"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</x-app-layout>