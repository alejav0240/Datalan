<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Detalles del Reporte de Falla</h1>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('reportes.edit', $reporte->id) }}" class="btn bg-yellow-500 hover:bg-yellow-600 text-white">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path d="M11.7.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM4.6 14H2v-2.6l6-6L10.6 8l-6 6zM12 6.6L9.4 4 11 2.4 13.6 5 12 6.6z" />
                    </svg>
                    <span class="ml-2">Editar</span>
                </a>
                <form action="{{ route('reportes.destroy', $reporte->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn bg-red-500 hover:bg-red-600 text-white" onclick="return confirm('¿Está seguro de eliminar este reporte?')">
                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                            <path d="M5 7h2v6H5V7zm4 0h2v6H9V7zm3-6v2h4v2h-1v10c0 .6-.4 1-1 1H2c-.6 0-1-.4-1-1V5H0V3h4V1c0-.6.4-1 1-1h6c.6 0 1 .4 1 1zM6 2v1h4V2H6zm7 3H3v9h10V5z" />
                        </svg>
                        <span class="ml-2">Eliminar</span>
                    </button>
                </form>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">ID</h3>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $reporte->id }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Cliente</h3>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $reporte->cliente->nombre }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo de Falla</h3>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ ucfirst($reporte->tipo_falla) }}</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Estado</h3>
                        <p class="mt-1">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $reporte->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100' : '' }}
                                {{ $reporte->estado == 'en_proceso' ? 'bg-blue-100 text-blue-800 dark:bg-blue-700 dark:text-blue-100' : '' }}
                                {{ $reporte->estado == 'resuelto' ? 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100' : '' }}
                            ">
                                {{ ucfirst(str_replace('_', ' ', $reporte->estado)) }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Creación</h3>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $reporte->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Última Actualización</h3>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $reporte->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Dirección</h3>
                    <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $reporte->direccion }}</p>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Descripción</h3>
                    <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $reporte->descripcion }}</p>
                </div>
            </div>

            @if($reporte->trabajo)
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Trabajo Asignado</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">ID del Trabajo</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $reporte->trabajo->id }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo de Trabajo</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ ucfirst($reporte->trabajo->tipo_trabajo) }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Prioridad</h3>
                            <p class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $reporte->trabajo->prioridad == 'normal' ? 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100' : '' }}
                                    {{ $reporte->trabajo->prioridad == 'alta' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100' : '' }}
                                    {{ $reporte->trabajo->prioridad == 'urgente' ? 'bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100' : '' }}
                                ">
                                    {{ ucfirst($reporte->trabajo->prioridad) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">No hay trabajo asignado</h2>
                    <a href="{{ route('trabajos.create', ['reporte_id' => $reporte->id]) }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                            <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                        </svg>
                        <span class="ml-2">Asignar Trabajo</span>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>