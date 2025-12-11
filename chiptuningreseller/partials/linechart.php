<?php
// Safety: Ensure required variables are available
if (!isset($stages) || !is_array($stages)) {
    $stages = [];
}
if (!isset($engine) || !is_array($engine)) {
    $engine = [];
}

// Generate line chart data from $stages
$lineChartData = [];
if (!empty($stages) && function_exists('ctr_linechart_data_generator')) {
    $lineChartData = ctr_linechart_data_generator($stages);
}

// Fallback: Build data manually if function failed or returned empty
$has_valid_data = !empty($lineChartData['lineDataHpOriData']);

if (!$has_valid_data && !empty($stages)) {
    // Get stock values from engine data (passed via $engine global or first stage)
    $stock_hp = 0;
    $stock_nm = 0;

    // Try to get stock values from engine
    if (isset($engine) && is_array($engine)) {
        $stock_hp = isset($engine['hp']) ? intval($engine['hp']) : 0;
        $stock_nm = isset($engine['nm']) ? intval($engine['nm']) : 0;
    }

    // If no engine data, try first stage using correct CTR key names
    if ($stock_hp === 0 && !empty($stages[0])) {
        $first_stage = isset($stages[0]['data']) ? $stages[0]['data'] : $stages[0];
        $stock_hp = isset($first_stage['hp_ori']) ? intval($first_stage['hp_ori']) : 0;
        $stock_nm = isset($first_stage['nm_ori']) ? intval($first_stage['nm_ori']) : 0;
    }

    // Simulate dyno curve (power builds with RPM)
    $rpm_multipliers = [0.15, 0.25, 0.40, 0.55, 0.70, 0.82, 0.92, 0.98, 1.00, 0.97, 0.93, 0.88];
    $stock_hp_curve = [];
    $stock_nm_curve = [];

    foreach ($rpm_multipliers as $mult) {
        $stock_hp_curve[] = round($stock_hp * $mult);
        $stock_nm_curve[] = round($stock_nm * $mult);
    }

    $lineChartData = [
        'lineDataHpOriData' => implode(',', $stock_hp_curve),
        'lineDataNmOriData' => implode(',', $stock_nm_curve),
        'dataSetsHp' => '',
        'dataSetsNm' => ''
    ];

    // Generate tuned curves for each stage
    foreach ($stages as $index => $stage) {
        // Handle nested data structure
        $data_source = isset($stage['data']) ? $stage['data'] : $stage;

        // Use correct CTR plugin key names
        $tuned_hp = isset($data_source['hp_tuning']) ? intval($data_source['hp_tuning']) : $stock_hp;
        $tuned_nm = isset($data_source['nm_tuning']) ? intval($data_source['nm_tuning']) : $stock_nm;
        $stage_name = isset($stage['display_name']) ? $stage['display_name'] : (isset($stage['name']) ? $stage['name'] : 'Stage ' . ($index + 1));

        $tuned_hp_curve = [];
        $tuned_nm_curve = [];
        foreach ($rpm_multipliers as $mult) {
            $tuned_hp_curve[] = round($tuned_hp * $mult);
            $tuned_nm_curve[] = round($tuned_nm * $mult);
        }

        $lineChartData['dataSetsHp'] .= '{
            label: "' . esc_js($stage_name) . ' HP",
            data: [' . implode(',', $tuned_hp_curve) . '],
            borderColor: "#ccff00",
            backgroundColor: "rgba(204, 255, 0, 0.1)",
            borderWidth: 2,
            pointRadius: 0,
            fill: true,
            tension: 0.4,
            yAxisID: "y_hp"
        },';

        $lineChartData['dataSetsNm'] .= '{
            label: "' . esc_js($stage_name) . ' Nm",
            data: [' . implode(',', $tuned_nm_curve) . '],
            borderColor: "#00f3ff",
            backgroundColor: "rgba(0, 243, 255, 0.1)",
            borderWidth: 2,
            pointRadius: 0,
            fill: true,
            tension: 0.4,
            yAxisID: "y_nm"
        },';
    }

    $has_valid_data = true;
}
?>

