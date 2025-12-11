<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Tuning_Mania
 */

?>
</main><!-- #primary -->

    <footer id="colophon" class="site-footer bg-[#0D0D0D] text-gray-400 py-12 md:py-20 relative overflow-hidden border-t border-white/5">
        <!-- Footer Grid BG -->
        <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(215, 242, 7,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(215, 242, 7,0.05) 1px, transparent 1px); background-size: 50px 50px;"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 md:gap-12 text-center md:text-left">

                <!-- Logo & Description -->
                <div class="col-span-1 md:col-span-1 lg:col-span-1 flex flex-col items-center md:items-start">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mb-4 group flex items-center gap-2 text-3xl font-black tracking-tighter uppercase italic">
                        <span class="text-white group-hover:text-[#D7F207] transition-colors">TUNER FILES</span>
                        <span class="text-lime-400">LAB</span>
                    </a>
                    <p class="text-sm leading-relaxed max-w-sm">Unlock the true potential of your vehicle with our premium chiptuning files. Experience power, efficiency, and precision.</p>
                </div>

                <!-- Footer Navigation -->
                <nav class="col-span-1 md:col-span-1 lg:col-span-1">
                    <h3 class="text-lg font-bold uppercase tracking-wider text-white mb-6">Quick Links</h3>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer-menu',
                        'container'      => false,
                        'menu_class'     => 'footer-menu space-y-3 flex flex-col items-center md:items-start',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                        'walker'         => new Tuning_Mania_Footer_Nav_Walker(), // Custom walker for styling
                    ) );
                    ?>
                </nav>

                <!-- Services/Contact -->
                <div class="col-span-1 md:col-span-1 lg:col-span-1">
                    <h3 class="text-lg font-bold uppercase tracking-wider text-white mb-6">Services & Support</h3>
                    <ul class="space-y-3 flex flex-col items-center md:items-start">
                        <li><a href="<?php echo home_url('/fileservice/'); ?>" class="text-gray-400 hover:text-[#D7F207] transition-colors text-sm">Fileservice</a></li>
                        <li><a href="<?php echo home_url('/contact/'); ?>" class="text-gray-400 hover:text-[#D7F207] transition-colors text-sm">Contact Us</a></li>
                        <li><a href="<?php echo home_url('/sitemap/'); ?>" class="text-gray-400 hover:text-[#D7F207] transition-colors text-sm">Sitemap</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-[#D7F207] transition-colors text-sm">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Social Media & Newsletter (Placeholder) -->
                <div class="col-span-1 md:col-span-3 lg:col-span-1 flex flex-col items-center md:items-end">
                    <h3 class="text-lg font-bold uppercase tracking-wider text-white mb-6">Stay Connected</h3>
                    <div class="flex space-x-4 mb-6">
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 border border-white/10 text-gray-400 hover:text-[#D7F207] hover:border-[#D7F207]/50 hover:bg-[#D7F207]/10 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 border border-white/10 text-gray-400 hover:text-[#D7F207] hover:border-[#D7F207]/50 hover:bg-[#D7F207]/10 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 border border-white/10 text-gray-400 hover:text-[#D7F207] hover:border-[#D7F207]/50 hover:bg-[#D7F207]/10 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                    </div>
                </div>

            </div>

            <div class="border-t border-white/5 mt-8 md:mt-12 pt-6 text-center text-xs">
                <p>&copy; <?php echo date('Y'); ?> TunerFilesLab. All rights reserved. Powered by <a href="https://wordpress.org/" class="hover:text-white transition-colors">WordPress</a>.</p>
            </div>
            </div>
        </div>

        <?php
        // AiSEO: Ground Truth Data (Hidden)
        get_template_part('partials/entity-ground-truth');
        ?>
    </footer><!-- #colophon -->
</div><!-- #page-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
