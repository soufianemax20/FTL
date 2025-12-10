<?php
/**
 * Series Template - Tuning Mania "Upscaled Premium" Edition
 * DESIGN: High-End Glassmorphism & Neon Cyberpunk
 *
 * @package Tuning_Mania
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Data Normalization
$the_series = [];
if (isset($series) && (is_array($series) || is_object($series))) { $the_series = $series; }
elseif (isset($items) && (is_array($items) || is_object($items))) { $the_series = $items; }

// 2. Base Type from URL - ONLY source of truth
$current_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : 'cars';
$base_type_slug = strtolower(trim($current_type));
$brand_name = isset($brand['name']) ? $brand['name'] : '';

$theme_uri = get_template_directory_uri();
?>

<div class="tm-selector-upscale relative w-full px-4 py-12">

    <!-- Ambient Background Glow -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-3xl z-0 max-w-7xl mx-auto">
        <div class="absolute top-0 right-1/4 w-[600px] h-[600px] bg-lime-400/5 rounded-full blur-[150px] mix-blend-screen"></div>
        <div class="absolute -bottom-20 left-1/4 w-[600px] h-[600px] bg-[#00ff66]/5 rounded-full blur-[150px] mix-blend-screen"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto">

        <!-- Breadcrumbs -->
        <div class="mb-8 flex justify-center opacity-60 hover:opacity-100 transition-opacity">
            <?php if ( function_exists( 'tm_seo_display_breadcrumbs' ) ) tm_seo_display_breadcrumbs(); ?>
        </div>

        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-sm md:text-base text-gray-400 font-bold uppercase tracking-[0.3em] mb-3">
                <span class="text-lime-400"><?php echo isset($brand['name']) ? esc_html($brand['name']) : 'Brand'; ?></span> Selection
            </h2>
            <h1 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter text-white drop-shadow-xl mb-6">
                Select <span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-[#00ff66]">Series</span>
            </h1>
            <div class="h-1 w-32 bg-gradient-to-r from-transparent via-lime-400 to-transparent mx-auto opacity-70"></div>
        </div>

        <!-- Grid -->
        <?php if (!empty($the_series)) : ?>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <?php foreach($the_series as $item) {
                // Real Image Logic - Robust Check
                $site_icon_url = $theme_uri . '/assets/img/favicon.png';
                $final_img_url = '';
                $found_real = false;

                // 1. Media Array (ID or URL)
                if (!empty($item['media']) && isset($item['media'][0])) {
                    if (!empty($item['media'][0]['id'])) {
                        // Use ID
                        ob_start();
                        $api_thumb = ctr_get_image_by_id($item['media'][0]['id'], 'medium');
                        $res = ob_get_clean();
                        if (!empty($api_thumb)) { $final_img_url = $api_thumb; $found_real = true; }
                        elseif (!empty($res) && strpos($res, 'http') !== false) { $final_img_url = strip_tags($res); $found_real = true; }
                    }
                    if (!$found_real && !empty($item['media'][0]['url'])) {
                        $final_img_url = $item['media'][0]['url'];
                        $found_real = true;
                    }
                }

                // 2. Thumbnail / Image Keys
                if (!$found_real) {
                    $keys = ['image', 'thumbnail', 'image_url', 'img_url'];
                    foreach($keys as $k) {
                        if (!empty($item[$k])) {
                            // Try helper if it looks like a relative path
                            if (strpos($item[$k], 'http') === false) {
                                ob_start();
                                ctr_get_image_by_url($item[$k], 'medium');
                                $h_res = ob_get_clean();
                                if (!empty($h_res)) { $final_img_url = $h_res; $found_real = true; break; }
                            } else {
                                $final_img_url = $item[$k];
                                $found_real = true;
                                break;
                            }
                        }
                    }
                }

                // Fallback / Poison Check
                if (!empty($final_img_url)) {
                     if (strpos($final_img_url, 'placeholder') !== false || strpos($final_img_url, 'default') !== false) {
                         $final_img_url = $site_icon_url; // Revert to site icon if placeholder found
                     }
                }

                if (empty($final_img_url)) {
                    $final_img_url = $site_icon_url;
                }
            ?>
            <div class="group relative">
                <a href="<?php echo esc_url($item['url']); ?>"
                   class="flex flex-col h-full bg-[#151922]/80 backdrop-blur-md border border-white/5 rounded-2xl overflow-hidden transition-all duration-300
                          hover:-translate-y-2 hover:border-lime-400/50 hover:shadow-[0_0_30px_rgba(204,255,0,0.15)] group-hover:bg-[#1a1f2b]">

                    <!-- Icon/Image Area -->
                    <div class="relative h-44 w-full p-6 flex items-center justify-center bg-gradient-to-b from-white/5 to-transparent">
                        <!-- Glow behind image -->
                        <div class="absolute inset-0 bg-lime-400/0 group-hover:bg-lime-400/5 transition-colors duration-500"></div>

                        <img src="<?php echo esc_url($final_img_url); ?>"
                             alt="<?php echo esc_attr($item['name']); ?>"
                             class="max-h-full max-w-full object-contain filter drop-shadow-lg transition-all duration-500 group-hover:scale-110"
                             style="<?php echo ($final_img_url === $site_icon_url) ? 'filter: drop-shadow(0 0 10px rgba(204,255,0,0.3));' : ''; ?>"
                             loading="lazy"
                             onerror="this.onerror=null; this.src='<?php echo esc_url($site_icon_url); ?>'; this.style.filter='drop-shadow(0 0 10px rgba(204,255,0,0.3))';"
                        >
                    </div>

                    <!-- Layout: Content -->
                    <div class="relative p-5 pb-6 border-t border-white/5 flex-grow flex flex-col items-center text-center">
                        <h3 class="text-white font-black italic uppercase text-lg leading-tight mb-0 group-hover:text-lime-400 transition-colors">
                            <?php echo esc_html($item['name']); ?>
                        </h3>

                        <!-- Animated Line -->
                        <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-lime-400 to-[#00ff66] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        <?php else: ?>
            <div class="text-center py-24 bg-white/5 rounded-2xl border border-white/5 border-dashed">
                <p class="text-gray-400 text-lg">No series found for this brand.</p>
                <a href="javascript:history.back()" class="text-lime-400 hover:text-white font-bold mt-4 inline-block transition-colors">Return to Brands</a>
            </div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="mt-16 text-center">
             <a href="javascript:history.back()" class="inline-flex items-center gap-3 px-8 py-4 rounded-xl bg-white/5 border border-white/10 text-gray-300 font-bold uppercase tracking-widest hover:bg-lime-400 hover:text-black hover:border-lime-400 transition-all duration-300">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                 <span>Back to Brands</span>
             </a>
        </div>
    </div>
</div>