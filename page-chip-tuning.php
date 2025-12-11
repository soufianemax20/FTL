<?php
/**
 * Template Name: Chip Tuning Page
 *
 * @package Tuning_Mania
 */

get_header();
?>

<main id="primary" class="site-main bg-[#050505] text-white min-h-screen pt-20">

    <!-- Breadcrumbs -->
    <?php if (function_exists('tm_breadcrumbs')) tm_breadcrumbs(); ?>

    <!-- HERO SECTION (Compact) -->
    <section class="relative h-[40vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=2070&auto=format&fit=crop"
                 alt="Engine Tuning"
                 class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-b from-[#050505]/80 via-[#050505]/50 to-[#050505]"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-black italic uppercase tracking-tighter mb-4">
                Select Your <span class="text-lime-400">Vehicle</span>
            </h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto font-light">
                Choose your make and model to see the potential gains.
            </p>
        </div>
    </section>

    <!-- SELECTOR SECTION -->
    <section class="py-12 -mt-20 relative z-20">
        <div class="container mx-auto px-4">
            <div class="bg-[#151922]/90 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-[0_0_50px_rgba(0,0,0,0.5)]">
                <!-- The Plugin Selector Shortcode -->
                <div class="ctr-selector-wrapper">
                    <?php
                    $type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : 'cars';
                    echo do_shortcode('[ctr_show_selector type="' . $type . '" autoredirect="true"]');
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- INFO GRID -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="p-8 bg-[#151922] border border-white/5 rounded-xl hover:border-lime-400/50 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-lime-400/10 rounded-lg flex items-center justify-center mb-6 group-hover:bg-lime-400/20 transition-colors">
                        <svg class="w-6 h-6 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase mb-3">Power Increase</h3>
                    <p class="text-gray-400 text-sm">Unlock the hidden potential of your engine with our safe and tested maps.</p>
                </div>

                <!-- Card 2 -->
                <div class="p-8 bg-[#151922] border border-white/5 rounded-xl hover:border-lime-400/50 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-lime-400/10 rounded-lg flex items-center justify-center mb-6 group-hover:bg-lime-400/20 transition-colors">
                        <svg class="w-6 h-6 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase mb-3">Fuel Efficiency</h3>
                    <p class="text-gray-400 text-sm">Optimize your fuel consumption with our Eco-Tuning options.</p>
                </div>

                <!-- Card 3 -->
                <div class="p-8 bg-[#151922] border border-white/5 rounded-xl hover:border-lime-400/50 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-lime-400/10 rounded-lg flex items-center justify-center mb-6 group-hover:bg-lime-400/20 transition-colors">
                        <svg class="w-6 h-6 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase mb-3">Lifetime Warranty</h3>
                    <p class="text-gray-400 text-sm">We stand behind our software with a lifetime warranty on all files.</p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
