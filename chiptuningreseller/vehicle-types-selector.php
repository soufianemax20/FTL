<?php
/**
 * Vehicle Type Selector - Tuning Mania "Upscaled Premium" Edition
 *
 * DESIGN:
 * - High-End Glassmorphism
 * - Neon Cyberpunk Accents
 * - 3D Hover Effects
 * - Fully Responsive Grid
 *
 * @package Tuning_Mania
 */

$theme_uri = get_template_directory_uri();

// 1. Get Current Type from URL (Default to cars)
$current_type = isset($_GET['type']) ? sanitize_key($_GET['type']) : 'cars';

// 2. Define Vehicle Types & Icons
// ✅ CRITICAL: Slugs MUST match ChiptuningReseller plugin exactly!
$vehicle_types = [
    'cars'       => ['name' => 'Cars',          'icon' => 'car.png'],
    'bikesquad'  => ['name' => 'Bikes & Quads', 'icon' => 'bike.png'],     // ✅ bikesquad (NOT bike/bikes)
    'trucks'     => ['name' => 'Trucks',        'icon' => 'truck.png'],
    'tractors'   => ['name' => 'Tractors',      'icon' => 'tractor.png'],
    'motorboats' => ['name' => 'Boats',         'icon' => 'boat.png'],     // ✅ motorboats (NOT boat/boats)
    'jet-skis'   => ['name' => 'Jet Skis',      'icon' => 'Jet skis.png'],
];
?>

