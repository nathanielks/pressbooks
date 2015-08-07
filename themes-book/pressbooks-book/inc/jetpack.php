<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Luther
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function pressbooks_book_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'pressbooks_book_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function pressbooks_book_jetpack_setup
add_action( 'after_setup_theme', 'pressbooks_book_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function pressbooks_book_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function pressbooks_book_infinite_scroll_render
