<?php
/**
 * The template for displaying all single posts.
 *
 * @package Luther
 */

if ( get_option('blog_public') == '1' || ( get_option('blog_public') == '0' && current_user_can_for_blog( $blog_id, 'read' ) ) ) : ?>

<?php get_header(); ?>
<?php $metadata = pb_get_book_information();?>
	<main id="main" class="site-main site-width-inner clear" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="pb-book-theme pb-book-branding">
			<div class="pb-book-branding-info">

				<a class="pb-book-title" href="<?php echo get_bloginfo( 'url' ); ?>"><?php echo get_bloginfo( 'name'); ?></a>
				<?php if ( ! empty( $metadata['pb_author'] ) ): ?>
					<p class="pb-book-author"><?php echo $metadata['pb_author']; ?></p>
				<?php endif; ?>
			</div>
		</div>

		<?php get_template_part( 'template-parts/content', 'single' ); ?>
		
		<?php get_template_part( 'template-parts/content', 'social' ); ?>

		<?php pb_get_links(); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>

	<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->

<?php get_footer(); ?>
<?php else: ?>
	<?php pb_private(); ?>
<?php endif; ?>
