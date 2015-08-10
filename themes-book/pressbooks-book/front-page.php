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

	<?php if ( have_posts() ) : ?>

		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>


			<!-- Book Branding-->
			<?php get_template_part( 'template-parts/content', 'front-page-book-branding' );?>


			<!-- Book Description -->
			<?php get_template_part( 'template-parts/content', 'front-page-book-description' );?>


			<!-- Book Table of Contents -->
			<?php get_template_part( 'template-parts/content', 'front-page-toc' ); ?>


		<?php endwhile; ?>

		<?php the_posts_navigation(); ?>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>

	</main><!-- #main -->

<?php get_footer(); ?>
