<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Tuning Mania
 */

get_header();
?>

<main id="primary" class="site-main bg-[#020617] text-white font-inter min-h-screen flex items-center justify-center">

    <div class="text-center px-4">

        <!-- 404 Neon Glitch Effect -->
        <h1 class="text-[150px] md:text-[200px] font-black font-orbitron leading-none text-transparent bg-clip-text bg-gradient-to-b from-lime-400 to-transparent opacity-50 select-none">
            404
        </h1>

        <div class="relative -mt-16 md:-mt-24 z-10">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 font-orbitron uppercase">
                Engine Stalled?
            </h2>
            <p class="text-gray-400 text-lg max-w-lg mx-auto mb-8">
                Looks like you've taken a wrong turn. This page doesn't exist or has been moved to another garage.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="<?php echo home_url('/'); ?>" class="px-8 py-3 bg-lime-400 text-black font-bold uppercase rounded-full hover:bg-white transition-colors">
                    Back to Home
                </a>
                <a href="<?php echo home_url('/vehicle-search/'); ?>" class="px-8 py-3 border border-white/20 text-white font-bold uppercase rounded-full hover:border-lime-400 hover:text-lime-400 transition-colors">
                    Search Vehicle
                </a>
            </div>
        </div>

    </div>

</main>

<?php
get_footer();
