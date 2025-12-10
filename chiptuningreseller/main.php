<?php
/**
 * The main displaying template - SEO Enhanced
 *
 * This template can be overridden by copying it to yourtheme/chiptuningreseller/main.php.
 * SEO Enhancements: Breadcrumbs, dynamic titles, semantic structure
 *
 * @package     ChiptuningReseller\Templates
 * @version     6.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// SEO: Parse URL for dynamic content
$url_path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
$url_parts = explode( '/', $url_path );
$ctr_start_url = get_option( 'ctr_start_url', 'chip-tuning' );

// Determine context from URL
$brand = isset( $url_parts[1] ) ? ucwords( str_replace( '-', ' ', $url_parts[1] ) ) : '';
$model = isset( $url_parts[2] ) ? ucwords( str_replace( '-', ' ', $url_parts[2] ) ) : '';
$engine = isset( $url_parts[3] ) ? ucwords( str_replace( '-', ' ', $url_parts[3] ) ) : '';
?>

<!-- START TEMPLATE: Main Wrapper Cyberpunk Design -->
<div class="ctr-container-full ctr-mx-auto max-w-[1400px]" style="color: #e5e5e5;">

    <?php
    // SEO: Display breadcrumbs
    if ( function_exists( 'tm_seo_display_breadcrumbs' ) ) {
        echo '<div class="ctr-mb-4 px-4">';
        tm_seo_display_breadcrumbs();
        echo '</div>';
    }
    ?>

    <?php
    // SEO: Intro content (Only show on main landing if needed, handled by templates usually)
    // We keep the dynamic title logic here just in case specific templates don't override it,
    // but the new Brands/Engines/Stages templates have their own headers.
    ?>

    <!-- Plugin Content Container -->
    <div class="ctr-content-wrapper min-h-[60vh]">
        <div class="page-content bg-[#0b0f19] rounded-xl p-6 md:p-12 border border-white/10 shadow-2xl relative">
            <?php
            // Display the Selector
            $current_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : 'cars';
            echo do_shortcode('[ctr_show_selector type="' . $current_type . '" autoredirect="true" title="false"]');
            ?>

            <div class="mt-16">
                <h3 class="text-2xl font-black uppercase italic text-white mb-8 text-center">
                    Browse by <span class="text-neon-yellow">Brand</span>
                </h3>
                <?php
                // Display the Brands
                echo do_shortcode('[ctr_show_brands]');
                ?>
            </div>
        </div>
    </div>

</div>

<?php
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