<div class="tm-selector-upscale relative w-full" id="selector-component">

    <!-- Ambient Background Glow -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-3xl z-0">
        <div class="absolute -top-20 right-0 w-[500px] h-[500px] bg-lime-400/5 rounded-full blur-[120px] mix-blend-screen"></div>
        <div class="absolute -bottom-20 left-0 w-[500px] h-[500px] bg-[#00ff66]/5 rounded-full blur-[120px] mix-blend-screen"></div>
    </div>

    <div class="relative z-10 px-2 py-4">

        <!-- Header -->
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-5xl font-black uppercase italic tracking-tighter text-white drop-shadow-xl">
                Select <span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-[#00ff66]">Category</span>
            </h2>
            <div class="mt-4 mx-auto w-24 h-1 bg-gradient-to-r from-transparent via-lime-400 to-transparent opacity-70"></div>
        </div>

        <!-- 1. TYPE ICONS (Premium 3D Grid) -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-12">
            <?php foreach ($vehicle_types as $slug => $data):
                $isActive = ($current_type === $slug);
                $icon_url = $theme_uri . '/assets/img/' . rawurlencode($data['icon']);
            ?>
            <a href="?type=<?php echo esc_attr($slug); ?>#selector-component"
               class="group relative flex flex-col items-center justify-center p-6 rounded-2xl transition-all duration-300 tm-loader-trigger
                      <?php echo $isActive
                          ? 'bg-gradient-to-b from-white/10 to-white/5 border-lime-400 shadow-[0_0_30px_rgba(204,255,0,0.2)] scale-105'
                          : 'bg-white/5 border-white/5 hover:bg-white/10 hover:border-lime-400/50 hover:-translate-y-2 hover:shadow-xl'; ?>
                      border backdrop-blur-md overflow-hidden focus:outline-none focus-visible:ring-4 focus-visible:ring-lime-400 focus-visible:ring-offset-4 focus-visible:ring-offset-[#0b0f19]"
               data-type="<?php echo esc_attr($slug); ?>">

                <!-- Active Glow Effect -->
                <?php if($isActive): ?>
                    <div class="absolute inset-0 bg-gradient-to-b from-lime-400/10 to-transparent opacity-50"></div>
                <?php endif; ?>

                <!-- Icon Wrapper -->
                <div class="relative w-16 h-16 mb-4 transition-transform duration-300 group-hover:scale-110">
                    <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($data['name']); ?>"
                         class="w-full h-full object-contain transition-all duration-300
                                <?php echo $isActive ? 'brightness-100 drop-shadow-[0_0_10px_rgba(204,255,0,0.8)]' : 'opacity-60 grayscale group-hover:grayscale-0 group-hover:opacity-100 group-hover:drop-shadow-[0_0_8px_rgba(204,255,0,0.5)]'; ?>"
                         style="filter: <?php echo $isActive ? 'brightness(0) saturate(100%) invert(89%) sepia(47%) saturate(1283%) hue-rotate(30deg) brightness(103%) contrast(104%)' : 'brightness(0) invert(1)'; ?>;">
                </div>

                <!-- Label -->
                <span class="text-xs md:text-sm font-black uppercase tracking-widest transition-colors duration-300
                             <?php echo $isActive ? 'text-lime-400' : 'text-gray-400 group-hover:text-white'; ?>">
                    <?php echo esc_html($data['name']); ?>
                </span>

                <!-- Bottom Highlight Line -->
                <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-lime-400 to-transparent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- 2. SELECTOR WRAPPER (Native Shortcode) -->
        <div class="relative max-w-4xl mx-auto">

            <!-- Loading Overlay -->
            <div id="tm-real-loader" class="absolute inset-0 z-50 bg-[#0b0f19]/90 backdrop-blur-md rounded-2xl flex flex-col items-center justify-center hidden transition-all duration-300">
                <div class="relative">
                    <div class="w-16 h-16 border-4 border-lime-400/30 border-t-lime-400 rounded-full animate-spin"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-8 h-8 bg-lime-400 rounded-full animate-pulse opacity-50"></div>
                    </div>
                </div>
                <span class="mt-4 text-lime-400 font-bold uppercase tracking-widest text-sm animate-pulse">Loading Configuration...</span>
            </div>

            <!-- Content Card -->
            <div class="relative bg-gradient-to-b from-[#151922] to-[#0b0f19] border border-white/10 rounded-2xl p-6 md:p-10 shadow-2xl">
                <!-- Border Glow -->
                <div class="absolute -inset-[1px] bg-gradient-to-r from-lime-400/20 via-transparent to-lime-400/20 rounded-2xl -z-10 blur-sm"></div>

                <!-- Card Header -->
                <div class="flex items-center justify-between mb-8 pb-6 border-b border-white/5">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-lime-400/10 flex items-center justify-center border border-lime-400/20">
                            <!-- Icon for current type -->
                            <img src="<?php echo $theme_uri . '/assets/img/' . rawurlencode($vehicle_types[$current_type]['icon']); ?>"
                                 alt="<?php echo esc_attr($vehicle_types[$current_type]['name']); ?>"
                                 class="w-6 h-6 object-contain"
                                 style="filter: brightness(0) saturate(100%) invert(89%) sepia(47%) saturate(1283%) hue-rotate(30deg) brightness(103%) contrast(104%);">
                        </div>
                        <div>
                            <div class="text-[10px] text-gray-500 uppercase tracking-wider font-bold mb-1">Vehicle Type</div>
                            <h3 class="text-xl md:text-2xl font-black italic uppercase text-white">
                                <?php echo esc_html($vehicle_types[$current_type]['name']); ?>
                            </h3>
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-lime-400/5 rounded-full border border-lime-400/20">
                        <div class="w-1.5 h-1.5 rounded-full bg-lime-400 animate-pulse shadow-[0_0_10px_#ccff00]"></div>
                        <span class="text-[10px] uppercase text-lime-400 font-bold tracking-wider">System Ready</span>
                    </div>
                </div>

                <!-- NATIVE PLUGIN SHORTCODE + Override Wrappers -->
                <div class="tm-plugin-output relative">
                    <?php
                    echo do_shortcode('[ctr_show_selector type="' . $current_type . '" autoredirect="true" title="false"]');
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
/* --- PLUGIN OVERRIDES (Ultra Premium) --- */

/* 1. Hide unwanted plugin elements */
.tm-plugin-output .ctr-type-selector,
.tm-plugin-output .ctr-type-selection,
.tm-plugin-output .vehicle-type-list,
.tm-plugin-output .selectVehicleTitle,
.tm-plugin-output h3,
.tm-plugin-output .ctr-title,
.tm-plugin-output .selectTypeControl {
    display: none !important;
}

/* 2. Dropdown Container Styling */
.tm-plugin-output select,
.tm-plugin-output .select2-container--default .select2-selection--single {
    background-color: #0f131a !important; /* Authentic Dark */
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    border-radius: 12px !important;
    height: 60px !important; /* Taller touch targets */
    color: #fff !important;
    font-family: 'Inter', sans-serif !important;
    font-size: 1rem !important;
    font-weight: 500 !important;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.2) !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.tm-plugin-output .select2-container--default .select2-selection--single {
    display: flex !important;
    align-items: center !important;
    cursor: pointer !important;
    pointer-events: auto !important; /* Ensure clickable */
}

/* Hover/Focus State for Inputs */
.tm-plugin-output .select2-container--default .select2-selection--single:hover,
.tm-plugin-output .select2-container--open .select2-selection--single {
    border-color: rgba(204, 255, 0, 0.5) !important; /* Neon Green Border */
    box-shadow: 0 0 0 4px rgba(204, 255, 0, 0.05) !important;
    background-color: #161b22 !important;
}

/* 3. Text & Placeholder */
.tm-plugin-output .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #e5e7eb !important;
    line-height: normal !important; /* Reset to normal as flex handles centering */
    padding-left: 1.5rem !important;
    flex: 1 !important; /* Fill available space */
    width: 100% !important; /* Ensure full width clickable area */
}
.tm-plugin-output .select2-selection__placeholder {
    color: #6b7280 !important;
}

/* 4. Dropdown Arrow (Custom Chevron) */
.tm-plugin-output .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100% !important;
    width: 50px !important;
    position: absolute !important;
    top: 0 !important;
    right: 0 !important;
}
.tm-plugin-output .select2-container--default .select2-selection--single .select2-selection__arrow b {
    border: none !important;
    width: 10px !important;
    height: 10px !important;
    border-right: 2px solid #ccff00 !important; /* Neon Arrow */
    border-bottom: 2px solid #ccff00 !important;
    transform: rotate(45deg) translateY(-50%) !important;
    position: absolute !important;
    top: 45% !important;
    left: 50% !important;
    margin: 0 !important;
    transition: transform 0.3s !important;
}
.tm-plugin-output .select2-container--open .select2-selection--single .select2-selection__arrow b {
    transform: rotate(225deg) translateY(0%) !important;
    top: 50% !important;
}

