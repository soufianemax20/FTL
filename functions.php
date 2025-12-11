<?php
/**
 * Tuning Mania functions and definitions
 *
 * @package Tuning_Mania
 */

// ENABLE DEBUGGING (Modified to suppress Deprecated warnings from old plugins)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// Suppress Deprecated and Notices to clean up the UI
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Include SEO Enhancements Module
 * Based on Backlinko's On-Page SEO Definitive Guide (2025)
 */
require_once get_template_directory() . '/inc/seo-enhancements.php';

/**
 * Enqueue scripts and styles.
 */
function tuning_mania_scripts() {
	// Main Theme Stylesheet
	wp_enqueue_style( 'tuning-mania-style', get_stylesheet_uri(), array(), '1.0.0' );

	// Google Fonts (Orbitron for headers, Inter for body)
	// Ensure display=swap is present
	wp_enqueue_style( 'tuning-mania-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&family=Orbitron:wght@400;700;900&display=swap', array(), null );

    // Alpine.js (for interactions)
    wp_enqueue_script( 'alpine-js', 'https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js', array(), '3.14.1', false );

    // GSAP (Required for Animations)
    wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js', array(), '3.9.1', true );

    // Hero Dynamic Logic (CSS-based background, no Three.js)
    if ( is_front_page() ) {
        // Optimize: Only load heavy GSAP on desktop if possible, or keep minimal
        wp_enqueue_script( 'hero-dynamic-js', get_template_directory_uri() . '/assets/js/hero-dynamic.js', array('gsap-js'), '2.0.0', true );
        wp_enqueue_style( 'hero-dynamic-css', get_template_directory_uri() . '/assets/css/hero-3d.css', array(), '2.0.0' );
    }

    // Chart.js (Required for Dyno & Performance Graphs) - Loaded above
    // wp_enqueue_script( 'chart-js' ); // Already enqueued

    // Anti-Gravity Core (Parallax & 3D Tilt)
    wp_enqueue_script( 'anti-gravity-js', get_template_directory_uri() . '/assets/js/anti-gravity.js', array(), '1.0.0', true );

    // Tailwind CSS (Compiled Locally - NOT CDN)
    $tailwind_path = get_template_directory() . '/assets/css/tailwind.css';
    $tailwind_ver = file_exists($tailwind_path) ? filemtime($tailwind_path) : '1.0.0';
    wp_enqueue_style( 'tailwindcss', get_template_directory_uri() . '/assets/css/tailwind.css', array(), $tailwind_ver );

    // CTR Plugin Skin (Overrides)
    wp_enqueue_style( 'tuning-mania-ctr-skin', get_template_directory_uri() . '/assets/css/ctr-skin.css', array(), '1.0.0' );

    // Brand Search Fix (Global JS)
    wp_enqueue_script( 'ctr-search-fix', get_template_directory_uri() . '/assets/js/ctr-search-fix.js', array(), time() + 12, true );

    /* SPA Disabled for Performance/Stability - DIAGNOSTIC DISABLE
    // Web App / SPA Functionality (Barba.js + GSAP)
    wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true );
    wp_enqueue_script( 'barba', 'https://unpkg.com/@barba/core', array(), '2.9.7', true );
    wp_enqueue_script( 'tuning-mania-app', get_template_directory_uri() . '/assets/js/app-spa.js', array('barba', 'gsap'), '1.0.0', true );
    */
}
add_action( 'wp_enqueue_scripts', 'tuning_mania_scripts' );

/**
 * Add 'defer' attribute to specific scripts (Performance)
 */
function tuning_mania_add_defer_attribute($tag, $handle) {
    // Scripts to defer - jQuery is typically render blocking, deferring it improves Mobile Score
    // WARNING: Verify no inline jQuery scripts exist before deferring
    $defer_scripts = array('alpine-js', 'google-recaptcha', 'jquery-core', 'jquery-migrate', 'ctr-search-fix');

    if ( in_array($handle, $defer_scripts) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}
add_filter('script_loader_tag', 'tuning_mania_add_defer_attribute', 10, 2);

/**
 * Theme Setup
 */
function tuning_mania_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Title Tag Support
	add_theme_support( 'title-tag' );

	// Post Thumbnails
	add_theme_support( 'post-thumbnails' );

    // WooCommerce Support
    add_theme_support( 'woocommerce' );

	// Navigation Menus
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'tuning-mania' ),
            'footer-menu' => esc_html__( 'Footer Menu', 'tuning-mania' ),
		)
	);

	// HTML5 Support
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

    // Logo Support
    add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
	) );
}
add_action( 'after_setup_theme', 'tuning_mania_setup' );

/**
 * Add "active" class to current menu item for styling
 */
function tuning_mania_menu_classes($classes, $item, $args) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'text-[#D7F207]'; // Tailwind class for active state
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'tuning_mania_menu_classes', 1, 3);

/**
 * SEO Optimization - Meta Tags & Schema
 * (Handled by inc/seo-enhancements.php)
 */
// tuning_mania_seo_head removed to avoid duplication with inc/seo-enhancements.php

/**
 * SEO: Custom Robots.txt Rules
 * Adds optimal directives as per SEO best practices.
 */
function tuning_mania_robots_txt( $output, $public ) {
    $rules = "
User-agent: *
Disallow: /wp-admin/
Allow: /wp-admin/admin-ajax.php
Disallow: /?s=
Disallow: /search/
Disallow: /wp-json/
Allow: /wp-content/uploads/

# Sitemap
Sitemap: " . home_url('/sitemap_index.xml') . "
Sitemap: " . home_url('/ctr_sitemap.xml') . "
";
    return $output . $rules;
}
add_filter( 'robots_txt', 'tuning_mania_robots_txt', 10, 2 );

