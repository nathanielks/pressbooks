	<!-- Book Description -->
	<section class="pb-book-theme book-info bg-alt-color clear">

		<div class="site-width">

			<div class="book-info-description">
				<?php $metadata = pb_get_book_information();?>
				<h3><?php _e('Book Description', 'pressbooks'); ?></h3>
					<?php if ( ! empty( $metadata['pb_about_unlimited'] ) ): ?>
						<p><?php
							$about_unlimited = pb_decode( $metadata['pb_about_unlimited'] );
							$about_unlimited = preg_replace( '/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $about_unlimited ); // Make valid HTML by removing first <p> and last </p>
							echo $about_unlimited; ?></p>
					<?php endif; ?>	
			</div><!-- .book-info-description -->

			<?php	$args = $args = array(
						'post_type' => 'back-matter',
						'tax_query' => array(
							array(
							'taxonomy' => 'back-matter-type',
							'field' => 'slug',
							'terms' => 'about-the-author'
							)
						)
					); ?>

			<div class="book-info-author">

				<?php $loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<h3 class="book-info-author-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
					<?php  echo '<div class="entry-content">';
						the_excerpt();
					echo '</div>';
					endwhile; ?>

				<?php get_template_part( 'template-parts/content', 'social' ); ?>
				
			</div><!-- .book-info-author -->
		</div><!-- .site-width -->
	</section>