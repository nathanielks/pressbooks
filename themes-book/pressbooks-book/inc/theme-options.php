<?php
/**
 * Theme options page.
 *
 * @package Luther
 */

if ( ! function_exists( 'pressbooks_theme_options_display' ) ) :

/**
 * Function called by the PressBooks plugin when user is on [ Appearance → Theme Options ] page
 */
function pressbooks_theme_options_display() { ?>
	<div class="wrap">
		<div id="icon-themes" class="icon32"></div>
		<h2><?php echo wp_get_theme(); ?> Theme Options</h2>
		<?php settings_errors(); ?>
		<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'global_options'; ?>
		<h2 class="nav-tab-wrapper">
		<a href="?page=pressbooks_theme_options&tab=global_options" class="nav-tab <?php echo $active_tab == 'global_options' ? 'nav-tab-active' : ''; ?>">Global Options</a>
		<a href="?page=pressbooks_theme_options&tab=web_options" class="nav-tab <?php echo $active_tab == 'web_options' ? 'nav-tab-active' : ''; ?>">Web Options</a>
		<?php if( true == \PressBooks\Utility\check_prince_install() ){ ?>
		<a href="?page=pressbooks_theme_options&tab=pdf_options" class="nav-tab <?php echo $active_tab == 'pdf_options' ? 'nav-tab-active' : ''; ?>">PDF Options</a>
		<?php } ;?>
		<?php if ( true == \PressBooks\Utility\show_experimental_features() ) { ?>
		<a href="?page=pressbooks_theme_options&tab=mpdf_options" class="nav-tab <?php echo $active_tab == 'mpdf_options' ? 'nav-tab-active' : ''; ?>">mPDF Options</a>
		<?php } ?>
		<a href="?page=pressbooks_theme_options&tab=ebook_options" class="nav-tab <?php echo $active_tab == 'ebook_options' ? 'nav-tab-active' : ''; ?>">Ebook Options</a>
		</h2>
		<!-- Create the form that will be used to render our options -->
		<form method="post" action="options.php">
			<?php if( $active_tab == 'global_options' ) {
				settings_fields( 'pressbooks_theme_options_global' );
				do_settings_sections( 'pressbooks_theme_options_global' );
			} elseif( $active_tab == 'web_options' ) {
				settings_fields( 'pressbooks_theme_options_web' );
				do_settings_sections( 'pressbooks_theme_options_web' );
			} elseif( $active_tab == 'pdf_options' ) {
				settings_fields( 'pressbooks_theme_options_pdf' );
				do_settings_sections( 'pressbooks_theme_options_pdf' );
			} elseif( $active_tab == 'mpdf_options' ) {
				settings_fields( 'pressbooks_theme_options_mpdf' );
				do_settings_sections( 'pressbooks_theme_options_mpdf' );
			} elseif( $active_tab == 'ebook_options' ) {
				settings_fields( 'pressbooks_theme_options_ebook' );
				do_settings_sections( 'pressbooks_theme_options_ebook' );
			} ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}

endif;


/* ------------------------------------------------------------------------ *
 * Theme Options Summary (displayed on Export Page)
 * ------------------------------------------------------------------------ */

if ( ! function_exists( 'pressbooks_theme_options_summary' ) ) :

/**
 * Function called by the PressBooks plugin when user is on [ Export ] page
 */
function pressbooks_theme_options_summary() { ?>
	<p><strong><?php _e('Global options', 'pressbooks' ); ?>:</strong></p>
	<ul>
	<?php
	$global_options = get_option('pressbooks_theme_options_global');
	foreach ($global_options as $key => $value) {
		switch($key) {
			case 'chapter_numbers': ?>
			<li><?php _e('Chapter numbers', 'pressbooks' ); ?>: <em><?php echo $value == 1 ? __( 'display chapter numbers', 'pressbooks' ) : __( 'do not display chapter numbers', 'pressbooks' ); ?></em></li>
			<?php break;
		}
	}
	?>
	</ul>
	<p><strong><?php _e('PDF options', 'pressbooks' ) ?>:</strong></p>
	<ul>
		<?php
		// TODO: Control the order of display.
		$pdf_options = get_option('pressbooks_theme_options_pdf');
		foreach ($pdf_options as $key => $value) {
			switch($key) {
				case 'pdf_page_size': ?>
					<li><?php _e( 'Page size', 'pressbooks' ) ?>: <em><?php
						if ( $value == 1 ) { _e( 'digest', 'pressbooks' ); }
						elseif ( $value == 2 ) { _e( 'US trade', 'pressbooks' ); }
						elseif ( $value == 3 ) { _e( 'US letter', 'pressbooks' ); }
						elseif ( $value == 4 ) { _e( '8.5 x 9.25"', 'pressbooks' ); }
						elseif ( $value == 5 ) { _e( 'duodecimo', 'pressbooks' ); }
						elseif ( $value == 6 ) { _e( 'pocket', 'pressbooks' ); }
						elseif ( $value == 7 ) { _e( 'A4', 'pressbooks' ); }
						elseif ( $value == 8 ) { _e( 'A5', 'pressbooks' ); } ?></em></li>
					<?php break;
				case 'pdf_paragraph_separation': ?>
					<li><?php _e( 'Paragraph separator', 'pressbooks' ) ?>: <em><?php
						if ( $value == 1 ) { _e( 'indent', 'pressbooks' ); }
						elseif ( $value == 2 ) { _e( 'skip lines', 'pressbooks' ); } ?></em></li>
					<?php break;
				case 'pdf_blankpages': ?>
					<li><?php _e( 'Blank pages' , 'pressbooks' ) ?>: <em><?php
						if ( $value == 1 ) { _e( 'include blank pages (for print PDF)', 'pressbooks' ); }
						elseif ( $value == 2 ) { _e( 'remove blank pages (for web PDF)', 'pressbooks' ); } ?></em></li>
					<?php break;
				case 'pdf_toc': ?>
					<li><?php _e( 'Table of contents' , 'pressbooks' ) ?>: <em><?php echo $value == 1 ? __( 'display', 'pressbooks' ) : __( 'do not display', 'pressbooks' ); ?></em></li>
					<?php break;
				case 'pdf_footnotes_style': ?>
					<li><?php _e( 'Footnotes style' , 'pressbooks' ) ?>: <em><?php echo $value == 1 ? __( 'normal', 'pressbooks' ) : __( 'force as endnotes', 'pressbooks' ); ?></em></li>
					<?php break;
				case 'pdf_crop_marks': ?>
					<li><?php _e( 'Crop marks' , 'pressbooks' ) ?>: <em><?php echo $value == 1 ? __( 'display', 'pressbooks' ) : __( 'do not display', 'pressbooks' ); ?></em></li>
					<?php break;
				case 'pdf_hyphens': ?>
					<li><?php _e( 'Hyphens' , 'pressbooks' ) ?>: <em><?php echo $value == 1 ? __( 'enabled', 'pressbooks' ) : __( 'disabled', 'pressbooks' ); ?></em></li>
					<?php break;
				case 'pdf_widows': ?>
					<li><?php _e( 'Widows' , 'pressbooks' ) ?>: <em><?php echo $value; ?></em></li>
					<?php break;
				case 'pdf_orphans': ?>
					<li><?php _e( 'Orphans' , 'pressbooks' ) ?>: <em><?php echo $value; ?></em></li>
					<?php break;
				case 'pdf_fontsize': ?>
					<li><?php _e( 'Accessibility Increase Font Size' , 'pressbooks' ) ?>: <em><?php echo $value == 1 ? __( 'enabled', 'pressbooks' ) : __( 'disabled', 'pressbooks' ); ?></em></em></li>
					<?php break;
			}
		}
		?>
	</ul>
	<p><strong><?php _e( 'Ebook options' , 'pressbooks' ) ?>:</strong></p>
	<ul>
		<?php
		$ebook_options = get_option('pressbooks_theme_options_ebook');
		foreach ($ebook_options as $key => $value) {
			switch($key) {
				case 'ebook_paragraph_separation': ?>
					<li><?php _e( 'Paragraph separator' , 'pressbooks' ) ?>: <em><?php
						if ( $value == 1 ) { _e( 'indent', 'pressbooks' ); }
						elseif ( $value == 2 ) { _e( 'skip lines', 'pressbooks' ); } ?></em></li>
					<?php break;
				case 'ebook_compress_images': ?>
					<li><?php _e( 'Compress images' , 'pressbooks' ) ?>: <em><?php echo $value == 1 ? __( 'enabled', 'pressbooks' ) : __( 'disabled', 'pressbooks' ); ?></em></li>
					<?php break;
			}
		}
		?>
	</ul>
<?php
}

