<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Clientes</h1>
            </div>
        </div>

        <div class="mb-4 space-x-1">
            <x-button href="" class="bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 rounded-lg px-4 py-2 shadow-md transition-all duration-300 ease-in-out transform hover:scale-105 focus:ring-offset-blue-200">
                <i class="fas fa-plus"></i> Agregar Cliente
            </x-button>
        </div>

        <x-tables.clientes-table :clientes="$clientes" />
    </div>
</x-app-layout>
