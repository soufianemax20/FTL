<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <!-- PWA MODERN META TAGS -->
    <meta name="theme-color" content="#0D0D0D" media="(prefers-color-scheme: dark)">
    <meta name="theme-color" content="#D7F207" media="(prefers-color-scheme: light)">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="TunerFilesLab">
    <meta name="application-name" content="TunerFilesLab">
    <meta name="msapplication-TileColor" content="#0D0D0D">
    <meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/browserconfig.xml">

    <!-- PWA MANIFEST -->
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/manifest.json" crossorigin="use-credentials">
	<link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- PERFORMANCE: Preconnect to External Resources (Optimized Order) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

    <!-- DNS Prefetch for Secondary Resources -->
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://www.google-analytics.com">

    <!-- SEO: Meta Description -->
    <!-- SEO: Meta Description managed in functions.php -->

    <!-- FAVICON (Manual Override) -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.png" type="image/png">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.png">

	<?php wp_head(); ?>

    <!-- CRITICAL CSS (LCP & Layout Stability) -->
    <style>
        /* Global Reset & Base */
        body { margin: 0; padding: 0; background-color: #0D0D0D; color: white; font-family: sans-serif; }
        .antialiased { -webkit-font-smoothing: antialiased; -moz-osx-smoothing: grayscale; }

        /* Header Reserve Space */
        .site-header {
            height: 80px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 50;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
        }

        /* Header Critical CSS (Prevent FOUC) */
        .site-header .container { width: 100%; max-width: 1280px; margin-left: auto; margin-right: auto; padding-left: 1rem; padding-right: 1rem; }
        .glass-header-bg {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(6px);
        }

        /* Logo Critical */
        .site-branding a { display: flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; font-weight: 900; font-style: italic; text-transform: uppercase; font-size: 1.5rem; }
        .site-branding .text-lime-400 { color: #D7F207; }

        /* Navigation Critical */
        #site-navigation { display: none; } /* Hidden on mobile */
        #site-navigation a { color: #d1d5db; text-decoration: none; text-transform: uppercase; font-size: 0.875rem; font-weight: 700; letter-spacing: 0.1em; margin-right: 2rem; }
        #site-navigation a:last-child { margin-right: 0; }

        /* Mobile Toggle Critical */
        .md\:hidden { display: block; background: none; border: none; color: white; }

        /* Desktop Media Query */
        @media (min-width: 768px) {
            #site-navigation { display: flex !important; }
            .md\:hidden { display: none !important; }
            .hidden.md\:flex { display: flex !important; }
        }

        /* Hero Section (LCP Target) */
        /* Hero Section (LCP Target) - Critical CSS */
        .hero-section { position: relative; min-height: 100vh; display: flex; align-items: center; overflow: hidden; background-color: #000; padding-top: 80px; }
        .hero-bg-wrapper { position: absolute; inset: 0; z-index: 0; width: 100%; height: 100%; }
        .hero-section img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.6; }

        /* Hero Layers (Prevent FOUC) */
        .hero-gradient-1 { position: absolute; inset: 0; z-index: 1; pointer-events: none; background: linear-gradient(to right, #000000, rgba(0,0,0,0.5), transparent); width: 100%; height: 100%; }
        .hero-gradient-2 { position: absolute; inset: 0; z-index: 1; pointer-events: none; background: linear-gradient(to top, #000000, transparent, rgba(0,0,0,0.4)); width: 100%; height: 100%; }
        .hero-texture { position: absolute; inset: 0; z-index: 2; pointer-events: none; opacity: 0.2; width: 100%; height: 100%; }
        .hero-glow { position: absolute; top: 25%; left: 0; width: 800px; height: 800px; background-color: #D7F207; border-radius: 9999px; mix-blend-mode: overlay; filter: blur(150px); opacity: 0.1; z-index: 3; pointer-events: none; }
        .hero-content { position: relative; z-index: 10; height: 100%; display: flex; flex-direction: column; justify-content: center; padding-left: 1.5rem; padding-right: 1.5rem; width: 100%; }
        .hero-bottom-fade { position: absolute; bottom: 0; left: 0; width: 100%; height: 8rem; background: linear-gradient(to top, #0D0D0D, transparent); z-index: 20; pointer-events: none; }

        /* Typography (Prevent Layout Shifts) */
        .hero-title { font-family: 'Orbitron', sans-serif; font-weight: 900; text-transform: uppercase; font-style: italic; line-height: 1; margin-bottom: 2rem; margin-top: 10px; text-align: center; }
        .hero-title span { display: block; letter-spacing: -0.05em; }
        .hero-title span:first-child { color: white; font-size: 3rem; }
        .hero-title span:last-child { color: #D7F207; font-size: 3rem; position: relative; display: inline-block; }

        .hero-subtitle { color: #d1d5db; font-size: 1.125rem; margin-bottom: 2.5rem; max-width: 42rem; margin-left: auto; margin-right: auto; font-weight: 300; line-height: 1.625; text-align: center; }
        .hero-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 3rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 2rem; max-width: 48rem; margin-left: auto; margin-right: auto; }

        @media (min-width: 768px) {
            .hero-title span:first-child, .hero-title span:last-child { font-size: 4.5rem; }
            .hero-subtitle { font-size: 1.5rem; }
            .hero-stats { gap: 3rem; }
        }
        @media (min-width: 1024px) {
            .hero-title span:first-child, .hero-title span:last-child { font-size: 6rem; } /* Adjusted for safety */
        }

        /* Plugin Layout Fixes */
        .ctr-brands-grid, .ctr-show-brands ul, ul.brands-list { display: grid !important; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)) !important; gap: 1rem !important; list-style: none !important; padding: 0 !important; }
        .ctr-selector-wrapper ul, .vehicle-type-list { display: flex !important; flex-wrap: wrap !important; justify-content: center !important; gap: 1rem !important; list-style: none !important; }
        .ctr-default-style { display: none !important; }

        /* Preloader Critical CSS */
        /* Preloader Critical CSS - Fixed Layers */
        #site-preloader { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 2147483647; background: #0D0D0D; display: flex; align-items: center; justify-content: center; transition: opacity 0.5s ease-out; overflow: hidden; }
        .preloader-hidden { opacity: 0; pointer-events: none; }

        /* Preloader Layers */
        .preloader-layer { position: absolute; inset: 0; width: 100%; height: 100%; pointer-events: none; }
        .preloader-grid { background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: 40px 40px; }
        .preloader-glow { background: radial-gradient(circle at 50% 50%, rgba(215, 242, 7, 0.08) 0%, transparent 60%); }
        .preloader-content { position: relative; z-index: 50; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 2rem; transform: scale(1); }

        .spinner-ring { width: 70px; height: 70px; border: 3px solid rgba(255, 255, 255, 0.05); border-top-color: #D7F207; border-right-color: rgba(215, 242, 7, 0.3); border-radius: 50%; animation: spin 0.8s linear infinite; box-shadow: 0 0 15px rgba(204,255,0,0.1); }
        .loading-text { font-family: 'Orbitron', sans-serif; letter-spacing: 0.3em; font-size: 0.75rem; color: #666; animation: pulse 2s ease-in-out infinite; text-transform: uppercase; margin-top: 1rem; }

        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @keyframes pulse { 0%, 100% { opacity: 0.5; } 50% { opacity: 1; text-shadow: 0 0 8px rgba(204,255,0,0.5); color: #888; } }
    </style>

    <!-- Alpine.js is enqueued in functions.php with defer -->

    <!-- NOTE: Tailwind CSS is now compiled locally -->
    <!-- Run 'npm run build:css' in the theme folder to regenerate -->
</head>

<body <?php body_class( 'bg-[#0D0D0D] text-white antialiased overflow-x-hidden selection:bg-[#D7F207] selection:text-black' ); ?>>
<?php wp_body_open(); ?>

<!-- PRELOADER COMPONENT -->
<!-- PRELOADER COMPONENT -->
<div id="site-preloader">
    <!-- Visual Layers -->
    <div class="preloader-layer preloader-grid"></div>
    <div class="preloader-layer preloader-glow"></div>

    <!-- Content Layer -->
    <div class="preloader-content">
        <!-- Logo Animation -->
        <div class="relative group">
            <div class="absolute inset-0 bg-[#D7F207]/20 blur-2xl rounded-full animate-pulse transition-all duration-500 group-hover:bg-[#D7F207]/30"></div>
            <div class="relative text-4xl md:text-6xl font-black italic tracking-tighter uppercase text-white drop-shadow-2xl">
                TUNER <span class="text-[#D7F207]">FILES</span> <span class="text-lime-400">LAB</span>
            </div>
        </div>

        <!-- High Performance Spinner -->
        <div class="relative mt-4">
            <div class="spinner-ring"></div>
            <!-- Center Dot -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-1.5 h-1.5 bg-[#D7F207] rounded-full shadow-[0_0_10px_#D7F207]"></div>
        </div>

        <!-- Status Text -->
        <div class="loading-text">
            System Initialization...
        </div>
    </div>
</div>

<script>
    (function() {
        const preloader = document.getElementById('site-preloader');

        // Lock scroll immediately
        if (preloader) {
            document.body.style.overflow = 'hidden';
        }

        const hidePreloader = () => {
            if (preloader && !preloader.classList.contains('preloader-hidden')) {
                preloader.classList.add('preloader-hidden');
                document.body.style.overflow = ''; // Unlock scroll
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500); // Wait for transition
            }
        };

        // Hide when window loads (images, scripts, etc.)
        window.addEventListener('load', hidePreloader);

        // Failsafe: Force hide after 1.5 seconds if something hangs
        setTimeout(hidePreloader, 1500);
    })();
</script>

<!-- Main Content Wrapper -->
<div id="page-wrapper" class="flex flex-col min-h-screen">


<!--
    SIMPLE HEADER
-->
<header id="masthead"
        class="site-header fixed w-full top-0 left-0 z-[999] bg-black/70 backdrop-blur-md transition-colors"
        x-data="{ mobileMenuOpen: false }">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- LOGO -->
            <div class="site-branding flex-shrink-0 relative z-50 -translate-y-2">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="group flex items-center gap-2 text-2xl font-black tracking-tighter uppercase italic">
                    <span class="text-white group-hover:text-[#D7F207] transition-colors">TUNER FILES</span>
                    <span class="text-lime-400">LAB</span>
                </a>
            </div>

            <!-- DESKTOP NAV -->
            <nav id="site-navigation" class="hidden md:flex space-x-8">
                <a href="<?php echo home_url('/'); ?>" class="text-sm font-bold uppercase tracking-widest text-white hover:text-[#F2EA79] transition-colors">Home</a>
                <a href="<?php echo function_exists('ctr_print_full_start_url') ? ctr_print_full_start_url(false) : home_url('/chip-tuning/'); ?>" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-[#F2EA79] transition-colors">Cars</a>
                <a href="<?php echo home_url('/brands-catalog/'); ?>" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-[#F2EA79] transition-colors">Brands</a>
                <a href="<?php echo home_url('/fileservice/'); ?>" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-[#F2EA79] transition-colors">Fileservice</a>
                <a href="<?php echo function_exists('wc_get_page_permalink') ? wc_get_page_permalink( 'shop' ) : home_url('/shop/'); ?>" class="text-sm font-bold uppercase tracking-widest text-gray-300 hover:text-[#F2EA79] transition-colors">Parts</a>
            </nav>

            <!-- CTA BUTTON -->
            <div class="hidden md:flex items-center">
                <a href="<?php echo is_front_page() ? '#selector' : (function_exists('ctr_print_full_start_url') ? ctr_print_full_start_url(false) : home_url('/chip-tuning/')); ?>"
                   class="btn-lambo">
                    <span>Select a Vehicle</span>
                </a>
            </div>

            <!-- MOBILE MENU TOGGLE -->
            <button class="md:hidden flex items-center gap-2 px-3 py-2 rounded-xl bg-white/5 backdrop-blur-md border border-white/10 hover:border-[#D7F207]/50 hover:bg-[#D7F207]/10 text-white transition-all duration-300 group z-50 relative"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    aria-controls="primary-menu" :aria-expanded="mobileMenuOpen"
                    aria-label="Toggle mobile menu">
                <span class="text-xs font-bold tracking-widest uppercase group-hover:text-[#D7F207]">Menu</span>
                <svg class="w-6 h-6 group-hover:text-[#D7F207] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!mobileMenuOpen">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg class="w-6 h-6 group-hover:text-[#D7F207] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="mobileMenuOpen" x-cloak>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

        </div>
    </div>

    <!-- MOBILE MENU OVERLAY - SIMPLIFIED -->
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[1001] md:hidden overflow-y-auto bg-[#030303]">

        <!-- Animated Background (Fixed position to stay while scrolling) -->
        <div class="fixed inset-0 pointer-events-none">
            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(204,255,0,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(204,255,0,0.1) 1px, transparent 1px); background-size: 50px 50px;"></div>

            <!-- Animated Gradient Orbs -->
            <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-[#D7F207]/15 rounded-full blur-[150px] animate-pulse" style="animation-duration: 4s;"></div>
            <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-[#F2EA79]/10 rounded-full blur-[130px] animate-pulse" style="animation-duration: 6s;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-[#ff00ff]/5 rounded-full blur-[100px] animate-pulse" style="animation-duration: 5s;"></div>

            <!-- Floating Particles -->
            <div class="absolute top-[10%] left-[20%] w-2 h-2 bg-[#D7F207] rounded-full animate-bounce opacity-60" style="animation-duration: 3s;"></div>
            <div class="absolute top-[30%] right-[15%] w-1 h-1 bg-[#F2EA79] rounded-full animate-bounce opacity-40" style="animation-duration: 2.5s;"></div>
            <div class="absolute bottom-[25%] left-[10%] w-1.5 h-1.5 bg-[#D7F207] rounded-full animate-bounce opacity-50" style="animation-duration: 4s;"></div>
            <div class="absolute bottom-[40%] right-[25%] w-1 h-1 bg-[#F2EA79] rounded-full animate-bounce opacity-30" style="animation-duration: 3.5s;"></div>
        </div>

        <!-- Sticky Header Area for Controls -->
        <div class="sticky top-0 z-[90] flex justify-between items-center px-4 py-4 sm:px-5 sm:py-6 w-full glass-header-bg">
             <!-- Logo (Glowing) -->
            <a href="<?php echo esc_url(home_url('/')); ?>"
               class="flex items-center gap-1.5 text-lg font-black tracking-tight uppercase italic group"
               @click="mobileMenuOpen = false">
                <span class="text-white group-hover:text-[#D7F207] transition-colors duration-300">TUNER FILES</span>
                <span class="text-[#D7F207] drop-shadow-[0_0_10px_rgba(204,255,0,0.5)]">LAB</span>
            </a>

            <!-- Close Button (Animated X) -->
            <button class="group p-3 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-[#D7F207]/60 hover:bg-[#D7F207]/10 transition-all duration-300 hover:rotate-90"
                    @click="mobileMenuOpen = false"
                    aria-label="Close Menu">
                <svg class="w-7 h-7 text-white group-hover:text-[#D7F207] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Container - Responsive -->
        <nav class="relative z-10 flex flex-col items-center justify-start w-full px-4 sm:px-6 pb-24 sm:pb-32 pt-2 sm:pt-4">

            <!-- Menu Items with Icons - Responsive spacing -->
            <div class="flex flex-col items-center space-y-2 sm:space-y-3 w-full max-w-[340px] sm:max-w-sm">

                <!-- HOME -->
                <a href="<?php echo home_url('/'); ?>"
                   class="group relative flex items-center gap-3 sm:gap-4 w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl sm:rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 hover:border-[#D7F207]/50 hover:bg-[#D7F207]/10 transition-all duration-300"
                   @click="mobileMenuOpen = false">
                    <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-br from-[#D7F207]/20 to-[#F2EA79]/10 shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#D7F207]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-base sm:text-lg font-bold uppercase tracking-wide text-white">Home</span>
                        <span class="text-[10px] sm:text-xs text-gray-500 truncate">Back to start</span>
                    </div>
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600 ml-auto shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <!-- CARS -->
                <a href="<?php echo function_exists('ctr_print_full_start_url') ? ctr_print_full_start_url(false) : home_url('/chip-tuning/'); ?>"
                   class="group relative flex items-center gap-3 sm:gap-4 w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl sm:rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 hover:border-[#D7F207]/50 hover:bg-[#D7F207]/10 transition-all duration-300"
                   @click="mobileMenuOpen = false">
                    <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-br from-[#D7F207]/20 to-[#F2EA79]/10 shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#D7F207]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8m-8 4h8m-5 8v-4a1 1 0 011-1h2a1 1 0 011 1v4m-8 0h10a2 2 0 002-2V5a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-base sm:text-lg font-bold uppercase tracking-wide text-white">Cars</span>
                        <span class="text-[10px] sm:text-xs text-gray-500 truncate">Find your vehicle</span>
                    </div>
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600 ml-auto shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <!-- BRANDS -->
                <a href="<?php echo home_url('/brands-catalog/'); ?>"
                   class="group relative flex items-center gap-3 sm:gap-4 w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl sm:rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 hover:border-[#D7F207]/50 hover:bg-[#D7F207]/10 transition-all duration-300"
                   @click="mobileMenuOpen = false">
                    <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-br from-[#D7F207]/20 to-[#F2EA79]/10 shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#D7F207]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-base sm:text-lg font-bold uppercase tracking-wide text-white">Brands</span>
                        <span class="text-[10px] sm:text-xs text-gray-500 truncate">All manufacturers</span>
                    </div>
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600 ml-auto shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <!-- FILESERVICE -->
                <a href="<?php echo home_url('/fileservice/'); ?>"
                   class="group relative flex items-center gap-3 sm:gap-4 w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl sm:rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 hover:border-[#D7F207]/50 hover:bg-[#D7F207]/10 transition-all duration-300"
                   @click="mobileMenuOpen = false">
                    <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-br from-[#D7F207]/20 to-[#F2EA79]/10 shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#D7F207]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-base sm:text-lg font-bold uppercase tracking-wide text-white">Fileservice</span>
                        <span class="text-[10px] sm:text-xs text-gray-500 truncate">Upload ECU files</span>
                    </div>
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600 ml-auto shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <!-- PARTS / SHOP -->
                <a href="<?php echo function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/'); ?>"
                   class="group relative flex items-center gap-3 sm:gap-4 w-full px-4 sm:px-6 py-3 sm:py-4 rounded-xl sm:rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 hover:border-[#D7F207]/50 hover:bg-[#D7F207]/10 transition-all duration-300"
                   @click="mobileMenuOpen = false">
                    <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-br from-[#D7F207]/20 to-[#F2EA79]/10 shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#D7F207]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-base sm:text-lg font-bold uppercase tracking-wide text-white">Parts</span>
                        <span class="text-[10px] sm:text-xs text-gray-500 truncate">Shop tuning gear</span>
                    </div>
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600 ml-auto shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- CTA Button - Responsive -->
            <div class="mt-4 sm:mt-6 w-full max-w-[340px] sm:max-w-sm">
                <a href="<?php echo is_front_page() ? '#selector' : (function_exists('ctr_print_full_start_url') ? ctr_print_full_start_url(false) : home_url('/chip-tuning/')); ?>"
                   class="group relative flex items-center justify-center gap-2 sm:gap-3 w-full px-6 sm:px-8 py-4 sm:py-5 rounded-xl sm:rounded-2xl bg-gradient-to-r from-[#D7F207] via-[#F2EA79] to-[#F2EA79] text-black font-bold sm:font-black text-base sm:text-lg uppercase tracking-wide sm:tracking-wider shadow-[0_0_30px_rgba(204,255,0,0.3)] transition-all duration-300 overflow-hidden"
                   @click="mobileMenuOpen = false">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span>Select a Vehicle</span>
                </a>
            </div>

            <!-- Contact & Social - Responsive -->
            <div class="mt-4 sm:mt-6 flex flex-col items-center space-y-3 sm:space-y-4 pb-8 sm:pb-10">

                <a href="<?php echo home_url('/contact/'); ?>"
                   class="flex items-center gap-2 text-sm uppercase tracking-widest text-gray-400 hover:text-[#D7F207] transition-colors duration-300"
                   @click="mobileMenuOpen = false">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Contact Us
                </a>

                <!-- Social Icons -->
                <div class="flex items-center gap-4 mt-2">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 border border-white/10 text-gray-400 hover:text-[#D7F207] hover:border-[#D7F207]/50 hover:bg-[#D7F207]/10 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 border border-white/10 text-gray-400 hover:text-[#D7F207] hover:border-[#D7F207]/50 hover:bg-[#D7F207]/10 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 border border-white/10 text-gray-400 hover:text-[#D7F207] hover:border-[#D7F207]/50 hover:bg-[#D7F207]/10 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                </div>

                <!-- Footer Text -->
                <p class="text-xs text-gray-600 mt-4">© <?php echo date('Y'); ?> TunerFilesLab. All rights reserved.</p>
            </div>
        </nav>
    </div>
</header>
