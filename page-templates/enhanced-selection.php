<?php
/*
Template Name: Enhanced Vehicle Selection (Cyberpunk)
Description: A standalone, high-impact landing page for vehicle category selection with advanced animations and neon effects.
*/

get_header();

// 1. Setup Data (Manual Definition for Robustness)
$assets_uri = get_template_directory_uri() . '/assets/img/';
$default_icon_url = $assets_uri . 'car.png';

$vehicle_types = [
    ['slug' => 'cars',       'name' => 'Cars',            'icon' => 'car.png'],
    ['slug' => 'bikesquad',  'name' => 'Bikes and Quads', 'icon' => 'bike.png'],      // ✅ Correct: bikesquad (NOT bikes)
    ['slug' => 'motorboats', 'name' => 'Boats',           'icon' => 'boat.png'],      // ✅ Correct: motorboats (NOT boats)
    ['slug' => 'jet-skis',   'name' => 'Jet Skis',        'icon' => 'Jet skis.png'],
    ['slug' => 'tractors',   'name' => 'Tractors',        'icon' => 'tractor.png'],
    ['slug' => 'trucks',     'name' => 'Trucks',          'icon' => 'truck.png'],
];
?>

<!-- MAIN CONTAINER (Full Screen, Dark Mode) -->
<main class="relative min-h-screen bg-[#050505] overflow-hidden flex flex-col items-center justify-center py-20">

    <!-- BACKGROUND FX -->
    <!-- Grid Floor -->
    <div class="absolute inset-0 pointer-events-none opacity-20"
         style="background-image: linear-gradient(rgba(204, 255, 0, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(204, 255, 0, 0.1) 1px, transparent 1px); background-size: 50px 50px; perspective: 500px; transform: rotateX(60deg) scale(2);"></div>

    <!-- Ambient Glows -->
    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-[#ccff00] rounded-full blur-[150px] opacity-10 animate-pulse"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-blue-600 rounded-full blur-[150px] opacity-10 animate-pulse" style="animation-delay: 1s;"></div>

    <!-- CONTENT WRAPPER -->
    <div class="container mx-auto px-4 relative z-10 w-full max-w-7xl">

        <!-- HEADER ANIMATION -->
        <div class="text-center mb-16 md:mb-24 opacity-0 animate-fade-in-down" style="animation-fill-mode: forwards;">
            <h1 class="text-4xl md:text-7xl font-black italic uppercase text-white mb-6 font-orbitron tracking-tighter drop-shadow-[0_0_25px_rgba(255,255,255,0.2)]">
                Select Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ccff00] to-green-400 drop-shadow-[0_0_15px_rgba(204,255,0,0.8)]">Machine</span>
            </h1>
            <p class="text-gray-400 text-lg md:text-2xl font-light tracking-wide max-w-2xl mx-auto">
                Premium Tuning Files for Every Vehicle Type
            </p>
            <div class="h-1 w-32 bg-[#ccff00] mx-auto mt-8 shadow-[0_0_25px_#ccff00] rounded-full"></div>
        </div>

        <!-- THE GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 md:gap-10 perspective-1000">
            <?php
            $delay = 0;
            foreach($vehicle_types as $type) {
                $delay += 100; // Stagger animation
                $icon_url = $assets_uri . $type['icon'];
                // Clean URL (Plugin standard)
                $link_url = home_url('/?type=' . $type['slug']);
            ?>

            <!-- CARD ITEM -->
            <div class="group relative opacity-0 animate-fade-in-up" style="animation-delay: <?php echo $delay; ?>ms; animation-fill-mode: forwards;">

                <a href="<?php echo esc_url($link_url); ?>"
                   class="block h-64 md:h-80 relative bg-white/5 backdrop-blur-md rounded-3xl border border-white/10 overflow-hidden transform transition-all duration-500 hover:scale-105 hover:-translate-y-2 hover:shadow-[0_20px_50px_-10px_rgba(204,255,0,0.3)] hover:border-[#ccff00]/60 group-hover:z-20">

                    <!-- Hover Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#ccff00]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <!-- Content Container -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-6">

                        <!-- Icon Wrapper (Neon Ring Effect) -->
                        <div class="relative w-32 h-32 mb-8 flex items-center justify-center">
                            <!-- Ring -->
                            <div class="absolute inset-0 rounded-full border border-white/10 group-hover:border-[#ccff00] group-hover:shadow-[0_0_30px_#ccff00] transition-all duration-500 scale-75 group-hover:scale-110 opacity-50 group-hover:opacity-100"></div>

                            <!-- Icon (Green Neon) -->
                            <img class="w-24 h-24 object-contain relative z-10 transition-transform duration-500 group-hover:scale-110 filter grayscale brightness-0 invert sepia saturate-[50] hue-rotate-[65deg] drop-shadow-[0_0_10px_#ccff00]"
                                 src="<?php echo esc_url($icon_url); ?>"
                                 alt="<?php echo esc_attr($type['name']); ?>"
                                 loading="lazy">
                        </div>

                        <!-- Title -->
                        <h3 class="text-2xl md:text-3xl font-bold font-orbitron text-white uppercase tracking-widest relative z-10 group-hover:text-[#ccff00] transition-colors duration-300">
                            <?php echo esc_html($type['name']); ?>
                        </h3>

                        <!-- Arrow Indicator -->
                        <div class="absolute bottom-6 opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 text-[#ccff00]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </div>

                    </div>

                    <!-- Tech Lines -->
                    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-[#ccff00] to-transparent transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></div>
                </a>
            </div>

            <?php } ?>
        </div>

    </div>

    <!-- CUSTOM STYLES FOR ANIMATION -->
    <style>
        .font-orbitron { font-family: 'Orbitron', 'sans-serif'; }

        .perspective-1000 { perspective: 1000px; }

        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in-down { animation: fade-in-down 0.8s ease-out forwards; }
        .animate-fade-in-up { animation: fade-in-up 0.8s ease-out forwards; }
    </style>

</main>

<?php get_footer(); ?>
