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
