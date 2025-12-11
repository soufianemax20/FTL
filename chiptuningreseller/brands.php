<?php
/**
 * Brands template - SEO Enhanced & Image Fix with ROBUST Context Fallback (CDN & Plugin Fallback)
 *
 * This template can be overridden by copying it to yourtheme/chiptuningreseller/brands.php.
 * KEY CHANGE: Added Javascript Fallback Chain: Original -> Plugin Local -> GitHub CDN (Real Logos) -> Generic Icon.
 *
 * @package     ChiptuningReseller\Templates
 * @version     6.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// SEO: Get current vehicle type for context
$current_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : 'cars';
$type_slug = strtolower($current_type);

// Explicit Fallback Map - Using CORRECT plugin slugs
$fallback_map = [
    'bikesquad'  => 'bike.png',     // ✅ CORRECT plugin slug
    'bikes'      => 'bike.png',     // Fallback alias
    'trucks'     => 'truck.png',
    'tractors'   => 'tractor.png',
    'motorboats' => 'boat.png',     // ✅ CORRECT plugin slug
    'boats'      => 'boat.png',     // Fallback alias
    'jet-skis'   => 'Jet skis.png'
];

$fallback_file = 'default-brand.webp'; // Default

// Priority 1: Explicit
if (isset($fallback_map[$type_slug])) {
    $fallback_file = $fallback_map[$type_slug];
} else {
    // Priority 2: Keyword Search (Fallback)
    if (strpos($type_slug, 'boat') !== false || strpos($type_slug, 'marine') !== false) {
        $fallback_file = 'boat.png';
    } elseif (strpos($type_slug, 'jet') !== false || strpos($type_slug, 'ski') !== false) {
        $fallback_file = 'Jet skis.png';
    } elseif (strpos($type_slug, 'tractor') !== false || strpos($type_slug, 'agri') !== false) {
        $fallback_file = 'tractor.png';
    } elseif (strpos($type_slug, 'truck') !== false) {
        $fallback_file = 'truck.png';
    } elseif (strpos($type_slug, 'bike') !== false || strpos($type_slug, 'moto') !== false) {
        $fallback_file = 'bike.png';
    }
}

$fallback_img = get_template_directory_uri() . '/assets/img/' . $fallback_file;
?>
<!-- START TEMPLATE: Brands Cyberpunk Design -->
<div class="ctr-container ctr-mx-auto px-4 py-8">

    <?php
    if ( function_exists( 'tm_seo_display_breadcrumbs' ) ) {
        tm_seo_display_breadcrumbs();
    }
    ?>

    <!-- Fallback Script -->
    <script>
    function tm_brand_fallback(img, pluginSrc, cdnSrc, finalSrc) {
        if (!img.getAttribute('data-tried-plugin')) {
            img.setAttribute('data-tried-plugin', 'true');
            img.src = pluginSrc;
        } else if (!img.getAttribute('data-tried-cdn')) {
            img.setAttribute('data-tried-cdn', 'true');
            img.src = cdnSrc;
        } else {
             img.onerror = null; // Stop looping
             img.src = finalSrc;
        }
    }
    </script>

    <!-- Neon Header -->
    <header class="text-center mb-12 relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-3/4 h-32 bg-lime-500/10 blur-[100px] rounded-full pointer-events-none"></div>
        <h2 class="text-3xl md:text-5xl font-black italic uppercase text-white mb-4 relative z-10" style="font-family: 'Orbitron', sans-serif; text-shadow: 0 0 20px rgba(204, 255, 0, 0.3);">
            Select <span class="text-[#ccff00]">Brand</span>
        </h2>
        <div class="h-1 w-24 bg-[#ccff00] mx-auto shadow-[0_0_15px_#ccff00] relative z-10"></div>
    </header>

    <!-- Cyberpunk Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6" role="list">
    <?php
    $count = 0;
    foreach($brands as $brand) {
        $count++;
        // SEO: Enhanced alt text
        $alt_text = esc_attr($brand['name']) . ' Chiptuning - ECU Remapping Files';

        // Smart Paths
        $brand_slug = isset($brand['slug']) ? $brand['slug'] : sanitize_title($brand['name']);
        // 1. Plugin Local Guess
        $plugin_logo = content_url() . '/plugins/ctr/public/assets/brands/' . $brand_slug . '.png';
        // 2. High Quality CDN Guess (GitHub Dataset)
        $cdn_logo = 'https://raw.githubusercontent.com/filippofilip95/car-logos-dataset/master/logos/optimized/' . $brand_slug . '.svg';
    ?>
        <div class="group relative" role="listitem">
            <!-- Glass Card -->
            <a href="<?php echo esc_url($brand['url']); ?>"
               class="block h-full bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_10px_30px_-10px_rgba(204,255,0,0.2)] hover:border-[#ccff00]/50 relative overflow-hidden text-center flex flex-col justify-center items-center gap-4"
               title="<?php echo esc_attr($brand['name']); ?> Chiptuning">

                <!-- Hover Glow Effect -->
                <div class="absolute inset-0 bg-gradient-to-br from-[#ccff00]/0 via-[#ccff00]/0 to-[#ccff00]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                <!-- Brand Logo (Grayscale -> Color) -->
                <div class="relative w-24 h-24 flex items-center justify-center bg-white/5 rounded-full p-4 group-hover:bg-white/10 transition-colors">
                    <img class="w-full h-full object-contain transition-all duration-300
                                filter grayscale opacity-70 contrast-125
                                group-hover:grayscale-0 group-hover:opacity-100 group-hover:drop-shadow-[0_0_15px_rgba(255,255,255,0.4)]"
                         loading="<?php echo $count <= 12 ? 'eager' : 'lazy'; ?>"
                         src="<?php echo esc_url($brand['image_url']); ?>"
                         onerror="tm_brand_fallback(this, '<?php echo esc_url($plugin_logo); ?>', '<?php echo esc_url($cdn_logo); ?>', '<?php echo esc_url($fallback_img); ?>')"
                         alt="<?php echo $alt_text; ?>"
                         width="96" height="96">
                </div>

                <!-- Brand Name -->
                <div class="text-gray-300 font-bold tracking-wider text-sm uppercase group-hover:text-white transition-colors relative z-10">
                    <?php echo esc_html($brand['name']); ?>
                </div>
                <!-- Subtitle -->
                <div class="text-[10px] text-gray-500 uppercase font-mono group-hover:text-[#ccff00] transition-colors relative z-10">
                    Chiptuning - ECU Remapping
                </div>

                <!-- Tech Elements -->
                <div class="absolute top-2 right-2 w-1.5 h-1.5 bg-[#ccff00] rounded-full opacity-0 group-hover:opacity-100 shadow-[0_0_8px_#ccff00] transition-opacity duration-300 delay-100"></div>
                <div class="absolute bottom-0 left-0 h-[2px] w-0 bg-[#ccff00] group-hover:w-full transition-all duration-500 ease-out"></div>
            </a>
        </div>
    <?php } ?>
    </div>

    <!-- Footer CTA -->
    <div class="text-center mt-16 mb-8 relative z-10">
        <a href="<?php ctr_print_full_start_url(); ?>"
           class="inline-flex items-center gap-3 px-8 py-4 bg-neutral-900 border border-white/10 rounded-lg text-white font-bold uppercase tracking-widest hover:bg-[#ccff00] hover:text-black hover:border-[#ccff00] transition-all duration-300 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="currentColor" viewBox="0 0 448 512"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
            <span>Back to Type Selection</span>
        </a>
    </div>

</div>
<!-- END TEMPLATE -->