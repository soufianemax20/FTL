<?php
/**
 * Vehicle Types Template - Cyberpunk Local Assets (V6 Green Neon)
 *
 * This template handles the Vehicle Type selection grid using LOCAL assets.
 * KEY CHANGE: Applied CSS Filters to force icons into NEON GREEN (#ccff00).
 *
 * @package Tuning_Mania
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Helper to get local URI
$assets_uri = get_template_directory_uri() . '/assets/img/';
$default_icon_url = $assets_uri . 'car.png';

// Explicit Map - Using CORRECT plugin slugs
$explicit_map = [
    'cars'            => 'car.png',
    'bikesquad'       => 'bike.png',     // ✅ CORRECT plugin slug
    'bikes'           => 'bike.png',     // Fallback alias
    'bikes-and-quads' => 'bike.png',     // Fallback alias
    'trucks'          => 'truck.png',
    'tractors'        => 'tractor.png',
    'motorboats'      => 'boat.png',     // ✅ CORRECT plugin slug
    'boats'           => 'boat.png',     // Fallback alias
    'jet-skis'        => 'Jet skis.png',
    'jetskis'         => 'Jet skis.png'
];

if(isset($vehicle_types)) {
?>
<!-- START TEMPLATE: Vehicle Types Cyberpunk Design (Green Neon) -->
<div class="ctr-container ctr-mx-auto px-4 py-8">

    <?php
    if ( function_exists( 'ctr_get_template' ) ) {
        ctr_get_template('partials/breadcrumbs.php', []);
    }
    ?>

    <!-- Neon Header -->
    <header class="text-center mb-16 relative">
        <h1 class="text-3xl md:text-5xl font-black italic uppercase text-white mb-4 font-orbitron drop-shadow-[0_0_10px_rgba(255,255,255,0.3)]">
            Select <span class="text-[#ccff00] drop-shadow-[0_0_15px_rgba(204,255,0,0.6)]">Category</span>
        </h1>
        <div class="h-1 w-24 bg-[#ccff00] mx-auto shadow-[0_0_20px_#ccff00]"></div>
    </header>

    <!-- Categories Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 max-w-6xl mx-auto" role="list">
    <?php foreach($vehicle_types as $vehicle_type) {
        $slug = isset($vehicle_type['slug']) ? strtolower($vehicle_type['slug']) : '';
        $name = isset($vehicle_type['name']) ? strtolower($vehicle_type['name']) : '';

        $icon_file = 'car.png'; // Default

        // Priority 1: Explicit Map
        if (isset($explicit_map[$slug])) {
            $icon_file = $explicit_map[$slug];
        } else {
            // Priority 2: Keyword Search (Fallback) - Strict Order
            $search_str = $slug . ' ' . $name;

            // Check BOAT/MARINE first
            if (strpos($search_str, 'boat') !== false || strpos($search_str, 'marine') !== false || strpos($search_str, 'water') !== false || strpos($search_str, 'vessel') !== false) {
                $icon_file = 'boat.png';
            } elseif (strpos($search_str, 'jet') !== false || strpos($search_str, 'ski') !== false) {
                $icon_file = 'Jet skis.png';
            } elseif (strpos($search_str, 'tractor') !== false || strpos($search_str, 'agri') !== false || strpos($search_str, 'farm') !== false) {
                $icon_file = 'tractor.png';
            } elseif (strpos($search_str, 'truck') !== false || strpos($search_str, 'lorry') !== false) {
                $icon_file = 'truck.png';
            } elseif (strpos($search_str, 'bike') !== false || strpos($search_str, 'moto') !== false || strpos($search_str, 'quad') !== false || strpos($search_str, 'cycle') !== false) {
                $icon_file = 'bike.png';
            } elseif (strpos($search_str, 'car') !== false || strpos($search_str, 'auto') !== false) {
                 $icon_file = 'car.png';
            }
        }

        // Final Path
        $icon_url = $assets_uri . $icon_file;
    ?>
        <div class="group relative aspect-square" role="listitem">
            <!-- Glass Card -->
            <a href="<?php echo esc_url(strtolower($vehicle_type['url'])); ?>"
               class="block h-full w-full bg-[#0b0f19] border border-white/10 rounded-2xl p-6 flex flex-col items-center justify-center transition-all duration-300 hover:scale-105 hover:shadow-[0_0_30px_rgba(204,255,0,0.15)] hover:border-[#ccff00]/50 relative overflow-hidden group">

                <!-- Background Glow -->
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-[#ccff00]/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                <!-- Icon (Forced Neon Green) -->
                <!-- filter calculation: grayscale -> brightness-0 (black) -> invert (white) -> sepia (yellow) -> saturate (intense) -> hue-rotate (lime) -->
                <div class="relative z-10 w-24 h-24 mb-6 flex items-center justify-center">
                    <img class="w-full h-full object-contain transition-all duration-300 contrast-125
                                filter grayscale brightness-0 invert sepia saturate-[50] hue-rotate-[65deg] drop-shadow-[0_0_5px_#ccff00]"
                         loading="lazy"
                         src="<?php echo esc_url($icon_url); ?>"
                         onerror="this.onerror=null;this.src='<?php echo esc_url($default_icon_url); ?>';"
                         alt="<?php echo esc_attr($vehicle_type['name']); ?>"
                         width="96" height="96">
                </div>

                <!-- Label -->
                <div class="relative z-10 text-center">
                    <h3 class="text-xl md:text-2xl font-bold font-orbitron text-white uppercase tracking-wider group-hover:text-[#ccff00] transition-colors">
                        <?php echo esc_html($vehicle_type['name']); ?>
                    </h3>
                    <div class="w-8 h-1 bg-[#ccff00] mx-auto mt-3 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                </div>
            </a>
        </div>
    <?php } ?>
    </div>
</div>
<!-- END TEMPLATE -->
<?php
}
?>