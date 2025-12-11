<?php
/**
 * SEO Enhancements for Tuning Mania
 * Based on Backlinko's On-Page SEO Definitive Guide (2025)
 *
 * Features:
 * - Dynamic Meta Titles & Descriptions
 * - Schema.org Structured Data (JSON-LD)
 * - Open Graph & Twitter Cards
 * - Breadcrumb Schema
 * - FAQ Schema
 * - Product/Service Schema for Chiptuning
 * - LLM-friendly Content Structuring
 * - Internal Linking Helpers
 * - Performance Optimizations
 *
 * @package Tuning_Mania
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ============================================================
// 1. ENHANCED TITLE TAG OPTIMIZATION
// ============================================================

/**
 * Custom document title with SEO modifiers
 * Implements: Front-loading keywords, emotional modifiers, year
 */
function tm_seo_document_title( $title ) {
    $site_name = 'TunerFilesLab'; // Strictly as per SEO template requirements
    $current_year = date( 'Y' );

    // Homepage - Primary keyword first
    if ( is_front_page() ) {
        return "Chiptuning Files & ECU Remapping | Stage 1 & 2 | {$site_name} {$current_year}";
    }

    // Plugin CTR pages - Dynamic based on URL structure
    if ( is_page() || is_singular() ) {
        global $post;
        $url_path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
        $url_parts = explode( '/', $url_path );

        // Detect if we're on a CTR plugin page
        $ctr_start_url = get_option( 'ctr_start_url', 'chip-tuning' );

        if ( ! empty( $url_parts ) && $url_parts[0] === $ctr_start_url ) {
            // Build dynamic title based on path depth
            // Hierarchy: Root -> Brand -> Series -> Model -> Engine
            $brand  = isset( $url_parts[1] ) ? tm_seo_format_name( $url_parts[1] ) : '';
            $series = isset( $url_parts[2] ) ? tm_seo_format_name( $url_parts[2] ) : '';
            $model  = isset( $url_parts[3] ) ? tm_seo_format_name( $url_parts[3] ) : '';
            $engine = isset( $url_parts[4] ) ? tm_seo_format_name( $url_parts[4] ) : '';

            // 5. [Engine Level] (Most Important)
            if ( $engine ) {
                // "{Brand_Name} {Model_Name} {Engine_Name} Tuning File | TunerFilesLab"
                return "{$brand} {$model} {$engine} Tuning File | {$site_name}";
            }
            // 4. [Model Level]
            elseif ( $model ) {
                // "{Brand_Name} {Serie_Name} {Model_Name} Remapping"
                return "{$brand} {$series} {$model} Remapping";
            }
            // 3. [Series Level]
            elseif ( $series ) {
                // "{Brand_Name} {Serie_Name} Tuning files"
                return "{$brand} {$series} Tuning files";
            }
            // 2. [Brand Level]
            elseif ( $brand ) {
                // "{Brand_Name} Chiptuning files | TunerFilesLab"
                return "{$brand} Chiptuning files | {$site_name}";
            }
            // 1. [Vehicle Type Level] (Root)
            else {
                // "Select Vehicle Type | TunerFilesLab"
                return "Select Vehicle Type | {$site_name}";
            }
        }
    }

    // Contact page
    if ( is_page( 'contact' ) || is_page( 'contact-us' ) ) {
        return "Contact Us | 24/7 Expert Support | {$site_name}";
    }

    // Fileservice page
    if ( is_page( 'fileservice' ) ) {
        return "Fileservice | Upload & Tune Your ECU File | {$site_name}";
    }

    // Brands catalog
    if ( is_page( 'brands-catalog' ) ) {
        return "All Car Brands | Chiptuning Database {$current_year} | {$site_name}";
    }

    // Blog posts - Add modifiers
    if ( is_single() ) {
        $post_title = get_the_title();
        return "{$post_title} | Expert Guide | {$site_name}";
    }

    // Category/Archive
    if ( is_category() || is_tag() || is_archive() ) {
        $archive_title = get_the_archive_title();
        return "{$archive_title} | {$site_name}";
    }

    // Search results
    if ( is_search() ) {
        $search_query = get_search_query();
        return "Search: {$search_query} | {$site_name}";
    }

    // 404
    if ( is_404() ) {
        return "Page Not Found | {$site_name}";
    }

    return $title;
}
add_filter( 'pre_get_document_title', 'tm_seo_document_title', 100 );

