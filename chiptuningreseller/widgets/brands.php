<?php
/**
 * Brands template (Widget Version) - Fixed Displays with ROBUST Context Fallback (CDN & Plugin Fallback)
 *
 * Replaces the default widget logic with the enhanced Cyberpunk grid
 * to ensure consistency and fix broken image displays via fallback.
 * VS: CDN + Plugin Fallback + Fixed Filters.
 *
 * @package     ChiptuningReseller\Templates
 * @version     6.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Ensure $brands variable is available
if(!isset($brands)) return;

// Context Aware Fallback Logic
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
}
// Priority 2: Keyword (Reordered)
else {
     // Check BOAT first
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
<!-- START TEMPLATE -->
<div class="ctr-container ctr-mx-auto">

    <!-- Fallback Script (Inline for Widget) -->
    <script>
    function tm_widget_brand_fallback(img, pluginSrc, cdnSrc, finalSrc) {
        if (!img.getAttribute('data-tried-plugin')) {
            img.setAttribute('data-tried-plugin', 'true');
            img.src = pluginSrc;
        } else if (!img.getAttribute('data-tried-cdn')) {
            img.setAttribute('data-tried-cdn', 'true');
            img.src = cdnSrc;
        } else {
             img.onerror = null;
             img.src = finalSrc;
        }
    }
    </script>

    <!-- Header -->
    <p class="text-2xl text-center font-orbitron text-white uppercase tracking-widest mb-8">
        <?php _e('Select a brand', 'ctr'); ?>
    </p>

    <!-- Cyberpunk Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 px-4" role="list">
    <?php
    foreach($brands as $brand) {
        $brand_slug = isset($brand['slug']) ? $brand['slug'] : sanitize_title($brand['name']);
        // 1. Plugin Local Guess
        $plugin_logo = content_url() . '/plugins/ctr/public/assets/brands/' . $brand_slug . '.png';
        // 2. CDN Guess
        $cdn_logo = 'https://raw.githubusercontent.com/filippofilip95/car-logos-dataset/master/logos/optimized/' . $brand_slug . '.svg';
    ?>
        <div class="group relative" role="listitem">
            <a href="<?php echo esc_url($brand['url']); ?>"
               class="block h-full bg-[#151922] border border-white/10 rounded-lg p-4 transition-all duration-300 hover:border-[#ccff00] hover:shadow-[0_0_15px_rgba(204,255,0,0.2)] text-center flex flex-col items-center justify-center gap-2">

                <!-- Brand Logo (Grayscale -> Color) -->
                <div class="relative w-16 h-16 flex items-center justify-center mb-2 bg-white/5 rounded-full p-2">
                    <img class="w-full h-full object-contain transition-all duration-300
                                filter grayscale opacity-70 contrast-125
                                group-hover:grayscale-0 group-hover:opacity-100 group-hover:drop-shadow-[0_0_10px_rgba(255,255,255,0.4)]"
                         loading="lazy"
                         src="<?php echo esc_url($brand['image_url']); ?>"
                         onerror="tm_widget_brand_fallback(this, '<?php echo esc_url($plugin_logo); ?>', '<?php echo esc_url($cdn_logo); ?>', '<?php echo esc_url($fallback_img); ?>')"
                         alt="<?php echo esc_attr($brand['name']); ?>"
                         title="<?php echo esc_attr($brand['name']); ?>">
                </div>

                <!-- Brand Name -->
                <div class="text-xs font-bold text-gray-300 uppercase group-hover:text-white transition-colors">
                    <?php echo esc_html($brand['name']); ?>
                </div>
                 <!-- Extra Text -->
                 <div class="text-[9px] text-gray-600 uppercase font-mono">Chiptuning</div>
            </a>
        </div>
    <?php } ?>
    </div>

    <!-- Footer CTA -->
    <div class="text-center mt-8 pb-4">
        <a href="<?php ctr_print_full_start_url(); ?>"
           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-800 rounded hover:bg-[#ccff00] hover:text-black transition-colors text-xs font-bold uppercase">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 448 512"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
            <?php _e('Back to vehicle type selection', 'ctr'); ?>
        </a>
    </div>

</div>
<!-- END TEMPLATE -->