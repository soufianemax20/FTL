<?php
/**
 * Template Name: Tuning Catalog Root
 * Description: The root page for the Chiptuning Plugin structure (Select Vehicle Type).
 *
 * @package Tuning Mania
 */

get_header();
?>

<main id="primary" class="site-main bg-[#020617] text-white font-inter min-h-screen pt-12 pb-20">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Hero / Title -->
        <div class="text-center mb-16">
            <div class="inline-block mb-4 px-4 py-1 rounded-full bg-lime-400/10 border border-lime-400/20 text-lime-400 text-xs font-bold uppercase tracking-widest">
                Step 1
            </div>
            <h1 class="text-4xl md:text-6xl font-black font-orbitron uppercase text-white mb-4">
                Select <span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-emerald-400">Vehicle Type</span>
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Choose your vehicle category to browse available tuning files and performance stats.
            </p>
        </div>

        <!-- The Selector Widget (Plugin Entry Point) -->
        <!-- We use the shortcode provided by the plugin to initiate the flow -->
        <div class="bg-[#111] border border-[#222] rounded-3xl p-8 md:p-16 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-lime-400 to-emerald-500"></div>

            <!-- Visual Decoration -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-lime-400/5 rounded-full blur-[100px] pointer-events-none"></div>

            <div class="ctr-selector-wrapper relative z-10">
                <?php echo do_shortcode('[ctr_show_selector autoredirect="true"]'); ?>
            </div>
        </div>

        <!-- Categories Grid (Visual Shortcut - optional but good for UX) -->
        <!-- Only if plugin doesn't output them graphically, we can add manual links here if needed -->

    </div>

</main>

<?php
get_footer();
