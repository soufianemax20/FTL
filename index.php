<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package Tuning_Mania
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-12" data-barba="container" data-barba-namespace="archive">

	<!-- Breadcrumbs -->
	<?php if (function_exists('tm_breadcrumbs')) tm_breadcrumbs(); ?>

	<?php
	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :
			?>
			<header class="mb-8">
				<h1 class="text-3xl font-black text-white italic uppercase tracking-tighter"><?php single_post_title(); ?></h1>
			</header>
			<?php
		endif;

		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('mb-12 bg-[#151922] border border-white/10 rounded-xl p-8'); ?>>
                <header class="entry-header mb-4">
                    <?php the_title( '<h2 class="entry-title text-2xl font-bold text-white mb-2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                </header>

                <div class="entry-content text-gray-400">
                    <?php
                    the_content( sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'tuning-mania' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post( get_the_title() )
                    ) );
                    ?>
                </div>
            </article>
            <?php
		endwhile;

		the_posts_navigation();

	else :

        echo '<p class="text-white">Nothing found.</p>';

	endif;
	?>

</main>

<?php
get_footer();