endif;


/* ------------------------------------------------------------------------ *
 * Global Options Tab
 * ------------------------------------------------------------------------ */

// Global Options Registration
function pressbooks_theme_options_global_init() {

	$_page = $_option = 'pressbooks_theme_options_global';
	$_section = 'global_options_section';
	$defaults = array(
		'chapter_numbers' => 1,
	);

	if ( false == get_option( $_option ) ) {
		add_option( $_option, $defaults );
	}

	add_settings_section(
		$_section,
		__( 'Global Options', 'pressbooks' ),
		'pressbooks_theme_options_global_callback',
		$_page
	);

	add_settings_field(
		'chapter_numbers',
		__( 'Chapter Numbers', 'pressbooks' ),
		'pressbooks_theme_chapter_numbers_callback',
		$_page,
		$_section,
		array(
			 __( 'Display chapter numbers', 'pressbooks' )
		)
	);

	add_settings_field(
		'parse_sections',
		__( 'Parse Sections', 'pressbooks' ),
		'pressbooks_theme_parse_sections_callback',
		$_page,
		$_section,
		array(
			 __( 'Enable a two-level TOC', 'pressbooks' )
		)
	);

	add_settings_field(
		'copyright_license',
		__( 'Copyright License', 'pressbooks' ),
		'pressbooks_theme_copyright_license_callback',
		$_page,
		$_section,
		array(
			 __( 'Display the copyright license', 'pressbooks' )
		)
	);

	register_setting(
		$_option,
		$_option,
		'pressbooks_theme_options_global_sanitize'
	);
}
add_action('admin_init', 'pressbooks_theme_options_global_init');


// Global Options Section Callback
function pressbooks_theme_options_global_callback() {
	echo '<p>' . __( 'These options apply universally to webbook, PDF and ebook exports.', 'pressbooks' ) . '</p>';
}


// Global Options Field Callback
function pressbooks_theme_chapter_numbers_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_global' );

	if ( ! isset( $options['chapter_numbers'] ) ) {
		$options['chapter_numbers'] = 1;
	}

	$html = '<input type="checkbox" id="chapter_numbers" name="pressbooks_theme_options_global[chapter_numbers]" value="1" ' . checked( 1, $options['chapter_numbers'], false ) . '/>';
	$html .= '<label for="chapter_numbers"> ' . $args[0] . '</label>';
	echo $html;
}

// Global Options Field Callback
function pressbooks_theme_parse_sections_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_global' );

	if ( ! isset( $options['parse_sections'] ) ) {
		$options['parse_sections'] = 0;
	}

	$html = '<input type="checkbox" id="parse_sections" name="pressbooks_theme_options_global[parse_sections]" value="1" ' . checked( 1, $options['parse_sections'], false ) . '/>';
	$html .= '<label for="parse_sections"> ' . $args[0] . '</label>';
	echo $html;
}

// Global Options Field Callback
function pressbooks_theme_copyright_license_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_global' );

	if ( ! isset( $options['copyright_license'] ) ) {
		$options['copyright_license'] = 0;
	}

	$html = '<input type="checkbox" id="copyright_license" name="pressbooks_theme_options_global[copyright_license]" value="1" ' . checked( 1, $options['copyright_license'], false ) . '/>';
	$html .= '<label for="copyright_license"> ' . $args[0] . '</label>';
	echo $html;
}

// Global Options Input Sanitization
function pressbooks_theme_options_global_sanitize( $input ) {

	$options = get_option( 'pressbooks_theme_options_global' );

	if ( ! isset( $input['chapter_numbers'] ) || $input['chapter_numbers'] != '1' ) {
		$options['chapter_numbers'] = 0;
	} else {
		$options['chapter_numbers'] = 1;
	}

	if ( ! isset( $input['parse_sections'] ) || $input['parse_sections'] != '1' ) {
		$options['parse_sections'] = 0;
	} else {
		$options['parse_sections'] = 1;
	}

	if ( ! isset( $input['copyright_license'] ) || $input['copyright_license'] != '1' ) {
		$options['copyright_license'] = 0;
	} else {
		$options['copyright_license'] = 1;
	}

	return $options;
}

/* ------------------------------------------------------------------------ *
 * Web Options Tab
 * ------------------------------------------------------------------------ */

function pressbooks_theme_options_web_init() {
	
	$_page = $_option = 'pressbooks_theme_options_web';
	$_section = 'web_options_section';
	$defaults = array(
	    'toc_collapse' => 0,
	);

	if ( false == get_option( $_option ) ) {
		add_option( $_option, $defaults );
	}

	add_settings_section(
		$_section, 
		__( 'Web Options', 'pressbooks' ), 
		'pressbooks_theme_options_web_callback', 
		$_page
	);

	add_settings_field(
		'toc_collapse', 
		__( 'Collapsable TOC', 'pressbooks' ), 
		'pressbooks_theme_toc_collapse_callback', 
		$_page, 
		$_section, 
		array(
		    __( 'Make webbook TOC collapsable', 'pressbooks' ) 
		)
	);
	
	add_settings_field(
		'accessibility_fontsize', 
		__( 'Increase Font Size', 'pressbooks' ), 
		'pressbooks_theme_accessibility_fontsize_callback',
		$_page,
		$_section,
		array(
		    __('Add an option for the user to increase font size for greater accessibility', 'pressbooks' )
		)
	);

	add_settings_field(
		'social_media_buttons', 
		__( 'Enable Social Media', 'pressbooks' ), 
		'pressbooks_theme_social_media_callback',
		$_page,
		$_section,
		array(
		    __('Add buttons to cover page and each chapter so that readers may share links to your book through social media: Facebook, Twitter, Google+.', 'pressbooks' )
		)
	);
	register_setting(
		$_option, 
		$_option, 
		'pressbooks_theme_options_web_sanitize'
	);
}

