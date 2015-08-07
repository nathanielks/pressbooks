<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Luther
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if ( is_front_page() ) {
	echo pb_get_seo_meta_elements();
	echo pb_get_microdata_elements();
} else {
	echo pb_get_microdata_elements();
} ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class('pb-book'); ?>>
<?php get_template_part( 'template-parts/content', 'accessibility-toolbar' ); ?>
<?php $fb_script = get_option( 'pressbooks_theme_options_web' );
if ( isset( $fb_script['social_media'] ) && $fb_script['social_media'] == 1 ) { ?>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>
<?php } ?>
<?php if (is_front_page()):?>
<div id="page" class="hfeed site" itemscope itemtype="http://schema.org/Book" itemref="about alternativeHeadline author copyrightHolder copyrightYear datePublished description editor image inLanguage keywords publisher">
<?php else: ?> 
<div id="page" class="hfeed site" itemscope itemtype="http://schema.org/WebPage" itemref="about copyrightHolder copyrightYear inLanguage publisher">
<?php endif; ?>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pressbooks' ); ?></a>

	<header id="masthead" class="pb-book-theme site-header" role="banner">

		<div class="site-width">
			<!-- PB Branding -->
			<div class="pb-branding">
				<p><?php esc_html_e( 'created with', 'pressbooks' ); ?></p>
				<h2 class="pressbooks-logo"><a href="<?php echo PATH_CURRENT_SITE; ?>"><?php echo get_site_option('site_name'); ?></a></h2>
			</div>

			<!-- User navigation -->
			<nav id="site-navigation" class="settings-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'pressbooks' ); ?></button>
					<?php if (!is_user_logged_in()): ?>

						<a href="<?php echo wp_login_url(); ?>" class=""><i class="icon-budicon"></i><?php _e('Login', 'pressbooks'); ?></a>

					<?php else: ?>

						<a href="<?php echo  wp_logout_url(); ?>" class=""><i class="icon-budicon-1"></i><?php _e('Logout', 'pressbooks'); ?></a>

						<?php if (is_super_admin() || is_user_member_of_blog()): ?>
							<a href="<?php echo get_option('home'); ?>/wp-admin"><i class="icon-budicon-2"></i><span class="screen-reader-text"><?php _e('Admin', 'pressbooks'); ?></span></a>

						<?php endif; ?>

					<?php endif; ?>

			</nav><!-- #site-navigation -->
		</div><!-- end. site-width-->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
