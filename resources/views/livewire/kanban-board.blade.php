<div class="grid grid-cols-3 gap-4 p-4">
    @foreach (['normal', 'alta', 'urgente'] as $prioridad)
        <div class="bg-gray-100 p-2 rounded shadow">
            <h2 class="text-center font-bold mb-2 uppercase">{{ $prioridad }}</h2>

            <div wire:sortable="actualizarOrden" wire:sortable.group="{{ $prioridad }}">
                @foreach ($trabajosPorPrioridad[$prioridad] as $trabajo)
                    <div
                        wire:sortable.item="{{ $trabajo->id }}"
                        wire:key="trabajo-{{ $trabajo->id }}"
                        class="p-2 mb-2 bg-white rounded shadow cursor-move"
                    >
                        <div wire:sortable.handle>
                            {{ $trabajo->titulo }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
