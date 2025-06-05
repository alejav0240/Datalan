<div id="direccionesModal" class="hidden flex fixed inset-0 bg-black bg-opacity-50 justify-center items-center z-50">
    <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg relative">
        <button id="cerrarModalDirecciones"
            class="absolute top-2 right-4 text-gray-600 hover:text-red-500 text-2xl">&times;</button>
        <h2 class="text-xl font-bold text-blue-600 mb-4 text-center">Mis Direcciones Adicionales</h2>
        <div id="contenidoDirecciones" class="space-y-4 text-center">
            <p class="text-gray-500">Cargando direcciones...</p>
        </div>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', () => {
        const abrirDirecciones = document.getElementById('abrirDirecciones');
        const modalDirecciones = document.getElementById('direccionesModal');
        const contenidoDirecciones = document.getElementById('contenidoDirecciones');
        const cerrarModalDirecciones = document.getElementById('cerrarModalDirecciones');

        if (abrirDirecciones) {
            abrirDirecciones.addEventListener('click', function () {
                modalDirecciones.classList.remove('hidden');
                contenidoDirecciones.innerHTML = '<p class="text-gray-500">Cargando direcciones...</p>';

                fetch('/direcciones-adicionales')
                    .then(response => response.json())
                    .then(data => {
                        if (!Array.isArray(data) || data.length === 0) {
                            contenidoDirecciones.innerHTML = '<p class="text-gray-600">No tienes direcciones adicionales registradas.</p>';
                        } else {
                            const tabla = `
                                <table class="w-full border-collapse border border-gray-300 text-left text-sm rounded-lg overflow-hidden shadow-md">
                                    <thead>
                                        <tr class="bg-blue-600 text-white">
                                            <th class="border border-gray-300 px-4 py-2 font-semibold">Dirección</th>
                                            <th class="border border-gray-300 px-4 py-2 font-semibold">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${data.map(direccion => `
                                            <tr class="hover:bg-blue-50 transition-colors duration-300">
                                                <td class="border border-gray-300 px-4 py-2">${direccion.direccion}</td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <form action="/direcciones-adicionales/${direccion.id}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-800 font-semibold transition-colors duration-300">
                                                            <i class="fas fa-trash-alt"></i> Eliminar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            `;
                            contenidoDirecciones.innerHTML = tabla;
                        }
                    });
            });
        }

        if (cerrarModalDirecciones) {
            cerrarModalDirecciones.addEventListener('click', function () {
                modalDirecciones.classList.add('hidden');
            });
        }
    });
</script>
