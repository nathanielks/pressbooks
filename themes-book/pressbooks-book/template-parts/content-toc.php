<?php global $blog_id; $book = pb_get_book_structure(); ?>
<h2><?php _e('Table of Contents', 'pressbooks'); ?></h2>
<ul class="pb-book-theme pb-book-toc" id="pb-table-of-contents">
	<li id="front-matter">
		<h4><?php _e( 'Front Matter', 'pressbooks' ); ?></h4>
		<ul>
			<?php foreach ( $book['front-matter'] as $fm ) : ?>
			<?php if ( $fm['post_status'] !== 'publish' ) {
				if ( !current_user_can_for_blog( $blog_id, 'read_private_posts' ) ) {
					if ( current_user_can_for_blog( $blog_id, 'read' ) ) {
						if ( absint( get_option( 'permissive_private_content' ) ) !== 1 ) continue; // Skip
					} elseif ( !current_user_can_for_blog( $blog_id, 'read' ) ) {
						 continue; // Skip
					}
				}
			} ?>
			<li class="front-matter <?php echo pb_get_section_type( get_post($fm['ID'] ) ); ?>"><a href="<?php echo get_permalink( $fm['ID'] ); ?>"><?php echo pb_strip_br( $fm['post_title'] );?></a>
				<?php if ( pb_should_parse_sections() ) :
				$sections = pb_get_sections( $fm['ID'] );
				if ($sections) :
				$s = 1; ?>
				<ul class="sections">
					<?php foreach ( $sections as $id => $name ) : ?>
					<li class="section"><a href="<?php echo get_permalink($fm['ID']); ?>#<?php echo $id; ?>"><?php echo $name; ?></a></li>
					<?php endforeach; ?>
          		</ul>
		  		<?php endif;
			  	endif; ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</li> <!-- #front-matter -->
	<?php foreach ( $book['part'] as $part ) : ?>
	<li id="part-<?php echo $part['ID']; ?>"><h4><?php if ( count( $book['part'] ) > 1 || get_post_meta( $part['ID'], 'pb_part_invisible', true ) !== 'on' ) { ?>
	<?php if ( get_post_meta( $part['ID'], 'pb_part_content', true ) ) { ?><a href="<?php echo get_permalink($part['ID']); ?>"><?php } ?>
	<?php echo $part['post_title']; ?>
	<?php if ( get_post_meta( $part['ID'], 'pb_part_content', true ) ) { ?></a><?php } ?>
	<?php } ?></h4>
		<ul class="chapters">
			<?php foreach ($part['chapters'] as $chapter) : ?>
				<?php if ( $chapter['post_status'] !== 'publish' ) {
					if ( !current_user_can_for_blog( $blog_id, 'read_private_posts' ) ) {
						if ( current_user_can_for_blog( $blog_id, 'read' ) ) {
							if ( absint( get_option( 'permissive_private_content' ) ) !== 1 ) continue; // Skip
						} elseif ( !current_user_can_for_blog( $blog_id, 'read' ) ) {
							 continue; // Skip
						}
					}
				} ?>
				<li class="chapter <?php echo pb_get_section_type( get_post( $chapter['ID'] ) ); ?>"><a href="<?php echo get_permalink( $chapter['ID'] ); ?>"><?php echo pb_strip_br( $chapter['post_title'] ); ?></a>
                <?php if ( pb_should_parse_sections() ) {
                $sections = pb_get_sections( $chapter['ID'] );
                if ( $sections ) {
					$s = 1; ?>
					<ul class="sections">
					<?php foreach ( $sections as $id => $name ) { ?>
						<li class="section"><a href="<?php echo get_permalink( $chapter['ID'] ); ?>#<?php echo $id; ?>"><?php echo $name; ?></a></li>
					<?php } ?>
					</ul>
				<?php }
				} ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</li> <!-- #part-<?php echo $part['ID']; ?> -->
	<?php endforeach; ?>
	<li id="back-matter">
		<h4><?php _e( 'Back Matter', 'pressbooks' ); ?></h4>
		<ul>
			<?php foreach ( $book['back-matter'] as $bm ) : ?>
			<?php if ( $bm['post_status'] !== 'publish' ) {
				if ( !current_user_can_for_blog( $blog_id, 'read_private_posts' ) ) {
					if ( current_user_can_for_blog( $blog_id, 'read' ) ) {
						if ( absint( get_option( 'permissive_private_content' ) ) !== 1 ) continue; // Skip
					} elseif ( !current_user_can_for_blog( $blog_id, 'read' ) ) {
						 continue; // Skip
					}
				}
			} ?>
			<li class="back-matter <?php echo pb_get_section_type( get_post( $bm['ID'] ) ); ?>"><a href="<?php echo get_permalink( $bm['ID'] ); ?>"><?php echo pb_strip_br( $bm['post_title'] );?></a>
                <?php if ( pb_should_parse_sections() ) {
                $sections = pb_get_sections( $bm['ID'] );
                if ( $sections ) {
					$s = 1; ?>
					<ul class="sections">
					<?php foreach ( $sections as $id => $name ) { ?>
						<li class="section"><a href="<?php echo get_permalink( $bm['ID'] ); ?>#<?php echo $id; ?>"><?php echo $name; ?></a></li>
					<?php } ?>
					</ul>
				<?php }
				} ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</li> <!-- #back-matter -->
</ul> <!-- #toc -->