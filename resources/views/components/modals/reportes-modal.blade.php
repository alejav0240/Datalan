@props(['reportes'])

<div id="reportesModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white w-full max-w-4xl p-6 rounded-lg shadow-lg relative overflow-x-auto">
        <button id="cerrarModalReportes"
            class="absolute top-3 right-4 text-gray-600 hover:text-red-500 text-3xl font-bold leading-none">&times;</button>
        <h2 class="text-2xl font-bold text-blue-600 mb-6 text-center">Mis Reportes</h2>

        @if($reportes && count($reportes) > 0)
            <table class="w-full border-collapse border border-gray-300 text-left text-sm rounded-lg overflow-hidden shadow-md">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="border border-gray-300 px-4 py-3 font-semibold">Tipo</th>
                        <th class="border border-gray-300 px-4 py-3 font-semibold">Dirección</th>
                        <th class="border border-gray-300 px-4 py-3 font-semibold">Descripción</th>
                        <th class="border border-gray-300 px-4 py-3 font-semibold">Estado</th>
                        <th class="border border-gray-300 px-4 py-3 font-semibold">Fecha</th>
                        <th class="border border-gray-300 px-4 py-3 font-semibold text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportes as $reporte)
                        <tr class="hover:bg-blue-50 transition-colors duration-300">
                            <td class="border border-gray-300 px-4 py-3">{{ ucfirst($reporte->tipo_falla) }}</td>
                            <td class="border border-gray-300 px-4 py-3">{{ $reporte->direccionAdicional->direccion }}</td>
                            <td class="border border-gray-300 px-4 py-3 max-w-xs truncate">{{ $reporte->descripcion }}</td>
                            <td class="border border-gray-300 px-4 py-3">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $reporte->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $reporte->estado == 'en_proceso' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $reporte->estado == 'resuelto' ? 'bg-green-100 text-green-800' : '' }}
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $reporte->estado)) }}
                                </span>
                            </td>
                            <td class="border border-gray-300 px-4 py-3">{{ $reporte->created_at->format('d/m/Y') }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-center">
                                @if($reporte->estado == 'pendiente')
                                    <form action="{{ route('reportes.cliente.destroy', $reporte->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 font-semibold transition-colors duration-300">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 cursor-not-allowed" title="No se puede eliminar un reporte que ya está en proceso o resuelto">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500 text-center">No hay reportes de fallas disponibles.</p>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const abrirReportes = document.getElementById('abrirReportes');
        const modalReportes = document.getElementById('reportesModal');
        const cerrarModalReportes = document.getElementById('cerrarModalReportes');

        if (abrirReportes) {
            abrirReportes.addEventListener('click', function () {
                modalReportes.classList.remove('hidden');
            });
        }

        if (cerrarModalReportes) {
            cerrarModalReportes.addEventListener('click', function () {
                modalReportes.classList.add('hidden');
            });
        }
    });
</script>
