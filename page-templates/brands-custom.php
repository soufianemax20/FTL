<?php
/**
 * Template Name: Tuning Mania - Custom Brands Display
 *
 * This template manually retrieves data from the CTR plugin to bypass
 * any template loading issues.
 */

get_header();

// 1. RECOVER DATA FROM PLUGIN
// We need to know WHICH vehicle type we are looking at (cars, trucks, etc.)
// Usually passed via query var 'ctr_vehicle_type'
$vehicle_type = get_query_var('ctr_vehicle_type');

if (empty($vehicle_type)) {
    // Fallback: try to guess from URL or default to 'cars'
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (strpos($path, 'trucks') !== false) $vehicle_type = 'trucks';
    elseif (strpos($path, 'tractors') !== false) $vehicle_type = 'tractors';
    else $vehicle_type = 'cars';
}

// 2. FETCH BRANDS DATA DIRECTLY
// Using the plugin's internal API class
$brands = [];
if (class_exists('Ctr_Api_Connector')) {
    // The plugin usually gets brands via this method or similar
    // We will try to get ALL brands for this type
    $response = Ctr_Api_Connector::get_brands($vehicle_type);

    if (isset($response['brands'])) {
        $brands = $response['brands'];
    } elseif (is_array($response)) {
        $brands = $response;
    }
}

// If still empty, try the fallback global variable if the plugin already loaded it
if (empty($brands) && isset($GLOBALS['ctr_brands'])) {
    $brands = $GLOBALS['ctr_brands'];
}

?>

<div id="tm-brands-app" class="w-full min-h-screen bg-[#050505] text-white p-4">

    <!-- HEADER -->
    <div class="max-w-[1800px] mx-auto mb-6 flex flex-col md:flex-row justify-between items-center gap-4 border-b border-[#222] pb-6">
        <div>
            <h3 class="text-lime-400 font-bold uppercase text-xs tracking-[0.3em] mb-1"><?php echo esc_html(ucfirst($vehicle_type)); ?></h3>
            <h1 class="text-2xl font-orbitron font-bold text-white uppercase tracking-wider">
                Manufacturer <span class="text-lime-400">Index</span>
            </h1>
        </div>

        <!-- LIVE FILTER -->
        <div class="relative w-full md:w-1/3">
            <input type="text" id="brandFilter" placeholder="FILTER BRANDS..."
                   class="w-full bg-[#111] border border-[#333] text-white px-4 py-2 rounded-none focus:border-lime-400 outline-none font-mono text-sm uppercase transition-colors">
        </div>
    </div>

    <!-- THE GRID -->
    <div class="max-w-[1800px] mx-auto">

        <?php if (!empty($brands)) : ?>
            <div id="brandsGrid" class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 2xl:grid-cols-10 border-t border-l border-[#222]">

                <?php foreach ($brands as $brand) :
                    $name = $brand['name'] ?? 'Unknown';
                    // Reconstruct URL if needed, or use provided
                    $url = $brand['url'] ?? home_url('/tuner-files-lab/' . $vehicle_type . '/' . $brand['slug'] . '/');
                    $img = $brand['image_url'] ?? '';
                ?>

                    <a href="<?php echo esc_url($url); ?>" class="brand-cell group relative flex flex-col items-center justify-center h-32 border-r border-b border-[#222] bg-[#0a0a0a] hover:bg-[#111] hover:z-10 transition-all" data-name="<?php echo esc_attr(strtolower($name)); ?>">

                        <!-- Hover Border -->
                        <div class="absolute inset-0 border-2 border-lime-400 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity"></div>

                        <!-- Logo -->
                        <div class="w-12 h-12 bg-white rounded p-1 flex items-center justify-center mb-2 opacity-80 group-hover:opacity-100 transition-opacity">
                            <?php if ($img) : ?>
                                <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($name); ?>" class="w-full h-full object-contain">
                            <?php else : ?>
                                <span class="text-black font-bold text-lg"><?php echo substr($name, 0, 1); ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Name -->
                        <span class="text-[10px] font-mono text-gray-500 uppercase group-hover:text-lime-400 transition-colors text-center px-2 truncate w-full">
                            <?php echo esc_html($name); ?>
                        </span>

                    </a>

                <?php endforeach; ?>

            </div>
        <?php else : ?>

            <div class="py-20 text-center border border-[#222] bg-[#111] rounded-xl">
                <h2 class="text-xl text-white font-orbitron mb-4">No Data Found</h2>
                <p class="text-gray-500 mb-6">We couldn't retrieve the manufacturers list directly.</p>
                <a href="<?php echo home_url('/vehicle-selector/'); ?>" class="text-lime-400 underline">Try the Vehicle Selector</a>
            </div>

        <?php endif; ?>

        <!-- No Results JS Fallback -->
        <div id="noResults" class="hidden py-12 text-center text-gray-600 font-mono uppercase">
            No matching manufacturers found.
        </div>

    </div>

</div>

<script>
document.getElementById('brandFilter').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let cells = document.querySelectorAll('.brand-cell');
    let visibleCount = 0;

    cells.forEach(cell => {
        let name = cell.getAttribute('data-name');
        if (name.includes(filter)) {
            cell.style.display = 'flex';
            visibleCount++;
        } else {
            cell.style.display = 'none';
        }
    });

    let noRes = document.getElementById('noResults');
    if(visibleCount === 0) {
        noRes.classList.remove('hidden');
    } else {
        noRes.classList.add('hidden');
    }
});
</script>

<?php
get_footer();