/**
 * Format URL slugs into readable names
 * Enhanced to handle uppercase acronyms
 */
function tm_seo_format_name( $slug ) {
    $slug = str_replace( [ '-', '_' ], ' ', $slug );
    $name = ucwords( $slug );

    // Force uppercase for common technical terms
    $uppercase_terms = [
        'Tdi', 'Tsi', 'Tfsi', 'Hdi', 'Cdti', 'Crdi', 'Dci', 'Cdi', 'Jtd', 'Tdci',
        'Gti', 'Gtd', 'Gte', 'Rs', 'Amg', 'Mp', 'Mpower', 'Wrx', 'Sti', 'Vtec',
        'Bmw', 'Vw', 'Gmc', 'Ram', 'Ltv', 'Suv', 'Ecu', 'Dsg', 'Pdk', 'Hp', 'Nm',
        'Dpf', 'Egr', 'Scr', 'Adblue'
    ];

    foreach ( $uppercase_terms as $term ) {
        // Word boundary check to avoid replacing inside other words
        $pattern = '/\b' . preg_quote( $term, '/' ) . '\b/';
        $name = preg_replace_callback( $pattern, function($matches) {
            return strtoupper( $matches[0] );
        }, $name );
    }

    // Special fix for "V6", "V8" etc. (regex for V followed by digit)
    $name = preg_replace( '/\bV([0-9]+)\b/i', 'V$1', $name );

    return $name;
}

// ============================================================
// 2. ENHANCED META DESCRIPTIONS
// ============================================================

/**
 * Generate dynamic, keyword-rich meta descriptions
 * Max 155 characters, includes CTA
 */
function tm_seo_meta_description() {
    $desc = '';
    $current_year = date( 'Y' );

    if ( is_front_page() ) {
        $desc = "Premium chiptuning files for all vehicle brands. Stage 1, 2 & 3 ECU remapping. Dyno-tested, safe & reliable. 24/7 support. Get +30% power today!";
    } elseif ( is_page( 'contact' ) || is_page( 'contact-us' ) ) {
        $desc = "Need help with your ECU tuning? Contact TunerFilesLab 24/7. Expert support for chiptuning, Stage files, DPF/EGR solutions. Fast response guaranteed!";
    } elseif ( is_page( 'fileservice' ) ) {
        $desc = "Upload your ECU file and get a custom tune in hours. Professional chiptuning service. Stage 1, Stage 2, Pop & Bangs, Vmax Off. Order now!";
    } elseif ( is_page( 'brands-catalog' ) ) {
        $desc = "Browse all supported car brands for chiptuning. BMW, Mercedes, Audi, VW, Ford & more. Find your vehicle and unlock hidden power today. {$current_year} database.";
    } else {
        // Dynamic for CTR pages
        $url_path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
        $url_parts = explode( '/', $url_path );
        $ctr_start_url = get_option( 'ctr_start_url', 'chip-tuning' );

        if ( ! empty( $url_parts ) && isset( $url_parts[0] ) && $url_parts[0] === $ctr_start_url ) {
            $brand  = isset( $url_parts[1] ) ? tm_seo_format_name( $url_parts[1] ) : '';
            $series = isset( $url_parts[2] ) ? tm_seo_format_name( $url_parts[2] ) : '';
            $model  = isset( $url_parts[3] ) ? tm_seo_format_name( $url_parts[3] ) : '';
            $engine = isset( $url_parts[4] ) ? tm_seo_format_name( $url_parts[4] ) : '';

            if ( $engine ) {
                $desc = "Professional chiptuning for {$brand} {$model} {$engine}. Up to +35% HP & +40% Torque. Safe Stage 1 & 2 files. Download your custom tune now!";
            } elseif ( $model ) {
                $desc = "{$brand} {$series} {$model} ECU tuning files. All engines supported. Stage 1, Stage 2, Pop & Bangs. Unlock hidden power - professional remapping {$current_year}.";
            } elseif ( $series ) {
                 $desc = "Tuning files for {$brand} {$series}. Select your model to view gains. Stage 1, Stage 2, and custom remapping solutions available.";
            } elseif ( $brand ) {
                $desc = "{$brand} chiptuning catalogue. All models & engines. Stage 1-3 files, DPF/EGR off, AdBlue delete. Professional ECU remapping service.";
            } else {
                $desc = "Complete chiptuning database. All brands, all models. Find your vehicle and get a custom ECU tune. Professional Stage files available 24/7.";
            }
        } else {
            // Default fallback
            $desc = "TunerFilesLab - Professional ECU chiptuning files. Stage 1, Stage 2, performance upgrades for all vehicles. Safe, tested, reliable. Order now!";
        }
    }

    return esc_attr( substr( $desc, 0, 155 ) );
}

