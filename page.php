<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package Tuning Mania
 */

get_header();
?>

<main id="primary" class="site-main bg-[#020617] text-white font-inter min-h-screen pt-12 pb-20">

    <!-- Breadcrumbs -->
    <?php if (function_exists('tm_breadcrumbs')) tm_breadcrumbs(); ?>

    <!-- Page Header -->
    <div class="relative py-16 mb-12 overflow-hidden">
        <div class="absolute inset-0 bg-lime-400/5"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-1 bg-gradient-to-r from-transparent via-lime-400 to-transparent opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <?php
            // Hide title on Cart, Checkout, Account pages because standard templates usually handle it inside content
            if(!is_cart() && !is_checkout() && !is_account_page()) : ?>
                <h1 class="text-4xl md:text-6xl font-black text-white font-orbitron uppercase tracking-wide mb-4 drop-shadow-lg">
                    <?php the_title(); ?>
                </h1>
                <div class="h-1 w-24 bg-lime-400 mx-auto shadow-[0_0_15px_#bef264]"></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Page Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Wrapper for standard pages to give them the "Card" look -->
        <!-- WooCommerce pages handle their own structure often, but this wrapper helps unification -->
        <div class="bg-[#111] border border-[#222] rounded-2xl p-8 md:p-12 shadow-2xl relative overflow-hidden">

            <!-- Content Loop -->
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <div class="entry-content text-gray-300 leading-relaxed">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tuning-mania' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div>
                <?php
            endwhile; // End of the loop.
            ?>

        </div>
    </div>

</main>

<?php
get_footer();