// Web Options Section Callback
function pressbooks_theme_options_web_callback() {
	echo '<p>' . __( 'These options apply to the webbook.', 'pressbooks' ) . '</p>';
}

// Web Options Field Callback
function pressbooks_theme_accessibility_fontsize_callback( $args ){
	$options = get_option( 'pressbooks_theme_options_web' );
	
	if ( ! isset( $options['accessibility_fontsize'] ) ) {
		$options['accessibility_fontsize'] = 0;
	}
	$html = '<input type="checkbox" id="accessibility_fontsize" name="pressbooks_theme_options_web[accessibility_fontsize]" value="1" ' . checked( 1, $options['accessibility_fontsize'], false ) . '/>';
	$html .= '<label for="accessibility_fontsize"> ' . $args[0] . '</label>';
	echo $html;	
	
}

// Web Options Field Callback
function pressbooks_theme_toc_collapse_callback( $args ) {
	$options = get_option( 'pressbooks_theme_options_web' );

	if ( ! isset( $options['toc_collapse'] ) ) {
		$options['toc_collapse'] = 0;
	}
	$html = '<input type="checkbox" id="toc_collapse" name="pressbooks_theme_options_web[toc_collapse]" value="1" ' . checked( 1, $options['toc_collapse'], false ) . '/>';
	$html .= '<label for="toc_collapse"> ' . $args[0] . '</label>';
	echo $html;
}

// Web Options Field Callback
function pressbooks_theme_social_media_callback( $args ) {
	$options = get_option( 'pressbooks_theme_options_web' );

	if ( ! isset( $options['social_media'] ) ) {
		$options['social_media'] = 1;
	}
	$html = '<input type="checkbox" id="social_media" name="pressbooks_theme_options_web[social_media]" value="1" ' . checked( 1, $options['social_media'], false ) . '/>';
	$html .= '<label for="social_media"> ' . $args[0] . '</label>';
	echo $html;
}

// Web Options Sanitize
function pressbooks_theme_options_web_sanitize( $input ) {

	$options = get_option( 'pressbooks_theme_options_web' );

	if ( ! isset( $input['toc_collapse'] ) || $input['toc_collapse'] != '1' ) {
		$options['toc_collapse'] = 0;
	} else {
		$options['toc_collapse'] = 1;
	}
	
	if ( ! isset( $input['accessibility_fontsize'] ) || $input['accessibility_fontsize'] != '1' ) {
		$options['accessibility_fontsize'] = 0;
	} else {
		$options['accessibility_fontsize'] = 1;
	}
	
	if ( ! isset( $input['social_media'] ) || $input['social_media'] != '1' ) {
		$options['social_media'] = 0;
	} else {
		$options['social_media'] = 1;
	}	
	
	return $options;
}

add_action( 'admin_init', 'pressbooks_theme_options_web_init' );

/* ------------------------------------------------------------------------ *
 * PDF Options Tab
 * ------------------------------------------------------------------------ */

use PressBooks\CustomCss;

// PDF Options Registration
function pressbooks_theme_options_pdf_init() {

	$_page = $_option = 'pressbooks_theme_options_pdf';
	$_section = 'pdf_options_section';
	$defaults = array(
		'pdf_page_size' => 1,
		'pdf_paragraph_separation' => 1,
		'pdf_blankpages' => 1,
		'pdf_toc' => 1,
		'pdf_romanize_parts' => 0,
		'pdf_footnotes_style' => 1,
		'pdf_crop_marks' => 0,
		'pdf_hyphens' => 0,
		'pdf_widows' => 3,
		'pdf_orphans' => 3,
		'pdf_fontsize' => 0,
	);

	if ( false == get_option( $_option ) ) {
		add_option( $_option, $defaults );
	}

	add_settings_section(
		$_section,
		__( 'PDF Options', 'pressbooks' ),
		'pressbooks_theme_options_pdf_callback',
		$_page
	);

	add_settings_field(
		'pdf_page_size',
		__( 'Page Size', 'pressbooks' ),
		'pressbooks_theme_pdf_page_size_callback',
		$_page,
		$_section,
		array(
			 __( 'Digest (5.5&quot; &times; 8.5&quot;)', 'pressbooks' ),
			 __( 'US Trade (6&quot; &times; 9&quot;)', 'pressbooks' ),
			 __( 'US Letter (8.5&quot; &times; 11&quot;)', 'pressbooks' ),
			 __( 'Custom (8.5&quot; &times; 9.25&quot;)', 'pressbooks' ),
			 __( 'Duodecimo (5&quot; &times; 7.75&quot;)', 'pressbooks' ),
			 __( 'Pocket (4.25&quot; &times; 7&quot;)', 'pressbooks' ),
			 __( 'A4 (21cm &times; 29.7cm)', 'pressbooks' ),
			 __( 'A5 (14.8cm &times; 21cm)', 'pressbooks' ),
			 __( '5&quot; &times; 8&quot;', 'pressbooks' ),
		)
	);
	add_settings_field(
		'pdf_crop_marks',
		__( 'Crop Marks', 'pressbooks' ),
		'pressbooks_theme_pdf_crop_marks_callback',
		$_page,
		$_section,
		array(
			 __( 'Display crop marks', 'pressbooks' )
		)
	);
	add_settings_field(
		'pdf_hyphens',
		__( 'Hyphens', 'pressbooks' ),
		'pressbooks_theme_pdf_hyphens_callback',
		$_page,
		$_section,
		array(
			 __( 'Enable hyphenation', 'pressbooks' )
		)
	);
	add_settings_field(
		'pdf_paragraph_separation',
		__( 'Paragraph Separation', 'pressbooks' ),
		'pressbooks_theme_pdf_paragraph_separation_callback',
		$_page,
		$_section,
		array(
			 __( 'Indent paragraphs', 'pressbooks' ),
			 __( 'Skip lines between paragraphs', 'pressbooks' )
		)
	);
	add_settings_field(
		'pdf_blankpages',
		__( 'Blank Pages', 'pressbooks' ),
		'pressbooks_theme_pdf_blankpages_callback',
		$_page,
		$_section,
		array(
			 __( 'Include blank pages (for print PDF)', 'pressbooks' ),
			 __( 'Remove all blank pages (for web PDF)', 'pressbooks' )
		)
	);
	add_settings_field(
		'pdf_toc',
		__( 'Table of Contents', 'pressbooks' ),
		'pressbooks_theme_pdf_toc_callback',
		$_page,
		$_section,
		array(
			 __( 'Display table of contents', 'pressbooks' )
		)
	);
	if ( CustomCss::isCustomCss() ) {
		add_settings_field(
			'pdf_romanize_parts',
			__( 'Romanize Part Numbers', 'pressbooks' ),
			'pressbooks_theme_pdf_romanize_parts_callback',
			$_page,
			$_section,
			array(
				 __( 'Convert part numbers into Roman numerals', 'pressbooks' )
			)
		);
	}
	add_settings_field(
		'pdf_footnotes_style',
		__( 'Footnotes Style', 'pressbooks' ),
		'pressbooks_theme_pdf_footnotes_callback',
		$_page,
		$_section,
		array(
			 __( 'Regular footnotes', 'pressbooks' ),
			 __( 'Force as endnotes', 'pressbooks' )
		)
	);
	add_settings_field(
		'pdf_widows',
		__( 'Widows', 'pressbooks' ),
		'pressbooks_theme_pdf_widows_callback',
		$_page,
		$_section
	);
	add_settings_field(
		'pdf_orphans',
		__( 'Orphans', 'pressbooks' ),
		'pressbooks_theme_pdf_orphans_callback',
		$_page,
		$_section
	);
	add_settings_field(
		'pdf_fontsize',
		__( 'Increase Font Size', 'pressbooks' ),
		'pressbooks_theme_pdf_fontsize_callback',
		$_page,
		$_section,
		array(
		    __('Increases font size and line height for greater accessibility', 'pressbooks' )
		)
	);
	register_setting(
		$_option,
		$_option,
		'pressbooks_theme_options_pdf_sanitize'
	);
}
add_action( 'admin_init', 'pressbooks_theme_options_pdf_init' );


