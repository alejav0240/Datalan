<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-screen-xl mx-auto">
        <div class="mb-8 text-center">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold mb-2">
                {{ isset($cliente) ? 'Editar Cliente' : 'Registrar Cliente' }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                {{ isset($cliente) ? 'Actualiza la información del cliente' : 'Completa el formulario para registrar un nuevo cliente' }}
            </p>
        </div>
        
        <x-forms.form-cliente :cliente="$cliente ?? null" />
    </div>
</x-app-layout>