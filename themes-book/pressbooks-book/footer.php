<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Luther
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="pb-book-theme site-footer" role="contentinfo">
		<div class="book-meta clear">
			<?php if (get_option('blog_public') == '1' || is_user_logged_in()): ?>

				<dl class="book-meta-list clear">
					<dt><?php _e('Book Name', 'pressbooks'); ?>:</dt>
					<dd><?php bloginfo('name'); ?></dd>

					<?php global $metakeys; ?>
					<?php $metadata = pb_get_book_information();?>
					<?php foreach ($metadata as $key => $val): ?>
					<?php if ( isset( $metakeys[$key] ) && ! empty( $val ) ): ?>
						<dt><?php _e($metakeys[$key], 'pressbooks'); ?>:</dt>
						<dd><?php if ( 'pb_publication_date' == $key ) { $val = date_i18n( 'F j, Y', absint( $val ) );  } echo $val; ?></dd>
					<?php endif; ?>
					<?php endforeach; ?>

					<?php
					// Copyright
					echo '<dt>' . __( 'Copyright', 'pressbooks' ) . ':</dt><dd>';
					echo ( ! empty( $metadata['pb_copyright_year'] ) ) ? $metadata['pb_copyright_year'] : date( 'Y' );
					if ( ! empty( $metadata['pb_copyright_holder'] ) ) echo ' ' . __( 'by', 'pressbooks' ) . ' ' . $metadata['pb_copyright_holder'] . '. ';
					echo "</dd>\n";
					?>

					</dl>

				<?php echo pressbooks_copyright_license(); ?>

			<?php endif; ?>
		</div><!-- .book-meta -->

		<div class="site-info">
			<p class="cie-name"><a href="http://pressbooks.com"><?php printf( esc_html__( 'PressBooks.com: Simple Book Production', 'pressbooks')); ?></a></p>
		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
