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

    <div class="container mx-auto px-4 py-8 bg-gray-50 dark:bg-gray-900">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-700 dark:text-indigo-300">
                <i class="fas fa-users mr-2"></i> Permisos
            </h1>
            <div class="mt-4 md:mt-0">
                @if(Auth::user()->role !== 'administrador')
                    @if(Auth::user()->empleado->permisos->count() < 5)
                        <a href="{{route('clientes.create')}}"
                            class="bg-indigo-600 dark:bg-indigo-500 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 dark:hover:bg-indigo-600">
                            <i class="fas fa-plus mr-1"></i> Solicitar Permiso
                        </a>
                    @else
                        <span class="text-red-600 dark:text-red-400 font-semibold">
                            Permisos excedidos
                        </span>
                    @endif
                @endif

            </div>
        </div>

        <!-- Listado de Clientes -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
        </div>

    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</x-app-layout>