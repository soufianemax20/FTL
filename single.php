<?php
/**
 * The template for displaying all single posts
 *
 * @package Tuning_Mania
 */

get_header();
?>

<main id="primary" class="site-main bg-[#050505] text-white font-inter min-h-screen pt-20 pb-20 relative overflow-hidden">

    <!-- GLOBAL 3D BACKGROUND (Internal Pages) -->
    <div id="page-3d-bg" class="absolute inset-0 z-0 opacity-50 pointer-events-none"></div>

    <!-- BACKGROUND TEXTURES -->
    <div class="absolute inset-0 z-0 pointer-events-none"
         style="background-image: radial-gradient(rgba(215, 242, 7, 0.03) 1px, transparent 1px); background-size: 40px 40px;">
    </div>

    <!-- Breadcrumbs -->
    <div class="relative z-10 pt-4 px-4 container mx-auto">
        <?php if (function_exists('tm_breadcrumbs')) tm_breadcrumbs(); ?>
    </div>

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <!-- Post Header -->
        <header class="relative py-12 mb-8 overflow-hidden z-10 text-center">
            <div class="container mx-auto px-4 max-w-4xl">
                <div class="inline-block px-3 py-1 mb-4 rounded-full bg-[#D7F207]/10 text-[#D7F207] text-xs font-bold uppercase tracking-widest border border-[#D7F207]/20">
                    <?php
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        echo esc_html( $categories[0]->name );
                    } else {
                        echo 'Update';
                    }
                    ?>
                </div>

                <h1 class="text-3xl md:text-5xl font-black text-white font-orbitron uppercase tracking-wide mb-6 drop-shadow-lg leading-tight">
                    <?php the_title(); ?>
                </h1>

                <div class="flex items-center justify-center gap-6 text-sm text-gray-500 uppercase tracking-widest">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <?php echo get_the_date(); ?>
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <?php the_author(); ?>
                    </span>
                </div>
            </div>
        </header>

        <!-- Post Content -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <article id="post-<?php the_ID(); ?>" class="bg-[#0a0a0a]/80 backdrop-blur-md border border-white/10 rounded-2xl p-8 md:p-12 shadow-2xl relative overflow-hidden">

                <?php if(has_post_thumbnail()): ?>
                <div class="mb-10 -mx-8 -mt-8 md:-mx-12 md:-mt-12 h-[300px] md:h-[400px] overflow-hidden relative border-b border-white/10">
                    <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']); ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] to-transparent opacity-50"></div>
                </div>
                <?php endif; ?>

                <div class="entry-content text-gray-300 leading-relaxed font-light prose prose-invert prose-lg max-w-none prose-headings:font-orbitron prose-headings:uppercase prose-headings:italic prose-a:text-[#D7F207] prose-a:no-underline hover:prose-a:underline">
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
            </article>

            <!-- Navigation -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();

                if($prev_post): ?>
                <a href="<?php echo get_permalink($prev_post); ?>" class="group p-6 bg-white/5 border border-white/10 rounded-xl hover:border-[#D7F207]/30 transition-all text-left">
                    <span class="block text-xs text-gray-500 uppercase tracking-widest mb-2">Previous</span>
                    <h3 class="text-white font-bold group-hover:text-[#D7F207] transition-colors truncate"><?php echo get_the_title($prev_post); ?></h3>
                </a>
                <?php endif;

                if($next_post): ?>
                <a href="<?php echo get_permalink($next_post); ?>" class="group p-6 bg-white/5 border border-white/10 rounded-xl hover:border-[#D7F207]/30 transition-all text-right md:col-start-2">
                    <span class="block text-xs text-gray-500 uppercase tracking-widest mb-2">Next</span>
                    <h3 class="text-white font-bold group-hover:text-[#D7F207] transition-colors truncate"><?php echo get_the_title($next_post); ?></h3>
                </a>
                <?php endif; ?>
            </div>

        </div>

        <?php
    endwhile; // End of the loop.
    ?>

</main>

<?php
get_footer();