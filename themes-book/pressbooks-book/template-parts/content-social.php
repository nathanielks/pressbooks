<?php $chapter_buttons = get_option( 'pressbooks_theme_options_web' );
if ( isset( $chapter_buttons['social_media'] ) && $chapter_buttons['social_media'] == 1 ) { ?>
<div id="share" class="sharrre-wrap">
	<div id="twitter" data-url="<?php the_permalink(); ?>" data-text="Check out this great book on PressBooks." data-title="Tweet"></div>
	<div id="facebook" data-url="<?php the_permalink(); ?>" data-text="Check out this great book on PressBooks." data-title="Like"></div>
	<div id="googleplus" data-url="<?php the_permalink(); ?>" data-text="Check out this great book on PressBooks." data-title="+1"></div>
</div> <!-- #share -->
<?php } ?>