/* 5. Dropdown Menu (The List itself) */
.select2-dropdown {
    background-color: #161b22 !important; /* Slightly lighter than bg for contrast */
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 12px !important;
    box-shadow: 0 20px 40px rgba(0,0,0,0.5), 0 0 0 1px rgba(0,0,0,0.2) !important;
    overflow: hidden !important;
    margin-top: 8px !important;
    z-index: 100000 !important; /* EXTREMELY HIGH Z-INDEX */
}

/* 6. Search Bar inside Dropdown */
.select2-search--dropdown {
    padding: 12px !important;
    background-color: #0f131a !important;
    border-bottom: 1px solid rgba(255,255,255,0.05) !important;
    z-index: 10000 !important;
}
.select2-search__field {
    background-color: #1e242e !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
    color: white !important;
    font-family: 'Inter', sans-serif !important;
    outline: none !important;
}
.select2-search__field:focus {
    border-color: #ccff00 !important;
}

/* 7. Results Options */
.select2-results__options {
    padding: 8px !important;
}
.select2-results__option {
    padding: 10px 16px !important;
    border-radius: 8px !important;
    font-size: 0.95rem !important;
    margin-bottom: 2px !important;
    transition: all 0.2s !important;
    color: #9ca3af !important;
}
.select2-results__option--highlighted {
    background-color: rgba(204, 255, 0, 0.1) !important;
    color: #ccff00 !important;
    font-weight: 600 !important;
}
.select2-results__option[aria-selected="true"] {
    background-color: rgba(204, 255, 0, 0.05) !important;
    color: #fff !important;
}

/* 8. Labels above inputs (if any) */
.tm-plugin-output label {
    display: block !important;
    margin-bottom: 8px !important;
    font-size: 0.75rem !important;
    font-weight: 700 !important;
    letter-spacing: 0.05em !important;
    color: #9ca3af !important;
    text-transform: uppercase !important;
}

/* 9. Submit Button (The "Find" button) */
.tm-plugin-output button[type="submit"] {
    position: relative !important;
    background: linear-gradient(135deg, #ccff00 0%, #00ff66 100%) !important;
    color: #000 !important;
    font-size: 1.1rem !important;
    font-weight: 900 !important;
    letter-spacing: 0.1em !important;
    text-transform: uppercase !important;
    border: none !important;
    padding: 20px !important;
    width: 100% !important;
    border-radius: 12px !important;
    margin-top: 24px !important;
    cursor: pointer !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 15px rgba(204, 255, 0, 0.3) !important;
}
.tm-plugin-output button[type="submit"]:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 10px 30px rgba(204, 255, 0, 0.5) !important;
}
.tm-plugin-output button[type="submit"]::after {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    left: -100% !important;
    width: 100% !important;
    height: 100% !important;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent) !important;
    transition: 0.5s !important;
}
.tm-plugin-output button[type="submit"]:hover::after {
    left: 100% !important;
    transition: 0.5s ease-in-out !important;
}

/* Responsive Fixes */
@media (max-width: 640px) {
    .tm-plugin-output select,
    .tm-plugin-output .select2-container--default .select2-selection--single {
        height: 50px !important;
        font-size: 0.9rem !important;
    }
}

/* Force 4-column layout since we hid the Type selector */
@media (min-width: 768px) {
    .tm-plugin-output .selectorSpace {
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Premium Loading State Logic
    const links = document.querySelectorAll('.tm-loader-trigger');
    const loader = document.getElementById('tm-real-loader');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            // Prevent double-loading if clicking active
            if (this.classList.contains('bg-white/5')) { // If it's NOT the active one (active uses bg-gradient)
                 loader.classList.remove('hidden');
                 loader.classList.add('flex');

                 // Smooth scroll to top of selector if needed
                 document.getElementById('selector-component').scrollIntoView({
                     behavior: 'smooth',
                     block: 'center'
                 });
            }
        });
    });
});
</script>