// PDF Options Section Callback
function pressbooks_theme_options_pdf_callback() {
	echo '<p>' . __( 'These options apply to PDF exports.', 'pressbooks' ) . '</p>';
}


// PDF Options Field Callback
function pressbooks_theme_pdf_page_size_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	if ( ! isset( $options['pdf_page_size'] ) ) {
		$options['pdf_page_size'] = 1;
	}

	$html = "<select name='pressbooks_theme_options_pdf[pdf_page_size]' id='pdf_page_size' >";
	foreach ( $args as $key => $val ) {
		$html .= "<option value='" . ( $key + 1 ) . "' " . selected( $key + 1, $options['pdf_page_size'], false ) . ">$val</option>";
	}
	$html .= '<select>';
	echo $html;
}


// PDF Options Field Callback
function pressbooks_theme_pdf_paragraph_separation_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	if ( ! isset( $options['pdf_paragraph_separation'] ) ) {
		$options['pdf_paragraph_separation'] = 1;
	}

	$html = '<input type="radio" id="paragraph_indent" name="pressbooks_theme_options_pdf[pdf_paragraph_separation]" value="1"' . checked( 1, $options['pdf_paragraph_separation'], false ) . '/> ';
	$html .= '<label for="paragraph_indent">' . $args[0] . '</label><br />';
	$html .= '<input type="radio" id="paragraph_skiplines" name="pressbooks_theme_options_pdf[pdf_paragraph_separation]" value="2"' . checked( 2, $options['pdf_paragraph_separation'], false ) . '/> ';
	$html .= '<label for="paragraph_skiplines">' . $args[1] . '</label>';
	echo $html;
}


// PDF Options Field Callback
function pressbooks_theme_pdf_blankpages_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	if ( ! isset( $options['pdf_blankpages'] ) ) {
		$options['pdf_blankpages'] = 1;
	}

	$html = '<input type="radio" id="include" name="pressbooks_theme_options_pdf[pdf_blankpages]" value="1"' . checked( 1, $options['pdf_blankpages'], false ) . '/> ';
	$html .= '<label for="include">' . $args[0] . '</label><br />';
	$html .= '<input type="radio" id="remove" name="pressbooks_theme_options_pdf[pdf_blankpages]" value="2"' . checked( 2, $options['pdf_blankpages'], false ) . '/> ';
	$html .= '<label for="remove">' . $args[1] . '</label>';
	echo $html;
}


// PDF Options Field Callback
function pressbooks_theme_pdf_toc_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	if ( ! isset( $options['pdf_toc'] ) ) {
		$options['pdf_toc'] = 1;
	}

	$html = '<input type="checkbox" id="pdf_toc" name="pressbooks_theme_options_pdf[pdf_toc]" value="1" ' . checked( 1, $options['pdf_toc'], false ) . '/>';
	$html .= '<label for="pdf_toc"> ' . $args[0] . '</label>';
	echo $html;
}

// PDF Options Field Callback
function pressbooks_theme_pdf_romanize_parts_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	if ( ! isset( $options['pdf_romanize_parts'] ) ) {
		$options['pdf_romanize_parts'] = 0;
	}

	$html = '<input type="checkbox" id="pdf_romanize_parts" name="pressbooks_theme_options_pdf[pdf_romanize_parts]" value="1" ' . checked( 1, $options['pdf_romanize_parts'], false ) . '/>';
	$html .= '<label for="pdf_romanize_parts"> ' . $args[0] . '</label>';
	echo $html;
}

// PDF Options Field Callback
function pressbooks_theme_pdf_footnotes_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	if ( ! isset( $options['pdf_footnotes_style'] ) ) {
		$options['pdf_footnotes_style'] = 1;
	}

	$html = '<input type="radio" id="footnotes" name="pressbooks_theme_options_pdf[pdf_footnotes_style]" value="1"' . checked( 1, $options['pdf_footnotes_style'], false ) . '/> ';
	$html .= '<label for="footnotes">' . $args[0] . '</label><br />';
	$html .= '<input type="radio" id="endnotes" name="pressbooks_theme_options_pdf[pdf_footnotes_style]" value="2"' . checked( 2, $options['pdf_footnotes_style'], false ) . '/> ';
	$html .= '<label for="endnotes">' . $args[1] . '</label>';
	echo $html;
}


// PDF Options Field Callback
function pressbooks_theme_pdf_crop_marks_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	if ( ! isset( $options['pdf_crop_marks'] ) ) {
		$options['pdf_crop_marks'] = 0;
	}

	$html = '<input type="checkbox" id="pdf_crop_marks" name="pressbooks_theme_options_pdf[pdf_crop_marks]" value="1" ' . checked( 1, $options['pdf_crop_marks'], false ) . '/>';
	$html .= '<label for="pdf_crop_marks"> ' . $args[0] . '</label>';
	echo $html;
}


