<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Encabezado de página -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl font-bold">Detalle del Trabajo #{{ $trabajo->id }}</h1>
            </div>
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <a href="{{ route('trabajos.edit', $trabajo) }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                    <span class="hidden xs:block ml-2">Editar</span>
                </a>
                <a href="{{ route('trabajos.index') }}" class="btn border-slate-200 hover:border-slate-300 text-slate-600">
                    <span class="hidden xs:block ml-2">Volver</span>
                </a>
            </div>
        </div>

        <!-- Tarjeta de información -->
        <div class="bg-white shadow-lg rounded-sm border border-slate-200 mb-8">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-5">Información del Trabajo</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-4">
                            <span class="font-semibold text-slate-400">Tipo:</span>
                            <p>{{ $trabajo->tipo }}</p>
                        </div>
                        <div class="mb-4">
                            <span class="font-semibold text-slate-400">Descripción:</span>
                            <p>{{ $trabajo->descripcion }}</p>
                        </div>
                        <div class="mb-4">
                            <span class="font-semibold text-slate-400">Prioridad:</span>
                            <p>
                                @switch($trabajo->prioridad)
                                    @case('baja')
                                        <span class="text-green-500 font-semibold">Baja</span>
                                        @break
                                    @case('media')
                                        <span class="text-blue-500 font-semibold">Media</span>
                                        @break
                                    @case('alta')
                                        <span class="text-amber-500 font-semibold">Alta</span>
                                        @break
                                    @case('urgente')
                                        <span class="text-rose-500 font-semibold">Urgente</span>
                                        @break
                                @endswitch
                            </p>
                        </div>
                        <div class="mb-4">
                            <span class="font-semibold text-slate-400">Estado:</span>
                            <p>
                                @switch($trabajo->estado)
                                    @case('pendiente')
                                        <span class="text-amber-500 font-semibold">Pendiente</span>
                                        @break
                                    @case('en_proceso')
                                        <span class="text-blue-500 font-semibold">En Proceso</span>
                                        @break
                                    @case('completado')
                                        <span class="text-green-500 font-semibold">Completado</span>
                                        @break
                                    @case('cancelado')
                                        <span class="text-rose-500 font-semibold">Cancelado</span>
                                        @break
                                @endswitch
                            </p>
                        </div>
                    </div>
                    <div>
                        <div class="mb-4">
                            <span class="font-semibold text-slate-400">Materiales:</span>
                            <p>{{ $trabajo->materiales ?: 'No especificados' }}</p>
                        </div>
                        <div class="mb-4">
                            <span class="font-semibold text-slate-400">Observaciones:</span>
                            <p>{{ $trabajo->observaciones ?: 'Sin observaciones' }}</p>
                        </div>
                        <div class="mb-4">
                            <span class="font-semibold text-slate-400">Reporte de Falla:</span>
                            <p>
                                @if($trabajo->reporteFalla)
                                    <a href="{{ route('reportes.show', $trabajo->reporteFalla) }}" class="text-indigo-500 hover:text-indigo-600">
                                        #{{ $trabajo->reporteFalla->id }} - {{ $trabajo->reporteFalla->tipo_falla }}
                                    </a>
                                @else
                                    No asociado a un reporte
                                @endif
                            </p>
                        </div>
                        <div class="mb-4">
                            <span class="font-semibold text-slate-400">Fecha de Creación:</span>
                            <p>{{ $trabajo->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Cambiar estado -->
                @if(!in_array($trabajo->estado, ['completado', 'cancelado']))
                <div class="mt-6 border-t border-slate-200 pt-6">
                    <h3 class="text-lg font-semibold mb-4">Cambiar Estado</h3>
                    <form action="{{ route('trabajos.cambiar-estado', $trabajo) }}" method="POST" class="flex items-center space-x-4">
                        @csrf
                        <select name="estado" class="form-select">
                            <option value="pendiente" {{ $trabajo->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_proceso" {{ $trabajo->estado == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="completado">Completado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                        <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">Actualizar Estado</button>
                    </form>
                </div>
                @endif
            </div>
        </div>

        <!-- Información del equipo -->
        <div class="bg-white shadow-lg rounded-sm border border-slate-200">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-5">Equipo Asignado</h2>
                
                @if($trabajo->equipo && $trabajo->equipo->empleados->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50">
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Nombre</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Cargo</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Rol</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-slate-100">
                                @foreach($trabajo->equipo->empleados as $empleado)
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="font-medium text-slate-800">{{ $empleado->nombre }} {{ $empleado->apellido }}</div>
                                            </div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{ $empleado->puesto }}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left font-medium {{ $empleado->pivot->is_encargado ? 'text-indigo-500' : 'text-slate-500' }}">
                                                {{ $empleado->pivot->is_encargado ? 'Encargado' : 'Miembro' }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-slate-500">No hay empleados asignados a este trabajo.</p>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>