// ============================================================
// 3. ADVANCED SCHEMA MARKUP (JSON-LD)
// ============================================================

/**
 * Output comprehensive Schema.org markup
 * Includes: Organization, LocalBusiness, WebSite, Product, BreadcrumbList, FAQPage
 */
function tm_seo_schema_output() {
    $schemas = [];
    $site_url = home_url( '/' );
    $site_name = 'TunerFilesLab';
    $logo_url = get_theme_mod( 'custom_logo' ) ? wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' ) : get_template_directory_uri() . '/assets/img/logo.png';

    // 1. Organization Schema (Always)
    $schemas[] = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        '@id' => $site_url . '#organization',
        'name' => $site_name,
        'url' => $site_url,
        'logo' => [
            '@type' => 'ImageObject',
            'url' => $logo_url,
            'width' => 400,
            'height' => 100
        ],
        'description' => 'Professional ECU chiptuning and remapping service. Premium tuning files for cars, bikes, trucks and tractors.',
        'founder' => [
            '@type' => 'Person',
            'name' => 'TunerFilesLab Team'
        ],
        'foundingDate' => '2020',
        'sameAs' => [
            'https://www.facebook.com/tunerfileslab',
            'https://www.instagram.com/tunerfileslab',
            'https://twitter.com/tunerfileslab'
        ],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'contactType' => 'customer support',
            'email' => 'support@tunerfileslab.com',
            'availableLanguage' => [ 'English' ],
            'hoursAvailable' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ],
                'opens' => '00:00',
                'closes' => '23:59'
            ]
        ]
    ];

    // 2. WebSite Schema with SearchAction (For Sitelinks Search Box)
    $schemas[] = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => $site_url . '#website',
        'name' => $site_name,
        'url' => $site_url,
        'description' => tm_seo_meta_description(),
        'publisher' => [
            '@id' => $site_url . '#organization'
        ],
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => $site_url . '?s={search_term_string}'
            ],
            'query-input' => 'required name=search_term_string'
        ],
        'inLanguage' => 'en-US'
    ];

    // 3. LocalBusiness Schema (For Local SEO)
    $schemas[] = [
        '@context' => 'https://schema.org',
        '@type' => 'AutoRepair',
        '@id' => $site_url . '#localbusiness',
        'name' => $site_name,
        'image' => $logo_url,
        'url' => $site_url,
        'telephone' => '+1-XXX-XXX-XXXX', // Update with real number
        'priceRange' => '$$',
        'description' => 'Professional ECU chiptuning service. Stage 1, Stage 2, performance tuning files for all vehicle brands.',
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ],
            'opens' => '00:00',
            'closes' => '23:59'
        ],
        'areaServed' => [
            '@type' => 'Place',
            'name' => 'Worldwide'
        ],
        'serviceType' => [
            'ECU Chiptuning',
            'Engine Remapping',
            'Stage 1 Tuning',
            'Stage 2 Tuning',
            'DPF Delete',
            'EGR Off',
            'AdBlue Delete'
        ]
    ];

    // 4. BreadcrumbList Schema (Dynamic)
    $breadcrumbs = tm_seo_get_breadcrumbs();
    if ( ! empty( $breadcrumbs ) && count( $breadcrumbs ) > 1 ) {
        $breadcrumb_items = [];
        $position = 1;
        foreach ( $breadcrumbs as $crumb ) {
            $breadcrumb_items[] = [
                '@type' => 'ListItem',
                'position' => $position,
                'name' => $crumb['name'],
                'item' => $crumb['url']
            ];
            $position++;
        }

        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $breadcrumb_items
        ];
    }

    // 5. Service Schema for Chiptuning Pages
    if ( tm_seo_is_chiptuning_page() ) {
        $url_parts = tm_seo_get_url_parts();
        $brand = isset( $url_parts[1] ) ? tm_seo_format_name( $url_parts[1] ) : '';
        $model = isset( $url_parts[2] ) ? tm_seo_format_name( $url_parts[2] ) : '';
        $engine = isset( $url_parts[3] ) ? tm_seo_format_name( $url_parts[3] ) : '';

        $service_name = 'ECU Chiptuning';
        if ( $brand ) $service_name = "{$brand} Chiptuning";
        if ( $model ) $service_name = "{$brand} {$model} Chiptuning";
        if ( $engine ) $service_name = "{$brand} {$model} {$engine} ECU Tuning";

        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'serviceType' => $service_name,
            'provider' => [
                '@id' => $site_url . '#organization'
            ],
            'name' => $service_name,
            'description' => tm_seo_meta_description(),
            'url' => ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'EUR',
                'priceRange' => '49-199',
                'availability' => 'https://schema.org/InStock'
            ],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Tuning Stages',
                'itemListElement' => [
                    [
                        '@type' => 'Offer',
                        'name' => 'Stage 1 - ECU Remap',
                        'description' => 'Safe power upgrade within factory tolerances. +15-30% power increase.'
                    ],
                    [
                        '@type' => 'Offer',
                        'name' => 'Stage 2 - Performance Tune',
                        'description' => 'Aggressive tune for modified vehicles. Requires exhaust/intake upgrades.'
                    ],
                    [
                        '@type' => 'Offer',
                        'name' => 'Stage 3 - Full Custom',
                        'description' => 'Maximum power for heavily modified engines. Requires supporting mods.'
                    ]
                ]
            ]
        ];
    }

    // 6. FAQ Schema for Homepage
    if ( is_front_page() ) {
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'What is ECU chiptuning?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'ECU chiptuning is the process of modifying the software in your vehicle\'s Engine Control Unit to optimize performance. This can increase horsepower, torque, and fuel efficiency while maintaining reliability.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Is Stage 1 tuning safe for my car?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Yes, Stage 1 tuning is designed to work within your engine\'s safe operating parameters. Our tunes are dyno-tested and calibrated to provide optimal performance gains of 15-30% while maintaining reliability and factory tolerances.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'How much power can I gain from chiptuning?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Power gains depend on your vehicle and tuning stage. Stage 1 typically adds 15-30% more power. Stage 2 can provide 25-40% gains. Diesel vehicles often see the largest improvements, with some gaining up to 50% more torque.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'How long does the tuning process take?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Our fileservice operates 24/7. Once you upload your original ECU file, we typically deliver your custom tune within 1-2 hours. Express service is available for urgent requests.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Do you support all car brands?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Yes, we support all major car manufacturers including BMW, Mercedes, Audi, Volkswagen, Ford, Opel, Peugeot, Renault, and many more. Our database covers cars, bikes, trucks, tractors, and marine vehicles.'
                    ]
                ]
            ]
        ];
    }

    // 7. Product Schema for WooCommerce (if applicable)
    if ( function_exists( 'is_product' ) && is_product() ) {
        global $product;
        if ( $product ) {
            $schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'Product',
                'name' => $product->get_name(),
                'description' => wp_strip_all_tags( $product->get_short_description() ),
                'sku' => $product->get_sku(),
                'image' => wp_get_attachment_url( $product->get_image_id() ),
                'offers' => [
                    '@type' => 'Offer',
                    'priceCurrency' => get_woocommerce_currency(),
                    'price' => $product->get_price(),
                    'availability' => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                    'seller' => [
                        '@id' => $site_url . '#organization'
                    ]
                ]
            ];
        }
    }

    // Output all schemas
    foreach ( $schemas as $schema ) {
        echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'tm_seo_schema_output', 5 );

