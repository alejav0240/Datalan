<div class="card-hover bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
    <div class="flex flex-col md:flex-row">
        <div class="bg-gray-200 dark:bg-gray-700 rounded-xl w-16 h-16 m-6">
            <div class="flex items-center justify-center h-full">
                @if($type === 'clientes')
                    <i class="fas fa-user-tie text-4xl text-indigo-600 dark:text-indigo-400"></i>
                @elseif($type === 'empleados')
                    <i class="fas fa-user-cog text-4xl text-green-600 dark:text-green-400"></i>
                @endif
            </div>
        </div>
        <div class="flex-1 p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                        {{ $item->user->name ?? 'N/A' }}
                    </h3>
                    <div class="flex items-center mt-1">
                        @if($type === 'clientes')
                            <span class="mr-2">
                                @if($item->tipo_cliente === 'gobierno')
                                    <span class="text-blue-600">
                                        <i class="fa-solid fa-landmark mr-1"></i> {{ $item->tipo_cliente }}
                                    </span>
                                @elseif($item->tipo_cliente === 'empresa')
                                    <span class="text-green-600">
                                        <i class="fa-solid fa-building mr-1"></i> {{ $item->tipo_cliente }}
                                    </span>
                                @elseif($item->tipo_cliente === 'residencial')
                                    <span class="text-yellow-600">
                                        <i class="fa-solid fa-house mr-1"></i> {{ $item->tipo_cliente }}
                                    </span>
                                @elseif($item->tipo_cliente === 'educacion')
                                    <span class="text-purple-600">
                                        <i class="fa-solid fa-graduation-cap mr-1"></i> {{ $item->tipo_cliente }}
                                    </span>
                                @else
                                    <span class="text-gray-600">
                                        <i class="fa-solid fa-question-circle mr-1"></i> {{ $item->tipo_cliente ?? 'N/A' }}
                                    </span>
                                @endif
                            </span>
                        @elseif($type === 'empleados')
                            <span class="mr-2">
                                <i class="fas fa-briefcase mr-1"></i> {{ $item->cargo ?? 'N/A' }}
                            </span>
                            <span class="bg-green-100 text-green-800 badge">
                                <i class="fas fa-star mr-1"></i> {{ $item->experiencia }} años
                            </span>
                        @endif
                    </div>
                </div>
                <div class="text-right">
                    @if($type === 'empleados')
                        <div class="text-2xl font-bold text-indigo-700 dark:text-indigo-500">
                            B. {{ number_format($item->salario, 2) }}
                        </div>
                        <div class="text-sm text-gray-500">CI: {{ $item->ci }}</div>
                    @else
                        <div class="text-2xl font-bold text-indigo-700 dark:text-indigo-500">NIT/CI.
                            {{ $item->nit_ci ?? 'N/A' }}
                        </div>
                    @endif
                    <div class="text-sm font-bold {{ $item->user->is_active ? 'text-green-500' : 'text-red-500' }}">
                        {{ $item->user->is_active ? 'Activo' : 'Inactivo' }}
                    </div>
                </div>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                <div class="flex items-center">
                    <i class="fas fa-phone text-indigo-500 mr-2"></i>
                    <span>{{ $item->telefono ?? 'N/A' }}</span>
                </div>
                <div class="flex items-center">
                    @if($type === 'empleados')
                        <i class="fas fa-heart text-pink-500 mr-2"></i>
                        <span>{{ $item->estado_civil ?? 'N/A' }}</span>
                    @else
                        <i class="fa fa-location-arrow text-amber-500 mr-2"></i>
                        <span>
                            @if($item->direcciones->count() === 0)
                                Sin direcciones
                            @elseif($item->direcciones->count() === 1)
                                1 Dirección
                            @else
                                {{ $item->direcciones->count() }} Direcciones
                            @endif
                        </span>
                        
                    @endif
                </div>
                
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                    <span>Registro: {{ $item->created_at->format('d/m/Y') }}</span>
                </div>
                @if($type === 'empleados')
                    <div class="flex items-center">
                        <i class="fas fa-tasks text-amber-500 mr-2"></i>
                        <span>{{ $item->trabajos->count() }} proyectos</span>
                    </div>
                @endif
                @if($type === 'clientes')
                    <div class="flex items-center">
                        <i class="fa fa-exclamation-triangle text-red-500 mr-2"></i>
                        <span>
                            @if($item->reportes_falla->count() === 0)
                                Sin reportes de fallas
                            @elseif($item->reportes_falla->count() === 1)
                                1 Reporte de falla
                            @else
                                {{ $item->reportes_falla->count() }} Reportes de fallas
                            @endif
                        </span>
                    </div>
                @endif
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route($type . '.show', $item) }}" class="text-indigo-600 hover:text-indigo-900">
                    <i class="fas fa-eye fa-lg"></i>
                </a>
                <a href="{{ route($type . '.edit', $item) }}" class="text-yellow-600 hover:text-yellow-800">
                    <i class="fas fa-edit fa-lg"></i>
                </a>
                @if($item->user->is_active)
                    <form action="{{ route($type . '.destroy', $item) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash-alt fa-lg"></i>
                        </button>
                    </form>
                @else
                    <form action="{{ route($type . '.enable', $item) }}" method="POST">
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
