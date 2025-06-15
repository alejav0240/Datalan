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

    <!-- Aprobación y rechazo de permisos (solo si el rol es administrador) -->
    @if($type === 'permisos' && auth()->user()->role === 'administrador')
        @if($item->estado === 'pendiente')
            <!-- Botón Aceptar -->
            <form action="{{ route('permisos.aprobar', $item) }}" method="POST" class="inline-block">
                @csrf
                <button type="submit" class="p-2 rounded hover:bg-green-100 transition">
                    <i class="fas fa-thumbs-up fa-lg text-green-500 hover:text-green-700"></i>
                </button>
            </form>

            <!-- Botón Rechazar -->
            <form action="{{ route('permisos.rechazar', $item) }}" method="POST" class="inline-block">
                @csrf
                <button type="submit" class="p-2 rounded hover:bg-red-100 transition">
                    <i class="fas fa-thumbs-down fa-lg text-red-500 hover:text-red-700"></i>
                </button>
            </form>
        @endif

        <!-- Botón PDF -->
        <a href="{{ route('permisos.pdf', $item->id) }}" target="_blank" class="p-2 rounded hover:bg-gray-100 transition inline-block">
            <i class="fa-regular fa-file-pdf fa-lg text-red-500 hover:text-red-700"></i>
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
</div>
