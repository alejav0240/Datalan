<div wire:sortable="actualizarOrden">
    @foreach ($tareas as $tarea)
        <div wire:sortable.item="{{ $tarea['id'] }}" wire:key="tarea-{{ $tarea['id'] }}">
            <div wire:sortable.handle>
                {{ $tarea['titulo'] }}
            </div>
        </div>
    @endforeach
</div>
