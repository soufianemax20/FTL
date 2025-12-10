<?php if (in_array('premium', Ctr_Api_Connector::connection_valid()['subscriptions']) || in_array('medium', Ctr_Api_Connector::connection_valid()['subscriptions'])) {
    $chart_data = ctr_generate_chartdata($stages);

    $stage_1 = null;
    $stage_2 = null;
    $stage_3 = null;
    $lineDataHpOriData = '';
    $lineDataHpDataStage_1 = '';
    $lineDataHpDataStage_2 = '';
    $lineDataHpDataStage_3 = '';

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
    foreach ($increaseHp as $increase) {
        $addComma = $i == count($increaseHp) ? '' : ', ';
        if (is_numeric($stage_1['data']['hp_tuning'])) {
            $lineDataHpOriData .= round($stage_1['data']['hp_ori'] * $increase / 100) . $addComma;
            if ($stage_1 !== null) {
                $lineDataHpDataStage_1 .= round($stage_1['data']['hp_tuning'] * $increase / 100) . $addComma;
                $legendHpStage_1 = '<div style="display:flex; flex-direction: row;margin-right:12px;"><span style="margin-right:5px; height:12px;width:12px;background:#262626;border-radius: 100%;margin: auto 5px auto 0px;"></span><span>Stage 1</span></div>';
            };
            if ($stage_2 !== null) {
                $lineDataHpDataStage_2 .= round($stage_2['data']['hp_tuning'] * $increase / 100) . $addComma;
                $legendHpStage_2 = '<div style="display:flex; flex-direction: row;margin-right:12px;">
            <span style="margin-right:5px; height:12px;width:12px;background:#61b8ff;border-radius: 100%;margin: auto 5px auto 0px;"></span><span>Stage 2</span>
            </div>';
            };
            if ($stage_3 !== null) {
                $lineDataHpDataStage_3 .= round($stage_3['data']['hp_tuning'] * $increase / 100) . $addComma;
                $legendHpStage_3 = '<div style="display:flex; flex-direction: row;margin-right:12px;">
            <span style="margin-right:5px; height:12px;width:12px;background:#0079d9;border-radius: 100%;margin: auto 5px auto 0px;"></span><span>Stage 3</span>
            </div>';
            };
        }
        $i++;
    };
?>



    <div class="ctr-w-full ctr-px-2 chart-block">
        <div class="ctr-w-full px-2">
            <div class="ctr-rounded-lg ctr-shadow-sm mb-4">
                <div class="ctr-rounded-lg ctr-bg-white ctr-relative ctr-overflow-hidden">
                    <div class="ctr-bottom-0 ctr-inset-x-0">
                        <span class="ctr-text-[#262626] ctr-text-[28px] ctr-font-semibold ctr-ml-3">Power</span>
                        <div style="display:flex; flex-direction: row;margin-left:12px;margin-bottom:12px;">
                            <div style="display:flex; flex-direction: row;margin-right:12px;">
                                <span style="margin-right:5px; height:12px;width:12px;background:#787878;border-radius: 100%;margin: auto 5px auto 0px;"></span><span>Ori</span>
                            </div>
                            <?php echo $legendHpStage_1; ?>
                            <?php echo $legendHpStage_2; ?>
                            <?php echo $legendHpStage_3; ?>
                        </div>
                        <canvas id="ctr-tuning-dynochart-data-1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // this is JS code
        document.addEventListener('DOMContentLoaded', () => {
            var dynoChart = document.getElementById("ctr-tuning-dynochart-data-1");

            if (dynoChart !== null && typeof(dynoChart) !== 'undefined') {
                dynoChart = dynoChart.getContext('2d');
                var gradientHpOri = dynoChart.createLinearGradient(0, 0, 0, 400);

                gradientHpOri.addColorStop(0.3, '#787878'); //top
                gradientHpOri.addColorStop(0.6, '#bdbdbd'); //bottom
                var gradientHpStage1 = dynoChart.createLinearGradient(0, 0, 0, 400);
                gradientHpStage1.addColorStop(0, '#262626');
                gradientHpStage1.addColorStop(1, '#474747');
                var gradientHpStage2 = dynoChart.createLinearGradient(0, 0, 0, 400);
                gradientHpStage2.addColorStop(0, '#61b8ff');
                gradientHpStage2.addColorStop(1, '#3da8ff');
                var gradientHpStage3 = dynoChart.createLinearGradient(0, 0, 0, 400);
                gradientHpStage3.addColorStop(0, '#0079d9');
                gradientHpStage3.addColorStop(1, '#3da8ff');



                if (typeof(Chart) !== 'undefined') {
                    <?php $lineChartData = ctr_linechart_data_generator($stages); ?>
                    var lineChart = new Chart(dynoChart, {
                        backgroundColor: "transparent",
                        type: 'line',
                        data: {
                            labels: ['1000 RPM', '1500 RPM', '2000 RPM', '2500 RPM', '3000 RPM', '3500 RPM', '4000 RPM', '4500 RPM', '5000 RPM', '5500 RPM', '6000 RPM', '6500 RPM'],
                            datasets: [{
                                    data: [<?php echo $lineDataHpOriData; ?>],
                                    backgroundColor: gradientHpOri,
                                    borderColor: ['transparent'],
                                    borderWidth: '0',
                                    fill: true,
                                    tension: 0.4,
                                    yAxisID: 'y_hp',
                                    pointColor: "#ccc",
                                    pointStrokeColor: "#ff6c23",
                                },
                                {
                                    data: [<?php echo $lineDataHpDataStage_1; ?>],
                                    backgroundColor: gradientHpStage1,
                                    borderColor: ['transparent'],
                                    borderWidth: '0',
                                    fill: true,
                                    tension: 0.4,
                                    yAxisID: 'y_hp',
                                    pointColor: "#ccc",
                                    pointStrokeColor: "#ff6c23",
                                },
                                {
                                    data: [<?php echo $lineDataHpDataStage_2; ?>],
                                    backgroundColor: gradientHpStage2,
                                    borderColor: ['transparent'],
                                    borderWidth: '0',
                                    fill: true,
                                    tension: 0.4,
                                    yAxisID: 'y_hp',
                                    pointColor: "#ccc",
                                    pointStrokeColor: "#ff6c23",
                                },
                                {
                                    data: [<?php echo $lineDataHpDataStage_3; ?>],
                                    backgroundColor: gradientHpStage3,
                                    borderColor: ['transparent'],
                                    borderWidth: '0',
                                    fill: true,
                                    tension: 0.4,
                                    yAxisID: 'y_hp',
                                    pointColor: "#ccc",
                                    pointStrokeColor: "#ff6c23",
                                },

                            ],

                        },
                        options: {
                            aspectRatio: 1.9,
                            animation: {
                                duration: 2000,
                                easing: 'easeInOutElastic'
                            },
                            elements: {
                                point: {
                                    radius: 0
                                }
                            },
                            responsiveAnimationDuration: 1000,
                            responsive: true,
                            scales: {
                                y_hp: {
                                    type: 'linear',
                                    display: true,
                                    position: 'left',
                                    title: {
                                        display: false,
                                        text: '<?php _e('Power (HP)', 'ctr'); ?>'
                                    },
                                    // grid line settings
                                    grid: {
                                        drawOnChartArea: true, // only want the grid lines for one axis to show up
                                    },
                                },
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                    labels: {
                                        // This more specific font property overrides the global property
                                        font: {
                                            size: 16
                                        }
                                    }
                                }
                            }
                        },
                    });
                } else {
                    console.log('CTR: DynoLineChart not activated');
                }
            }
        }, false);
    </script>
<?php } ?>