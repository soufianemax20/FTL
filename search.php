<?php
/**
 * The template for displaying Search Results pages
 *
 * @package Tuning Mania
 */

get_header();
?>

<main id="primary" class="site-main bg-[#020617] text-white font-inter min-h-screen pt-12 pb-20">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <header class="mb-12 text-center">
            <h1 class="text-3xl md:text-5xl font-black font-orbitron uppercase mb-4">
                Search Results for: <span class="text-lime-400"><?php echo get_search_query(); ?></span>
            </h1>
            <div class="h-1 w-24 bg-lime-400 mx-auto shadow-[0_0_15px_#bef264]"></div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if ( have_posts() ) : ?>
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-[#111] border border-[#222] rounded-xl p-6 hover:border-lime-400/50 transition-all duration-300 group'); ?>>
                        <header class="entry-header mb-4">
                            <?php the_title( sprintf( '<h2 class="entry-title text-xl font-bold font-orbitron text-white mb-2"><a href="%s" rel="bookmark" class="group-hover:text-lime-400 transition-colors">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                            <?php if ( 'post' === get_post_type() ) : ?>
                            <div class="entry-meta text-xs text-gray-500 uppercase tracking-wider">
                                <?php echo get_the_date(); ?>
                            </div>
                            <?php endif; ?>
                        </header>

                        <div class="entry-summary text-gray-400 text-sm leading-relaxed mb-4 line-clamp-3">
                            <?php the_excerpt(); ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-lime-400 text-sm font-bold uppercase tracking-wider hover:text-white transition-colors">
                            Read More <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </article>
                <?php endwhile; ?>

                <div class="col-span-full mt-12">
                    <?php
                    the_posts_navigation( array(
                        'prev_text' => '<span class="px-6 py-3 bg-[#222] rounded-full text-white hover:bg-lime-400 hover:text-black font-bold transition-colors">Previous</span>',
                        'next_text' => '<span class="px-6 py-3 bg-[#222] rounded-full text-white hover:bg-lime-400 hover:text-black font-bold transition-colors">Next</span>',
                    ) );
                    ?>
                </div>

            <?php else : ?>

                <div class="col-span-full text-center py-20 bg-[#111] border border-[#222] rounded-2xl">
                    <h2 class="text-2xl font-bold text-gray-400 mb-4">Nothing Found</h2>
                    <p class="text-gray-500 mb-8">Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
                    <?php get_search_form(); ?>
                </div>

            <?php endif; ?>
        </div>

    </div>
</main>

<?php
get_footer();
