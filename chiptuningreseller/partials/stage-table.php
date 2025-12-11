<?php
/**
 * Partial: Stage Table (Cyberpunk Redesign)
 *
 * Displays tuning stages with high-contrast neon styling.
 * Robust handling of missing data keys.
 */

if (empty($stages)) {
    ?>
    <div class="bg-gray-900/50 border border-gray-800 rounded-xl p-8 text-center backdrop-blur-sm">
        <svg class="w-12 h-12 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <h3 class="text-xl text-white font-bold mb-2 font-orbitron">No Stage Data Found</h3>
        <p class="text-gray-400 mb-6 text-sm">Performance data for this specific configuration is currently unavailable via the API.</p>
        <a href="<?php echo home_url('/contact/'); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-[#ccff00] text-black font-black uppercase text-xs tracking-widest rounded hover:bg-white transition-all duration-300">
            Contact Support
        </a>
    </div>
    <?php
} else {
    ?>
    <div class="grid gap-6 my-8">
    <?php
    foreach ($stages as $stage) {
        // Skip development stages if flag exists
        if (isset($stage['in_development']) && $stage['in_development']) continue;

        // 1. Determine Colors based on Stage Name
        $stageName = strtoupper(isset($stage['display_name']) ? $stage['display_name'] : $stage['name']);

        $theme = [
            'color' => '#ccff00', // Default Lime
            'glow'  => 'rgba(204, 255, 0, 0.3)',
            'bg'    => 'rgba(204, 255, 0, 0.05)'
        ];

        if (strpos($stageName, 'STAGE 2') !== false || strpos($stageName, 'STAGE_2') !== false) {
            $theme = ['color' => '#00f3ff', 'glow' => 'rgba(0, 243, 255, 0.3)', 'bg' => 'rgba(0, 243, 255, 0.05)'];
        } elseif (strpos($stageName, 'STAGE 3') !== false || strpos($stageName, 'STAGE_3') !== false) {
            $theme = ['color' => '#ff00ff', 'glow' => 'rgba(255, 0, 255, 0.3)', 'bg' => 'rgba(255, 0, 255, 0.05)'];
        } elseif (strpos($stageName, 'ECO') !== false || strpos($stageName, 'E85') !== false) {
            $theme = ['color' => '#00ff7f', 'glow' => 'rgba(0, 255, 127, 0.3)', 'bg' => 'rgba(0, 255, 127, 0.05)'];
        }

        // 2. Safe Data Extraction
        // The plugin structure varies. Sometimes data is in $stage['data'], sometimes directly in $stage.
        // We check both.
        $data_source = isset($stage['data']) ? $stage['data'] : $stage;

        $hp_ori    = isset($data_source['hp_ori'])    ? floatval($data_source['hp_ori'])    : 0;
        $hp_tuning = isset($data_source['hp_tuning']) ? floatval($data_source['hp_tuning']) : 0;
        $nm_ori    = isset($data_source['nm_ori'])    ? floatval($data_source['nm_ori'])    : 0;
        $nm_tuning = isset($data_source['nm_tuning']) ? floatval($data_source['nm_tuning']) : 0;

        // Calculate Differences
        $diffHp = $hp_tuning - $hp_ori;
        $diffNm = $nm_tuning - $nm_ori;

        // Formatting
        $diffHpDisplay = ($diffHp > 0 ? '+' : '') . $diffHp;
        $diffNmDisplay = ($diffNm > 0 ? '+' : '') . $diffNm;

        // Price
        $price = isset($stage['price']) ? $stage['price'] : 'N/A';
        $currency_symbol = isset($currency) ? $currency : '€';

        // Safety Fallbacks for Data
        $hp_ori_display    = ($hp_ori > 0) ? $hp_ori : 'N/A';
        $hp_tuning_display = ($hp_tuning > 0) ? $hp_tuning : 'N/A';
        $nm_ori_display    = ($nm_ori > 0) ? $nm_ori : 'N/A';
        $nm_tuning_display = ($nm_tuning > 0) ? $nm_tuning : 'N/A';

        ?>

        <!-- Stage Card Container -->
        <div class="relative group rounded-xl overflow-hidden bg-[#0b0f19] border border-white/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_0_30px_<?php echo $theme['glow']; ?>]"
             style="border-left: 4px solid <?php echo $theme['color']; ?>;">

            <!-- Top Gradient Line -->
            <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-white/20 to-transparent opacity-50"></div>

            <div class="p-6 md:p-8 flex flex-col xl:flex-row gap-6 items-center">

                <!-- LEFT: Title & Price -->
                <div class="w-full xl:w-1/4 text-center xl:text-left">
                    <h3 class="text-2xl font-black italic uppercase font-orbitron tracking-wider mb-2 text-white group-hover:text-white transition-colors">
                        <?php echo esc_html($stageName); ?>
                    </h3>

                    <?php if(isset($show_price) && $show_price): ?>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded bg-white/5 border border-white/10">
                        <span class="text-xs text-gray-400 uppercase font-bold tracking-wider">Price</span>
                        <span class="text-lg font-bold text-white font-mono"><?php echo $currency_symbol . ' ' . $price; ?></span>
                    </div>
                    <?php endif; ?>

                    <!-- Optional Desc -->
                    <?php if(isset($stage['description']) && !empty($stage['description'])): ?>
                        <p class="text-xs text-gray-500 mt-3 line-clamp-2"><?php echo wp_strip_all_tags($stage['description']); ?></p>
                    <?php endif; ?>
                </div>

                <!-- CENTER: The Data Grid (Visual Comparison) -->
                <div class="w-full xl:w-2/4 bg-white/5 border border-white/10 rounded-lg overflow-hidden">
                    <div class="grid grid-cols-3 divide-x divide-white/10">
                        <!-- Headers -->
                        <div class="bg-white/5 p-2 text-center text-[10px] text-gray-500 uppercase tracking-widest font-bold">Metric</div>
                        <div class="bg-white/5 p-2 text-center text-[10px] text-gray-500 uppercase tracking-widest font-bold">Original</div>
                        <div class="bg-white/5 p-2 text-center text-[10px] uppercase tracking-widest font-bold" style="background-color: <?php echo $theme['bg']; ?>; color: <?php echo $theme['color']; ?>;">Tuned</div>

                        <!-- HP Row -->
                        <div class="bg-[#0b0f19] p-3 flex items-center justify-center border-t border-white/5">
                            <span class="font-bold text-sm text-gray-300">Power</span>
                        </div>
                        <div class="bg-[#0b0f19] p-3 flex items-center justify-center border-t border-white/5">
                            <span class="font-mono text-gray-400"><?php echo $hp_ori_display; ?> <span class="text-[10px] ml-1">HP</span></span>
                        </div>
                        <div class="bg-[#0b0f19] p-3 flex items-center justify-center border-t border-white/5 relative overflow-hidden">
                            <div class="absolute inset-0 opacity-10" style="background-color: <?php echo $theme['color']; ?>;"></div>
                            <span class="font-mono font-bold text-lg" style="color: <?php echo $theme['color']; ?>; text-shadow: 0 0 10px <?php echo $theme['glow']; ?>;">
                                <?php echo $hp_tuning_display; ?>
                            </span>
                            <?php if($diffHp > 0): ?>
                            <span class="absolute top-0 right-1 text-[9px] font-bold opacity-80" style="color: <?php echo $theme['color']; ?>;">
                                +<?php echo $diffHp; ?>
                            </span>
                            <?php endif; ?>
                        </div>

                        <!-- Nm Row -->
                        <div class="bg-[#0b0f19] p-3 flex items-center justify-center border-t border-white/5">
                            <span class="font-bold text-sm text-gray-300">Torque</span>
                        </div>
                        <div class="bg-[#0b0f19] p-3 flex items-center justify-center border-t border-white/5">
                            <span class="font-mono text-gray-400"><?php echo $nm_ori_display; ?> <span class="text-[10px] ml-1">Nm</span></span>
                        </div>
                        <div class="bg-[#0b0f19] p-3 flex items-center justify-center border-t border-white/5 relative overflow-hidden">
                            <div class="absolute inset-0 opacity-10" style="background-color: <?php echo $theme['color']; ?>;"></div>
                            <span class="font-mono font-bold text-lg" style="color: <?php echo $theme['color']; ?>; text-shadow: 0 0 10px <?php echo $theme['glow']; ?>;">
                                <?php echo $nm_tuning_display; ?>
                            </span>
                             <?php if($diffNm > 0): ?>
                            <span class="absolute top-0 right-1 text-[9px] font-bold opacity-80" style="color: <?php echo $theme['color']; ?>;">
                                +<?php echo $diffNm; ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Action -->
                <div class="w-full xl:w-1/4 flex flex-col justify-center items-center xl:items-end">
                    <?php
                    // Assuming plugin provides an 'add_to_cart_url' or similar. If not, link to contact.
                    $action_url = isset($stage['add_to_cart_url']) ? $stage['add_to_cart_url'] : home_url('/contact/?subject=' . urlencode('Inquiry about ' . $stageName));
                    $btn_text = isset($stage['add_to_cart_url']) ? 'Order Now' : 'Inquire';
                    ?>
                    <a href="<?php echo esc_url($action_url); ?>"
                       class="relative overflow-hidden w-full md:w-auto text-center px-8 py-4 rounded font-black uppercase tracking-wider text-xs transition-all duration-300 hover:scale-105 group-hover:shadow-[0_0_20px_<?php echo $theme['glow']; ?>]"
                       style="background: <?php echo $theme['color']; ?>; color: #000;">
                       <span class="relative z-10"><?php echo $btn_text; ?></span>
                       <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                    </a>
                </div>

            </div>
        </div>
        <?php
    }
    ?>
    </div>
    <?php
}
?>