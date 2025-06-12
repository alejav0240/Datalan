<div wire:sortable-group="actualizarPrioridad">
    <div class="flex space-x-4">
        @foreach (['urgente', 'alta', 'normal'] as $prioridad)
            <div class="w-1/3 bg-gray-100 p-4 rounded">
                <h2 class="font-bold capitalize">{{ $prioridad }}</h2>

                <ul wire:sortable-group.item-group="{{ $prioridad }}" class="min-h-[100px]">
                    @foreach ($trabajos[$prioridad] as $t)
                        <li wire:sortable-group.item="{{ $t->id }}"
                            wire:key="trabajo-{{ $t->id }}"
                            class="p-2 bg-white mt-2 cursor-move shadow"
                        >
                            <strong>{{ $t->tipo_trabajo }}</strong>
                            <div>{{ $t->descripcion }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
