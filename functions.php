<?php
/**
 * Madison River Ranch functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Madison_River_Ranch
 */

if ( ! function_exists( 'madisonriverranch_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function madisonriverranch_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Madison River Ranch, use a find and replace
	 * to change 'madisonriverranch' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'madisonriverranch', get_template_directory() . '/languages' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'madisonriverranch' ),
		'footer' => esc_html__( 'Footer', 'madisonriverranch' ),
	) );

  /*
   * Change 'Max Mega Menu' container to <nav>
   */
  function megamenu_use_nav_container( $defaults, $menu_id, $current_theme_location ) {
 	  $defaults['container'] = 'nav';
 	  return $defaults;
   }
   add_filter( "megamenu_nav_menu_args", "megamenu_use_nav_container", 10, 3 );

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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'madisonriverranch_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	// Remove Error: Bad value https://api.w.org/ from attribute rel on element link:
	// the string https://api.w.org/ is not a registered keyword
	remove_action('wp_head', 'rest_output_link_wp_head');
}
endif;
add_action( 'after_setup_theme', 'madisonriverranch_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function madisonriverranch_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'madisonriverranch_content_width', 640 );
}
add_action( 'after_setup_theme', 'madisonriverranch_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function madisonriverranch_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'madisonriverranch' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'madisonriverranch' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'madisonriverranch_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function madisonriverranch_scripts() {
	$rand = rand(1, 99999999999);
	wp_enqueue_style( 'madisonriverranch-style', get_stylesheet_uri(), '', $rand );

	wp_enqueue_script( 'madisonriverranch-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'madisonriverranch-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'madisonriverranch_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
