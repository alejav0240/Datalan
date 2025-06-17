// Import Chart.js
import {
    Chart, DoughnutController, ArcElement, TimeScale, Tooltip,
} from 'chart.js';
import 'chartjs-adapter-moment';

// Import utilities
import { getCssVariable } from '../utils';

Chart.register(DoughnutController, ArcElement, TimeScale, Tooltip);

// Tooltip colors
const tooltipColors = {
    title: {
        light: '#1F2937',
        dark: '#F3F4F6',
    },
    body: {
        light: '#6B7280',
        dark: '#9CA3AF',
    },
    background: {
        light: '#ffffff',
        dark: '#374151',
    },
    border: {
        light: '#E5E7EB',
        dark: '#4B5563',
    }
};

const getTooltipColors = (isDark) => ({
    titleColor: isDark ? tooltipColors.title.dark : tooltipColors.title.light,
    bodyColor: isDark ? tooltipColors.body.dark : tooltipColors.body.light,
    backgroundColor: isDark ? tooltipColors.background.dark : tooltipColors.background.light,
    borderColor: isDark ? tooltipColors.border.dark : tooltipColors.border.light,
});

const getDefaultColors = () => [
    getCssVariable('--color-violet-500'),
    getCssVariable('--color-sky-500'),
    getCssVariable('--color-violet-800'),
    getCssVariable('--color-emerald-500'),
    getCssVariable('--color-amber-500'),
];

const getHoverColors = () => [
    getCssVariable('--color-violet-600'),
    getCssVariable('--color-sky-600'),
    getCssVariable('--color-violet-900'),
    getCssVariable('--color-emerald-600'),
    getCssVariable('--color-amber-600'),
];

const dashboardCard06 = async () => {
    const canvas = document.getElementById('dashboard-card-06');
    if (!canvas) return;

    const darkMode = localStorage.getItem('dark-mode') === 'true';

    try {
        const response = await fetch('/dashboard/tipos-fallas-mes');
        const data = await response.json();

        const labels = data.map(item => item.tipo_falla);
        const values = data.map(item => item.cantidad);

        const chart = new Chart(canvas, {
            type: 'doughnut',
            data: {
                labels,
                datasets: [{
                    label: 'Tipos de Fallas',
                    data: values,
                    backgroundColor: getDefaultColors().slice(0, labels.length),
                    hoverBackgroundColor: getHoverColors().slice(0, labels.length),
                    borderWidth: 0,
                }],
            },
            options: {
                cutout: '80%',
                layout: {
                    padding: 24,
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        ...getTooltipColors(darkMode),
                    },
                    htmlLegend: {
                        containerID: 'dashboard-card-06-legend',
                    },
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest',
                },
                animation: {
                    duration: 200,
                },
                maintainAspectRatio: false,
            },
            plugins: [{
                id: 'htmlLegend',
                afterUpdate(chartInstance, args, options) {
                    const legendContainer = document.getElementById(options.containerID);
                    const ul = legendContainer?.querySelector('ul');
                    if (!ul) return;

                    ul.innerHTML = ''; // Limpiar contenido anterior

                    const items = chartInstance.options.plugins.legend.labels.generateLabels(chartInstance);
                    items.forEach((item) => {
                        const li = document.createElement('li');
                        li.style.margin = '4px';

                        const button = document.createElement('button');
                        button.classList.add('btn-xs', 'bg-white', 'dark:bg-gray-700', 'text-gray-500', 'dark:text-gray-400', 'shadow-xs', 'shadow-black/[0.08]', 'rounded-full');
                        button.style.opacity = item.hidden ? '.3' : '';
                        button.onclick = () => {
                            chartInstance.toggleDataVisibility(item.index);
                            chartInstance.update();
                        };

                        const box = document.createElement('span');
                        box.style.display = 'block';
                        box.style.width = '8px';
                        box.style.height = '8px';
                        box.style.backgroundColor = item.fillStyle;
                        box.style.borderRadius = '4px';
                        box.style.marginRight = '4px';
                        box.style.pointerEvents = 'none';

                        const label = document.createElement('span');
                        label.style.display = 'flex';
                        label.style.alignItems = 'center';
                        label.appendChild(document.createTextNode(item.text));

                        li.appendChild(button);
                        button.appendChild(box);
                        button.appendChild(label);
                        ul.appendChild(li);
                    });
                },
            }],
        });

        // Detectar cambio de modo oscuro y actualizar colores
        document.addEventListener('darkMode', (e) => {
            const isDark = e.detail.mode === 'on';
            Object.assign(chart.options.plugins.tooltip, getTooltipColors(isDark));
            chart.update('none');
        });

    } catch (error) {
        console.error('Error al cargar datos del gráfico de fallas:', error);
    }
};

export default dashboardCard06;