// ============================================================
// 4. BREADCRUMB GENERATION
// ============================================================

/**
 * Generate breadcrumb data for Schema and display
 */
function tm_seo_get_breadcrumbs() {
    $breadcrumbs = [];
    $home_url = home_url( '/' );

    // Always start with Home
    $breadcrumbs[] = [
        'name' => 'Home',
        'url' => $home_url
    ];

    if ( is_front_page() ) {
        return $breadcrumbs;
    }

    // CTR Plugin pages
    if ( tm_seo_is_chiptuning_page() ) {
        $url_parts = tm_seo_get_url_parts();
        $ctr_start_url = get_option( 'ctr_start_url', 'chip-tuning' );
        $current_url = $home_url . $ctr_start_url . '/';

        $breadcrumbs[] = [
            'name' => 'Chiptuning',
            'url' => $current_url
        ];

        if ( isset( $url_parts[1] ) && $url_parts[1] ) {
            $current_url .= $url_parts[1] . '/';
            $breadcrumbs[] = [
                'name' => tm_seo_format_name( $url_parts[1] ),
                'url' => $current_url
            ];
        }

        if ( isset( $url_parts[2] ) && $url_parts[2] ) {
            $current_url .= $url_parts[2] . '/';
            $breadcrumbs[] = [
                'name' => tm_seo_format_name( $url_parts[2] ),
                'url' => $current_url
            ];
        }

        if ( isset( $url_parts[3] ) && $url_parts[3] ) {
            $current_url .= $url_parts[3] . '/';
            $breadcrumbs[] = [
                'name' => tm_seo_format_name( $url_parts[3] ),
                'url' => $current_url
            ];
        }

        return $breadcrumbs;
    }

    // Standard pages
    if ( is_page() && ! is_front_page() ) {
        $breadcrumbs[] = [
            'name' => get_the_title(),
            'url' => get_permalink()
        ];
    }

    // Single posts
    if ( is_single() ) {
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            $breadcrumbs[] = [
                'name' => $categories[0]->name,
                'url' => get_category_link( $categories[0]->term_id )
            ];
        }
        $breadcrumbs[] = [
            'name' => get_the_title(),
            'url' => get_permalink()
        ];
    }

    // Archives
    if ( is_category() ) {
        $breadcrumbs[] = [
            'name' => single_cat_title( '', false ),
            'url' => get_category_link( get_queried_object_id() )
        ];
    }

    return $breadcrumbs;
}

