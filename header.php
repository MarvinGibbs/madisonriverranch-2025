<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Madison_River_Ranch
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'madisonriverranch' ); ?></a>

	<!-- !HEADER
	=============================================================================== -->		
	<header class="site-header" role="banner">
		
		<!-- NAVBAR
		=============================================================================== -->
		<!-- Step 4 cleanup: flattened from the old .navbar-wrapper > .navbar > .container >
		     .navbar-header + <nav> nesting. .navbar-wrapper and .navbar-header had zero CSS
		     or JS behavior (confirmed via grep across the theme) - inert leftovers from the
		     Bootstrap 3 structure. navbar-inverse/navbar-fixed-top were already dead in
		     Bootstrap 5 and superseded by the real fixed-top/navbar-dark classes below. This
		     is now standard Bootstrap 5 navbar markup: .navbar > .container > .navbar-brand
		     + <nav>, which renders identically since .navbar > .container is already a flex
		     row regardless of whether the brand link sits in its own wrapper div. -->
		<div class="navbar fixed-top navbar-dark" role="navigation">
			<div class="container">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/mrr-logo.png" alt="Madison River Ranch"></a>

				<?php
					/* This location has Max Mega Menu enabled (Appearance > Menus), which fully
					   replaces this call's output with its own #mega-menu-wrap-primary /
					   #mega-menu-primary markup at every screen width - it forces its own
					   container tag via the megamenu_nav_menu_args filter in functions.php. */
					wp_nav_menu( array (
						'theme_location' => 'primary',
					));
				?>
			</div><!-- .container -->
		</div><!-- .navbar -->
	</header>
