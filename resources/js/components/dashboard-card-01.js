// Import Chart.js
import {
    Chart, LineController, LineElement, Filler, PointElement, LinearScale, TimeScale, Tooltip,
} from 'chart.js';
import 'chartjs-adapter-moment';
import { chartAreaGradient } from '../app';

// Import utilities
import { formatValue, getCssVariable, adjustColorOpacity } from '../utils';

// Registrar componentes necesarios
Chart.register(LineController, LineElement, Filler, PointElement, LinearScale, TimeScale, Tooltip);

// Tooltip colors
const tooltipColors = {
    body: {
        light: '#6B7280',
        dark: '#9CA3AF'
    },
    background: {
        light: '#ffffff',
        dark: '#374151'
    },
    border: {
        light: '#E5E7EB',
        dark: '#4B5563'
    }
};

const getTooltipColors = (isDark) => ({
    bodyColor: isDark ? tooltipColors.body.dark : tooltipColors.body.light,
    backgroundColor: isDark ? tooltipColors.background.dark : tooltipColors.background.light,
    borderColor: isDark ? tooltipColors.border.dark : tooltipColors.border.light,
});

const dashboardCard01 = async () => {
    const canvas = document.getElementById('dashboard-card-01');
    if (!canvas) return;

    const darkMode = localStorage.getItem('dark-mode') === 'true';

    try {
        const response = await fetch('/dashboard/trabajosmes');
        const result = await response.json();

        const chartData = result.map(item => ({
            x: `2025-${item.mes}-01`,
            y: item.cantidad
        }));

        const chart = new Chart(canvas, {
            type: 'line',
            data: {
                datasets: [
                    {
                        label: 'Cantidad mensual',
                        data: chartData,
                        fill: true,
                        backgroundColor: (context) => {
                            const { ctx, chartArea } = context.chart;
                            return chartAreaGradient(ctx, chartArea, [
                                { stop: 0, color: adjustColorOpacity(getCssVariable('--color-violet-500'), 0) },
                                { stop: 1, color: adjustColorOpacity(getCssVariable('--color-violet-500'), 0.2) }
                            ]);
                        },
                        borderColor: getCssVariable('--color-violet-500'),
                        borderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 3,
                        pointBackgroundColor: getCssVariable('--color-violet-500'),
                        pointHoverBackgroundColor: getCssVariable('--color-violet-500'),
                        pointBorderWidth: 0,
                        pointHoverBorderWidth: 0,
                        clip: 20,
                        tension: 0.2
                    }
                ],
            },
            options: {
                layout: { padding: 20 },
                scales: {
                    y: {
                        display: true,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad'
                        }
                    },
                    x: {
                        type: 'time',
                        time: {
                            parser: 'YYYY-MM-DD',
                            unit: 'month',
                            displayFormats: { month: 'MMM' }
                        },
                        display: true,
                        title: {
                            display: true,
                            text: 'Mes'
                        }
                    },
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: (context) => {
                                const date = new Date(context[0].parsed.x);
                                return date.toLocaleString('default', { month: 'long' });
                            },
                            label: (context) => formatValue(context.parsed.y),
                        },
                        ...getTooltipColors(darkMode),
                    },
                    legend: { display: false }
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest',
                },
                maintainAspectRatio: false,
            },
        });

        // Escucha cambios de modo oscuro
        document.addEventListener('darkMode', (e) => {
            const { mode } = e.detail;
            const isDark = mode === 'on';
            Object.assign(chart.options.plugins.tooltip, getTooltipColors(isDark));
            chart.update('none');
        });

    } catch (error) {
        console.error('Error al cargar datos para el gráfico:', error);
    }
};

export default dashboardCard01;
