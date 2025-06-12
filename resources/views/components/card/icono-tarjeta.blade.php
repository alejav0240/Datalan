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