// PDF Options Field Callback
function pressbooks_theme_pdf_hyphens_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	if ( ! isset( $options['pdf_hyphens'] ) ) {
		$options['pdf_hyphens'] = 0;
	}

	$html = '<input type="checkbox" id="pdf_hyphens" name="pressbooks_theme_options_pdf[pdf_hyphens]" value="1" ' . checked( 1, $options['pdf_hyphens'], false ) . '/>';
	$html .= '<label for="pdf_hyphens"> ' . $args[0] . '</label>';
	echo $html;
}


// PDF Options Field Callback
function pressbooks_theme_pdf_widows_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	if ( ! isset( $options['pdf_widows'] ) ) {
		$options['pdf_widows'] = 3;
	}

	$html = '<input type="text" id="pdf_widows" name="pressbooks_theme_options_pdf[pdf_widows]" value="' . $options['pdf_widows'] . '" size="3" />';
	$html .= '<label for="pdf_widows"></label>';
	echo $html;
}


// PDF Options Field Callback
function pressbooks_theme_pdf_orphans_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	if ( ! isset( $options['pdf_orphans'] ) ) {
		$options['pdf_orphans'] = 3;
	}

	$html = '<input type="text" id="pdf_orphans" name="pressbooks_theme_options_pdf[pdf_orphans]" value="' . $options['pdf_orphans'] . '" size="3" />';
	$html .= '<label for="pdf_orphans"></label>';
	echo $html;
}

//PDF Options Field Callback
function pressbooks_theme_pdf_fontsize_callback( $args ) {
	
	$options = get_option( 'pressbooks_theme_options_pdf' );
	
	if ( ! isset( $options['pdf_fontsize'] ) ){
		$options['pdf_fontsize'] = 0;
	}
	
	$html = '<input type="checkbox" id="pdf_fontsize" name="pressbooks_theme_options_pdf[pdf_fontsize]" value="1" ' . checked( 1, $options['pdf_fontsize'], false ) . '/>';
	$html .= '<label for="pdf_fontsize"> ' . $args[0] . '</label>';
	echo $html;
}

// PDF Options Input Sanitization
function pressbooks_theme_options_pdf_sanitize( $input ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	// Absint
	foreach ( array( 'pdf_page_size', 'pdf_paragraph_separation', 'pdf_blankpages', 'pdf_footnotes_style', 'pdf_widows', 'pdf_orphans' ) as $val ) {
		$options[$val] = absint( $input[$val] );
	}

	// Checkmarks
	foreach ( array( 'pdf_toc', 'pdf_romanize_parts', 'pdf_crop_marks', 'pdf_hyphens', 'pdf_fontsize' ) as $val ) {
		if ( ! isset( $input[$val] ) || $input[$val] != '1' ) $options[$val] = 0;
		else $options[$val] = 1;
	}

	return $options;
}


/* ------------------------------------------------------------------------ *
 * mPDF Options Tab
 * ------------------------------------------------------------------------ */

// mPDF Options Registration
function pressbooks_theme_options_mpdf_init() {

	$_page = $_option = 'pressbooks_theme_options_mpdf';
	$_section = 'mpdf_options_section';
	$defaults = array(
		'mpdf_page_size' => 'Letter',
		'mpdf_include_cover' => 1,
		'mpdf_indent_paragraphs' => 0,
	);

	if ( false == get_option( $_option ) ) {
		add_option( $_option, $defaults );
	}

	add_settings_section(
		$_section,
		__( 'mPDF Options', 'pressbooks' ),
		'pressbooks_theme_options_mpdf_callback',
		$_page
	);

	add_settings_field(
		'mpdf_page_size',
		__( 'Page Size', 'pressbooks' ),
		'pressbooks_theme_mpdf_page_size_callback',
		$_page,
		$_section,
		array(
			'A0' => __( 'A0', 'pressbooks' ),
			'A1' => __( 'A1', 'pressbooks' ),
			'A2' => __( 'A2', 'pressbooks' ),
			'A3' => __( 'A3', 'pressbooks' ),
			'A4' => __( 'A4', 'pressbooks' ),
			'A5' => __( 'A5', 'pressbooks' ),
			'A6' => __( 'A6', 'pressbooks' ),
			'A7' => __( 'A7', 'pressbooks' ),
			'A8' => __( 'A8', 'pressbooks' ),
			'A9' => __( 'A9', 'pressbooks' ),
			'A10' => __( 'A10', 'pressbooks' ),
			'B0' => __( 'B0', 'pressbooks' ),
			'B1' => __( 'B1', 'pressbooks' ),
			'B2' => __( 'B2', 'pressbooks' ),
			'B3' => __( 'B3', 'pressbooks' ),
			'B4' => __( 'B4', 'pressbooks' ),
			'B5' => __( 'B5', 'pressbooks' ),
			'B6' => __( 'B6', 'pressbooks' ),
			'B7' => __( 'B7', 'pressbooks' ),
			'B8' => __( 'B8', 'pressbooks' ),
			'B9' => __( 'B9', 'pressbooks' ),
			'B10' => __( 'B10', 'pressbooks' ),
			'C0' => __( 'C0', 'pressbooks' ),
			'C1' => __( 'C1', 'pressbooks' ),
			'C2' => __( 'C2', 'pressbooks' ),
			'C3' => __( 'C3', 'pressbooks' ),
			'C4' => __( 'C4', 'pressbooks' ),
			'C5' => __( 'C5', 'pressbooks' ),
			'C6' => __( 'C6', 'pressbooks' ),
			'C7' => __( 'C7', 'pressbooks' ),
			'C8' => __( 'C8', 'pressbooks' ),
			'C9' => __( 'C9', 'pressbooks' ),
			'C10' => __( 'C10', 'pressbooks' ),
			'4A0' => __( '4A0', 'pressbooks' ),
			'2A0' => __( '2A0', 'pressbooks' ),
			'RA0' => __( 'RA0', 'pressbooks' ),
			'RA1' => __( 'RA1', 'pressbooks' ),
			'RA2' => __( 'RA2', 'pressbooks' ),
			'RA3' => __( 'RA3', 'pressbooks' ),
			'RA4' => __( 'RA4', 'pressbooks' ),
			'SRA0' => __( 'SRA0', 'pressbooks' ),
			'SRA1' => __( 'SRA1', 'pressbooks' ),
			'SRA2' => __( 'SRA2', 'pressbooks' ),
			'SRA3' => __( 'SRA3', 'pressbooks' ),
			'SRA4' => __( 'SRA4', 'pressbooks' ),
			'Letter' => __( 'Letter', 'pressbooks' ),
			'Legal' => __( 'Legal' , 'pressbooks' ),
			'Executive' => __( 'Executive' , 'pressbooks' ),
			'Folio' => __( 'Folio' , 'pressbooks' ),
			'Demy' => __( 'Demy' , 'pressbooks' ),
			'Royal' => __( 'Royal' , 'pressbooks' ),
			'A' => __( 'Type A paperback 111x178mm' , 'pressbooks' ),
			'B' => __( 'Type B paperback 128x198mm' , 'pressbooks' ),
		)
	);

	add_settings_field(
		'mpdf_margin_left',
		__( 'Left margin', 'pressbooks' ),
		'pressbooks_theme_mpdf_margin_left_callback',
		$_page,
		$_section,
		array(
			__(  ' Left Margin (in milimeters)', 'pressbooks' )
		)
	);

	add_settings_field(
		'mpdf_margin_right',
		__( 'Right margin', 'pressbooks' ),
		'pressbooks_theme_mpdf_margin_right_callback',
		$_page,
		$_section,
		array(
			__(  ' Right margin (in milimeters)', 'pressbooks' )
		)
	);

	add_settings_field(
		'mpdf_mirror_margins',
		__( 'Mirror Margins', 'pressbooks' ),
		'pressbooks_theme_mpdf_mirror_margins_callback',
		$_page,
		$_section,
		array(
			 __( 'The document will mirror the left and right margin values on odd and even pages (i.e. they become inner and outer margins)', 'pressbooks' )
		)
	);

	add_settings_field(
		'mpdf_include_cover',
		__( 'Cover Image', 'pressbooks' ),
		'pressbooks_theme_mpdf_include_cover_callback',
		$_page,
		$_section,
		array(
			 __( 'Display cover image', 'pressbooks' )
		)
	);
	
	add_settings_field(
		'mpdf_include_toc',
		__( 'Table of Contents', 'pressbooks' ),
		'pressbooks_theme_mpdf_include_toc_callback',
		$_page,
		$_section,
		array(
			 __( 'Display table of contents', 'pressbooks' )
		)
	);
	
	add_settings_field(
		'mpdf_indent_paragraphs',
		__( 'Indent paragraphs', 'pressbooks' ),
		'pressbooks_theme_mpdf_indent_paragraphs_callback',
		$_page,
		$_section,
		array(
			 __( 'Indent paragraphs', 'pressbooks' )
		)
	);
	
	add_settings_field(
		'mpdf_hyphens',
		__( 'Hyphens', 'pressbooks' ),
		'pressbooks_theme_mpdf_hyphens_callback',
		$_page,
		$_section,
		array(
			 __( 'Enable hyphenation', 'pressbooks' )
		)
	);

	add_settings_field(
		'mpdf_fontsize',
		__( 'Increase Font Size', 'pressbooks' ),
		'pressbooks_theme_mpdf_fontsize_callback',
		$_page,
		$_section,
		array(
		    __('Increases font size and line height for greater accessibility', 'pressbooks' )
		)
	);
	register_setting(
		$_option,
		$_option,
		'pressbooks_theme_options_mpdf_sanitize'
	);

}
add_action( 'admin_init', 'pressbooks_theme_options_mpdf_init' );