/**
 * SEO: Breadcrumbs Function
 * Generates semantic breadcrumbs for better indexing and UX.
 */
function tm_breadcrumbs() {
    // Settings
    $separator          = '<svg class="w-4 h-4 text-gray-500 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'flex items-center text-sm text-gray-400 py-4 container mx-auto px-4';
    $home_title         = 'Home';

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( !is_front_page() ) {

        echo '<nav id="' . $breadcrums_id . '" class="' . $breadcrums_class . '" aria-label="Breadcrumb">';
        echo '<ol class="flex items-center flex-wrap" itemscope itemtype="http://schema.org/BreadcrumbList">';

        // Home
        echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
        echo '<a class="hover:text-[#D7F207] transition-colors" href="' . get_home_url() . '" title="' . $home_title . '" itemprop="item"><span itemprop="name">' . $home_title . '</span></a>';
        echo '<meta itemprop="position" content="1" />';
        echo '</li>';
        echo $separator;

        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
            echo '<span class="text-white font-bold" itemprop="name">' . post_type_archive_title('', false) . '</span>';
            echo '<meta itemprop="position" content="2" />';
            echo '</li>';
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
            // Check if we keep this for custom taxonomies
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
                echo '<a class="hover:text-[#D7F207] transition-colors" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '" itemprop="item"><span itemprop="name">' . $post_type_object->labels->name . '</span></a>';
                echo '<meta itemprop="position" content="2" />';
                echo '</li>';
                echo $separator;
            }

            $custom_tax_name = get_queried_object()->name;
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
            echo '<span class="text-white font-bold" itemprop="name">' . $custom_tax_name . '</span>';
            echo '<meta itemprop="position" content="3" />';
            echo '</li>';

        } else if ( is_single() ) {
            $post_type = get_post_type();
            if($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
                echo '<a class="hover:text-[#D7F207] transition-colors" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '" itemprop="item"><span itemprop="name">' . $post_type_object->labels->name . '</span></a>';
                echo '<meta itemprop="position" content="2" />';
                echo '</li>';
                echo $separator;
            }
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
            echo '<span class="text-white font-bold" itemprop="name">' . get_the_title() . '</span>';
            echo '<meta itemprop="position" content="3" />';
            echo '</li>';
        } else if ( is_category() ) {
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
            echo '<span class="text-white font-bold" itemprop="name">' . single_cat_title('', false) . '</span>';
            echo '<meta itemprop="position" content="2" />';
            echo '</li>';
        } else if ( is_page() ) {
            if ( $post->post_parent ) {
                $anc = get_post_ancestors( $post->ID );
                $anc = array_reverse($anc);
                $i = 2;
                foreach ( $anc as $ancestor ) {
                    echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
                    echo '<a class="hover:text-[#D7F207] transition-colors" href="' . get_permalink( $ancestor ) . '" title="' . get_the_title( $ancestor ) . '" itemprop="item"><span itemprop="name">' . get_the_title( $ancestor ) . '</span></a>';
                    echo '<meta itemprop="position" content="' . $i . '" />';
                    echo '</li>';
                    echo $separator;
                    $i++;
                }
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
                echo '<span class="text-white font-bold" itemprop="name">' . get_the_title() . '</span>';
                echo '<meta itemprop="position" content="' . $i . '" />';
                echo '</li>';
            } else {
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
                echo '<span class="text-white font-bold" itemprop="name">' . get_the_title() . '</span>';
                echo '<meta itemprop="position" content="2" />';
                echo '</li>';
            }
        }
        echo '</ol>';
        echo '</nav>';
    }
}

/**
 * SEO: FAQ Schema for Homepage
 * Adds structured data for the FAQ section on the front page.
 */
function tuning_mania_faq_schema() {
    if ( is_front_page() ) {
        $faq_data = [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => [
                [
                    "@type" => "Question",
                    "name" => "What is ECU chiptuning?",
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => "ECU chiptuning is the process of modifying the software in your vehicle's Engine Control Unit to optimize performance. This can increase horsepower, torque, and fuel efficiency while maintaining reliability."
                    ]
                ],
                [
                    "@type" => "Question",
                    "name" => "Is Stage 1 tuning safe for my car?",
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => "Yes, Stage 1 tuning is designed to be completely safe for your engine. Our tunes work within your engine's factory tolerances and are extensively dyno-tested."
                    ]
                ],
                [
                    "@type" => "Question",
                    "name" => "How much power can I gain from chiptuning?",
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => "Power gains depend on your vehicle. Stage 1 typically offers 15-30% more power, while Stage 2 can offer 25-40% gains."
                    ]
                ],
                [
                    "@type" => "Question",
                    "name" => "How long does the tuning process take?",
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => "Once you upload your original ECU file, we typically deliver your custom tune within 1-2 hours. The flashing process varies but is usually under 30 minutes."
                    ]
                ],
                [
                    "@type" => "Question",
                    "name" => "Do you support all car brands?",
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => "We support all major manufacturers including BMW, Mercedes, Audi, VW, and many more, covering cars, bikes, trucks, and tractors."
                    ]
                ]
            ]
        ];

        echo '<script type="application/ld+json">' . json_encode($faq_data) . '</script>' . "\n";
    }
}
add_action('wp_head', 'tuning_mania_faq_schema', 5);

