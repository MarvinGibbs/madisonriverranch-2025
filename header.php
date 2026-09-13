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
		
		<!-- NAVEBAR
		=============================================================================== -->
		<div class="navbar-wrapper">
			<div class="navbar navbar-inverse navbar-fixed-top fixed-top navbar-dark" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/mrr-logo.png" alt="Madison River Ranch"></a>
					</div><!-- .navbar-header -->
					
					
					<?php
						/* Step 4 cleanup: this location has Max Mega Menu enabled (Appearance > Menus),
						   which fully replaces this call's output with its own #mega-menu-wrap-primary /
						   #mega-menu-primary markup at every screen width - it forces its own container
						   tag via the megamenu_nav_menu_args filter in functions.php, and ignores
						   container_class/menu_class entirely. Those Bootstrap 3 collapse/toggle
						   classes never reached the rendered page; removed rather than left as dead
						   hints for a future maintainer to puzzle over. */
						wp_nav_menu( array (
							'theme_location' => 'primary',
						));
					?>
					
				</div><!-- .container -->
			</div><!-- .navbar -->
		</div><!-- .navbar-wrapper -->
	</header>
