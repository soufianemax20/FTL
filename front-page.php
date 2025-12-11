<?php
/**
 * The template for displaying the front page.
 *
 * @package Tuning_Mania
 */

get_header();
?>

<main id="primary" class="site-main bg-neutral-950 text-white min-h-screen" data-barba="container" data-barba-namespace="home">

    <!-- LOADING SCREEN (Cyberpunk Intro) -->
    <div id="hero-loader" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-[#050505] transition-opacity duration-1000">
        <div class="loader-spinner w-12 h-12 border-4 border-[#111] border-t-neon-yellow rounded-full animate-spin mb-4"></div>
        <p class="font-['Orbitron'] text-xs tracking-[0.3em] text-white animate-pulse">INITIALIZING SYSTEM</p>
    </div>

    <!-- DYNAMIC HERO SECTION (CSS-Based) -->
    <section class="hero-dynamic relative w-full min-h-screen overflow-hidden flex items-center">

        <!-- ANIMATED BACKGROUND LAYERS -->
        <div class="absolute inset-0 z-0 pointer-events-none">

            <!-- Layer 1: Animated Gradient -->
            <div class="absolute inset-0 hero-gradient-bg"></div>

            <!-- Layer 2: Data Stream Lines -->
            <div class="data-streams">
                <div class="stream stream-1"></div>
                <div class="stream stream-2"></div>
                <div class="stream stream-3"></div>
                <div class="stream stream-4"></div>
                <div class="stream stream-5"></div>
            </div>

            <!-- Layer 3: Floating ECU Chips -->
            <div class="floating-elements">
                <div class="float-chip chip-1">ECU</div>
                <div class="float-chip chip-2">+35%</div>
                <div class="float-chip chip-3">REMAP</div>
                <div class="float-chip chip-4">STAGE 2</div>
                <div class="float-chip chip-5">POWER</div>
            </div>

            <!-- Layer 4: Grid Overlay -->
            <div class="absolute inset-0 opacity-10"
                 style="background-image: linear-gradient(rgba(215,242,7,0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(215,242,7,0.3) 1px, transparent 1px); background-size: 60px 60px;">
            </div>

            <!-- Layer 5: Neon Glow Spots -->
            <div class="absolute top-1/4 -left-20 w-[500px] h-[500px] bg-[#D7F207] rounded-full blur-[200px] opacity-15 animate-pulse"></div>
            <div class="absolute bottom-1/4 -right-20 w-[400px] h-[400px] bg-[#00aaff] rounded-full blur-[180px] opacity-10 animate-pulse" style="animation-delay: 1s;"></div>
        </div>

        <div class="container relative z-10 px-6 mx-auto h-full flex flex-col md:flex-row items-center justify-between gap-12 pt-20 pb-20">

            <!-- LEFT COLUMN: Marketing & Headlines -->
            <div class="hero-text-col w-full md:w-1/2 text-left animate-fade-in-up">
                <?php $hero_hook = tm_get_dynamic_title('homepage'); ?>

                <h1 class="font-black italic uppercase leading-none mb-6">
                    <span class="block text-5xl md:text-7xl lg:text-8xl text-white tracking-tighter drop-shadow-2xl glitch-text" data-text="<?php echo esc_attr($hero_hook['title']); ?>">
                        <?php echo $hero_hook['title']; ?>
                    </span>
                    <span class="block text-2xl md:text-3xl text-neon-yellow mt-2 tracking-widest font-light">
                        Performance Redefined
                    </span>
                </h1>

                <p class="text-gray-400 text-lg md:text-xl mb-10 max-w-xl leading-relaxed font-light">
                    <?php echo $hero_hook['subtitle']; ?>
                    <span class="block mt-2 text-white font-medium">Instant Download | Dyno-Tested | 100% Safe</span>
                </p>

                <!-- STATS HUD (From Snippet 1) -->
                <div class="hero-stats-hud flex gap-8 mb-10 border-t border-white/10 pt-6">
                    <div class="stat">
                        <h3>800+</h3>
                        <p>Horsepower</p>
                    </div>
                    <div class="stat">
                        <h3>2.8s</h3>
                        <p>0-60 MPH</p>
                    </div>
                    <div class="stat">
                        <h3>340</h3>
                        <p>km/h Top</p>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <a href="#selector" class="btn-lambo skew-x-[-20deg]" aria-label="Select a Vehicle">
                         <span class="skew-x-[20deg]">Select a Vehicle</span>
                    </a>
                    <div class="flex items-center gap-2 text-sm text-[#00ff66] font-bold uppercase tracking-widest">
                        <span class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#00ff66] opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-[#00ff66]"></span>
                        </span>
                        Online 24/7
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: 3D Tuning Visualizer (Desktop Only - Performance Optimized) -->
            <div class="hero-card-col w-full md:w-[600px] flex justify-center animate-fade-in-up" style="animation-delay: 0.2s;">
                <!-- 3D Visualizer Container (Desktop) -->
                <div class="hidden md:block w-full h-[500px] mt-4 relative z-50 group">
                    <!-- 3D Canvas -->
                    <div id="tuning-visualizer-canvas" class="w-full h-full"></div>

                    <!-- UI Overlay (Interactive Game Mode) -->
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[90%] bg-black/60 backdrop-blur-md rounded-t-xl p-5 border border-white/10 border-b-0 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest font-mono">Tuning Simulation</span>
                            <span id="tuning-stage-label" class="text-neon-yellow font-black uppercase italic">Stock</span>
                        </div>

                        <!-- Range Slider -->
                        <div class="relative w-full h-6 flex items-center">
                            <input type="range" id="tuning-stage-slider" min="0" max="3" value="0" step="1"
                                   class="w-full h-1 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-neon-yellow z-10 focus:outline-none">
                            <div class="absolute inset-0 flex justify-between px-1 pointer-events-none">
                                <div class="w-0.5 h-2 bg-gray-600 mt-2"></div>
                                <div class="w-0.5 h-2 bg-gray-600 mt-2"></div>
                                <div class="w-0.5 h-2 bg-gray-600 mt-2"></div>
                                <div class="w-0.5 h-2 bg-gray-600 mt-2"></div>
                            </div>
                        </div>

                        <!-- Live Stats Bars -->
                        <div class="grid grid-cols-3 gap-4 mt-4 text-[9px] text-gray-500 uppercase font-bold tracking-wider">
                            <div>
                                <div class="mb-1 flex justify-between"><span>Power</span></div>
                                <div class="h-1 bg-gray-800 rounded-full overflow-hidden shadow-inner"><div id="sim-power-bar" class="h-full bg-blue-500 w-[60%] transition-all duration-500 shadow-[0_0_10px_currentColor]"></div></div>
                            </div>
                            <div>
                                <div class="mb-1 flex justify-between"><span>Torque</span></div>
                                <div class="h-1 bg-gray-800 rounded-full overflow-hidden shadow-inner"><div id="sim-torque-bar" class="h-full bg-blue-500 w-[55%] transition-all duration-500 shadow-[0_0_10px_currentColor]"></div></div>
                            </div>
                            <div>
                                <div class="mb-1 flex justify-between"><span>Response</span></div>
                                <div class="h-1 bg-gray-800 rounded-full overflow-hidden shadow-inner"><div id="sim-response-bar" class="h-full bg-blue-500 w-[50%] transition-all duration-500 shadow-[0_0_10px_currentColor]"></div></div>
                            </div>
                        </div>
                    </div>

                    <!-- Initial Loading State -->
                    <div id="gauge-loading" class="absolute inset-0 flex items-center justify-center text-white text-xs uppercase tracking-widest font-bold pointer-events-none opacity-0 transition-opacity duration-500">
                        Initializing Engine...
                    </div>
                </div>

                <!-- Static Image Fallback (Mobile) -->
                <div class="md:hidden w-full h-[300px] mt-8 relative z-50 flex items-center justify-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero-supercar.webp"
                         alt="High Performance Tuning"
                         class="w-full h-full object-contain drop-shadow-[0_0_20px_rgba(204,255,0,0.3)]"
                         loading="eager"
                         width="300"
                         height="200">
                </div>
            </div>
        </div>

        <!-- Bottom Fade -->
        <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-neutral-950 to-transparent z-20 pointer-events-none"></div>

    </section>

    <!-- 3D Gauge Dependencies (Import Map) - Desktop Only via JS Check -->
    <script type="importmap">
        {
            "imports": {
                "three": "https://unpkg.com/three@0.160.0/build/three.module.js",
                "three/addons/": "https://unpkg.com/three@0.160.0/examples/jsm/"
            }
        }
    </script>

    <!-- 3D Tuning Visualizer Script - Load only if width > 768px -->
    <script>
        if (window.innerWidth >= 768) {
            const script = document.createElement('script');
            script.type = 'module';
            script.src = '<?php echo get_template_directory_uri(); ?>/assets/js/tuning-visualizer.js?ver=<?php echo time(); ?>';
            document.body.appendChild(script);
        }
    </script>

    <!-- FIND YOUR RIDE (Categories) -->
    <section id="selector" class="py-12 md:py-24 bg-neutral-950 border-t border-white/5 relative z-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-10 md:mb-16">
                <h2 class="text-3xl md:text-6xl font-black uppercase italic mb-4">
                    Find Your <span class="text-neon-yellow">Ride</span>
                </h2>
                <div class="h-1 w-20 bg-lime-400 mx-auto shadow-[0_0_15px_#ccff00]"></div>
            </div>

            <!-- HUD Dashboard Wrapper for Selector -->
            <div class="max-w-5xl mx-auto relative group">
                <div class="relative bg-[#0b0f19] rounded-xl p-4 md:p-12 border border-white/10 shadow-2xl">
                    <?php
                    // Use our custom vehicle type selector with local icons
                    $template_path = get_template_directory() . '/chiptuningreseller/vehicle-types-selector.php';
                    if (file_exists($template_path)) {
                        include $template_path;
                    } else {
                        // Fallback to plugin shortcode
                        $current_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : 'cars';
                        echo do_shortcode('[ctr_show_selector type="' . $current_type . '" autoredirect="true"]');
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- SUPPORTED BRANDS (The Massive Grid) -->
    <section id="brands" class="py-12 md:py-24 bg-black border-t border-white/10 relative z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 md:mb-16">
                <h2 class="text-3xl md:text-6xl font-black uppercase italic mb-4">
                    Supported <span class="text-neon-yellow">Brands</span>
                </h2>
                <p class="text-gray-400 text-base md:text-lg">We support all major manufacturers</p>
            </div>

            <div class="max-w-7xl mx-auto">
                <?php echo do_shortcode('[ctr_show_brands]'); ?>
            </div>
        </div>
    </section>

    <!-- DEALER CTA -->
    <section class="py-12 md:py-24 bg-neutral-900 border-t border-white/10 relative overflow-hidden z-10">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=2000&auto=format&fit=crop')] bg-cover bg-center opacity-10"></div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h2 class="text-3xl md:text-5xl font-black uppercase italic mb-6">
                Unlock Your Car's <span class="text-neon-yellow">Potential</span>
            </h2>
            <p class="text-base md:text-xl text-gray-400 max-w-2xl mx-auto mb-10">
                Experience the ultimate performance upgrade. Get custom tuning files tailored for your vehicle today.
            </p>
            <a href="<?php echo home_url( '/fileservice/' ); ?>" class="btn-lambo" aria-label="Get Started Now">
                Get Started Now
            </a>
        </div>
    </section>

    <!-- FAQ SECTION (SEO Optimized for Featured Snippets & LLM Visibility) -->
    <section id="faq" class="py-16 md:py-24 bg-neutral-950 border-t border-white/10" aria-labelledby="faq-heading">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center mb-12 md:mb-16">
                <h2 id="faq-heading" class="text-3xl md:text-5xl font-black uppercase italic mb-4">
                    Frequently Asked <span class="text-[#ccff00]">Questions</span>
                </h2>
                <p class="text-gray-400 text-base md:text-lg max-w-2xl mx-auto">
                    Everything you need to know about ECU chiptuning and our professional remapping services.
                </p>
                <div class="h-1 w-20 bg-lime-400 mx-auto mt-6 shadow-[0_0_15px_#ccff00]"></div>
            </div>

            <!-- FAQ Grid (Structured for LLMs) -->
            <div class="max-w-4xl mx-auto space-y-4" x-data="{ openFaq: null }">

                <!-- FAQ 1 -->
                <article class="group bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden transition-all duration-300 hover:border-[#ccff00]/30">
                    <button @click="openFaq = openFaq === 1 ? null : 1"
                            class="w-full flex items-center justify-between p-5 md:p-6 text-left focus:outline-none focus:ring-2 focus:ring-[#ccff00]/50 focus:ring-inset"
                            aria-expanded="false"
                            aria-controls="faq-answer-1">
                        <h3 class="text-lg md:text-xl font-bold text-white pr-4">
                            What is ECU chiptuning?
                        </h3>
                        <svg class="w-6 h-6 text-[#ccff00] transform transition-transform duration-300 flex-shrink-0"
                             :class="{ 'rotate-180': openFaq === 1 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 1"
                         x-cloak
                         x-collapse
                         id="faq-answer-1"
                         class="px-5 md:px-6 pb-5 md:pb-6">
                        <p class="text-gray-400 leading-relaxed">
                            <strong>ECU chiptuning</strong> is the process of modifying the software in your vehicle's Engine Control Unit to optimize performance.
                            This can increase horsepower, torque, and fuel efficiency while maintaining reliability.
                            Our professional ECU remapping service unlocks hidden power that manufacturers leave unused from the factory.
                            Typical gains range from <span class="text-[#ccff00] font-semibold">15-40% more power</span> depending on your vehicle and chosen tuning stage.
                        </p>
                    </div>
                </article>

                <!-- FAQ 2 -->
                <article class="group bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden transition-all duration-300 hover:border-[#ccff00]/30">
                    <button @click="openFaq = openFaq === 2 ? null : 2"
                            class="w-full flex items-center justify-between p-5 md:p-6 text-left focus:outline-none focus:ring-2 focus:ring-[#ccff00]/50 focus:ring-inset"
                            aria-expanded="false"
                            aria-controls="faq-answer-2">
                        <h3 class="text-lg md:text-xl font-bold text-white pr-4">
                            Is Stage 1 tuning safe for my car?
                        </h3>
                        <svg class="w-6 h-6 text-[#ccff00] transform transition-transform duration-300 flex-shrink-0"
                             :class="{ 'rotate-180': openFaq === 2 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 2"
                         x-cloak
                         x-collapse
                         id="faq-answer-2"
                         class="px-5 md:px-6 pb-5 md:pb-6">
                        <p class="text-gray-400 leading-relaxed">
                            Yes, <strong>Stage 1 tuning is designed to be completely safe</strong> for your engine. Our tunes work within your engine's factory tolerances and are extensively
                            <span class="text-[#ccff00] font-semibold">dyno-tested</span> before delivery. Stage 1 requires no hardware modifications and provides optimal performance gains
                            of 15-30% while maintaining reliability. We calibrate each map to ensure safe air-fuel ratios, boost pressure, and ignition timing for longevity.
                        </p>
                    </div>
                </article>

                <!-- FAQ 3 -->
                <article class="group bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden transition-all duration-300 hover:border-[#ccff00]/30">
                    <button @click="openFaq = openFaq === 3 ? null : 3"
                            class="w-full flex items-center justify-between p-5 md:p-6 text-left focus:outline-none focus:ring-2 focus:ring-[#ccff00]/50 focus:ring-inset"
                            aria-expanded="false"
                            aria-controls="faq-answer-3">
                        <h3 class="text-lg md:text-xl font-bold text-white pr-4">
                            How much power can I gain from chiptuning?
                        </h3>
                        <svg class="w-6 h-6 text-[#ccff00] transform transition-transform duration-300 flex-shrink-0"
                             :class="{ 'rotate-180': openFaq === 3 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 3"
                         x-cloak
                         x-collapse
                         id="faq-answer-3"
                         class="px-5 md:px-6 pb-5 md:pb-6">
                        <p class="text-gray-400 leading-relaxed mb-4">
                            Power gains depend on your vehicle type and chosen tuning stage:
                        </p>
                        <ul class="space-y-2 text-gray-400">
                            <li class="flex items-start gap-2">
                                <span class="text-[#ccff00]">▸</span>
                                <span><strong class="text-white">Stage 1:</strong> 15-30% more power. No hardware modifications required.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-[#ccff00]">▸</span>
                                <span><strong class="text-white">Stage 2:</strong> 25-40% gains. Requires exhaust and intake upgrades.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-[#ccff00]">▸</span>
                                <span><strong class="text-white">Stage 3+:</strong> 40%+ gains for heavily modified engines.</span>
                            </li>
                        </ul>
                        <p class="text-gray-400 leading-relaxed mt-4">
                            <strong>Diesel vehicles</strong> often see the largest improvements, with some gaining up to <span class="text-[#ccff00] font-semibold">50% more torque</span>.
                        </p>
                    </div>
                </article>

                <!-- FAQ 4 -->
                <article class="group bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden transition-all duration-300 hover:border-[#ccff00]/30">
                    <button @click="openFaq = openFaq === 4 ? null : 4"
                            class="w-full flex items-center justify-between p-5 md:p-6 text-left focus:outline-none focus:ring-2 focus:ring-[#ccff00]/50 focus:ring-inset"
                            aria-expanded="false"
                            aria-controls="faq-answer-4">
                        <h3 class="text-lg md:text-xl font-bold text-white pr-4">
                            How long does the tuning process take?
                        </h3>
                        <svg class="w-6 h-6 text-[#ccff00] transform transition-transform duration-300 flex-shrink-0"
                             :class="{ 'rotate-180': openFaq === 4 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 4"
                         x-cloak
                         x-collapse
                         id="faq-answer-4"
                         class="px-5 md:px-6 pb-5 md:pb-6">
                        <p class="text-gray-400 leading-relaxed">
                            Our <strong>fileservice operates 24/7</strong>. Once you upload your original ECU file through our secure portal, we typically deliver your custom tune within
                            <span class="text-[#ccff00] font-semibold">1-2 hours</span>. Express service is available for urgent requests.
                            The actual flashing process in your vehicle takes only 15-30 minutes depending on your ECU type.
                        </p>
                    </div>
                </article>

                <!-- FAQ 5 -->
                <article class="group bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden transition-all duration-300 hover:border-[#ccff00]/30">
                    <button @click="openFaq = openFaq === 5 ? null : 5"
                            class="w-full flex items-center justify-between p-5 md:p-6 text-left focus:outline-none focus:ring-2 focus:ring-[#ccff00]/50 focus:ring-inset"
                            aria-expanded="false"
                            aria-controls="faq-answer-5">
                        <h3 class="text-lg md:text-xl font-bold text-white pr-4">
                            Do you support all car brands?
                        </h3>
                        <svg class="w-6 h-6 text-[#ccff00] transform transition-transform duration-300 flex-shrink-0"
                             :class="{ 'rotate-180': openFaq === 5 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 5"
                         x-cloak
                         x-collapse
                         id="faq-answer-5"
                         class="px-5 md:px-6 pb-5 md:pb-6">
                        <p class="text-gray-400 leading-relaxed">
                            Yes! We support <strong>all major car manufacturers</strong> including BMW, Mercedes-Benz, Audi, Volkswagen, Ford, Opel, Peugeot, Renault, Toyota, Honda, and many more.
                            Our database covers <span class="text-[#ccff00] font-semibold">cars, motorcycles, trucks, tractors, and marine vehicles</span>.
                            <a href="<?php echo home_url('/brands-catalog/'); ?>" class="text-[#ccff00] hover:underline">Browse our complete brand catalog</a> to find your vehicle.
                        </p>
                    </div>
                </article>

                <!-- FAQ 6 -->
                <article class="group bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 overflow-hidden transition-all duration-300 hover:border-[#ccff00]/30">
                    <button @click="openFaq = openFaq === 6 ? null : 6"
                            class="w-full flex items-center justify-between p-5 md:p-6 text-left focus:outline-none focus:ring-2 focus:ring-[#ccff00]/50 focus:ring-inset"
                            aria-expanded="false"
                            aria-controls="faq-answer-6">
                        <h3 class="text-lg md:text-xl font-bold text-white pr-4">
                            What additional tuning options are available?
                        </h3>
                        <svg class="w-6 h-6 text-[#ccff00] transform transition-transform duration-300 flex-shrink-0"
                             :class="{ 'rotate-180': openFaq === 6 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 6"
                         x-cloak
                         x-collapse
                         id="faq-answer-6"
                         class="px-5 md:px-6 pb-5 md:pb-6">
                        <p class="text-gray-400 leading-relaxed mb-4">
                            Beyond standard Stage tuning, we offer a full range of <strong>ECU modifications</strong>:
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="flex items-center gap-2 text-gray-400">
                                <span class="w-2 h-2 rounded-full bg-[#ccff00]"></span>
                                <span>Pop & Bangs / Crackle Map</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-400">
                                <span class="w-2 h-2 rounded-full bg-[#ccff00]"></span>
                                <span>Vmax / Speed Limiter Off</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-400">
                                <span class="w-2 h-2 rounded-full bg-[#ccff00]"></span>
                                <span>DPF / FAP Delete</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-400">
                                <span class="w-2 h-2 rounded-full bg-[#ccff00]"></span>
                                <span>EGR Off Solution</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-400">
                                <span class="w-2 h-2 rounded-full bg-[#ccff00]"></span>
                                <span>AdBlue / SCR Delete</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-400">
                                <span class="w-2 h-2 rounded-full bg-[#ccff00]"></span>
                                <span>E85 FlexFuel Conversion</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-400">
                                <span class="w-2 h-2 rounded-full bg-[#ccff00]"></span>
                                <span>Launch Control</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-400">
                                <span class="w-2 h-2 rounded-full bg-[#ccff00]"></span>
                                <span>Start/Stop Disable</span>
                            </div>
                        </div>
                    </div>
                </article>

            </div>

            <!-- CTA After FAQ -->
            <div class="text-center mt-12">
                <p class="text-gray-400 mb-6">Still have questions? Our experts are here to help.</p>
                <a href="<?php echo home_url('/contact/'); ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-white hover:border-[#ccff00]/50 hover:text-[#ccff00] transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Contact Support
                </a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();