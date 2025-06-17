// Import Chart.js
import {
  Chart, LineController, LineElement, Filler, PointElement, LinearScale, TimeScale, Tooltip,
} from 'chart.js';
import 'chartjs-adapter-moment';
import { chartAreaGradient } from '../app';

// Import utilities
import { formatValue, getCssVariable, adjustColorOpacity } from '../utils';

Chart.register(LineController, LineElement, Filler, PointElement, LinearScale, TimeScale, Tooltip);

// A chart built with Chart.js 3
// https://www.chartjs.org/
const dashboardCard01 = () => {
  const ctx = document.getElementById('dashboard-card-01');
  if (!ctx) return;

  const darkMode = localStorage.getItem('dark-mode') === 'true';

  const tooltipBodyColor = {
    light: '#6B7280',
    dark: '#9CA3AF'
  };

  const tooltipBgColor = {
    light: '#ffffff',
    dark: '#374151'
  };

  const tooltipBorderColor = {
    light: '#E5E7EB',
    dark: '#4B5563'
  };

  fetch('/dashboard/trabajosmes')
    .then(a => {
      return a.json();
    })
    .then(result => {
        console.log(result)

        const chartData = result.map((item, index) => {
            return {
                x: `2025-${item.mes}-01`, // formato fecha
                y: item.cantidad
            };
        });

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [
                    {
                        label: 'Cantidad mensual',
                        data: chartData,
                        fill: true,
                        backgroundColor: function(context) {
                            const chart = context.chart;
                            const {ctx, chartArea} = chart;
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
                layout: {
                    padding: 20,
                },
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
                            displayFormats: {
                                month: 'MMM'
                            }
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
                        bodyColor: darkMode ? tooltipBodyColor.dark : tooltipBodyColor.light,
                        backgroundColor: darkMode ? tooltipBgColor.dark : tooltipBgColor.light,
                        borderColor: darkMode ? tooltipBorderColor.dark : tooltipBorderColor.light,
                    },
                    legend: {
                        display: false,
                    },
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest',
                },
                maintainAspectRatio: false,
            },
        });


        document.addEventListener('darkMode', (e) => {
        const { mode } = e.detail;
        if (mode === 'on') {
          chart.options.plugins.tooltip.bodyColor = tooltipBodyColor.dark;
          chart.options.plugins.tooltip.backgroundColor = tooltipBgColor.dark;
          chart.options.plugins.tooltip.borderColor = tooltipBorderColor.dark;
        } else {
          chart.options.plugins.tooltip.bodyColor = tooltipBodyColor.light;
          chart.options.plugins.tooltip.backgroundColor = tooltipBgColor.light;
          chart.options.plugins.tooltip.borderColor = tooltipBorderColor.light;
        }
        chart.update('none');
      });
    });
};

export default dashboardCard01;