// mPDF Options Section Callback
function pressbooks_theme_options_mpdf_callback() {
	echo '<p>' . __( 'These options apply to mPDF exports.', 'pressbooks' ) . '</p>';
}


// mPDF Options Field Callback
function pressbooks_theme_mpdf_page_size_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_mpdf' );

	if ( ! isset( $options['mpdf_page_size'] ) ) {
		$options['mpdf_page_size'] = 'Letter';
	}

	$html = "<select name='pressbooks_theme_options_mpdf[mpdf_page_size]' id='mpdf_page_size' >";
	foreach ( $args as $key => $val ) {
		$html .= "<option value='" . $key . "' " . selected( $key , $options['mpdf_page_size'], false ) . ">$val</option>";
	}
	$html .= '<select>';
	echo $html;
}

function pressbooks_theme_mpdf_margin_left_callback ( $args ) {
	$options = get_option( 'pressbooks_theme_options_mpdf' );

	if ( ! isset( $options['mpdf_left_margin'] ) ) {
		$options['mpdf_left_margin'] = '15';
	}

	$html = '<input type="text" id="mpdf_left_margin" name="pressbooks_theme_options_mpdf[mpdf_left_margin]" value="' . $options['mpdf_left_margin'] . '" size="3" />';
	$html .= '<label for="mpdf_left_margin">' . $args[0] . '</label>';
	echo $html;
}

function pressbooks_theme_mpdf_margin_right_callback ( $args ) {
	$options = get_option( 'pressbooks_theme_options_mpdf' );

	if ( ! isset( $options['mpdf_right_margin'] ) ) {
		$options['mpdf_right_margin'] = '30';
	}

	$html = '<input type="text" id="mpdf_right_margin" name="pressbooks_theme_options_mpdf[mpdf_right_margin]" value="' . $options['mpdf_right_margin'] . '" size="3" />';
	$html .= '<label for="mpdf_right_margin">' . $args[0] . '</label>';
	echo $html;
}

function pressbooks_theme_mpdf_mirror_margins_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_mpdf' );

	if ( ! isset( $options['mpdf_mirror_margins'] ) ) {
		$options['mpdf_mirror_margins'] = 1;
	}

	$html = '<input type="checkbox" id="mpdf_mirror_margins" name="pressbooks_theme_options_mpdf[mpdf_mirror_margins]" value="1" ' . checked( 1, $options['mpdf_mirror_margins'], false ) . '/>';
	$html .= '<label for="mpdf_mirror_margins"> ' . $args[0] . '</label>';
	echo $html;
}

function pressbooks_theme_mpdf_include_cover_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_mpdf' );

	if ( ! isset( $options['mpdf_include_cover'] ) ) {
		$options['mpdf_include_cover'] = 0;
	}

	$html = '<input type="checkbox" id="mpdf_include_cover" name="pressbooks_theme_options_mpdf[mpdf_include_cover]" value="1" ' . checked( 1, $options['mpdf_include_cover'], false ) . '/>';
	$html .= '<label for="mpdf_include_cover"> ' . $args[0] . '</label>';
	echo $html;
}

function pressbooks_theme_mpdf_include_toc_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_mpdf' );

	if ( ! isset( $options['mpdf_include_toc'] ) ) {
		$options['mpdf_include_toc'] = 1;
	}

	$html = '<input type="checkbox" id="mpdf_include_toc" name="pressbooks_theme_options_mpdf[mpdf_include_toc]" value="1" ' . checked( 1, $options['mpdf_include_toc'], false ) . '/>';
	$html .= '<label for="mpdf_include_toc"> ' . $args[0] . '</label>';
	echo $html;
}

function pressbooks_theme_mpdf_indent_paragraphs_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_mpdf' );

	if ( ! isset( $options['mpdf_indent_paragraphs'] ) ) {
		$options['mpdf_indent_paragraphs'] = 1;
	}

	$html = '<input type="checkbox" id="mpdf_indent_paragraphs" name="pressbooks_theme_options_mpdf[mpdf_indent_paragraphs]" value="1" ' . checked( 1, $options['mpdf_indent_paragraphs'], false ) . '/>';
	$html .= '<label for="mpdf_indent_paragraphs"> ' . $args[0] . '</label>';
	echo $html;
}

