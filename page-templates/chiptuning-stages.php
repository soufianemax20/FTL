<?php
/**
 * Template Name: Chiptuning Stages Overview
 *
 * This is the template for displaying an overview of chiptuning stages,
 * explaining the benefits and what each stage offers.
 *
 * @package Tuning_Mania
 */

get_header(); ?>

<main id="primary" class="site-main bg-neutral-950 text-white min-h-screen pt-24 pb-12" data-barba="container" data-barba-namespace="chiptuning-stages">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <header class="page-header text-center mb-10 md:mb-16">
            <h1 class="text-3xl md:text-6xl font-black uppercase italic mb-4">
                Mastering Your <span class="text-neon-yellow">Chiptuning Stages</span>
            </h1>
            <p class="text-gray-400 text-base md:text-lg max-w-2xl mx-auto">
                Discover the different levels of performance upgrades available for your vehicle.
            </p>
            <div class="h-1 w-20 bg-lime-400 mx-auto shadow-[0_0_15px_#ccff00] mt-6"></div>
        </header>

        <div class="page-content bg-[#0b0f19] rounded-xl p-6 md:p-12 border border-white/10 shadow-2xl relative">
            <div class="prose prose-invert max-w-none text-gray-300">
                <h2 class="text-neon-yellow text-2xl md:text-3xl mb-4 font-black italic uppercase">Stage 1: Optimized Daily Driving</h2>
                <p>Stage 1 tuning is designed for vehicles with stock hardware, offering significant power and torque increases without requiring any mechanical modifications. It's the most popular and cost-effective upgrade, improving throttle response, acceleration, and often fuel efficiency under normal driving conditions.</p>
                <ul>
                    <li><strong>Typical Gains:</strong> 15-30% HP & Torque</li>
                    <li><strong>Hardware Required:</strong> None (Stock)</li>
                    <li><strong>Benefits:</strong> Improved drivability, better acceleration, potential fuel savings.</li>
                </ul>

                <h2 class="text-neon-yellow text-2xl md:text-3xl mt-8 mb-4 font-black italic uppercase">Stage 2: Enhanced Performance</h2>
                <p>For enthusiasts looking for more, Stage 2 tuning builds upon Stage 1 and often requires minor hardware upgrades like a performance air intake, upgraded exhaust system (downpipe), or intercooler. This allows for more aggressive tuning, pushing the vehicle closer to its performance limits while maintaining reliability.</p>
                <ul>
                    <li><strong>Typical Gains:</strong> 25-40% HP & Torque</li>
                    <li><strong>Hardware Required:</strong> Performance Intake, Upgraded Exhaust, Intercooler (recommended)</li>
                    <li><strong>Benefits:</strong> More aggressive power delivery, louder exhaust note (if applicable), optimized for hardware mods.</li>
                </ul>

                <h2 class="text-neon-yellow text-2xl md:text-3xl mt-8 mb-4 font-black italic uppercase">Stage 3 & Beyond: Ultimate Customization</h2>
                <p>Stage 3 and higher levels of tuning are for highly modified vehicles, typically involving turbocharger upgrades, fuel system enhancements, and forged internals. These stages are custom-tailored to specific vehicle builds and require extensive dyno testing and specialized knowledge.</p>
                <ul>
                    <li><strong>Typical Gains:</strong> 40%+ HP & Torque (highly variable)</li>
                    <li><strong>Hardware Required:</strong> Major engine/turbo modifications</li>
                    <li><strong>Benefits:</strong> Maximum performance, track-oriented setups, highly personalized tuning.</li>
                </ul>

                <div class="text-center mt-12">
                    <p class="text-lg text-white mb-6">Ready to find the perfect stage for your ride?</p>
                    <a href="<?php echo home_url('/vehicle-search/'); ?>" class="btn-lambo">
                        <span>Find My Vehicle</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main><!-- #primary -->

<?php
get_footer();