/**
 * Auto-create required pages upon theme activation.
 * This ensures the theme works out-of-the-box on new installations.
 */
function tuning_mania_auto_setup_pages() {
    // Standard Pages
    $pages_to_create = array(
        'vehicle-search' => array(
            'title'    => 'Vehicle Search',
            'template' => 'page-templates/vehicle-search.php'
        ),
        'brands-catalog' => array(
            'title'    => 'Brands Catalog',
            'template' => 'page-templates/brands-catalog.php'
        ),
        'fileservice' => array(
            'title'    => 'Fileservice',
            'template' => 'page-fileservice.php'
        ),
        'contact' => array(
            'title'    => 'Contact Us',
            'template' => 'page.php',
            'content'  => '<!-- Contact Form Placeholder -->'
        ),
        'sitemap' => array(
            'title'    => 'Sitemap',
            'template' => 'page-templates/html-sitemap.php'
        )
    );

    // 1. Handle Standard Pages
    foreach ($pages_to_create as $slug => $page_data) {
        $existing_page = get_page_by_path($slug);

        if (!$existing_page) {
            $page_id = wp_insert_post(array(
                'post_title'    => $page_data['title'],
                'post_name'     => $slug,
                'post_content'  => isset($page_data['content']) ? $page_data['content'] : '',
                'post_status'   => 'publish',
                'post_type'     => 'page'
            ));

            if ($page_id && !is_wp_error($page_id)) {
                if (isset($page_data['template'])) {
                    update_post_meta($page_id, '_wp_page_template', $page_data['template']);
                }
            }
        } else {
            // Update template if page exists but has wrong template
            if (isset($page_data['template'])) {
                $current_template = get_post_meta($existing_page->ID, '_wp_page_template', true);
                if ($current_template != $page_data['template']) {
                    update_post_meta($existing_page->ID, '_wp_page_template', $page_data['template']);
                }
            }
        }
    }

    // 2. Handle Dynamic Plugin Start URL (e.g. 'tuner-files-lab')
    $ctr_start_url = get_option('ctr_start_url', 'chip-tuning'); // Default to 'chip-tuning' if not set
    if ( $ctr_start_url ) {
        $start_page = get_page_by_path( $ctr_start_url );
        if ( ! $start_page ) {
            // Prettify title (e.g., 'tuner-files-lab' -> 'Tuner Files Lab')
            $page_title = ucwords( str_replace( '-', ' ', $ctr_start_url ) );

            wp_insert_post( array(
                'post_title'    => $page_title,
                'post_name'     => $ctr_start_url,
                'post_content'  => '[ctr_show_selector type="cars"]', // Safe default content
                'post_status'   => 'publish',
                'post_type'     => 'page'
            ) );
        }
    }

    // 3. Setup WooCommerce Shop Page
    $shop_slug = 'boutique';
    $shop_page = get_page_by_path($shop_slug);

    if (!$shop_page) {
        $shop_id = wp_insert_post(array(
            'post_title'    => 'Shop',
            'post_name'     => $shop_slug,
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_content'  => '' // WooCommerce auto-fills
        ));
    } else {
        $shop_id = $shop_page->ID;
    }

    // Force WooCommerce to use this page
    if ($shop_id && !is_wp_error($shop_id)) {
        update_option('woocommerce_shop_page_id', $shop_id);
    }

    // Flush rewrite rules to ensure new page permalinks work
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'tuning_mania_auto_setup_pages');

/**
 * FORCE CTR PLUGIN TO USE THEME TEMPLATES
 * This hooks into the plugin's template loader to ensure it looks in the theme folder first.
 */
function tuning_mania_force_ctr_templates( $template, $template_name, $template_path ) {
    // Check if the template exists in our theme's 'chiptuningreseller' folder
    $theme_template = locate_template( array( 'chiptuningreseller/' . $template_name ) );

    if ( $theme_template ) {
        return $theme_template;
    }

    return $template;
}

// Force Template Override for Plugin Pages
add_filter( 'template_include', function( $template ) {
    // Force Contact Page Template
    if ( is_page('contact') || is_page('contact-us') ) {
        $contact_template = locate_template( array( 'page-templates/contact-page.php' ) );
        if ( '' != $contact_template ) {
            return $contact_template;
        }
    }

    // Existing Plugin Override Logic
    if ( is_page('brands-catalog') ) {
        $new_template = locate_template( array( 'page-templates/brands-catalog.php' ) );
        if ( '' != $new_template ) {
            return $new_template;
        }
    }
    return $template;
});
// Hook into common filters used by plugins (adjust if CTR uses a specific one)
add_filter( 'ctr_locate_template', 'tuning_mania_force_ctr_templates', 20, 3 );
add_filter( 'wc_get_template', 'tuning_mania_force_ctr_templates', 20, 3 ); // Just in case it uses WC logic

// Debugging: Log template loading (Remove in production)
/*
add_filter( 'template_include', function( $template ) {
    error_log( 'Loading Template: ' . $template );
    return $template;
});
*/

/**
 * PERFORMANCE OPTIMIZATIONS (2025)
 * Target: Mobile Score 90+
 */

/**
 * 2. Preload LCP Image (Hero Background)
 * This tells the browser to fetch the main image immediately.
 */