function pressbooks_theme_mpdf_hyphens_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_mpdf' );

	if ( ! isset( $options['mpdf_hyphens'] ) ) {
		$options['mpdf_hyphens'] = 0;
	}

	$html = '<input type="checkbox" id="mpdf_hyphens" name="pressbooks_theme_options_mpdf[mpdf_hyphens]" value="1" ' . checked( 1, $options['mpdf_hyphens'], false ) . '/>';
	$html .= '<label for="mpdf_hyphens"> ' . $args[0] . '</label>';
	echo $html;
}

function pressbooks_theme_mpdf_fontsize_callback( $args ) {
	
	$options = get_option( 'pressbooks_theme_options_mpdf' );
	
	if ( ! isset( $options['mpdf_fontsize'] ) ){
		$options['mpdf_fontsize'] = 0;
	}
	
	$html = '<input type="checkbox" id="mpdf_fontsize" name="pressbooks_theme_options_mpdf[mpdf_fontsize]" value="1" ' . checked( 1, $options['mpdf_fontsize'], false ) . '/>';
	$html .= '<label for="mpdf_fontsize"> ' . $args[0] . '</label>';
	echo $html;
}

function pressbooks_theme_options_mpdf_sanitize ( $input ){

	$options = get_option( 'pressbooks_theme_options_mpdf' );

	// Absint
	foreach ( array( 'mpdf_right_margin', 'mpdf_left_margin' ) as $val ) {
		$options[$val] = absint( $input[$val] );
	}

	// Checkmarks
	foreach ( array( 'mpdf_indent_paragraphs', 'mpdf_include_cover', 'mpdf_mirror_margins', 'mpdf_include_toc', 'mpdf_hyphens', 'mpdf_fontsize' ) as $val ) {
		if ( ! isset( $input[$val] ) || $input[$val] != '1' ) $options[$val] = 0;
		else $options[$val] = 1;
	}
	
	// nothing to do, select list 
	$options['mpdf_page_size'] = $input['mpdf_page_size'];

	return $options;	
}

/* ------------------------------------------------------------------------ *
 * Ebook Options Tab
 * ------------------------------------------------------------------------ */

// Ebook Options Registration
function pressbooks_theme_options_ebook_init() {

	$_page = $_option = 'pressbooks_theme_options_ebook';
	$_section = 'ebook_options_section';
	$defaults = array(
		'ebook_paragraph_separation' => 1,
		'ebook_compress_images' => 0,
	);

	if ( false == get_option( $_option ) ) {
		add_option( $_option, $defaults );
	}

	add_settings_section(
		$_section,
		__( 'Ebook Options', 'pressbooks' ),
		'pressbooks_theme_options_ebook_callback',
		$_page
	);

	add_settings_field(
		'ebook_paragraph_separation',
		__( 'Paragraph Separation', 'pressbooks' ),
		'pressbooks_theme_ebook_paragraph_separation_callback',
		$_page,
		$_section,
		array(
			 __( 'Indent paragraphs', 'pressbooks' ),
			 __( 'Skip lines between paragraphs', 'pressbooks' )
		)
	);

	add_settings_field(
		'ebook_compress_images',
		__( 'Compress images', 'pressbooks' ),
		'pressbooks_theme_ebook_compress_images_callback',
		$_page,
		$_section,
		array(
			__( 'Reduce image size and quality', 'pressbooks' )
		)
	);

	register_setting(
		$_option,
		$_option,
		'pressbooks_theme_options_ebook_sanitize'
	);
}
add_action( 'admin_init', 'pressbooks_theme_options_ebook_init' );


// Ebook Options Section Callback
function pressbooks_theme_options_ebook_callback() {
	echo '<p>' . __( 'These options apply to ebook exports.', 'pressbooks' ) . '</p>';
}

// Ebook Options Field Callbacks
function pressbooks_theme_ebook_paragraph_separation_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_ebook' );

	if ( ! isset( $options['ebook_paragraph_separation'] ) ) {
		$options['ebook_paragraph_separation'] = 1;
	}

	$html = '<input type="radio" id="paragraph_indent" name="pressbooks_theme_options_ebook[ebook_paragraph_separation]" value="1"' . checked( 1, $options['ebook_paragraph_separation'], false ) . '/> ';
	$html .= '<label for="paragraph_indent">' . $args[0] . '</label><br />';
	$html .= '<input type="radio" id="paragraph_skiplines" name="pressbooks_theme_options_ebook[ebook_paragraph_separation]" value="2"' . checked( 2, $options['ebook_paragraph_separation'], false ) . '/> ';
	$html .= '<label for="paragraph_skiplines">' . $args[1] . '</label>';
	echo $html;
}

// PDF Options Field Callback
function pressbooks_theme_ebook_compress_images_callback( $args ) {

	$options = get_option( 'pressbooks_theme_options_ebook' );

	if ( ! isset( $options['ebook_compress_images'] ) ) {
		$options['ebook_compress_images'] = 0;
	}

	$html = '<input type="checkbox" id="ebook_compress_images" name="pressbooks_theme_options_ebook[ebook_compress_images]" value="1" ' . checked( 1, $options['ebook_compress_images'], false ) . '/>';
	$html .= '<label for="ebook_compress_images"> ' . $args[0] . '</label>';
	echo $html;
}


// Ebook Options Input Sanitization
function pressbooks_theme_options_ebook_sanitize( $input ) {

	$options = get_option( 'pressbooks_theme_options_ebook' );

	// Absint
	foreach ( array( 'ebook_paragraph_separation' ) as $val ) {
		$options[$val] = absint( $input[$val] );
	}

	// Checkmarks
	foreach ( array( 'ebook_compress_images' ) as $val ) {
		if ( ! isset( $input[$val] ) || $input[$val] != '1' ) $options[$val] = 0;
		else $options[$val] = 1;
	}

	return $options;
}


/* ------------------------------------------------------------------------ *
 * Hooks, Actions and Filters
 * ------------------------------------------------------------------------ */

