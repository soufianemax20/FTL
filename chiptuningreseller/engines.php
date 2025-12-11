<?php
/**
 * Engines Template - Tuning Mania "Upscaled Premium" Edition
 * DESIGN: High-End Glassmorphism & Neon Cyberpunk
 *
 * @package Tuning_Mania
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Type from URL is the ONLY source of truth
$current_type_slug = isset($vehicle_type) ? strtolower(trim($vehicle_type)) : (isset($_GET['type']) ? strtolower(trim(sanitize_text_field($_GET['type']))) : 'cars');

// Safe Variable Extraction
$brand_name = isset($brand['name']) ? $brand['name'] : '';
$brand_slug = isset($brand['slug']) ? $brand['slug'] : '';

$serie_name = isset($serie['name']) ? $serie['name'] : (isset($series['name']) ? $series['name'] : '');
$serie_slug = isset($serie['slug']) ? $serie['slug'] : (isset($series['slug']) ? $series['slug'] : '');

$model_name = isset($model['name']) ? $model['name'] : '';
?>

<div class="tm-selector-upscale relative w-full px-4 py-12">

    <!-- Ambient Background Glow -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-3xl z-0 max-w-7xl mx-auto">
        <div class="absolute top-0 right-1/4 w-[600px] h-[600px] bg-lime-400/5 rounded-full blur-[150px] mix-blend-screen"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto">

        <!-- Breadcrumbs -->
        <div class="mb-8 flex justify-center opacity-60 hover:opacity-100 transition-opacity">
            <?php if ( function_exists( 'tm_seo_display_breadcrumbs' ) ) tm_seo_display_breadcrumbs(); ?>
        </div>

        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-sm md:text-base text-gray-400 font-bold uppercase tracking-[0.3em] mb-3">
                <span class="text-lime-400"><?php echo esc_html($brand_name); ?></span>
                <?php if($serie_name): ?><span class="text-gray-600">/</span> <?php echo esc_html($serie_name); ?><?php endif; ?>
                <?php if($model_name): ?><span class="text-gray-600">/</span> <?php echo esc_html($model_name); ?><?php endif; ?>
            </h2>
            <h1 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter text-white drop-shadow-xl mb-6">
                Select <span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-[#00ff66]">Engine</span>
            </h1>
            <div class="h-1 w-32 bg-gradient-to-r from-transparent via-lime-400 to-transparent mx-auto opacity-70"></div>
        </div>

        <!-- Engines Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $count = 0;
            foreach($engines as $engine) {
                $count++;
                $hp_percent = min(100, (intval($engine['hp']) / 600) * 100);
                $fallback_url = tm_get_vehicle_icon_url($engine['name'], $brand_name, $current_type_slug);
                $final_img_url = $engine['image_url'];
                if (empty($final_img_url) || strpos($final_img_url, 'placeholder') !== false) {
                    $final_img_url = $fallback_url;
                }
            ?>
            <article class="group relative flex flex-col h-full bg-[#151922]/80 backdrop-blur-md border border-white/5 rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:border-lime-400/50 hover:shadow-[0_0_30px_rgba(204,255,0,0.15)]">

                <!-- Fuel Badge -->
                <div class="absolute top-4 right-4 z-20">
                     <span class="px-3 py-1 bg-black/60 backdrop-blur border border-lime-400/20 rounded-lg text-[10px] font-bold text-lime-400 uppercase tracking-wider">
                        <?php _e($engine['fuel_type'], 'ctr'); ?>
                     </span>
                </div>

                <!-- Image Area -->
                <div class="relative h-48 w-full p-6 flex items-center justify-center bg-gradient-to-b from-white/5 to-transparent">
                    <div class="absolute inset-0 bg-lime-400/0 group-hover:bg-lime-400/5 transition-colors duration-500"></div>
                    <img src="<?php echo esc_url($final_img_url); ?>"
                         alt="<?php echo esc_attr($engine['name']); ?>"
                         class="max-h-full max-w-full object-contain filter drop-shadow-lg transition-all duration-500 group-hover:scale-105"
                         style="<?php echo ($final_img_url === $fallback_url) ? 'filter: brightness(0) saturate(100%) invert(89%) sepia(47%) saturate(1283%) hue-rotate(30deg) brightness(103%) contrast(104%) drop-shadow(0 0 5px rgba(204,255,0,0.5));' : ''; ?>"
                         loading="<?php echo $count <= 6 ? 'eager' : 'lazy'; ?>"
                         onerror="this.onerror=null; this.src='<?php echo esc_url($fallback_url); ?>'; this.style.filter='brightness(0) saturate(100%) invert(89%) sepia(47%) saturate(1283%) hue-rotate(30deg) brightness(103%) contrast(104%) drop-shadow(0 0 5px rgba(204,255,0,0.5))';"
                    >
                </div>

                <!-- Content -->
                <div class="relative p-6 border-t border-white/5 flex-grow flex flex-col bg-[#1a1f2b]/50">
                    <h3 class="text-xl font-black italic uppercase text-white mb-1 group-hover:text-lime-400 transition-colors">
                        <?php echo esc_html($engine['name']); ?>
                    </h3>

                    <div class="flex justify-between items-center mb-6">
                        <span class="text-xs text-gray-500 font-mono">Code: <?php echo esc_html($engine['code']); ?></span>
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-lime-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-lime-400 animate-pulse"></span>
                            TUNING READY
                        </span>
                    </div>

                    <!-- Power Visualization -->
                    <div class="mt-auto">
                        <div class="flex justify-between items-end mb-2">
                             <span class="text-xs text-gray-400 uppercase tracking-wider">Stock</span>
                             <span class="text-2xl font-black text-white italic leading-none">
                                <?php echo esc_html($engine['hp']); ?> <span class="text-sm font-bold text-lime-400 not-italic">HP</span>
                             </span>
                        </div>
                        <div class="h-1.5 w-full bg-gray-800 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-lime-600 to-[#ccff00] rounded-full transition-all duration-1000 ease-out group-hover:shadow-[0_0_10px_#ccff00]"
                                 style="width: <?php echo $hp_percent; ?>%"></div>
                        </div>
                    </div>
                </div>

                <a href="<?php echo esc_url($engine['url']); ?>" class="absolute inset-0 z-30" aria-label="Select Engine"></a>
            </article>
            <?php } ?>
        </div>

        <!-- Footer -->
        <div class="mt-16 text-center">
             <a href="<?php ctr_print_full_start_url(); ?><?php echo $vehicle_type; ?>/<?php echo $brand_slug; ?>/<?php echo $serie_slug . ctr_get_trailing_slash(); ?>"
                class="inline-flex items-center gap-3 px-8 py-4 rounded-xl bg-white/5 border border-white/10 text-gray-300 font-bold uppercase tracking-widest hover:bg-lime-400 hover:text-black hover:border-lime-400 transition-all duration-300">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                 <span>Back to Models</span>
             </a>
        </div>
    </div>
</div>