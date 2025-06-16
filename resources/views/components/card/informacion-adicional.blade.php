<div class="mt-4 grid grid-cols-2 gap-3 text-sm">
    <div class="flex items-center">
        @if($type === 'permisos')
            <span class="text-red-500 dark:text-red-400">
                <i class="fas fa-file-alt mr-1"></i>
                {{ $item->motivo ?? 'N/A' }}
            </span>
        @else
            <span>
                <i class="fas fa-phone text-indigo-500 mr-2"></i>
                {{ $item->telefono ?? 'N/A' }}
            </span>
        @endif
    </div>

    <!-- Fecha de registro -->
    <div class="flex items-center">
        <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
        <span>
            Registro: {{ $item->created_at->format('d/m/Y') }}
        </span>
    </div>

    <!-- Fechas desde y hasta (solo para permisos) -->
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

    <!-- Información adicional de empleados -->
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

    <!-- Información adicional de clientes -->
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
                @elseif($item->direcciones->count() === 1)
                    1 Dirección
                @else
                    {{ $item->direcciones->count() }} Direcciones
                @endif
            </span>
        </div>
    @endif
</div>