function tuning_mania_preload_lcp() {
    if ( is_front_page() ) {
        // Preload the responsive Hero Image using imagesrcset
        // This matches the background CSS image in front-page.php (Layer 4) if strictly needed,
        // BUT for Mobile LCP, it's usually the Static Fallback Image we just added.

        // Preload the fallback WebP for Mobile
        echo '<link rel="preload" as="image"
              href="' . get_template_directory_uri() . '/assets/img/hero-supercar.webp"
              media="(max-width: 767px)"
              fetchpriority="high">';

        // Preload Desktop Background (Unsplash) - Lower priority on mobile
        echo '<link rel="preload" as="image"
              imagesrcset="https://images.unsplash.com/photo-1617788138017-80ad40651399?fm=webp&q=60&w=480&auto=format&fit=crop 480w,
                           https://images.unsplash.com/photo-1617788138017-80ad40651399?fm=webp&q=70&w=768&auto=format&fit=crop 768w,
                           https://images.unsplash.com/photo-1617788138017-80ad40651399?fm=webp&q=75&w=1920&auto=format&fit=crop 1920w"
              imagesizes="(max-width: 600px) 480px, (max-width: 900px) 768px, 100vw"
              media="(min-width: 768px)"
              fetchpriority="high">';
    }
}
add_action( 'wp_head', 'tuning_mania_preload_lcp', 1 );

/**
 * 3. Remove Unused CSS/JS (Cleanup)
 * Dequeues assets not needed on the homepage.
 */
function tuning_mania_remove_unused_assets() {
    if ( is_front_page() ) {
        // Remove Gutenberg Block Library CSS (if not using blocks)
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-blocks-style' ); // WooCommerce Blocks

        // Dequeue WooCommerce Styles (Non-Critical on Homepage)
        wp_dequeue_style( 'woocommerce-general' );
        wp_dequeue_style( 'woocommerce-layout' );
        wp_dequeue_style( 'woocommerce-smallscreen' );
        wp_dequeue_style( 'woocommerce_frontend_styles' );
        wp_dequeue_style( 'woocommerce_fancybox_styles' );
        wp_dequeue_style( 'woocommerce_chosen_styles' );
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

        // Remove Emoji Script (saves ~5KB)
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
    }
}
add_action( 'wp_enqueue_scripts', 'tuning_mania_remove_unused_assets', 100 );

/**
 * Fix cURL error 28: Operation timed out.
 * Increases the default HTTP request timeout to 120 seconds and disables SSL verification for local dev.
 */
function tuning_mania_http_request_args( $args ) {
    $args['timeout'] = 120;
    $args['sslverify'] = false; // Fix for XAMPP local SSL issues
    return $args;
}
add_filter( 'http_request_args', 'tuning_mania_http_request_args', 100, 1 );

// ============================================================
// TUNERFILESLAB - GOOGLE GEMINI AI CHATBOT INTEGRATION
// ============================================================

// CONFIGURATION - Gemini API Configuration
// Define GEMINI_API_KEY in wp-config.php for security
if (!defined('GEMINI_API_KEY')) {
    define('GEMINI_API_KEY', ''); // Placeholder - Set in wp-config.php
}
define('GEMINI_MODEL', 'gemini-flash-latest'); // Best available model for Free Tier
define('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/' . GEMINI_MODEL . ':generateContent');

// Register AJAX Endpoints (for logged-in and non-logged-in users)
add_action('wp_ajax_tunerfiles_gemini_chat', 'tunerfiles_handle_gemini_chat');
add_action('wp_ajax_nopriv_tunerfiles_gemini_chat', 'tunerfiles_handle_gemini_chat');

/**
 * Main handler for Gemini API chat requests
 */
function tunerfiles_handle_gemini_chat() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'tunerfiles_chatbot_nonce')) {
        wp_send_json_error(['message' => 'Security check failed.'], 403);
    }

    $user_message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

    if (empty($user_message)) {
        wp_send_json_error(['message' => 'Message cannot be empty.'], 400);
    }

    $history = isset($_POST['history']) ? json_decode(stripslashes($_POST['history']), true) : [];
    if (!is_array($history)) { $history = []; }

    $response = tunerfiles_call_gemini_api($user_message, $history);

    if (is_wp_error($response)) {
        wp_send_json_error(['message' => $response->get_error_message()], 500);
    }

    wp_send_json_success(['reply' => $response]);
}

/**
 * Call Google Gemini API (Standard Payload)
 */
