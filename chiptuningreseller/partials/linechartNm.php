<?php if (in_array('premium', Ctr_Api_Connector::connection_valid()['subscriptions']) || in_array('medium', Ctr_Api_Connector::connection_valid()['subscriptions'])) {
    $chart_data = ctr_generate_chartdata($stages);
    $stage_1 = null;
    $stage_2 = null;
    $stage_3 = null;
    $lineDataNmOriData = '';
    $lineDataNmStage_1 = '';
    $lineDataNmStage_2 = '';
    $lineDataNmStage_3 = '';

    foreach ($stages as $item) {
        if ($item['name'] === "stage_1") {
            $stage_1 = $item;
        } elseif ($item['name'] === "stage_2") {
            $stage_2 = $item;
        } elseif ($item['name'] === "stage_3") {
            $stage_3 = $item;
        }
    }

    $increaseNm = [0, 0, 70, 100, 98, 93, 85, 82, 75, 68, 50, 0];
    $increaseHp = [0, 0, 58, 69, 79, 86, 96, 100, 98, 90, 75, 0];
    $i = 1;
    foreach ($increaseNm as $increase) {
        $addComma = $i == count($increaseNm) ? '' : ', ';
        if (is_numeric($stage_1['data']['nm_tuning'])) {
            $lineDataNmOriData .= round($stage_1['data']['nm_ori'] * $increase / 100) . $addComma;
            if ($stage_1 !== null) {
                $lineDataNmStage_1 .= round($stage_1['data']['nm_tuning'] * $increase / 100) . $addComma;
                $legendNmStage_1 = '<div class="flex items-center mr-4"><span class="w-3 h-3 rounded-full mr-2 bg-[#ccff00] shadow-[0_0_8px_#ccff00]"></span><span class="text-white">Stage 1</span></div>';
            };
            if ($stage_2 !== null) {
                $lineDataNmStage_2 .= round($stage_2['data']['nm_tuning'] * $increase / 100) . $addComma;
                $legendNmStage_2 = '<div class="flex items-center mr-4"><span class="w-3 h-3 rounded-full mr-2 bg-[#00f3ff] shadow-[0_0_8px_#00f3ff]"></span><span class="text-white">Stage 2</span></div>';
            };
            if ($stage_3 !== null) {
                $lineDataNmStage_3 .= round($stage_3['data']['nm_tuning'] * $increase / 100) . $addComma;
                $legendNmStage_3 = '<div class="flex items-center mr-4"><span class="w-3 h-3 rounded-full mr-2 bg-[#ff00ff] shadow-[0_0_8px_#ff00ff]"></span><span class="text-white">Stage 3</span></div>';
            };
        }
        $i++;
    }
?>
    <div class="ctr-w-full ctr-px-2 chart-block mb-6">
        <div class="ctr-rounded-xl ctr-bg-[#0b0f19] ctr-border ctr-border-white/10 ctr-shadow-lg ctr-relative ctr-overflow-hidden p-4">

            <div class="ctr-bottom-0 ctr-inset-x-0">
                <div class="flex items-center justify-between mb-4 border-b border-white/5 pb-2">
                    <span class="ctr-text-[#00f3ff] ctr-text-xl ctr-font-bold ctr-font-mono uppercase tracking-widest"><?php esc_html_e('Torque Comparison', 'ctr'); ?></span>
                    <div class="flex flex-wrap text-xs">
                        <div class="flex items-center mr-4">
                            <span class="w-3 h-3 rounded-full mr-2 bg-gray-600"></span><span class="text-gray-400"><?php esc_html_e('Ori', 'ctr'); ?></span>
                        </div>
                        <?php if ($stage_1 !== null) echo $legendNmStage_1; ?>
                        <?php if ($stage_2 !== null) echo $legendNmStage_2; ?>
                        <?php if ($stage_3 !== null) echo $legendNmStage_3; ?>
                    </div>
                </div>
                <div class="ctr-relative" style="height: 350px;">
                    <canvas id="ctr-tuning-dynochart-data-2"></canvas>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            var dynoChart = document.getElementById("ctr-tuning-dynochart-data-2");
            if (dynoChart !== null && typeof(dynoChart) !== 'undefined') {
                dynoChart = dynoChart.getContext('2d');

                // Cyberpunk Gradients
                var gradientNmOri = dynoChart.createLinearGradient(0, 0, 0, 400);
                gradientNmOri.addColorStop(0, 'rgba(120, 120, 120, 0.5)');
                gradientNmOri.addColorStop(1, 'rgba(120, 120, 120, 0.1)');

                var gradientNmStage_1 = dynoChart.createLinearGradient(0, 0, 0, 400);
                gradientNmStage_1.addColorStop(0, 'rgba(204, 255, 0, 0.8)'); // #ccff00
                gradientNmStage_1.addColorStop(1, 'rgba(204, 255, 0, 0.1)');

                var gradientNmStage_2 = dynoChart.createLinearGradient(0, 0, 0, 400);
                gradientNmStage_2.addColorStop(0, 'rgba(0, 243, 255, 0.8)'); // #00f3ff
                gradientNmStage_2.addColorStop(1, 'rgba(0, 243, 255, 0.1)');

                var gradientNmStage_3 = dynoChart.createLinearGradient(0, 0, 0, 400);
                gradientNmStage_3.addColorStop(0, 'rgba(255, 0, 255, 0.8)'); // #ff00ffMagenta
                gradientNmStage_3.addColorStop(1, 'rgba(255, 0, 255, 0.1)');

                if (typeof(Chart) !== 'undefined') {
                    <?php $lineChartData = ctr_linechart_data_generator($stages); ?>
                    var lineChart = new Chart(dynoChart, {
                        type: 'line',
                        data: {
                            labels: ['1000 RPM', '1500 RPM', '2000 RPM', '2500 RPM', '3000 RPM', '3500 RPM', '4000 RPM', '4500 RPM', '5000 RPM', '5500 RPM', '6000 RPM', '6500 RPM'],
                            datasets: [{
                                    data: [<?php echo $lineDataNmOriData; ?>],
                                    backgroundColor: gradientNmOri,
                                    borderColor: '#787878',
                                    borderWidth: 1,
                                    fill: true,
                                    tension: 0.4,
                                    yAxisID: 'y_nm',
                                    pointRadius: 0
                                },
                                {
                                    data: [<?php echo $lineDataNmStage_1; ?>],
                                    backgroundColor: gradientNmStage_1,
                                    borderColor: '#ccff00',
                                    borderWidth: 2,
                                    fill: true,
                                    tension: 0.4,
                                    yAxisID: 'y_nm',
                                    pointRadius: 0
                                },
                                {
                                    data: [<?php echo $lineDataNmStage_2; ?>],
                                    backgroundColor: gradientNmStage_2,
                                    borderColor: '#00f3ff',
                                    borderWidth: 2,
                                    fill: true,
                                    tension: 0.4,
                                    yAxisID: 'y_nm',
                                    pointRadius: 0
                                },
                                {
                                    data: [<?php echo $lineDataNmStage_3; ?>],
                                    backgroundColor: gradientNmStage_3,
                                    borderColor: '#ff00ff',
                                    borderWidth: 2,
                                    fill: true,
                                    tension: 0.4,
                                    yAxisID: 'y_nm',
                                    pointRadius: 0
                                },
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            elements: {
                                point: { radius: 0 }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        color: 'rgba(255, 255, 255, 0.05)',
                                        borderColor: 'rgba(255, 255, 255, 0.1)'
                                    },
                                    ticks: {
                                        color: '#9ca3af',
                                        font: { family: "'Orbitron', sans-serif" }
                                    }
                                },
                                y_nm: {
                                    type: 'linear',
                                    display: true,
                                    position: 'left',
                                    grid: {
                                        color: 'rgba(255, 255, 255, 0.05)',
                                        borderColor: 'rgba(255, 255, 255, 0.1)'
                                    },
                                    ticks: { color: '#e5e5e5' }
                                },
                            },
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: 'rgba(11, 15, 25, 0.95)',
                                    titleColor: '#ccff00',
                                    bodyColor: '#fff',
                                    borderColor: 'rgba(255,255,255,0.1)',
                                    borderWidth: 1
                                }
                            }
                        },
                    });
                }
            }
        }, false);
    </script>
<?php } ?>