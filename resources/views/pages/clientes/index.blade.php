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
                <i class="fas fa-users mr-2"></i> Gestión de Clientes
            </h1>
            <div class="mt-4 md:mt-0">
                <a href="{{route('clientes.create')}}"
                    class="bg-indigo-600 dark:bg-indigo-500 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 dark:hover:bg-indigo-600">
                    <i class="fas fa-plus mr-1"></i> Nuevo Cliente
                </a>
            </div>
        </div>

        <!-- Buscador -->
        <div class="mb-8">
            <form action="{{ route('clientes.index') }}" method="GET">
                <div class="relative">
                    <input type="text" name="search" placeholder="Buscar clientes..."
                           class="w-full p-4 rounded-xl shadow-lg border-0 focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-300"
                           value="{{ request('search') }}">
                    <button type="submit" class="absolute right-3 top-3.5 text-indigo-600 dark:text-indigo-400">
                        <i class="fas fa-search fa-lg"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Listado de Clientes -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($clientes as $cliente)
                <x-card-item :item="$cliente" type="clientes" />
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-8">
            {{ $clientes->links() }}
        </div>

    </div>



    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</x-app-layout>
