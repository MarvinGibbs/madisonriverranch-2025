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
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'madisonriverranch' ),
				'footer'  => esc_html__( 'Footer', 'madisonriverranch' ),
			)
		);

		/*
		* Change 'Max Mega Menu' container to <nav>
		*/
		function megamenu_use_nav_container( $defaults, $menu_id, $current_theme_location ) {
			$defaults['container'] = 'nav';
			return $defaults;
		}
		add_filter( 'megamenu_nav_menu_args', 'megamenu_use_nav_container', 10, 3 );

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'madisonriverranch_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Remove Error: Bad value https://api.w.org/ from attribute rel on element link:
		// the string https://api.w.org/ is not a registered keyword
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
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
	register_sidebar(
		[
			'name'          => esc_html__( 'Sidebar', 'madisonriverranch' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'madisonriverranch' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		]
	);
}
add_action( 'widgets_init', 'madisonriverranch_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function madisonriverranch_scripts() {
	$rand = wp_rand( 1, 99999999999 );
	wp_enqueue_style( 'madisonriverranch-style', get_stylesheet_uri(), '', $rand );

	wp_enqueue_script( 'madisonriverranch-navigation', get_template_directory_uri() . '/js/navigation.js', [], '20151215', true );

	wp_enqueue_script( 'madisonriverranch-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', [], '20151215', true );

	wp_enqueue_script( 'madisonriverranch-read-more-less', get_template_directory_uri() . '/js/read-more-less.js', [], '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'madisonriverranch_scripts' );

/**
 * Configure bbPress edit area: turn on 'tinymce' and turn off 'quicktags'
 * 'quicktags' turns off html tag option
 *
 * @param array $args
 *
 * @return array
 */
function bbp_enable_visual_editor( array $args = [] ): array {
	$args['tinymce']   = true;
	$args['quicktags'] = false;

	return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'bbp_enable_visual_editor' );

/**
 * Add Redirect logic for forum guidelines
 */
function redirect_to_guidelines_if_needed(): void {
	// Check if user is trying to access the forums page
	if ( is_user_logged_in() && bbp_is_forum_archive() ) {
		$user_id    = get_current_user_id();
		$has_agreed = get_user_meta( $user_id, 'agreed_to_forum_guidelines', true );

		if ( ! $has_agreed ) {
			wp_safe_redirect( home_url( '/forum-guidelines/' ) );
			exit();
		}
	}
}
add_action( 'template_redirect', 'redirect_to_guidelines_if_needed' );

/**
 * Setup the forum guideline handling agreement
 */
function handle_forum_agreement(): void {
	check_ajax_referer( 'forum_agree_nonce' );

	if ( ! is_user_logged_in() ) {
		wp_send_json_error( 'User not logged in' );
	}

	$user_id = get_current_user_id();
	update_user_meta( $user_id, 'agreed_to_forum_guidelines', true );

	wp_send_json_success();
}
add_action( 'wp_ajax_set_forum_agreement', 'handle_forum_agreement' );

// Add checkbox to user profile
add_action( 'show_user_profile', 'add_reset_forum_agreement_checkbox' );
add_action( 'edit_user_profile', 'add_reset_forum_agreement_checkbox' );

/**
 * Add checkbox to user profile to turn off 'agreed_to_forum_guidelines'
 */
function add_reset_forum_agreement_checkbox(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return; // Only for admins
	}
	?>
	<h3>Forum Agreement</h3>
	<table class="form-table">
		<tr>
			<th><label for="reset_forum_agreement">Reset Agreement?</label></th>
			<td>
				<input type="checkbox" name="reset_forum_agreement" id="reset_forum_agreement" value="1" />
				<span class="description">Check this box to require the user to agree to the Forum Guidelines again.</span>
			</td>
		</tr>
		<?php wp_nonce_field( 'reset_forum_agreement_action', 'reset_forum_agreement_nonce' ); ?>
	</table>
	<?php
}

// Save reset checkbox
add_action( 'personal_options_update', 'save_reset_forum_agreement_checkbox' );
add_action( 'edit_user_profile_update', 'save_reset_forum_agreement_checkbox' );

function save_reset_forum_agreement_checkbox( $user_id ): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$nonce = isset( $_POST['reset_forum_agreement_nonce'] )
		? sanitize_text_field( wp_unslash( $_POST['reset_forum_agreement_nonce'] ) )
		: '';

	if ( ! wp_verify_nonce( $nonce, 'reset_forum_agreement_action' ) ) {
		return;
	}

	if ( isset( $_POST['reset_forum_agreement'] ) ) {
		delete_user_meta( $user_id, 'agreed_to_forum_guidelines' );
	}
}

/**
 * End of bbPress.
 */

/**
 * Start of BuddyPress
 */
function mrr_add_private_message_button( $author_link, $r, $args ) {
	if ( ! function_exists( 'bp_is_active' ) || ! bp_is_active( 'messages' ) ) {
		return $author_link;
	}

	if ( empty( $r['post_id'] ) ) {
		return $author_link;
	}

	$user_id = get_post_field( 'post_author', $r['post_id'] );

	if ( $user_id && $user_id !== get_current_user_id() ) {
		$username = bp_core_get_username( $user_id );
		$subject  = 'Re: ' . get_the_title( bbp_get_topic_id() );
		$content  = "Hi $username,\n\nI saw your post and wanted to follow up.";
		$nonce    = wp_create_nonce( 'prefill_message_fields' );

		$url = bp_loggedin_user_domain() . 'messages/compose/';
		$url = add_query_arg(
			[
				'r'             => $username,
				'subject'       => $subject,
				'content'       => $content,
				'prefill_nonce' => $nonce,
			],
			$url
		);

		$author_link .= '<br><a class="pm-link" href="' . esc_url( $url ) . '">Private Message</a>';
	}

	return $author_link;
}
add_filter( 'bbp_get_reply_author_link', 'mrr_add_private_message_button', 10, 3 );

add_filter( 'bp_get_message_get_recipient_usernames', function ( $value ) {
	if ( isset( $_GET['r'], $_GET['prefill_nonce'] ) && wp_verify_nonce( $_GET['prefill_nonce'], 'prefill_message_fields' ) ) {
		return sanitize_user( wp_unslash( $_GET['r'] ) );
	}
	return $value;
});

add_filter( 'bp_get_messages_subject_value', function ( $value ) {
	if ( isset( $_GET['subject'], $_GET['prefill_nonce'] ) && wp_verify_nonce( $_GET['prefill_nonce'], 'prefill_message_fields' ) ) {
		return sanitize_text_field( wp_unslash( $_GET['subject'] ) );
	}
	return $value;
});

add_filter( 'bp_get_messages_content_value', function ( $value ) {
	if ( isset( $_GET['content'], $_GET['prefill_nonce'] ) && wp_verify_nonce( $_GET['prefill_nonce'], 'prefill_message_fields' ) ) {
		return sanitize_textarea_field( wp_unslash( $_GET['content'] ) );
	}
	return $value;
});

//add_action( 'bp_init', function () {
//	$template = bp_locate_template( 'members/single/home.php', false, false );
//	error_log( 'bp_locate_template result: ' . $template );
//});



add_filter( 'template_include', function( $template ) {
	if ( is_user_logged_in() && bp_is_user() ) {
		error_log( 'BuddyPress profile page template being loaded: ' . $template );
	}
	return $template;
});





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
