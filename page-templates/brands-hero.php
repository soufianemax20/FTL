<?php
/**
 * Template Name: Zero to Hero Brands (Tuning Mania)
 * Description: A custom, standalone template to display vehicle brands with a premium 3D Grid design.
 *
 * @package Tuning Mania
 */

get_header();

// ---------------------------------------------------------
// 1. DATA RETRIEVAL (THE "ZERO" PART)
// ---------------------------------------------------------

// Default to 'cars' if no type is specified
$vehicle_type = get_query_var('ctr_vehicle_type', 'cars');

// Fetch brands using the plugin's helper if available, or manual DB query if needed.
// We prefer the official API connector for compatibility.
$brands = [];
if (class_exists('Ctr_Api_Connector')) {
    // Attempt to get brands for the selected vehicle type
    $api_response = Ctr_Api_Connector::get_brands($vehicle_type);
    if (isset($api_response['brands'])) {
        $brands = $api_response['brands'];
    } elseif (is_array($api_response)) {
        $brands = $api_response;
    }
}

// Fallback: Check global context if the plugin loaded before us
if (empty($brands) && isset($GLOBALS['ctr_brands'])) {
    $brands = $GLOBALS['ctr_brands'];
}

// ---------------------------------------------------------
// 2. THE DESIGN (THE "HERO" PART)
// ---------------------------------------------------------
?>

<div class="tm-hero-brands w-full min-h-screen bg-[#020617] text-white font-inter pb-20">

    <!-- HERO HEADER -->
    <div class="relative py-20 px-4 text-center overflow-hidden">
        <!-- Background FX -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-lime-400/10 via-[#020617] to-[#020617] pointer-events-none"></div>

        <div class="relative z-10 max-w-4xl mx-auto">
            <span class="inline-block py-1 px-3 rounded-full bg-lime-400/10 text-lime-400 text-xs font-bold uppercase tracking-[0.3em] border border-lime-400/20 mb-6 animate-pulse">
                Select Manufacturer
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-white font-orbitron uppercase tracking-tighter mb-6 drop-shadow-2xl">
                Make Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-emerald-400">Choice</span>
            </h1>

            <!-- SEARCH BAR (JS Powered) -->
            <div class="max-w-md mx-auto relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-lime-400 to-emerald-600 rounded-lg blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <input type="text" id="heroBrandSearch"
                       placeholder="Search brand (e.g. Audi)..."
                       class="relative w-full bg-[#0a0a0a] text-white border border-[#333] rounded-lg px-6 py-4 focus:outline-none focus:ring-2 focus:ring-lime-400 font-orbitron uppercase tracking-widest text-sm shadow-2xl placeholder-gray-600">
                <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- BRANDS GRID -->
    <div class="max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8">

        <?php if (!empty($brands)) : ?>
            <div id="heroGrid" class="grid grid-cols-2 xs:grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-8 2xl:grid-cols-10 gap-4">

                <?php foreach ($brands as $brand) :
                    $name = $brand['name'] ?? 'Unknown';
                    $url = $brand['url'] ?? home_url('/tuner-files-lab/' . $vehicle_type . '/' . $brand['slug'] . '/');
                    $img = $brand['image_url'] ?? '';
                ?>

                    <a href="<?php echo esc_url($url); ?>"
                       class="hero-brand-item group relative flex flex-col items-center justify-center p-4 h-40 bg-[#0f0f0f] border border-[#222] rounded-2xl transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_10px_40px_-10px_rgba(190,242,100,0.3)] hover:border-lime-400/50 overflow-hidden"
                       data-name="<?php echo esc_attr(strtolower($name)); ?>">

                        <!-- Background Glow (Reveal on Hover) -->
                        <div class="absolute inset-0 bg-gradient-to-br from-lime-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Logo Box -->
                        <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center p-2 mb-3 shadow-lg z-10 group-hover:scale-110 transition-transform duration-300 relative">
                            <?php if ($img) : ?>
                                <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($name); ?>" class="w-full h-full object-contain filter contrast-125" loading="lazy">
                            <?php else : ?>
                                <span class="text-black font-black text-xl"><?php echo substr($name, 0, 1); ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Name -->
                        <h3 class="text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-widest group-hover:text-white transition-colors font-orbitron z-10 text-center w-full truncate px-2">
                            <?php echo esc_html($name); ?>
                        </h3>

                        <!-- Active Indicator (Bottom Bar) -->
                        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-1 bg-lime-400 rounded-t-full transition-all duration-300 group-hover:w-1/2"></div>

                    </a>

                <?php endforeach; ?>

            </div>
        <?php else : ?>

            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-20 bg-[#111] rounded-3xl border border-[#222]">
                <svg class="w-16 h-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <h3 class="text-xl font-orbitron text-white mb-2">No Manufacturers Loaded</h3>
                <p class="text-gray-500">Please check your API connection or try refreshing.</p>
            </div>

        <?php endif; ?>

        <!-- No Results Message -->
        <div id="heroNoResults" class="hidden py-20 text-center">
            <p class="text-gray-500 font-orbitron text-lg">No brands match your search.</p>
        </div>

    </div>

</div>

<!-- SCRIPT (Self-Contained) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('heroBrandSearch');
    const grid = document.getElementById('heroGrid');
    const items = document.querySelectorAll('.hero-brand-item');
    const noResults = document.getElementById('heroNoResults');

    if(searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const term = e.target.value.toLowerCase();
            let visibleCount = 0;

            items.forEach(item => {
                const name = item.getAttribute('data-name');
                if(name.includes(term)) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if(visibleCount === 0) {
                grid.classList.add('hidden');
                noResults.classList.remove('hidden');
            } else {
                grid.classList.remove('hidden');
                noResults.classList.add('hidden');
            }
        });
    }
});
</script>

<?php
get_footer();
