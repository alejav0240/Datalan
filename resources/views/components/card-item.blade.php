<div class="card-hover bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
    <div class="flex flex-col md:flex-row">
        <div class="bg-gray-200 dark:bg-gray-700 rounded-xl w-16 h-16 m-6">
            <div class="flex items-center justify-center h-full">
                @if($type === 'clientes')
                    <i class="fas fa-user-tie text-4xl text-indigo-600 dark:text-indigo-400"></i>
                @elseif($type === 'empleados')
                    <i class="fas fa-user-cog text-4xl text-green-600 dark:text-green-400"></i>
                    @elseif($type === 'permisos')
                    @php
                        $estadoIcons = [
                            'pendiente' => 'fa-regular fa-clock text-yellow-600 dark:text-yellow-400',
                            'aprobado' => 'fa-thumbs-up text-green-600 dark:text-green-400',
                            'rechazado' => 'fa-thumbs-down text-red-600 dark:text-red-400',
                        ];
                    @endphp
                    <i class="fas {{ $estadoIcons[$item->estado] ?? 'fa-question-circle text-gray-500 dark:text-gray-600' }} text-4xl"></i>
                @endif
            </div>
        </div>
        <div class="flex-1 p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                        @if($type === 'permisos')
                            {{ $item->empleado->user->name ?? 'N/A' }}
                        @else
                            {{ $item->user->name ?? 'N/A' }}
                        @endif
                    </h3>
                    <div class="flex items-center mt-1">
                        @if($type === 'clientes')
                            {{-- cliente logic aquí --}}
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
                    @elseif($type === 'clientes')
                        <div class="text-2xl font-bold text-indigo-700 dark:text-indigo-500">
                            NIT/CI. {{ $item->nit_ci ?? 'N/A' }}
                        </div>
                    @elseif($type === 'permisos')
                        @php
                            $estadoColors = [
                                'pendiente' => 'bg-yellow-500 dark:bg-yellow-600',
                                'aprobado' => 'bg-green-500 dark:bg-green-600',
                                'rechazado' => 'bg-red-500 dark:bg-red-600',
                            ];
                        @endphp
                        <!-- Estado del Permiso -->
                        <span class="status-badge {{ $estadoColors[$item->estado] ?? 'bg-gray-500 dark:bg-gray-600' }} text-white py-1 px-3 rounded-lg mt-2">
                            {{ ucfirst($item->estado) }}
                        </span>
                    @endif

                    @if($type !== 'permisos')
                        <div class="text-sm font-bold {{ $item->user->is_active ? 'text-green-500' : 'text-red-500' }}">
                            {{ $item->user->is_active ? 'Activo' : 'Inactivo' }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                <div class="flex items-center">
                    
                    
                        @if($type === 'permisos')
                        <span class="text-red-500 dark:text-red-400">
                            <i class="fas fa-file-alt mr-1"></i>
                            {{ $item->motivo?? 'N/A' }}
                        </span>
                        @else
                        <span>
                            <i class="fas fa-phone text-indigo-500 mr-2"></i>
                            {{ $item->telefono ?? 'N/A' }}
                        </span>
                        @endif
                    </span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                    <span>
                        Registro: {{ $item->created_at->format('d/m/Y') }}
                    </span>
                </div>
            
                <!-- Desde y Hasta -->
                @if($type === 'permisos')
                    <div class="flex items-center">
                        <i class="fas fa-calendar-day text-green-500 mr-2"></i>
                        <span>
                            <strong>Desde:</strong> {{ \Carbon\Carbon::parse($item->fecha_inicio)->format('d/m/Y') }} 
                        </span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar-day text-green-500 mr-2"></i>
                        <span>
                            <strong>Hasta:</strong> {{ \Carbon\Carbon::parse($item->fecha_fin)->format('d/m/Y') }}
                        </span>
                    </div>
                @endif
            
                @if($type === 'empleados')
                    <div class="flex items-center">
                        <i class="fas fa-tasks text-amber-500 mr-2"></i>
                        <span>{{ $item->trabajos->count() }} proyectos</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-heart text-pink-500 mr-2"></i>
                        <span>{{ $item->estado_civil }}</span>
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
            
                    <div class="flex items-center">
                        <i class="fa-solid fa-location-dot text-yellow-500 mr-2"></i>
                        <span>
                            @if($item->direcciones->count() === 0)
                                Sin direcciones
                            @elseif($item->reportes_falla->count() === 1)
                                1 Direccion
                            @else
                                {{ $item->reportes_falla->count() }} Direcciones
                            @endif
                        </span>
                    </div>
                @endif
            </div>
            

            <div class="mt-6 flex justify-end space-x-3">
                @if ($type !== 'permisos')         
                    <a href="{{ route($type . '.show', $item) }}" class="text-indigo-600 hover:text-indigo-900">
                        <i class="fas fa-eye fa-lg"></i>
                    </a>
                @endif

            
                <!-- Mostrar botón de editar solo si el estado no es 'aprobado' ni 'rechazado' -->
                @if($type !== 'permisos' && !in_array($item->estado, ['aprobado', 'rechazado']))
                    <a href="{{ route($type . '.edit', $item) }}" class="text-yellow-600 hover:text-yellow-800">
                        <i class="fas fa-edit fa-lg"></i>
                    </a>
                @endif
            
                <!-- Mostrar botón de eliminar solo si no es 'permisos' o si está en estado 'pendiente' -->
                @if($type === 'clientes')
                    @if($item->user->is_active)
                        <!-- Mostrar botón de desactivar -->
                        <form action="{{ route('clientes.destroy', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" title="Desactivar">
                                <i class="fas fa-trash-alt fa-lg"></i>
                            </button>
                        </form>
                    @else
                        <!-- Mostrar botón de activar -->
                        <form action="{{ route('clientes.enable', $item) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-green-600 hover:text-green-800" title="Activar">
                                <i class="fas fa-check fa-lg"></i>
                            </button>
                        </form>
                    @endif
                @elseif($type !== 'permisos' || $item->estado === 'pendiente')
                    <!-- Para otros tipos -->
                    <form action="{{ route($type . '.destroy', $item) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash-alt fa-lg"></i>
                        </button>
                    </form>
                @endif

            
                <!-- Solo si el tipo es permisos y el rol del usuario es 'administrador' -->
                @if($type === 'permisos' && auth()->user()->role === 'administrador')
                    @if($item->estado === 'pendiente') <!-- Solo mostrar si el estado es 'pendiente' -->
                        <!-- Botón Aceptar -->
                        <form action="{{ route('permisos.aprobar', $item) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded-lg">
                                <i class="fas fa-thumbs-up fa-lg"></i>
                            </button>
                        </form>
            
                        <!-- Botón Rechazar -->
                        <form action="{{ route('permisos.rechazar', $item) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded-lg">
                                <i class="fas fa-thumbs-down fa-lg"></i>
                            </button>
                        </form>
                    @endif
                @endif
            </div>
                  
        </div>
    </div>
</div>
