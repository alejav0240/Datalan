@props(['direcciones'])

<div id="direccionesModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white w-full max-w-3xl p-6 rounded-lg shadow-lg relative overflow-x-auto">
        <button id="cerrarModalDirecciones" 
            class="absolute top-3 right-4 text-gray-600 hover:text-red-500 text-3xl font-bold leading-none">&times;</button>
        <h2 class="text-2xl font-bold text-blue-600 mb-6 text-center">Mis Direcciones Adicionales</h2>

        @if($direcciones && count($direcciones) > 0)
            <table class="w-full border-collapse border border-gray-300 text-left text-sm rounded-lg overflow-hidden shadow-md">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="border border-gray-300 px-4 py-3 font-semibold">Dirección</th>
                        <th class="border border-gray-300 px-4 py-3 font-semibold text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($direcciones as $direccion)
                        <tr class="hover:bg-blue-50 transition-colors duration-300">
                            <td class="border border-gray-300 px-4 py-3 align-top">
                                <div>{{ $direccion->direccion }}</div>
                                <a href="https://www.google.com/maps?q={{ $direccion->latitud }},{{ $direccion->longitud }}" 
                                   target="_blank" 
                                   class="text-blue-600 hover:underline text-sm inline-block mt-1">
                                    Ver en Google Maps
                                </a>
                            </td>
                            <td class="border border-gray-300 px-4 py-3 text-center align-middle">
                                <form action="{{ url('/direcciones-adicionales/'.$direccion->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="text-red-600 hover:text-red-800 font-semibold transition-colors duration-300">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500 text-center">No hay direcciones adicionales disponibles.</p>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const abrirDirecciones = document.getElementById('abrirDirecciones');
        const modalDirecciones = document.getElementById('direccionesModal');
        const cerrarModalDirecciones = document.getElementById('cerrarModalDirecciones');

        if (abrirDirecciones) {
            abrirDirecciones.addEventListener('click', function () {
                modalDirecciones.classList.remove('hidden');
            });
        }

        if (cerrarModalDirecciones) {
            cerrarModalDirecciones.addEventListener('click', function () {
                modalDirecciones.classList.add('hidden');
            });
        }
    });
</script>
