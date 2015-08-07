<?php
/**
 * The sidebar containing the main navigation area.
 *
 * @package Luther
 */
?>

<div id="secondary" class="widget-area" role="complementary">
<?php global $blog_id; ?>
<?php if ( is_single() ) : ?>
	<?php if ( get_option( 'blog_public' ) == '1' || ( get_option( 'blog_public' ) == '0' && current_user_can_for_blog( $blog_id, 'read' ) ) ) : ?>
		<ul id="booknav">
			<?php if ( current_user_can_for_blog( $blog_id, 'edit_posts' ) || is_super_admin() ) : ?>
			<li class="admin-btn"><a href="<?php echo get_option( 'home' ); ?>/wp-admin"><?php _e( 'Admin', 'pressbooks' ); ?></a></li>
			<?php endif; ?>
			<li class="home-btn"><a href="<?php echo get_option( 'home' ); ?>"><?php _e( 'Home', 'pressbooks' ); ?></a></li>
			<li class="toc-btn"><a href="<?php echo get_option( 'home' ); ?>/table-of-contents"><?php _e( 'Table of Contents', 'pressbooks' ); ?></a></li>
		</ul>
		<?php if ( is_single() ): ?>
		<div id="toc-container">
			<a href="#" class="close"><?php _e( 'Close', 'pressbooks' ); ?></a>
			<?php get_template_part( 'template-parts/content', 'toc' ); ?>
		</div> <!-- #toc-container -->
		<?php endif; endif; endif; ?>

</div><!-- #secondary -->
