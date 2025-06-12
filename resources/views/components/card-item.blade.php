<div class="card-hover bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
    <div class="flex flex-col md:flex-row">
        @include('components.card.icono-tarjeta')
        <div class="flex-1 p-6">
            @include('components.card.detalles-principales')
            @include('components.card.estado-actividad')
            @include('components.card.informacion-adicional')
            @include('components.card.botones-accion')
        </div>
    </div>
</div>
