<?php
/**
 * Template part for displaying posts.
 *
 * @package Luther
 */

?>

<?php $metadata = pb_get_book_information(); pb_get_links( false ); ?>
	<!-- Book Branding -->
	<div class="pb-book-theme pb-book-branding site-width clear">

		<!-- Book info -->
		<div class="pb-book-branding-info">
			<h1 class="pb-book-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

			<?php if ( ! empty( $metadata['pb_author'] ) ): ?>
				<p class="pb-book-author"><?php echo $metadata['pb_author']; ?></p>
			<?php endif; ?>

			<?php if ( ! empty( $metadata['pb_about_140'] ) ) : ?>
				<p class="pb-sub-title"><?php echo $metadata['pb_about_140']; ?></p>
			<?php endif; ?>

			<?php if ( ! empty( $metadata['pb_about_50'] ) ): ?>
				<p class="pb-book-blurb"><?php echo pb_decode( $metadata['pb_about_50'] ); ?></p>
			<?php endif; ?>

			<!-- Book CTAs -->
			<div class="call-to-action-wrap">
				<?php global $first_chapter; ?>
				<div class="call-to-action">
					<a class="pb-btn red" href="<?php global $first_chapter; echo $first_chapter; ?>"><?php _e('Read', 'pressbooks'); ?></a>

					<?php if ( @array_filter( get_option( 'pressbooks_ecommerce_links' ) ) ) : ?>
					 <!-- Buy -->
						 <a class="pb-btn black" href="<?php echo get_option('home'); ?>/buy"></span><?php _e('Buy', 'pressbooks'); ?></a>
					 <?php endif; ?>
				</div> <!-- end .call-to-action -->
			</div>
		</div> <!-- end .book-info -->

		<!-- Book Image -->
		<?php if ( ! empty( $metadata['pb_cover_image'] ) ): ?>
		<div class="pb-book-cover">
				<img src="<?php echo $metadata['pb_cover_image']; ?>" alt="book-cover" title="<?php bloginfo( 'name' ); ?> book cover" />
		</div>
		<?php endif; ?>

	</div><!-- .Book-branding -->