function tunerfiles_call_gemini_api($user_message, $history = []) {

    // Load URL Database
    $url_db_path = get_template_directory() . '/gemini_urls.json';
    $url_context = "No URLs available.";

    if (file_exists($url_db_path)) {
        $url_data = file_get_contents($url_db_path);
        // Limit context size if necessary to avoid token limits
        if ($url_data !== false) {
            $url_context = substr($url_data, 0, 30000);
        }
    }

    // SYSTEM INSTRUCTION
    $system_instruction = <<<EOD
### SYSTEM INSTRUCTIONS: TunerFilesLab - Elite Performance Consultant & Lead Converter

**ROLE:**
You are the **Lead Performance Consultant** for **TunerFilesLab**. You are not just a support bot; you are a **high-end automotive expert and persuasive marketer**. Your primary goal is to **convert visitors into customers** by making them crave the performance upgrades we offer. You speak directly to the driver's desire for speed, power, and efficiency.

**YOUR VIBE:**
*   **Professional & Authoritative:** You know engines inside out.
*   **Energetic & Persuasive:** You use powerful words (Unlock, Unleash, Transform, Optimize).
*   **Exclusive:** You make the customer feel they are joining an elite club of tuned vehicles.
*   **Helpful:** You guide them seamlessly to the solution.
*   **Languages:** English, French, Darija, Arabic, Spanish (Adapt naturally to the user).

**YOUR CORE MISSION:**
1.  **QUALIFY:** Immediately identify the user's vehicle (Make, Model, Engine, Fuel) if not stated.
2.  **SELL THE TRANSFORMATION (Marketing Hooks):**
    *   *Don't just sell software; sell the FEELING.*
    *   "Imagine passing effortlessly on the highway."
    *   "Feel the instant throttle response you've been missing."
    *   "Unlock the hidden horsepower the factory held back."
3.  **OVERCOME OBJECTIONS:**
    *   *Safety:* "Our Stage 1 files are engineered within safe manufacturer tolerances. 100% Dyno-tested reliability."
    *   *Fuel:* "Get more power AND better fuel economy with our optimized mapping."
    *   *Warranty:* "Our software is undetectable in most standard diagnostics." (Use caution, be honest but reassuring).
4.  **CLOSE THE DEAL (Call to Action):** Always guide them to click a link to view their specific gains or contact us.

**KNOWLEDGE BASE (Sales Focused):**
*   **Stage 1 (The Best Seller):** Safe, reliable, instant power boost, better MPG. Perfect for daily drivers. **" The smartest upgrade you can make."**
*   **Stage 2:** For enthusiasts with hardware mods (Exhaust/Intake). Aggressive sound, max flow.
    *   **E85 FlexFuel:** "Run cheaper, cleaner, and powerful fuel."
    *   **Options:** Pop & Bangs (The soundtrack of power), AdBlue/DPF/EGR Solutions (Efficiency).

**STRICT RULES FOR FOCUS:**
*   **STAY ON TRACK:** If the user asks about unrelated topics (weather, politics, cooking), politely pivot back to cars. *Ex: "I'm not sure about that, but I can tell you how to get +40HP on your Golf. Interested?"*
*   **BE CONCISE:** Short, punchy paragraphs. No walls of text.
    *   **USE EMOJIS:** Use 🏎️, 🔥, 💨, 🚀, 🛠️ to keep it visual and engaging.

**DYNAMIC RESPONSE STRATEGY:**
*   **If URL Found in Context:** "🔥 **Great news!** We have a custom tune ready for your **[Car Model]**. Check out the massive gains here: [Insert Link] 🚀"
*   **If URL Not Found:** "We absolutely tune the **[Brand]** [Model]! The specific page isn't just here, but I can confirm we have a Stage 1 solution waiting for you. 🏎️ **Browse our full catalog here:** https://tunerfileslab.com/"

### DATA CONTEXT (VALID URLs):
{$url_context}
EOD;

    $contents = [];

    // History
    $history = array_slice($history, -10);
    foreach ($history as $msg) {
        if (isset($msg['role']) && isset($msg['text'])) {
            $contents[] = [
                'role' => $msg['role'] === 'user' ? 'user' : 'model',
                'parts' => [['text' => sanitize_textarea_field($msg['text'])]]
            ];
        }
    }

    // Current message
    $contents[] = [
        'role' => 'user',
        'parts' => [['text' => $user_message]]
    ];

    // STANDARD PAYLOAD (Cleaned for compatibility)
    $payload = [
        'system_instruction' => [
            'parts' => [['text' => $system_instruction]]
        ],
        'contents' => $contents,
        'generationConfig' => [
            'temperature' => 0.7,
            'maxOutputTokens' => 1024,
        ],
        'safetySettings' => [
            ['category' => 'HARM_CATEGORY_HARASSMENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
            ['category' => 'HARM_CATEGORY_HATE_SPEECH', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
            ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
            ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
        ]
    ];

    $api_url = GEMINI_API_URL . '?key=' . GEMINI_API_KEY;

    $response = wp_remote_post($api_url, [
        'timeout' => 60,
        'sslverify' => false,
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode($payload),
    ]);

    if (is_wp_error($response)) {
        error_log('Gemini API Error: ' . $response->get_error_message());
        return new WP_Error('api_error', 'Connection Error: ' . $response->get_error_message());
    }

    $response_code = wp_remote_retrieve_response_code($response);
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if ($response_code !== 200) {
        $error_message = isset($data['error']['message']) ? $data['error']['message'] : 'Unknown API Error';
        error_log('Gemini API Error (' . $response_code . '): ' . $error_message);
        return new WP_Error('api_error', 'Google API Error (' . $response_code . '): ' . $error_message);
    }

    if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
        return $data['candidates'][0]['content']['parts'][0]['text'];
    }

    return new WP_Error('api_error', 'Unexpected response format.');
}

/**
 * Enqueue chatbot data for frontend JavaScript
 */
add_action('wp_enqueue_scripts', 'tunerfiles_enqueue_chatbot_data');
function tunerfiles_enqueue_chatbot_data() {
    wp_localize_script('jquery', 'tunerfilesChatbot', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('tunerfiles_chatbot_nonce'),
    ]);
}

/**
 * GENERATE DYNAMIC MARKETING TITLES (SEO HOOKS)
 * Returns an array [ 'title', 'subtitle' ] based on context.
 */
