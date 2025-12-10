<?php
/**
 * Models Template - Tuning Mania "Upscaled Premium" Edition
 * DESIGN: High-End Glassmorphism & Neon Cyberpunk
 *
 * @package Tuning_Mania
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Context & Settings
// The type from the URL is the ONLY source of truth. No overrides.
$current_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : 'cars';
$type_slug = strtolower(trim($current_type));

// Safe variable extraction with defaults
$brand_name  = isset($brand) && isset($brand['name']) ? $brand['name'] : '';

// Handle inconsistent variable naming ($series vs $serie)
$series_pool = isset($series) ? $series : (isset($serie) ? $serie : null);
$series_name = isset($series_pool) && isset($series_pool['name']) ? $series_pool['name'] : '';

$theme_uri = get_template_directory_uri();
?>

<div class="tm-selector-upscale relative w-full px-4 py-12">

    <!-- Ambient Background Glow -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-3xl z-0 max-w-7xl mx-auto">
        <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-lime-400/5 rounded-full blur-[150px] mix-blend-screen"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto">

        <!-- Breadcrumbs -->
        <div class="mb-8 flex justify-center opacity-60 hover:opacity-100 transition-opacity">
            <?php if ( function_exists( 'tm_seo_display_breadcrumbs' ) ) tm_seo_display_breadcrumbs(); ?>
        </div>

        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-sm md:text-base text-gray-400 font-bold uppercase tracking-[0.3em] mb-3">

                <?php if($brand_name): ?>
                    <span class="text-lime-400"><?php echo esc_html($brand_name); ?></span>
                <?php endif; ?>

                <?php if($series_name): ?>
                    <span class="text-gray-600">/</span> <?php echo esc_html($series_name); ?>
                <?php endif; ?>

            </h2>
            <h1 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter text-white drop-shadow-xl mb-6">
                Select <span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-[#00ff66]">Model</span>
            </h1>
            <div class="h-1 w-32 bg-gradient-to-r from-transparent via-lime-400 to-transparent mx-auto opacity-70"></div>
        </div>

        <!-- Grid -->
        <?php if (!empty($models)) : ?>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <?php foreach($models as $model) {
                $site_icon_url = $theme_uri . '/assets/img/favicon.png';
                $final_img_url = isset($model['image_url']) ? $model['image_url'] : '';
                if (empty($final_img_url) || strpos($final_img_url, 'placeholder') !== false) {
                    $final_img_url = $site_icon_url;
                }
            ?>
            <div class="group relative">
                <a href="<?php echo esc_url($model['url']); ?>"
                   class="flex flex-col h-full bg-[#151922]/80 backdrop-blur-md border border-white/5 rounded-2xl overflow-hidden transition-all duration-300
                          hover:-translate-y-2 hover:border-lime-400/50 hover:shadow-[0_0_30px_rgba(204,255,0,0.15)] group-hover:bg-[#1a1f2b]">

                    <!-- Icon/Image Area -->
                    <div class="relative h-44 w-full p-6 flex items-center justify-center bg-gradient-to-b from-white/5 to-transparent">
                        <!-- Glow behind image -->
                        <div class="absolute inset-0 bg-lime-400/0 group-hover:bg-lime-400/5 transition-colors duration-500"></div>

                        <img src="<?php echo esc_url($final_img_url); ?>"
                             alt="<?php echo esc_attr($model['name']); ?>"
                             class="max-h-full max-w-full object-contain filter drop-shadow-lg transition-all duration-500 group-hover:scale-110"
                             style="<?php echo ($final_img_url === $site_icon_url) ? 'filter: drop-shadow(0 0 10px rgba(204,255,0,0.3));' : ''; ?>"
                             loading="lazy"
                             onerror="this.onerror=null; this.src='<?php echo esc_url($site_icon_url); ?>'; this.style.filter='drop-shadow(0 0 10px rgba(204,255,0,0.3))';"
                        >
                    </div>

                    <!-- Layout: Content -->
                    <div class="relative p-5 pb-6 border-t border-white/5 flex-grow flex flex-col items-center text-center">
                        <h3 class="text-white font-black italic uppercase text-lg leading-tight mb-2 group-hover:text-lime-400 transition-colors">
                            <?php echo esc_html($model['name']); ?>
                        </h3>
                        <p class="text-xs text-gray-500 font-mono tracking-wider uppercase">
                            <?php echo isset($model['years']) ? esc_html($model['years']) : 'Model'; ?>
                        </p>

                        <!-- Animated Line -->
                        <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-lime-400 to-[#00ff66] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        <?php else: ?>
            <div class="text-center py-24 bg-white/5 rounded-2xl border border-white/5 border-dashed">
                <p class="text-gray-400 text-lg">No models found for this series.</p>
                <a href="javascript:history.back()" class="text-lime-400 hover:text-white font-bold mt-4 inline-block transition-colors">Return to Series</a>
            </div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="mt-16 text-center">
             <a href="javascript:history.back()" class="inline-flex items-center gap-3 px-8 py-4 rounded-xl bg-white/5 border border-white/10 text-gray-300 font-bold uppercase tracking-widest hover:bg-lime-400 hover:text-black hover:border-lime-400 transition-all duration-300">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                 <span>Back to Series</span>
             </a>
        </div>
    </div>
</div>