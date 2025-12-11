<?php
/**
 * Template Name: Brands Catalog
 *
 * This is the template for displaying the Brands Catalog.
 * It integrates the [ctr_show_brands] shortcode.
 *
 * @package Tuning_Mania
 */

get_header(); ?>

<main id="primary" class="site-main bg-neutral-950 text-white min-h-screen pt-24 pb-12" data-barba="container" data-barba-namespace="brands-catalog">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <header class="page-header text-center mb-10 md:mb-16">
            <h1 class="text-3xl md:text-6xl font-black uppercase italic mb-4">
                Our Supported <span class="text-neon-yellow">Brands</span>
            </h1>
            <p class="text-gray-400 text-base md:text-lg max-w-2xl mx-auto">
                Explore a comprehensive list of vehicle brands we support for chiptuning. Find your manufacturer and unlock enhanced performance.
            </p>
            <div class="h-1 w-20 bg-lime-400 mx-auto shadow-[0_0_15px_#ccff00] mt-6"></div>
        </header>

        <div class="page-content bg-[#0b0f19] rounded-xl p-6 md:p-12 border border-white/10 shadow-2xl relative">
            <?php
            // Display the ChiptuningReseller brands shortcode
            echo do_shortcode('[ctr_show_brands]');
            ?>
        </div>
    </div>
</main><!-- #primary -->

<?php
get_footer();