function tm_get_dynamic_title($context, $name = '', $type = 'cars') {
    $name = esc_html($name);

    // 0. Handle Global Contexts (Homepage, Contact)
    if ($context === 'homepage') {
        $headers = [
            "World's Leading <span style='color:#ccff00'>Tuning Files</span> Service",
            "Premium <span style='color:#ccff00'>Chip Tuning</span> for All Vehicles",
            "Unlock Your Vehicle's <span style='color:#00ff66'>True Potential</span>",
            "Your Trusted Partner for <span style='color:#ccff00'>Performance</span>"
        ];
        // Use generic subtitles
    } elseif ($context === 'contact') {
        $headers = [
            "Get in Touch with <span style='color:#ccff00'>Tuning Mania</span>",
            "Expert <span style='color:#00ff66'>Support</span> 24/7",
            "Need Help? We Are Here <span style='color:#ccff00'>For You</span>"
        ];
        $specific_subtitles = [
            "We reply within 1 hour during business days",
            "Professional support for all your tuning needs",
            "Send us a message and let's boost your ride"
        ];
    }

    if (!isset($headers)) {
        // 1. Define Hook Banks based on Vehicle Type
        $hooks = [
            'cars' => [
                'brand' => [
                    "Unlock Hidden Power in Your <span style='color:#ccff00'>$name</span>",
                    "Upgrade Your <span style='color:#ccff00'>$name</span> Performance",
                    "The Best Tuning Files for <span style='color:#ccff00'>$name</span>",
                    "Transcend Stock Limits: <span style='color:#ccff00'>$name</span>"
                ],
                'model' => [
                    "Transform Your <span style='color:#ccff00'>$name</span>",
                    "Unleash Your <span style='color:#ccff00'>$name</span>'s Potential",
                    "Make Your <span style='color:#ccff00'>$name</span> Faster",
                    "Premium Maps for <span style='color:#ccff00'>$name</span>"
                ],
                'engine' => [
                    "Maximize Torque for <span style='color:#00ff66'>$name</span>",
                    "Optimize Your <span style='color:#00ff66'>$name</span> Engine",
                    "Reliable Power for <span style='color:#00ff66'>$name</span>",
                    "Dyno-Tested Files: <span style='color:#00ff66'>$name</span>"
                ],
                'stage' => [
                    "Stage 1, 2, 3 for <span style='color:#ccff00'>$name</span>",
                    "Safely Tune Your <span style='color:#ccff00'>$name</span>",
                    "Experience Real Power: <span style='color:#ccff00'>$name</span>",
                    "Download Custom Map for <span style='color:#ccff00'>$name</span>"
                ]
            ],
            'bikes' => [
                'brand' => [
                    "Ride Faster. Tune Your <span style='color:#ccff00'>$name</span>",
                    "Push Your <span style='color:#ccff00'>$name</span> to the Limit",
                    "Ultimate Performance for <span style='color:#ccff00'>$name</span>"
                ],
                'model' => [
                    "Unlock Your <span style='color:#ccff00'>$name</span> Beast",
                    "Smoother Ride for <span style='color:#ccff00'>$name</span>",
                    "Race-Ready Maps for <span style='color:#ccff00'>$name</span>"
                ],
                'engine' => [
                    "Rev Higher: <span style='color:#00ff66'>$name</span> Tuning",
                    "Better Throttle Response: <span style='color:#00ff66'>$name</span>"
                ],
                'stage' => [
                    "Track-Tested Tunes for <span style='color:#ccff00'>$name</span>",
                    "More HP for Your <span style='color:#ccff00'>$name</span>"
                ]
            ],
            'trucks' => [
                'brand' => [
                    "Save Fuel with <span style='color:#ccff00'>$name</span> Tuning",
                    "Optimize Your Fleet: <span style='color:#ccff00'>$name</span>"
                ],
                'model' => [
                    "More Torque, Less Fuel: <span style='color:#ccff00'>$name</span>",
                    "Heavy Duty Tuning for <span style='color:#ccff00'>$name</span>"
                ],
                'engine' => [
                    "Efficiency Upgrade: <span style='color:#00ff66'>$name</span>",
                    "Eco-Tuning for <span style='color:#00ff66'>$name</span>"
                ],
                'stage' => [
                    "AdBlue/DPF Solutions for <span style='color:#ccff00'>$name</span>",
                    "Work Harder, Burn Less: <span style='color:#ccff00'>$name</span>"
                ]
            ],
            'tractors' => [
                'brand' => [
                    "Boost Your <span style='color:#ccff00'>$name</span> Productivity",
                    "Reliable Agrictultural Tuning: <span style='color:#ccff00'>$name</span>"
                ],
                'model' => [
                    "Power Your Harvest: <span style='color:#ccff00'>$name</span>",
                    "Get More Done with <span style='color:#ccff00'>$name</span>"
                ],
                'engine' => [
                    "Maximum Torque for <span style='color:#00ff66'>$name</span>",
                    "Field-Tested Maps: <span style='color:#00ff66'>$name</span>"
                ],
                'stage' => [
                    "EGR/DPF Delete Options for <span style='color:#ccff00'>$name</span>",
                    "Upgrade Your <span style='color:#ccff00'>$name</span> Workhorse"
                ]
            ]
        ];

        // Fallback if specific type not found
        $type_hooks = isset($hooks[$type]) ? $hooks[$type] : $hooks['cars'];

        // Get array of headers for this context (brand/model/engine/stage)
        $headers = isset($type_hooks[$context]) ? $type_hooks[$context] : ["Select <span style='color:#ccff00'>$name</span>"];
    }

    // Pick a random header
    $title = $headers[array_rand($headers)];

    // 2. Define Subtitles
    if (isset($specific_subtitles)) {
        $subtitles = $specific_subtitles;
    } else {
        $subtitles = [
            "Instant Download | Dyno-Tested | 100% Safe",
            "Join 10,000+ Happy Customers Today",
            "Stage 1 • Vmax Off • Pops & Bangs Available",
            "Professional ECU Remapping Service",
            "Unlock the True Potential of Your Engine",
            "File Service Available 24/7"
        ];
    }
    $subtitle = $subtitles[array_rand($subtitles)];

    return ['title' => $title, 'subtitle' => $subtitle];
}
// ============================================================
// END GEMINI CHATBOT BACKEND
// ============================================================