/**
 * Display HTML breadcrumbs (SEO-optimized)
 */
function tm_seo_display_breadcrumbs() {
    $breadcrumbs = tm_seo_get_breadcrumbs();

    if ( empty( $breadcrumbs ) || count( $breadcrumbs ) <= 1 ) {
        return;
    }

    echo '<nav class="tm-breadcrumbs py-3 text-sm" aria-label="Breadcrumb">';
    echo '<ol class="flex flex-wrap items-center gap-2 text-gray-400" itemscope itemtype="https://schema.org/BreadcrumbList">';

    $count = count( $breadcrumbs );
    $i = 0;

    foreach ( $breadcrumbs as $crumb ) {
        $i++;
        $is_last = $i === $count;

        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex items-center">';

        if ( ! $is_last ) {
            echo '<a itemprop="item" href="' . esc_url( $crumb['url'] ) . '" class="hover:text-[#ccff00] transition-colors">';
            echo '<span itemprop="name">' . esc_html( $crumb['name'] ) . '</span>';
            echo '</a>';
            echo '<meta itemprop="position" content="' . $i . '">';
            echo '<svg class="w-4 h-4 mx-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
        } else {
            echo '<span itemprop="name" class="text-[#ccff00] font-medium">' . esc_html( $crumb['name'] ) . '</span>';
            echo '<meta itemprop="position" content="' . $i . '">';
        }

        echo '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}

// ============================================================
// 5. HELPER FUNCTIONS
// ============================================================

/**
 * Check if current page is a CTR plugin page
 */
function tm_seo_is_chiptuning_page() {
    $ctr_start_url = get_option( 'ctr_start_url', 'chip-tuning' );
    $url_path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
    $url_parts = explode( '/', $url_path );

    return ! empty( $url_parts ) && isset( $url_parts[0] ) && $url_parts[0] === $ctr_start_url;
}

/**
 * Get URL parts for CTR pages
 */
function tm_seo_get_url_parts() {
    $url_path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
    return explode( '/', $url_path );
}

// ============================================================
// 6. ENHANCED OPEN GRAPH & TWITTER CARDS
// ============================================================

/**
 * Output enhanced Open Graph meta tags
 */
function tm_seo_open_graph() {
    $og = [];
    $site_name = 'TunerFilesLab';
    $current_url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

    // Default image
    $og_image = get_template_directory_uri() . '/assets/img/og-default.png';

    // Check for featured image
    if ( is_singular() && has_post_thumbnail() ) {
        $og_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    }

    // Core OG tags
    $og['og:site_name'] = $site_name;
    $og['og:title'] = wp_get_document_title();
    $og['og:description'] = tm_seo_meta_description();
    $og['og:url'] = $current_url;
    $og['og:type'] = is_singular( 'post' ) ? 'article' : 'website';
    $og['og:image'] = $og_image;
    $og['og:image:width'] = '1200';
    $og['og:image:height'] = '630';
    $og['og:locale'] = get_locale();

    // Twitter Cards
    $og['twitter:card'] = 'summary_large_image';
    $og['twitter:site'] = '@tunerfileslab';
    $og['twitter:title'] = wp_get_document_title();
    $og['twitter:description'] = tm_seo_meta_description();
    $og['twitter:image'] = $og_image;

    // Article-specific
    if ( is_singular( 'post' ) ) {
        $og['article:published_time'] = get_the_date( 'c' );
        $og['article:modified_time'] = get_the_modified_date( 'c' );
        $og['article:author'] = get_the_author();
    }

    // Output
    echo "\n<!-- Open Graph & Twitter Cards -->\n";
    echo '<meta name="description" content="' . tm_seo_meta_description() . '" />' . "\n";

    foreach ( $og as $property => $content ) {
        $attr = strpos( $property, 'og:' ) === 0 || strpos( $property, 'article:' ) === 0 ? 'property' : 'name';
        echo '<meta ' . $attr . '="' . esc_attr( $property ) . '" content="' . esc_attr( $content ) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'tm_seo_open_graph', 2 );

// ============================================================
// 7. INTERNAL LINKING HELPER
// ============================================================

/**
 * Auto-link keywords to relevant pages
 * Use: Apply to content via filter
 */
function tm_seo_auto_internal_links( $content ) {
    $links = [
        'chiptuning' => home_url( '/chip-tuning/' ),
        'Stage 1' => home_url( '/chip-tuning/' ) . '#stage1',
        'Stage 2' => home_url( '/chip-tuning/' ) . '#stage2',
        'ECU tuning' => home_url( '/chip-tuning/' ),
        'fileservice' => home_url( '/fileservice/' ),
        'remap' => home_url( '/chip-tuning/' ),
    ];

    foreach ( $links as $keyword => $url ) {
        // Only replace first occurrence
        $pattern = '/\b(' . preg_quote( $keyword, '/' ) . ')\b(?![^<]*>|[^<>]*<\/a>)/i';
        $replacement = '<a href="' . esc_url( $url ) . '" class="text-[#ccff00] hover:underline">${1}</a>';
        $content = preg_replace( $pattern, $replacement, $content, 1 );
    }

    return $content;
}
// Uncomment to enable: add_filter( 'the_content', 'tm_seo_auto_internal_links' );

// ============================================================
// 8. IMAGE SEO ENHANCEMENTS
// ============================================================

/**
 * Auto-add alt text to images without it
 */
function tm_seo_image_alt_text( $attr, $attachment, $size ) {
    if ( empty( $attr['alt'] ) ) {
        // Use attachment title
        $attr['alt'] = get_the_title( $attachment->ID );

        // If still empty, generate from filename
        if ( empty( $attr['alt'] ) ) {
            $filename = basename( get_attached_file( $attachment->ID ) );
            $attr['alt'] = ucwords( str_replace( [ '-', '_', '.jpg', '.png', '.webp' ], [ ' ', ' ', '', '', '' ], $filename ) );
        }
    }

    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'tm_seo_image_alt_text', 10, 3 );

/**
 * Add loading="lazy" to images below the fold
 */
function tm_seo_lazy_load_images( $content ) {
    // Skip if in admin or REST API
    if ( is_admin() || defined( 'REST_REQUEST' ) ) {
        return $content;
    }

    // Add loading="lazy" to images that don't have it
    $content = preg_replace( '/<img(?![^>]*loading=)([^>]*)>/i', '<img loading="lazy"$1>', $content );

    return $content;
}
add_filter( 'the_content', 'tm_seo_lazy_load_images', 99 );

// ============================================================
// 9. ROBOTS & CANONICAL TAGS
// ============================================================

/**
 * Add canonical URLs to prevent duplicate content
 */
function tm_seo_canonical_url() {
    $canonical = '';

    if ( is_front_page() ) {
        $canonical = home_url( '/' );
    } elseif ( is_singular() ) {
        $canonical = get_permalink();
    } elseif ( is_category() || is_tag() || is_tax() ) {
        $canonical = get_term_link( get_queried_object() );
    } elseif ( is_author() ) {
        $canonical = get_author_posts_url( get_queried_object_id() );
    } elseif ( is_archive() ) {
        if ( is_date() ) {
            if ( is_day() ) {
                $canonical = get_day_link( get_query_var( 'year' ), get_query_var( 'monthnum' ), get_query_var( 'day' ) );
            } elseif ( is_month() ) {
                $canonical = get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) );
            } else {
                $canonical = get_year_link( get_query_var( 'year' ) );
            }
        }
    } else {
        // CTR plugin pages
        $canonical = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        // Remove query strings
        $canonical = strtok( $canonical, '?' );
    }

    if ( ! empty( $canonical ) && ! is_wp_error( $canonical ) ) {
        echo '<link rel="canonical" href="' . esc_url( $canonical ) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'tm_seo_canonical_url', 1 );

/**
 * Add robots meta tag for noindex pages
 */
function tm_seo_robots_meta() {
    $robots = [];

    // Noindex certain pages
    if ( is_search() || is_404() ) {
        $robots[] = 'noindex';
        $robots[] = 'follow';
    } elseif ( is_paged() && ! is_singular() ) {
        // Paginated archives
        $robots[] = 'noindex';
        $robots[] = 'follow';
    } else {
        $robots[] = 'index';
        $robots[] = 'follow';
        $robots[] = 'max-snippet:-1';
        $robots[] = 'max-image-preview:large';
        $robots[] = 'max-video-preview:-1';
    }

    if ( ! empty( $robots ) ) {
        echo '<meta name="robots" content="' . esc_attr( implode( ', ', $robots ) ) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'tm_seo_robots_meta', 1 );

// ============================================================
// 10. PERFORMANCE OPTIMIZATIONS FOR SEO
// ============================================================

/**
 * Add preconnect hints for external resources
 */
function tm_seo_resource_hints( $hints, $relation_type ) {
    if ( $relation_type === 'preconnect' ) {
        $hints[] = [
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => true
        ];
        $hints[] = [
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => true
        ];
    }

    if ( $relation_type === 'dns-prefetch' ) {
        $hints[] = 'https://www.google-analytics.com';
        $hints[] = 'https://www.googletagmanager.com';
    }

    return $hints;
}
add_filter( 'wp_resource_hints', 'tm_seo_resource_hints', 10, 2 );

// ============================================================
// 11. SITEMAP ENHANCEMENTS (For XML Sitemap)
// ============================================================

/**
 * Add CTR plugin pages to sitemap
 * Note: Requires a sitemap plugin that supports this filter
 */
function tm_seo_sitemap_urls( $urls ) {
    // Add main chiptuning page
    $ctr_start_url = get_option( 'ctr_start_url', 'chip-tuning' );
    $urls[] = [
        'loc' => home_url( '/' . $ctr_start_url . '/' ),
        'lastmod' => date( 'Y-m-d' ),
        'changefreq' => 'weekly',
        'priority' => 0.9
    ];

    return $urls;
}
// Hook into sitemap plugins if available:
// add_filter( 'wpseo_sitemap_entry', 'tm_seo_sitemap_urls' );
// add_filter( 'aiosp_sitemap_extra', 'tm_seo_sitemap_urls' );

// ============================================================
// 12. PREVENT DUPLICATE CONTENT
// ============================================================

/**
 * Remove default WordPress meta description if exists
 */
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );

/**
 * Redirect www to non-www (or vice versa) - Choose one
 */
function tm_seo_canonical_redirect() {
    // Skip in admin or AJAX
    if ( is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        return;
    }

    // Force trailing slash for consistency
    $request_uri = $_SERVER['REQUEST_URI'];
    if ( ! preg_match( '/\.[a-z0-9]+$/i', $request_uri ) && substr( $request_uri, -1 ) !== '/' && ! empty( $request_uri ) && $request_uri !== '/' ) {
        wp_redirect( home_url( $request_uri ) . '/', 301 );
        exit;
    }
}
// Uncomment if needed: add_action( 'template_redirect', 'tm_seo_canonical_redirect' );

// ============================================================
// 13. CTR-SPECIFIC SEO CONTENT HOOKS
// ============================================================

/**
 * Add SEO-friendly content to CTR pages
 * Implements: Keyword in first 100 words, semantic headings
 */
function tm_seo_ctr_intro_content() {
    if ( ! tm_seo_is_chiptuning_page() ) {
        return;
    }

    $url_parts = tm_seo_get_url_parts();
    $brand = isset( $url_parts[1] ) ? tm_seo_format_name( $url_parts[1] ) : '';
    $model = isset( $url_parts[2] ) ? tm_seo_format_name( $url_parts[2] ) : '';
    $engine = isset( $url_parts[3] ) ? tm_seo_format_name( $url_parts[3] ) : '';

    $content = '';

    if ( $engine ) {
        $content = "<p class='text-gray-400 mb-6'>Looking for professional <strong>chiptuning files</strong> for your <strong>{$brand} {$model} {$engine}</strong>?
        Our ECU remapping experts have developed optimized Stage 1, Stage 2, and Stage 3 tuning solutions specifically for this engine.
        Experience significant power gains, improved throttle response, and better fuel efficiency with our dyno-tested tunes.</p>";
    } elseif ( $model ) {
        $content = "<p class='text-gray-400 mb-6'>Discover our complete range of <strong>{$brand} {$model} chiptuning files</strong>.
        Select your specific engine below to see available tuning stages and performance gains.
        All our ECU maps are custom calibrated for maximum power and reliability.</p>";
    } elseif ( $brand ) {
        $content = "<p class='text-gray-400 mb-6'>Browse all <strong>{$brand} chiptuning</strong> solutions.
        We support every {$brand} model from classics to the latest releases.
        Professional ECU remapping with Stage 1, Stage 2, and custom options available.</p>";
    }

    return $content;
}

// ============================================================
// END SEO ENHANCEMENTS
// ============================================================
