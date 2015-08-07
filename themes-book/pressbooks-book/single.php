<?php
/**
 * The template for displaying all single posts.
 *
 * @package Luther
 */

if ( get_option('blog_public') == '1' || ( get_option('blog_public') == '0' && current_user_can_for_blog( $blog_id, 'read' ) ) ) : ?>

<?php get_header(); ?>
	<main id="main" class="site-main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php pb_get_links(); ?>
		<?php get_template_part( 'template-parts/content', 'single' ); ?>
		
		<?php get_template_part( 'template-parts/content', 'social' ); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>

	<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->

	<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php else: ?>
	<?php pb_private(); ?>
<?php endif; ?>