/**
 * Custom Nav Walker for Footer Menu
 * Applies Tailwind CSS classes to the menu items.
 */
class Tuning_Mania_Footer_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        /**
         * Filters the CSS class(es) applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.4.0 The `$depth` parameter was added.
         *
         * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param WP_Post  $item    The current menu item.
         * @param stdClass $args    An object of `wp_nav_menu()` arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        /**
         * Filters the ID applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.4.0 The `$depth` parameter was added.
         *
         * @param string   $item_id The ID that is applied to the menu item's `<li>` element.
         * @param WP_Post  $item    The current menu item.
         * @param stdClass $args    An object of `wp_nav_menu()` arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target)     ? $item->target     : '';
        if ('_blank' === $item->target && empty($item->xfn)) {
            $atts['rel'] = 'noopener noreferrer';
        } else {
            $atts['rel'] = !empty($item->xfn)        ? $item->xfn        : '';
        }
        $atts['href']   = !empty($item->url)        ? $item->url        : '';
        $atts['aria-current'] = $item->current ? 'page' : '';

        // Add Tailwind classes
        $atts['class'] = 'text-gray-400 hover:text-[#ccff00] transition-colors text-sm';

        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.4.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, an array of key/value pairs.
         *
         *     @type string $title        Title attribute.
         *     @type string $target       Target attribute.
         *     @type string $rel          The rel attribute.
         *     @type string $href         The href attribute.
         *     @type string $aria_current The aria-current attribute.
         * }
         * @param WP_Post  $item  The current menu item.
         * @param stdClass $args  An object of `wp_nav_menu()` arguments.
         * @param int      $depth Depth of menu item.
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters('the_title', $item->title, $item->ID);

        /**
         * Filters a menu item's title.
         *
         * @since 4.4.0 The `$depth` parameter was added.
         *
         * @param string   $title The menu item's title.
         * @param WP_Post  $item  The current menu item.
         * @param stdClass $args  An object of `wp_nav_menu()` arguments.
         * @param int      $depth Depth of menu item.
         */
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Global Helper: Smart Vehicle Icon Detection
 * Handles mixed lists (Yamaha Bikes/Boats) and Truck/Tractor detection.
 * ORDER: Context > Keywords > Strict Brands > Mixed Defaults > Fallback
 *
 * @param string $name Item name (Series/Model/Engine)
 * @param string $brand_name Brand Name
 * @param string $default_type Slug from URL (cars, bikes, etc.)
 * @return string Full URL to the icon
 */
