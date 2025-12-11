<?php
// Safety: Ensure required variables are available
if (!isset($stages) || !is_array($stages)) {
    $stages = [];
}
if (!isset($engine) || !is_array($engine)) {
    $engine = [];
}

// Generate chart data from $stages array
$chart_data = [];
if (!empty($stages) && function_exists('ctr_generate_chartdata')) {
    $chart_data = ctr_generate_chartdata($stages);
}

// Fallback: Build data manually from $stages if function failed
if (empty($chart_data['data']) && !empty($stages)) {
    $chart_data = [
        'labels' => '"Stock", "Tuned"',
        'max' => 0,
        'data' => []
    ];

    foreach ($stages as $stage) {
        // Handle nested data structure (plugin sometimes nests data in 'data' key)
        $data_source = isset($stage['data']) ? $stage['data'] : $stage;

        // Use correct CTR plugin key names (hp_ori/hp_tuning, nm_ori/nm_tuning)
        $stock_hp = isset($data_source['hp_ori']) ? intval($data_source['hp_ori']) : 0;
        $tuned_hp = isset($data_source['hp_tuning']) ? intval($data_source['hp_tuning']) : 0;
        $stock_nm = isset($data_source['nm_ori']) ? intval($data_source['nm_ori']) : 0;
        $tuned_nm = isset($data_source['nm_tuning']) ? intval($data_source['nm_tuning']) : 0;

        // Skip if no data
        if ($stock_hp === 0 && $tuned_hp === 0) continue;

        $max_val = max($stock_hp, $tuned_hp, $stock_nm, $tuned_nm);
        if ($max_val > $chart_data['max']) {
            $chart_data['max'] = ceil($max_val / 100) * 100 + 100;
        }

        $stage_name = isset($stage['display_name']) ? $stage['display_name'] : (isset($stage['name']) ? $stage['name'] : 'Stage ' . (count($chart_data['data']) + 1));

        $chart_data['data'][] = [
            'name' => isset($stage['slug']) ? sanitize_title($stage['slug']) : 'stage-' . count($chart_data['data']),
            'label' => $stage_name,
            'hp' => $stock_hp . ', ' . $tuned_hp,
            'nm' => $stock_nm . ', ' . $tuned_nm
        ];
    }
}
?>
<?php if(isset($chart_data['data']) && !empty($chart_data['data'])) {
  foreach($chart_data['data'] as $stage_item) {
    ?>
<div class="ctr-w-full ctr-px-2 chart-block mb-6">
  <div class="ctr-rounded-xl ctr-bg-[#0b0f19] ctr-border ctr-border-white/10 ctr-shadow-lg ctr-relative ctr-overflow-hidden p-4">

    <!-- Chart Title/Watermark -->
    <div class="ctr-w-full ctr-text-center ctr-mb-4">
       <span class="ctr-text-sm ctr-font-mono ctr-text-[#ccff00] ctr-uppercase ctr-tracking-widest"><?php echo esc_html($stage_item['label']); ?> Gains</span>
    </div>

    <div class="ctr-relative" style="height: 300px;">
      <canvas id="ctr-tuning-chart-<?php echo esc_attr($stage_item['name']); ?>"></canvas>
    </div>
  </div>
</div>

<script>
  (function() {
    var barChartCanvas = document.getElementById("ctr-tuning-chart-<?php echo esc_js($stage_item['name']); ?>");
    if (barChartCanvas && typeof Chart !== 'undefined') {
      var ctx = barChartCanvas.getContext('2d');

      // Cyberpunk Gradients
      var gradientHp = ctx.createLinearGradient(0, 0, 0, 300);
      gradientHp.addColorStop(0, 'rgba(204, 255, 0, 0.9)');   // #ccff00
      gradientHp.addColorStop(1, 'rgba(204, 255, 0, 0.2)');

      var gradientNm = ctx.createLinearGradient(0, 0, 0, 300);
      gradientNm.addColorStop(0, 'rgba(0, 243, 255, 0.9)');  // Cyan
      gradientNm.addColorStop(1, 'rgba(0, 243, 255, 0.2)');

      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [<?php echo $chart_data['labels']; ?>],
          datasets: [{
            label: "HP / PS",
            data: [<?php echo $stage_item['hp']; ?>],
            backgroundColor: gradientHp,
            borderColor: '#ccff00',
            borderWidth: 1,
            barPercentage: 0.6,
            categoryPercentage: 0.8
          }, {
            label: "Torque (Nm)",
            data: [<?php echo $stage_item['nm']; ?>],
            backgroundColor: gradientNm,
            borderColor: '#00f3ff',
            borderWidth: 1,
            barPercentage: 0.6,
            categoryPercentage: 0.8
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              labels: {
                color: '#e5e5e5',
                font: { family: "'Orbitron', sans-serif" }
              }
            },
            tooltip: {
                backgroundColor: 'rgba(11, 15, 25, 0.9)',
                titleColor: '#ccff00',
                bodyColor: '#fff',
                borderColor: 'rgba(255,255,255,0.1)',
                borderWidth: 1
            }
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
            y: {
              beginAtZero: true,
              max: <?php echo intval($chart_data['max']); ?>,
              grid: {
                 color: 'rgba(255, 255, 255, 0.05)',
                 borderColor: 'rgba(255, 255, 255, 0.1)'
              },
              ticks: {
                 color: '#6b7280',
                 stepSize: 50
              }
            }
          }
        }
      });
    }
  })();
</script>
<?php }
} else { ?>
<!-- Debug: No chart data available -->
<div class="text-gray-500 text-xs p-4 text-center">
    <p>Chart data unavailable. Stages count: <?php echo is_array($stages) ? count($stages) : 'N/A'; ?></p>
</div>
<?php } ?>