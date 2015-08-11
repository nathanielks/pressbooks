<?php
/**
 * Luther functions and definitions
 *
 * @package Luther
 */

if ( ! function_exists( 'pressbooks_book_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pressbooks_book_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Luther, use a find and replace
	 * to change 'pressbooks' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'pressbooks', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured-image-post', 600, 99999, false );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'pressbooks' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif; // pressbooks_book_setup
add_action( 'after_setup_theme', 'pressbooks_book_setup' );


// Turn off admin bar
add_filter( 'show_admin_bar', function () { return false; } );

/**
 * Set up array of metadata keys for display in web book footer.
 */
global $metakeys;
$metakeys = array(
	'pb_author' => __( 'Author', 'pressbooks' ),
	'pb_contributing_authors' => __( 'Contributing Author', 'pressbooks' ),
 	'pb_publisher'  => __( 'Publisher', 'pressbooks' ),
	'pb_print_isbn'  => __( 'Print ISBN', 'pressbooks' ),
	'pb_keywords_tags'  => __( 'Keywords/Tags', 'pressbooks' ),
	'pb_publication_date'  => __( 'Publication Date', 'pressbooks' ),
	'pb_hashtag'  => __( 'Hashtag', 'pressbooks' ),
	'pb_ebook_isbn'  => __( 'Ebook ISBN', 'pressbooks' ),
);

/**
 * Build Google font url based on
 *
 * http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 */
function pressbooks_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
    * supported by Lato, translate this to 'off'. Do not translate
    * into your own language.
    */
	$lato = _x( 'on', 'Lato font: on or off', 'pressbooks' );

	/* Translators: If there are characters in your language that are not
    * supported by PT Serif, translate this to 'off'. Do not translate
    * into your own language.
    */
	$pt_serif = _x( 'on', 'PT Serif font: on or off', 'pressbooks' );

	if ( 'off' !== $lato || 'off' !== $pt_serif ) {
		$font_families = array();

		if ( 'off' !== $lato ) {
			$font_families[] = 'Lato:400,700';
		}

		if ( 'off' !== $pt_serif ) {
			$font_families[] = 'PT Serif:300,400,300italic,400italic,600';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

 /**
 * Enqueue Google font on front end
 */
function pressbooks_scripts_styles() {
	wp_enqueue_style( 'pressbooks-fonts', pressbooks_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'pressbooks_scripts_styles' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pressbooks_book_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pressbooks_book_content_width', 640 );
}
add_action( 'after_setup_theme', 'pressbooks_book_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function pressbooks_book_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'pressbooks' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'pressbooks_book_widgets_init' );

/* ------------------------------------------------------------------------ *
 * Scripts and styles for Book Info Page (cover page)
 * ------------------------------------------------------------------------ */
 
function pressbooks_book_info_page () {

	if ( is_front_page() || is_single() ) {
		// Sharrre
		wp_enqueue_script( 'sharrre', PB_PLUGIN_URL . 'symbionts/jquery/sharrre/jquery.sharrre-1.3.4.min.js', array( 'jquery' ), '20130712', false );
		wp_enqueue_script( 'sharrre-load', get_template_directory_uri() . '/js/sharrre-load.js', array( 'jquery', 'sharrre' ), '20130712', false );
		wp_localize_script( 'sharrre-load', 'PB_SharrreToken', array(
			'urlCurl' => PB_PLUGIN_URL . 'symbionts/jquery/sharrre/sharrre.php',
		) );
	}
}
add_action('wp_enqueue_scripts', 'pressbooks_book_info_page');


/**
 * Enqueue scripts and styles.
 */
function pressbooks_book_scripts() {
	wp_enqueue_style( 'pressbooks-style', get_stylesheet_uri() );

	wp_enqueue_script( 'pressbooks-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'pressbooks-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'pressbooks-modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array(), '20150730', true );

	wp_enqueue_script( 'pressbooks-keyboard-nav', get_template_directory_uri() . '/js/keyboard-nav.js', array('jquery'), '20150731', true );

	wp_enqueue_script( 'pressbooks-header-toc', get_template_directory_uri() . '/js/header-toc.js', array('jquery'), '20150811', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$options = get_option( 'pressbooks_theme_options_web' );
	if ( @$options['toc_collapse'] ) {
		wp_enqueue_script( 'pressbooks_toc_collapse',	get_template_directory_uri() . '/js/toc_collapse.js', array( 'jquery' ) );
		wp_enqueue_style( 'dashicons' );
	}
	if ( @$options['accessibility_fontsize'] ) {
		wp_enqueue_script( 'pressbooks-accessibility', get_template_directory_uri() . '/js/a11y.js', array( 'jquery' ) );
		wp_register_style( 'pressbooks-accessibility-toolbar', get_template_directory_uri() . '/css/a11y.css', array(), null, 'screen' );
		wp_enqueue_style( 'pressbooks-accessibility-toolbar' );
		wp_enqueue_style( 'dashicons' );
	}

}
add_action( 'wp_enqueue_scripts', 'pressbooks_book_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Render Previous and next buttons
 *
 * @param bool $echo
 */
function pb_get_links($echo=true) {
  global $first_chapter, $prev_chapter, $next_chapter;
  $first_chapter = pb_get_first();
  $prev_chapter = pb_get_prev();
  $next_chapter = pb_get_next();
  if ($echo):
?><div class="page-navigation pb-book-theme ">
  <?php if ($prev_chapter != '/') : ?>
	<span class="previous"><a href="<?php echo $prev_chapter; ?>"><?php _e('Previous', 'pressbooks'); ?></a></span>
  <?php endif; ?>
<!-- 	<h2 class="entry-title"><?php the_title(); ?></h2> -->
  <?php if ($next_chapter != '/') : ?>
	<span class="next"><a href="<?php echo $next_chapter ?>"><?php _e('Next', 'pressbooks'); ?></a></span>
  <?php endif; ?>
  </div><?php
  endif;
}

/**
 * Prevent access by unregistered user if the book in question is private.
 */
function pb_private() {
	$bloginfourl= get_bloginfo('url'); ?>
		<div <?php post_class(); ?>>
			<h2 class="entry-title denied-title"><?php _e('Access Denied', 'pressbooks'); ?></h2>
			<!-- Table of content loop goes here. -->
			<div class="entry_content denied-text"><?php _e('This book is private, and accessible only to registered users. If you have an account you can <a href="'. $bloginfourl .'/wp-login.php" class="login">login here</a>  <p class="sign-up">You can also set up your own PressBooks book at: <a href="http://pressbooks.com">PressBooks.com</a>.', 'pressbooks'); ?></p></div>
		</div><!-- #post-## -->
<?php
}

/* ------------------------------------------------------------------------ *
 * Copyright License
 * ------------------------------------------------------------------------ */

function pressbooks_copyright_license() {
	
	$option = get_option( 'pressbooks_theme_options_global' );
	$book_meta = \PressBooks\Book::getBookInformation();

	// if they don't want to see it, return
	// at minimum we need book copyright information set
	if ( !isset( $option['copyright_license'] ) || isset ( $option['copyright_license'] ) && false == $option['copyright_license'] || ! isset( $book_meta['pb_book_license'] ) ) {
		return '';
	}

	global $post;
	$id = $post->ID;
	$title = ( is_front_page() ) ? get_bloginfo('name') : $post->post_title ;
	$post_meta = get_post_meta( $id );
	$link = get_permalink( $id );
	$html = $license = $copyright_holder = '';
	$transient = get_transient("license-inf-$id" ); 
	$updated = array( $license, $copyright_holder, $title );
	$changed = false;
	$lang = $book_meta['pb_language'];

	
	// Copyright holder, set in order of precedence
	if ( isset( $post_meta['pb_section_author'] ) ) { 
		// section author overrides book author, copyrightholder
		$copyright_holder = $post_meta['pb_section_author'][0] ;
		
	} elseif ( isset( $book_meta['pb_copyright_holder'] ) ) { 
		// book copyright holder overrides book author
		$copyright_holder =  $book_meta['pb_copyright_holder'];
		
	} elseif ( isset( $book_meta['pb_author'] ) ) { 
		// book author is the fallback, default
		$copyright_holder =  $book_meta['pb_author'];
	}

	// Copyright license, set in order of precedence
	if ( isset( $post_meta['pb_section_license'] ) ) { 
		// section copyright overrides book 
		$license = $post_meta['pb_section_license'][0];
		
	} elseif ( isset( $book_meta['pb_book_license'] ) ) { 
		// book is the fallback, default
		$license = $book_meta['pb_book_license'];
	}
	
	 //delete_transient("license-inf-$id");
	 // check if the user has changed anything
	if ( is_array( $transient ) ) {
		foreach ( $updated as $val ) {
			if ( ! array_key_exists( $val, $transient ) ) {
				$changed = true;
			}
		}
	}
	// if the cache has expired, or the user changed the license
	if ( false === $transient || true == $changed ) {

		// get xml response from API
		$response = \PressBooks\Metadata::getLicenseXml( $license, $copyright_holder, $link, $title, $lang );

		try {
			// convert to object
			$result = simplexml_load_string( $response );

			// evaluate it for errors
			if ( ! false === $result || ! isset( $result->html ) ) {
				throw new \Exception( 'Creative Commons license API not returning expected results at PressBooks\Metadata::getLicenseXml' );
			} else {
				// process the response, return html
				$html = \PressBooks\Metadata::getWebLicenseHtml( $result->html );
			}
		} catch ( \Exception $e ) {
			error_log( $e->getMessage() );
		}
		// store it with the license as a key
		$value = array( 
		    $license => $html,
		    $copyright_holder => '',
		    $title => '',
		);
		// expires in 24 hours
		set_transient( "license-inf-$id", $value, 86400 );
	} else {
		$html = $transient[$license] ;
	}

	return $html;
}

include_once( 'inc/theme-options.php' );