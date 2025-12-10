<?php
/**
 * The template for displaying all WooCommerce pages.
 *
 * This template acts as a wrapper for all WooCommerce content, ensuring it fits
 * within the theme's layout structure (Dark mode, container, headers).
 *
 * @package Tuning_Mania
 */

get_header();
?>

<main id="primary" class="site-main bg-[#050505] text-white min-h-screen pt-24">

    <!-- Shop Header / Title Section -->
    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) && is_shop() ) : ?>
        <div class="relative mb-12 text-center">
            <h1 class="text-4xl md:text-6xl font-black font-orbitron uppercase tracking-tight mb-4">
                Performance <span class="text-[#ccff00]">Parts</span>
            </h1>
            <div class="h-1 w-24 bg-[#ccff00] mx-auto shadow-[0_0_15px_#ccff00]"></div>
            <p class="mt-4 text-gray-400 max-w-2xl mx-auto">
                Upgrade your vehicle with premium hardware. Turbos, intercoolers, exhaust systems, and more.
            </p>
        </div>
    <?php endif; ?>

    <!-- Main Content Container -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-20">

        <!-- WooCommerce Content Output -->
        <div class="tuning-mania-woo-wrapper">
            <?php woocommerce_content(); ?>
        </div>

    </div>

</main>

<?php
get_footer();
