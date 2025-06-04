<div x-data="{ estado: 'activo' }" class="space-y-6">
    <!-- Mensajes de éxito mejorado -->
    @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-init="setTimeout(() => show = false, 5000)" 
            class="relative bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 p-4 rounded-lg shadow-sm dark:from-green-900 dark:to-green-800 dark:border-green-600"
            role="alert"
        >
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-600 dark:text-green-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-green-800 dark:text-green-100">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-green-600 hover:text-green-800 dark:text-green-300 dark:hover:text-green-100 focus:outline-none transition-colors duration-150">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Barra de acciones mejorada -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <a 
            href="{{ route('clientes.create') }}" 
            class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:from-blue-700 hover:to-blue-800 transition-all duration-200 ease-in-out transform hover:-translate-y-0.5"
        >
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Nuevo Cliente
        </a>
        
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">Filtrar por estado:</label>
            <select 
                x-model="estado" 
                id="estado"
                class="block w-full sm:w-40 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-700  dark:border-gray-600 dark:text-gray-200 text-sm py-2 px-3 border transition duration-150 ease-in-out bg-white dark:bg-gray-800 hover:border-gray-400 dark:hover:border-gray-500"
            >
                <option value="activo">Activos</option>
                <option value="inactivo">Inactivos</option>
                <option value="todos">Todos</option>
            </select>
        </div>
    </div>

    <!-- Tabla mejorada -->
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Tipo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">NIT/CI</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Contacto</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($clientes as $cliente)
                        <tr 
                            x-show="
                                estado === 'todos' ||
                                (estado === 'activo' && {{ $cliente->user->is_active ? 'true' : 'false' }}) ||
                                (estado === 'inactivo' && {{ $cliente->user->is_active ? 'false' : 'true' }})
                            "
                            class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150"
                        >
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $cliente->nombre }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $cliente->tipo_cliente === 'empresa' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-200' : '' }}
                                    {{ $cliente->tipo_cliente === 'gobierno' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-200' : '' }}
                                    {{ $cliente->tipo_cliente === 'educacion' ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200' : '' }}
                                    {{ $cliente->tipo_cliente === 'residencial' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-200' : '' }}">
                                    {{ ucfirst($cliente->tipo_cliente) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $cliente->nit_ci }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $cliente->telefono }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $cliente->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $cliente->user->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-200' }}">
                                    {{ $cliente->user->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-3">
                                    <a 
                                        href="{{ route('clientes.edit', $cliente->id) }}"
                                        class="flex items-center justify-center p-1.5 rounded-md text-blue-600 dark:text-blue-400 hover:text-white hover:bg-blue-600 dark:hover:bg-blue-700 dark:hover:text-white transition-colors duration-200"
                                        title="Editar"
                                    >
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                    </a>
                                    
                                    @if ($cliente->user->is_active)
                                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="flex items-center justify-center p-1.5 rounded-md text-red-600 dark:text-red-400 hover:text-white hover:bg-red-600 dark:hover:bg-red-700 dark:hover:text-white transition-colors duration-200"
                                                title="Desactivar"
                                            >
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('clientes.enable', $cliente->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button 
                                                type="submit" 
                                                class="flex items-center justify-center p-1.5 rounded-md text-green-600 dark:text-green-400 hover:text-white hover:bg-green-600 dark:hover:bg-green-700 dark:hover:text-white transition-colors duration-200"
                                                title="Activar"
                                            >
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <x-modals.clientes-direcciones-modal :cliente="$cliente" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">No se encontraron clientes</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Intenta ajustar tus filtros o crear un nuevo cliente</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>