<?php if ($has_valid_data): ?>
<div class="ctr-w-full ctr-px-2 chart-block mb-6">
    <div class="ctr-rounded-xl ctr-bg-[#0b0f19] ctr-border ctr-border-white/10 ctr-shadow-lg ctr-relative ctr-overflow-hidden p-4">

        <!-- Chart Title -->
        <div class="ctr-w-full ctr-text-center ctr-mb-4">
           <span class="ctr-text-sm ctr-font-mono ctr-text-[#ccff00] ctr-uppercase ctr-tracking-widest">Power Verification</span>
        </div>

        <div class="ctr-relative" style="height: 400px;">
            <canvas id="ctr-tuning-dynochart-data" style="filter: drop-shadow(0 0 10px rgba(204,255,0,0.1));"></canvas>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        var dynoChartCanvas = document.getElementById("ctr-tuning-dynochart-data");
        if (dynoChartCanvas && typeof Chart !== 'undefined') {
            var dynoCtx = dynoChartCanvas.getContext('2d');

            // Cyberpunk Gradients
            var gradientHp = dynoCtx.createLinearGradient(0, 0, 0, 400);
            gradientHp.addColorStop(0, 'rgba(204, 255, 0, 0.4)');
            gradientHp.addColorStop(1, 'rgba(204, 255, 0, 0.05)');

            var gradientNm = dynoCtx.createLinearGradient(0, 0, 0, 400);
            gradientNm.addColorStop(0, 'rgba(0, 243, 255, 0.4)');
            gradientNm.addColorStop(1, 'rgba(0, 243, 255, 0.05)');

            // Chart Config
            Chart.defaults.font.family = "'Orbitron', sans-serif";
            Chart.defaults.color = '#6b7280';

            var lineChart = new Chart(dynoCtx, {
                type: 'line',
                data: {
                    labels: ['1000', '1500', '2000', '2500', '3000', '3500', '4000', '4500', '5000', '5500', '6000', '6500'],
                    datasets: [{
                            label: "<?php _e('Stock HP', 'ctr'); ?>",
                            data: [<?php echo $lineChartData['lineDataHpOriData']; ?>],
                            backgroundColor: 'transparent',
                            borderColor: 'rgba(255, 255, 255, 0.3)',
                            borderWidth: 1,
                            borderDash: [5, 5],
                            pointRadius: 0,
                            fill: false,
                            tension: 0.4,
                            yAxisID: 'y_hp',
                        },
                        {
                            label: "<?php _e('Stock Nm', 'ctr'); ?>",
                            data: [<?php echo $lineChartData['lineDataNmOriData']; ?>],
                            backgroundColor: 'transparent',
                            borderColor: 'rgba(255, 255, 255, 0.15)',
                            borderWidth: 1,
                            borderDash: [2, 2],
                            pointRadius: 0,
                            fill: false,
                            tension: 0.4,
                            yAxisID: 'y_nm',
                        },
                        <?php echo $lineChartData['dataSetsHp']; ?>
                        <?php echo $lineChartData['dataSetsNm']; ?>
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#e5e5e5',
                                boxWidth: 10,
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(11, 15, 25, 0.95)',
                            titleColor: '#ccff00',
                            bodyColor: '#fff',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            padding: 10,
                            titleFont: { size: 13 },
                            bodyFont: { size: 12 }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)',
                                borderColor: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: { color: '#6b7280' }
                        },
                        y_hp: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Power (HP)',
                                color: '#ccff00',
                                font: { size: 10 }
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)',
                                borderColor: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: { color: '#9ca3af' }
                        },
                        y_nm: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Torque (Nm)',
                                color: '#00f3ff',
                                font: { size: 10 }
                            },
                            grid: {
                                drawOnChartArea: false,
                            },
                            ticks: { color: '#9ca3af' }
                        }
                    }
                }
            });
        }
    }, false);
</script>
<?php else: ?>
<!-- Debug: No line chart data available -->
<div class="text-gray-500 text-xs p-4 text-center">
    <p>Dyno data unavailable. Stages: <?php echo is_array($stages) ? count($stages) : 'N/A'; ?></p>
</div>
<?php endif; ?>