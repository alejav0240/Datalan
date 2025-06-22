<div class="flex flex-col col-span-full sm:col-span-8 xl:col-span-12 bg-white dark:bg-gray-800 shadow-lg rounded-2xl overflow-hidden">
    <!-- Encabezado con filtros -->
    <div class="px-6 pt-6 pb-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <!-- Título -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white hover:text-violet-600 transition-colors">
                    Trabajos por Mes
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wide">General</p>
            </div>

            <!-- Filtros -->
            <div class="flex flex-wrap items-center gap-2">
                <button
                    id="exportar-grafico"
                    class="ml-2 inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-violet-600 border border-violet-500 rounded-md hover:bg-violet-50 dark:hover:bg-violet-600/10"
                >
                    Exportar PNG
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Gráfico -->
    <div class="px-4 pb-6">
        <div class="h-[320px] sm:h-[400px]">
            <canvas id="dashboard-card-01" class="w-full h-full"></canvas>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const exportBtn = document.getElementById('exportar-grafico');
            const canvas = document.getElementById('dashboard-card-01'); // Asegúrate que este ID sea correcto

            if (exportBtn && canvas) {
                exportBtn.addEventListener('click', () => {
                    const link = document.createElement('a');
                    link.download = 'grafico_trabajos_por_mes.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                });
            }
        });
    </script>
</div>
