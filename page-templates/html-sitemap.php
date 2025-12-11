<?php
/**
 * Template Name: HTML Sitemap
 * Description: A user-friendly sitemap for the Mobile Web App "Map" feature.
 *
 * @package Tuning_Mania
 */

get_header();
?>

<main id="primary" class="site-main bg-[#0D0D0D] text-white min-h-screen pt-24 pb-20">
    <div class="container mx-auto px-4 max-w-4xl">

        <!-- Header -->
        <header class="text-center mb-12">
            <h1 class="text-3xl md:text-5xl font-black uppercase italic mb-4">
                Site <span class="text-[#ccff00]">Map</span>
            </h1>
            <p class="text-gray-400">Quickly navigate to any section of our application.</p>
        </header>

        <!-- Main Sections Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">

            <!-- Core Pages -->
            <div class="bg-[#151922] border border-white/10 rounded-xl p-6">
                <h2 class="text-xl font-bold uppercase mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#ccff00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Main Navigation
                </h2>
                <ul class="space-y-3">
                    <li><a href="<?php echo home_url('/'); ?>" class="flex items-center text-gray-300 hover:text-[#ccff00] transition-colors">
                        <span class="w-1.5 h-1.5 bg-[#ccff00] rounded-full mr-3"></span> Home
                    </a></li>
                    <li><a href="<?php echo function_exists('ctr_print_full_start_url') ? ctr_print_full_start_url(false) : home_url('/chip-tuning/'); ?>" class="flex items-center text-gray-300 hover:text-[#ccff00] transition-colors">
                        <span class="w-1.5 h-1.5 bg-gray-600 rounded-full mr-3"></span> Vehicle Search
                    </a></li>
                    <li><a href="<?php echo home_url('/brands-catalog/'); ?>" class="flex items-center text-gray-300 hover:text-[#ccff00] transition-colors">
                        <span class="w-1.5 h-1.5 bg-gray-600 rounded-full mr-3"></span> Brands Catalog
                    </a></li>
                    <li><a href="<?php echo home_url('/fileservice/'); ?>" class="flex items-center text-gray-300 hover:text-[#ccff00] transition-colors">
                        <span class="w-1.5 h-1.5 bg-gray-600 rounded-full mr-3"></span> Fileservice Upload
                    </a></li>
                    <li><a href="<?php echo home_url('/contact/'); ?>" class="flex items-center text-gray-300 hover:text-[#ccff00] transition-colors">
                        <span class="w-1.5 h-1.5 bg-gray-600 rounded-full mr-3"></span> Support / Contact
                    </a></li>
                </ul>
            </div>

            <!-- Vehicle Categories -->
            <div class="bg-[#151922] border border-white/10 rounded-xl p-6">
                <h2 class="text-xl font-bold uppercase mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#ccff00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Tuning Categories
                </h2>
                <ul class="space-y-3">
                    <?php
                    $cats = ['Cars', 'Trucks', 'Tractors', 'Bikes', 'Boats'];
                    foreach($cats as $cat):
                        $slug = strtolower($cat);
                        // Adjust slug for plugin specific if needed
                        if($slug == 'bikes') $slug = 'bikesquad';
                        if($slug == 'boats') $slug = 'motorboats';
                    ?>
                    <li><a href="<?php echo function_exists('ctr_print_full_start_url') ? ctr_print_full_start_url(false) : home_url('/chip-tuning/'); ?>?type=<?php echo $slug; ?>" class="flex items-center text-gray-300 hover:text-[#ccff00] transition-colors">
                        <span class="w-1.5 h-1.5 bg-gray-600 rounded-full mr-3"></span> <?php echo $cat; ?>
                    </a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

        <!-- XML Sitemap Link -->
        <div class="text-center pt-8 border-t border-white/10">
            <p class="text-sm text-gray-500 mb-4">Looking for the raw XML sitemap for bots?</p>
            <a href="<?php echo home_url('/ctr_sitemap.xml'); ?>" class="inline-flex items-center px-4 py-2 bg-white/5 rounded-lg text-xs font-mono text-[#ccff00] border border-[#ccff00]/20 hover:bg-[#ccff00]/10 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                View XML Sitemap
            </a>
        </div>

    </div>
</main>

<?php get_footer(); ?>
