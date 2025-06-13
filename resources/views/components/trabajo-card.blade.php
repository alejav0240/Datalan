@props(['trabajo'])

<div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200 overflow-hidden">
    <div class="flex flex-col h-full">
        <!-- Card top -->
        <div class="grow p-5">
            <div class="flex justify-between items-start">
                <!-- Icono según prioridad -->
                <div>
                    @if($trabajo->prioridad == 'baja')
                        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-emerald-100">
                            <svg class="w-6 h-6 fill-current text-emerald-600" viewBox="0 0 24 24">
                                <path d="M12 17l-5-5 1.41-1.41L12 14.17l4.59-4.58L18 11l-6 6z"></path>
                            </svg>
                        </div>
                    @elseif($trabajo->prioridad == 'media')
                        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-100">
                            <svg class="w-6 h-6 fill-current text-blue-600" viewBox="0 0 24 24">
                                <path d="M12 9l-5 5 1.41 1.41L12 11.83l4.59 4.58L18 15l-6-6z"></path>
                            </svg>
                        </div>
                    @elseif($trabajo->prioridad == 'alta')
                        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-amber-100">
                            <svg class="w-6 h-6 fill-current text-amber-600" viewBox="0 0 24 24">
                                <path d="M12 2L1 21h22L12 2zm0 16h-2v-2h2v2zm0-4h-2v-4h2v4z"></path>
                            </svg>
                        </div>
                    @else
                        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-rose-100">
                            <svg class="w-6 h-6 fill-current text-rose-600" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <!-- Estado del trabajo -->
                <div class="inline-flex font-medium rounded-full text-center px-2.5 py-0.5 {{ $trabajo->estado === 'pendiente' ? 'bg-amber-100 text-amber-600' : ($trabajo->estado === 'en_progreso' ? 'bg-indigo-100 text-indigo-600' : 'bg-emerald-100 text-emerald-600') }}">
                    {{ ucfirst(str_replace('_', ' ', $trabajo->estado)) }}
                </div>
            </div>
            <!-- Detalles principales -->
            <div class="mt-4">
                <div class="text-xl font-semibold text-slate-800 mb-1">{{ $trabajo->tipo }}</div>
                <div class="text-sm">
                    <span class="text-slate-400">Cliente:</span> 
                    <span class="font-medium text-slate-600">{{ $trabajo->reporteFalla->cliente->nombre }}</span>
                </div>
                <div class="text-sm mt-1">
                    <span class="text-slate-400">Reporte:</span> 
                    <span class="font-medium text-slate-600">{{ $trabajo->reporteFalla->tipo_falla }}</span>
                </div>
                <div class="text-sm mt-1">
                    <span class="text-slate-400">Dirección:</span> 
                    <span class="font-medium text-slate-600">{{ $trabajo->reporteFalla->direccionAdicional ? $trabajo->reporteFalla->direccionAdicional->direccion : $trabajo->reporteFalla->cliente->direccion }}</span>
                </div>
                <div class="text-sm mt-1">
                    <span class="text-slate-400">Prioridad:</span> 
                    <span class="font-medium {{ $trabajo->prioridad === 'baja' ? 'text-emerald-600' : ($trabajo->prioridad === 'media' ? 'text-blue-600' : ($trabajo->prioridad === 'alta' ? 'text-amber-600' : 'text-rose-600')) }}">
                        {{ ucfirst($trabajo->prioridad) }}
                    </span>
                </div>
            </div>
            <!-- Descripción -->
            <div class="mt-4">
                <h3 class="text-sm font-semibold text-slate-800">Descripción:</h3>
                <div class="text-sm text-slate-600 line-clamp-2">{{ $trabajo->descripcion }}</div>
            </div>
            <!-- Equipo asignado -->
            <div class="mt-4">
                <h3 class="text-sm font-semibold text-slate-800">Equipo:</h3>
                <div class="flex -space-x-3 -ml-0.5 mt-1">
                    @foreach($trabajo->empleados as $empleado)
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-200 border-2 border-white" title="{{ $empleado->nombre }} {{ $empleado->apellido }} {{ $empleado->pivot->is_encargado ? '(Encargado)' : '' }}">
                            <span class="text-xs font-semibold text-slate-600">{{ substr($empleado->nombre, 0, 1) }}{{ substr($empleado->apellido, 0, 1) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Card footer -->
        <div class="border-t border-slate-200">
            <div class="flex divide-x divide-slate-200r">
                <a href="{{ route('trabajos.show', $trabajo) }}" class="block flex-1 text-center text-sm text-indigo-500 hover:text-indigo-600 font-medium px-3 py-4">
                    <div class="flex items-center justify-center">
                        <svg class="w-4 h-4 fill-current text-indigo-400 group-hover:text-indigo-600 shrink-0 mr-2" viewBox="0 0 16 16">
                            <path d="M14 0H2c-.6 0-1 .4-1 1v14c0 .6.4 1 1 1h8l5-5V1c0-.6-.4-1-1-1zM3 2h10v8H9v4H3V2z"></path>
                        </svg>
                        <span>Ver Detalles</span>
                    </div>
                </a>
                <a href="{{ route('trabajos.edit', $trabajo) }}" class="block flex-1 text-center text-sm text-slate-600 hover:text-slate-800 font-medium px-3 py-4 group">
                    <div class="flex items-center justify-center">
                        <svg class="w-4 h-4 fill-current text-slate-400 group-hover:text-slate-600 shrink-0 mr-2" viewBox="0 0 16 16">
                            <path d="M11.7.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM4.6 14H2v-2.6l6-6L10.6 8l-6 6zM12 6.6L9.4 4 11 2.4 13.6 5 12 6.6z"></path>
                        </svg>
                        <span>Editar</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>