function tm_get_vehicle_icon_url($name, $brand_name = '', $default_type = 'cars') {
    $name = strtoupper(trim($name));
    $b_name = strtoupper(trim($brand_name));
    $d_type = strtolower(trim($default_type)); // Trim whitespace on type

    // Define Icon Paths
    $icon_path = get_template_directory_uri() . '/assets/img/';

    // --- 1. CONTEXT-AWARE CHECK (HIGHEST PRIORITY if Explicit) ---
    // Matches explicit URL slugs or Labels (e.g. "Bikes and quads")
    $context_map = [
        // Cars
        'cars'           => 'car.png',
        'voitures'       => 'car.png',
        'auto'           => 'car.png',

        // Bikes - ✅ CORRECT plugin slug: bikesquad
        'bikesquad'      => 'bike.png',     // ✅ CORRECT plugin slug
        'bikes'          => 'bike.png',     // Fallback alias
        'bikes and quads'=> 'bike.png',
        'motorbike'      => 'bike.png',
        'motorcycles'    => 'bike.png',
        'motos'          => 'bike.png',
        'motos-et-quads' => 'bike.png',
        'quads'          => 'bike.png',

        // Trucks
        'trucks'         => 'truck.png',
        'camions'        => 'truck.png',
        'poids-lourds'   => 'truck.png',
        'heavy duty'     => 'truck.png',

        // Tractors
        'tractors'       => 'tractor.png',
        'tracteurs'      => 'tractor.png',
        'agri'           => 'tractor.png',
        'agricultural'   => 'tractor.png',

        // Boats - ✅ CORRECT plugin slug: motorboats
        'motorboats'     => 'boat.png',     // ✅ CORRECT plugin slug
        'boats'          => 'boat.png',     // Fallback alias
        'marine'         => 'boat.png',
        'bateaux'        => 'boat.png',
        'bateaux-a-moteur'=> 'boat.png',

        // Jet Skis
        'jet skis'       => 'Jet skis.png',
        'jet-skis'       => 'Jet skis.png',
        'jetskis'        => 'Jet skis.png',
        'watercraft'     => 'Jet skis.png'
    ];

    if (isset($context_map[$d_type])) {
        return $icon_path . $context_map[$d_type];
    }

    // --- 2. KEYWORD DETECTION IN NAME (Specific Series/Models) ---

    // Marine
    $marine_keys = ['OUTBOARD', 'MARINE', 'YACHT', 'V-MAX', 'KAD', 'TAMD', 'IPS', 'INBOARD', 'VERADO', 'OPTIMAX', 'MERCRUISER', 'VOLVO PENTA'];
    foreach($marine_keys as $k) { if(strpos($name, $k) !== false) return $icon_path . 'boat.png'; }

    // Jet Skis
    $jet_keys = ['RXP', 'RXT', 'GTX', 'GTR', 'GTI', 'SPARK', 'WAVERUNNER', 'SUPERJET', 'FX', 'VX', 'EX', 'ULTRA', 'STX'];
    foreach($jet_keys as $k) { if(strpos($name, $k) !== false) return $icon_path . 'Jet skis.png'; }

    // Tractors / Heavy
    $tractor_keys = ['TRACTOR', 'AGRICULTURAL', 'HARVESTER', 'FORESTRY', 'COMBINE', 'FORAGE', 'SPRAYER', 'XERION', 'AXION', 'ARION', 'MAGNUM', 'STEIGER', 'QUADTRAC', 'PUMA', 'MAXXUM', 'FARMALL', 'TELEHANDLER'];
    foreach($tractor_keys as $k) { if(strpos($name, $k) !== false) return $icon_path . 'tractor.png'; }

    // --- 3. STRICT BRAND MAPPING ---
    $strict_brand_map = [
        // TRUCKS
        'DAF' => 'truck.png',
        'IVECO' => 'truck.png',
        'SCANIA' => 'truck.png',
        'RENAULT TRUCKS' => 'truck.png',
        'VOLVO TRUCKS' => 'truck.png',
        'MERCEDES TRUCKS' => 'truck.png',
        'HINO' => 'truck.png',
        'MACK' => 'truck.png',
        'PETERBILT' => 'truck.png',
        'KENWORTH' => 'truck.png',
        'FREIGHTLINER' => 'truck.png',
        'WESTERN STAR' => 'truck.png',

        // TRACTORS
        'FENDT' => 'tractor.png',
        'JOHN DEERE' => 'tractor.png',
        'CASE IH' => 'tractor.png',
        'CASE' => 'tractor.png',
        'NEW HOLLAND' => 'tractor.png',
        'MASSEY FERGUSON' => 'tractor.png',
        'CLAAS' => 'tractor.png',
        'DEUTZ-FAHR' => 'tractor.png',
        'VALTRA' => 'tractor.png',
        'JCB' => 'tractor.png',
        'BOBCAT' => 'tractor.png',
        'KOMATSU' => 'tractor.png',
        'STEYR' => 'tractor.png',
        'ZETOR' => 'tractor.png',
        'LANDINI' => 'tractor.png',
        'MC CORMICK' => 'tractor.png',
        'CHALLENGER' => 'tractor.png',
        'SAME' => 'tractor.png',
        'LINDNER' => 'tractor.png',
        'URSUS' => 'tractor.png',
        'BELARUS' => 'tractor.png',
        'YANMAR' => 'tractor.png',
        'AGCO' => 'tractor.png',
        'PONSSE' => 'tractor.png',
        'ROTTNE' => 'tractor.png',
        'ECO LOG' => 'tractor.png',
        'LOGSET' => 'tractor.png',

        // BIKES
        'DUCATI' => 'bike.png',
        'KTM' => 'bike.png',
        'HARLEY-DAVIDSON' => 'bike.png',
        'HARLEY' => 'bike.png',
        'TRIUMPH' => 'bike.png',
        'APRILIA' => 'bike.png',
        'MV AGUSTA' => 'bike.png',
        'HUSQVARNA' => 'bike.png',
        'BMW MOTORRAD' => 'bike.png',
        'PIAGGIO' => 'bike.png',
        'VESPA' => 'bike.png',
        'MOTO GUZZI' => 'bike.png',
        'ROYAL ENFIELD' => 'bike.png',
        'INDIAN' => 'bike.png',
        'CAN-AM' => 'bike.png',
        'POLARIS' => 'bike.png',
        'CF MOTO' => 'bike.png',
        'BENELLI' => 'bike.png',
        'BIMOTA' => 'bike.png',
        'GASGAS' => 'bike.png',
        'ZERO' => 'bike.png',

        // MARINE
        'MERCURY' => 'boat.png',
        'MERCRUISER' => 'boat.png',
        'VOLVO PENTA' => 'boat.png',
        'YANMAR MARINE' => 'boat.png',
        'HONDA MARINE' => 'boat.png',
        'SUZUKI MARINE' => 'boat.png',
        'YAMAHA MARINE' => 'boat.png',
        'SEVEN MARINE' => 'boat.png',
        'MAN MARINE' => 'boat.png',
        'CATERPILLAR MARINE' => 'boat.png',

        // JET SKIS
        'SEA-DOO' => 'Jet skis.png',
        'SEADOO' => 'Jet skis.png',
    ];

    if (array_key_exists($b_name, $strict_brand_map)) {
        return $icon_path . $strict_brand_map[$b_name];
    }

    // --- 4. MIXED BRAND DEFAULTS (When Context is 'cars' or unknown) ---

    // DEUTZ -> Boat (Per User Request)
    if ($b_name === 'DEUTZ') return $icon_path . 'boat.png';

    // CATERPILLAR -> Tractor (Industrial Default)
    if (strpos($b_name, 'CATERPILLAR') !== false) return $icon_path . 'tractor.png';

    // MAN -> Truck (Default)
    if ($b_name === 'MAN') return $icon_path . 'truck.png';

    // Japanese Majors -> Bikes (Default if not in Car context)
    if (strpos($b_name, 'YAMAHA') !== false) return $icon_path . 'bike.png';
    if (strpos($b_name, 'KAWASAKI') !== false) return $icon_path . 'bike.png';
    if (strpos($b_name, 'BOMBARDIER') !== false) return $icon_path . 'bike.png';

    // --- 5. FALLBACK ---
    return $icon_path . 'car.png';
}