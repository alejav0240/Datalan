@if($type !== 'permisos')
    <div class="text-sm font-bold {{ $item->user->is_active ? 'text-green-500' : 'text-red-500' }}">
        {{ $item->user->is_active ? 'Activo' : 'Inactivo' }}
    </div>
@endif