function pressbooks_theme_pdf_css_override( $css ) {

	// --------------------------------------------------------------------
	// Global Options

	$options = get_option( 'pressbooks_theme_options_global' );

	// Display chapter numbers? true (default) / false
	if ( ! @$options['chapter_numbers'] ) {
		$css .= "div.part-title-wrap > .part-number, div.chapter-title-wrap > .chapter-number, #toc .part a::before, #toc .chapter a::before { display: none !important; } \n";
	}

	// --------------------------------------------------------------------
	// PDF Options

	$options = get_option( 'pressbooks_theme_options_pdf' );

	/*
	Page sizes:
	1 = 5.5 x 8.5"
	2 = 6 x 9"
	3 = 8.5 x 11"
	4 = 8.5 x 9.25"
	5 = 5 x 7.75"
	6 = 4.25 x 7"
	7 = 21 x 29.7cm
	8 = 14.8 x 21cm
	9 = 5in x 8in
	*/

	switch ( @$options['pdf_page_size'] ) {
		case 1:
			$css .= "@page { size: 5.5in 8.5in; } \n";
			break;
		case 2:
			$css .= "@page { size: 6in 9in; } \n";
			break;
		case 3:
			$css .= "@page { size: 8.5in 11in; } \n";
			break;
		case 4:
			$css .= "@page { size: 8.5in 9.25in } \n";
			break;
		case 5:
			$css .= "@page { size: 5in 7.75in } \n";
			break;
		case 6:
			$css .= "@page { size: 4.25in 7in } \n";
			break;
		case 7:
			$css .= "@page { size: 21cm 29.7cm } \n";
			break;
		case 8:
			$css .= "@page { size: 14.8cm 21cm; } \n";
			break;
		case 9:
			$css .= "@page { size: 5in 8in; } \n";
			break;
	}

	// Display crop marks? true / false (default)
	if ( @$options['pdf_crop_marks'] ) {
		$css .= "@page { marks: crop } \n";
	}

	// Hyphens?
	// To debug use `hyphens: prince-expand-all;` (then every hyphenation point will be shown with a dot)
	if ( @$options['pdf_hyphens'] ) {
		$css .= 'p { hyphens: auto; ';
		$hyphens_path = pb_get_hyphens_path();
		if ( $hyphens_path ) {
			$css .= "prince-hyphenate-patterns: '" . $hyphens_path . "'; ";
		}
		$css .= "} \n";
	}

	// Indent paragraphs? 1 = Indent (default), 2 = Skip Lines
	if ( 2 == @$options['pdf_paragraph_separation'] ) {
		$css .= "p + p { text-indent: 0em; margin-top: 1em; } \n";
	}

	// Include blank pages? 1 = Yes (default), 2 = No
	if ( 2 == @$options['pdf_blankpages'] ) {
		$css .= "#title-page, #copyright-page, #toc, div.part, div.front-matter, div.back-matter, div.chapter, #half-title-page h1.title:first-of-type  { page-break-before: auto; } \n";
	}

	// Display TOC? true (default) / false
	if ( ! @$options['pdf_toc'] ) {
		$css .= "#toc { display: none; } \n";
	}

	// Widows & Orphans
	if ( @$options['pdf_widows'] ) {
		$css .= '@page, p { widows: ' . $options['pdf_widows'] . '; }' . "\n";
	}
	if ( @$options['pdf_orphans'] ) {
		$css .= '@page, p { orphans: ' . $options['pdf_orphans'] . '; }' . "\n";
	}
	
	if ( @$options['pdf_fontsize'] ){
                $css .= 'body {font-size: 1.3em; line-height: 1.3; }' . "\n";
        }


	// --------------------------------------------------------------------
	// Luther features we inject ourselves, (not user options, this theme not child)

	$theme = strtolower( '' . wp_get_theme() );
	if ( 'luther' == $theme ) {
		// Translate "Part" to whatever language this book is in
		$css .= '#toc .part a::before { content: "' . __( 'Part', 'pressbooks' ) . ' "counter(part, upper-roman) ". "; }' . "\n";
		$css .= 'div.part-title-wrap > h3.part-number:before { content: "' . __( 'Part', 'pressbooks' ) . ' "; }' . "\n";
	}

	return $css;
}
add_filter( 'pb_pdf_css_override', 'pressbooks_theme_pdf_css_override' );

function pressbooks_theme_mpdf_css_override( $css ) {
	$options = get_option( 'pressbooks_theme_options_mpdf' );
	$global_options = get_option( 'pressbooks_theme_options_global' );

	// indent paragraphs
	if ( $options['mpdf_indent_paragraphs'] ) {
		$css .= "p + p, .indent {text-indent: 2.0 em; }" . "\n";
	}
	// hyphenation
	if ( $options['mpdf_hyphens'] ) {
		$css .= "p {hyphens: auto;}" . "\n";
	}
	// font-size
	if ( $options['mpdf_fontsize'] ){
                $css .= 'body {font-size: 1.3em; line-height: 1.3; }' . "\n";
        }
	// chapter numbers
	if ( ! $global_options['chapter_numbers'] ) {
		$css .= "h3.chapter-number {display: none;}" . "\n";
	}
	return $css;
}

add_filter( 'pb_mpdf_css_override', 'pressbooks_theme_mpdf_css_override' );

function pressbooks_theme_ebook_css_override( $css ) {

	// --------------------------------------------------------------------
	// Global Options

	$options = get_option( 'pressbooks_theme_options_global' );

	if ( ! @$options['chapter_numbers'] ) {
		$css .= "div.part-title-wrap > .part-number, div.chapter-title-wrap > .chapter-number { display: none !important; } \n";
	}

	// --------------------------------------------------------------------
	// Ebook Options

	$options = get_option( 'pressbooks_theme_options_ebook' );

	// Indent paragraphs? 1 = Indent (default), 2 = Skip Lines
	if ( 2 == @$options['ebook_paragraph_separation'] ) {
		$css .= "p + p, .indent, div.ugc p.indent { text-indent: 0; margin-top: 1em; } \n";
	}

	// --------------------------------------------------------------------
	// Luther features we inject ourselves, (not user options, this theme not child)

	$theme = strtolower( '' . wp_get_theme() );
	if ( 'luther' == $theme ) {
		// Translate "Part" to whatever language this book is in
		$css .= 'div.part-title-wrap > h3.part-number:before { content: "' . __( 'Part', 'pressbooks' ) . ' "; }' . "\n";
	}

	return $css;

}
add_filter( 'pb_epub_css_override', 'pressbooks_theme_ebook_css_override' );


function pressbooks_theme_pdf_hacks( $hacks ) {

	$options = get_option( 'pressbooks_theme_options_pdf' );

	// 1 = Footnotes (default), 2 = Endnotes
	$hacks['pdf_footnotes_style'] = @$options['pdf_footnotes_style'];

	return $hacks;
}
add_filter( 'pb_pdf_hacks', 'pressbooks_theme_pdf_hacks' );


function pressbooks_theme_ebook_hacks( $hacks ) {

	// --------------------------------------------------------------------
	// Global Options

	$options = get_option( 'pressbooks_theme_options_global' );

	// Display chapter numbers?
	$hacks['chapter_numbers'] = $options['chapter_numbers'];

	// --------------------------------------------------------------------
	// Ebook Options

	$options = get_option( 'pressbooks_theme_options_ebook' );

	// Indent paragraphs? 1 = Indent (default), 2 = Skip Lines
	if ( @$options['ebook_compress_images'] ) {
		$hacks['ebook_compress_images'] = true;
	}

	// --------------------------------------------------------------------
	// Luther features we inject ourselves, (not user options, this theme not child)

	$theme = strtolower( '' . wp_get_theme() );
	if ( 'luther' == $theme ) {
		$hacks['ebook_romanize_part_numbers'] = true;
	}

	return $hacks;
}
add_filter( 'pb_epub_hacks', 'pressbooks_theme_ebook_hacks' );