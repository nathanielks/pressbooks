<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Luther
 */

get_header(); ?>


	<main id="main" class="site-main" role="main">

		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header>
				<h1 class="page-title"><?php _e('Table of Contents', 'pressbooks'); ?></h1>
			</header>
			<?php get_template_part( 'template-parts/content', 'toc' ); ?>
		
		<?php else : ?>
	
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
	
		<?php endif; ?>

	</main><!-- #main -->


<?php get_footer(); ?>
