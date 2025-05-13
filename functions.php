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
 * Shortcode to output bbPress breadcrumbs
 * @return string
 */
function custom_forum_breadcrumbs(): string {
	if ( function_exists( 'bbp_breadcrumb' ) ) {

		// Only show breadcrumbs on forum/topic/reply pages
		if ( bbp_is_forum_archive() || bbp_is_single_forum() || bbp_is_single_topic() || bbp_is_single_reply() || bbp_is_search() ) {
			ob_start();
			bbp_breadcrumb(
				[
					'sep' => ' → ',
				]
			);
			return ob_get_clean();
		}
	}
	return ''; // Return nothing on other pages
}
add_shortcode( 'forum_breadcrumbs', 'custom_forum_breadcrumbs' );

/**
 * Change bbPress Forum Root Title everywhere
 * @param $title
 * @return string
 */
function custom_bbp_root_forum_title( $title ): string {
	if ( bbp_is_forum_archive() ) {
		$title = 'Trading Post'; // <- your new title
	}
	return $title;
}
add_filter( 'bbp_get_forum_archive_title', 'custom_bbp_root_forum_title' );

add_filter( 'bbp_topic_admin_links', 'mrr_remove_reply_link_for_participants', 20, 2 );
add_filter( 'bbp_reply_admin_links', 'mrr_remove_reply_link_for_participants', 20, 2 );

function mrr_remove_reply_link_for_participants( $links, $args ) {
	if ( current_user_can( 'bbp_participant' ) ) {
		if ( isset( $links['reply'] ) ) {
			unset( $links['reply'] );
		}
	}
	return $links;
}

/**
 * End of bbPress.
 */

/**
 * Start of bbPress Notify (No-Spam).
 */

add_filter(
	'bbpnns_skip_notification',
	function ( $skip, $user_info ) {
		$user_id = $user_info['user_id'] ?? 0;
		if ( ! $user_id || get_user_meta( $user_id, 'bbpnns_opt_in', true ) !== 'yes' ) {
			return true; // Skip notification
		}

		return false; // Allow notification
	},
	10,
	2
);

// Register shortcode to show the opt-in checkbox
add_shortcode(
	'bbpnns_optin',
	function () {
		if ( ! is_user_logged_in() ) {
			return '<p>You must be logged in to manage email preferences.</p>';
		}

		$user_id       = get_current_user_id();
		$opt_in        = get_user_meta( $user_id, 'bbpnns_opt_in', true );
		$current_value = $opt_in === 'yes' ? 'yes' : 'no';

		ob_start();
		?>

		<div id="bbpnns-optin-wrapper">
			<div id="bbpnns_optin_label" class="bbpnns-clickable-label" style="cursor: pointer; font-weight: bold;">
				<?php
				echo $current_value === 'yes'
					? '✅ You are receiving email notifications for new topics and replies'
					: '❌ You will not receive email notifications for new topics and replies';
				?>
				<span style="font-weight: normal; font-style: italic; font-size: 0.9em;">(Click to change this preference)</span>
			</div>
			<input type="hidden" id="bbpnns_opt_in_state" value="<?php echo esc_attr( $current_value ); ?>">
		</div>

		<div id="bbpnns_optin_modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
        background: rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
			<div style="background:#fff; padding:20px; max-width:400px; border-radius:8px; text-align:center;">
				<p id="bbpnns_modal_message"></p>
				<button id="bbpnns_confirm">Yes, save this change</button>
				<button id="bbpnns_cancel">Cancel</button>
			</div>
		</div>

		<script>
			document.addEventListener('DOMContentLoaded', function () {
				const label = document.getElementById('bbpnns_optin_label');
				const state = document.getElementById('bbpnns_opt_in_state');
				const modal = document.getElementById('bbpnns_optin_modal');
				const confirm = document.getElementById('bbpnns_confirm');
				const cancel = document.getElementById('bbpnns_cancel');

				const baseLabels = {
					yes: '✅ You are receiving email notifications for new topics and replies',
					no: '❌ You will not receive email notifications for new topics and replies',
					promptYes: 'Click to opt out of email notifications',
					promptNo: 'Click to opt in to email notifications'
				};

				const instruction = ' <span style="font-weight: normal; font-style: italic; font-size: 0.9em;">(Click to change this preference)</span>';

				let original = state.value;
				let intended = original;

				label.addEventListener('click', function () {
					intended = original === 'yes' ? 'no' : 'yes';
					label.innerHTML = (original === 'yes' ? baseLabels.promptYes : baseLabels.promptNo) + instruction;
					document.getElementById('bbpnns_modal_message').textContent =
						intended === 'yes'
							? "Do you want to start receiving email notifications?"
							: "Do you want to stop receiving email notifications?";
					modal.style.display = 'flex';
				});

				cancel.addEventListener('click', function () {
					label.innerHTML = baseLabels[original] + instruction;
					modal.style.display = 'none';
				});

				confirm.addEventListener('click', function () {
					fetch('<?php echo admin_url( 'admin-ajax.php' ); ?>', {
						method: 'POST',
						headers: {'Content-Type': 'application/x-www-form-urlencoded'},
						body: new URLSearchParams({
							action: 'bbpnns_save_optin',
							bbpnns_opt_in: intended,
							security: '<?php echo wp_create_nonce( 'bbpnns_optin_nonce' ); ?>'
						})
					})
						.then(response => response.json())
						.then(data => {
							if (data.success) {
								original = intended;
								state.value = intended;
								label.innerHTML = baseLabels[intended] + instruction;
							} else {
								alert('Error: ' + data.data);
								label.innerHTML = baseLabels[original] + instruction;
							}
							modal.style.display = 'none';
						});
				});
			});
		</script>

		<?php
		return ob_get_clean();
	}
);


add_action(
	'wp_ajax_bbpnns_save_optin',
	function () {
		if (
			! is_user_logged_in() ||
			! isset( $_POST['bbpnns_opt_in'] ) ||
			! wp_verify_nonce( $_POST['security'], 'bbpnns_optin_nonce' )
		) {
			wp_send_json_error( 'Invalid request' );
		}

		$user_id = get_current_user_id();
		$opt_in  = sanitize_text_field( $_POST['bbpnns_opt_in'] );

		if ( $opt_in === 'yes' ) {
			update_user_meta( $user_id, 'bbpnns_opt_in', 'yes' );
		} else {
			delete_user_meta( $user_id, 'bbpnns_opt_in' );
		}

		wp_send_json_success();
	}
);

// Handle form submission on init
add_action(
	'init',
	function () {
		if (
			isset( $_POST['bbpnns_opt_in_nonce'] ) &&
			wp_verify_nonce( $_POST['bbpnns_opt_in_nonce'], 'bbpnns_opt_in_action' ) &&
			is_user_logged_in()
		) {
			$user_id = get_current_user_id();
			if ( isset( $_POST['bbpnns_opt_in'] ) && $_POST['bbpnns_opt_in'] === 'yes' ) {
				update_user_meta( $user_id, 'bbpnns_opt_in', 'yes' );
			} else {
				delete_user_meta( $user_id, 'bbpnns_opt_in' );
			}
		}
	}
);


/**
 * End of bbPress Notify (No-Spam).
 */

/**
 * Start of Front End PM
 */

/**
 * Filter Front End PM user list to exclude administrator accounts
 */
function mrr_fep_exclude_administrators_from_list( $args ) {
	// Get the current list of role__not_in, or initialize an empty array if it doesn't exist
	if ( ! isset( $args['role__not_in'] ) ) {
		$args['role__not_in'] = [];
	}

	// Add 'administrator' to the roles to exclude
	if ( ! in_array( 'administrator', $args['role__not_in'] ) ) {
		$args['role__not_in'][] = 'administrator';
	}

	return $args;
}
add_filter( 'fep_user_query_args', 'mrr_fep_exclude_administrators_from_list' );

/**
 * Add Private Message link to bbPress topic authors
 */
function mrr_add_pm_link_to_topic_starter(): void {
	if ( ! is_user_logged_in() ) {
		return;
	}

	$topic_id   = bbp_get_topic_id();
	$author_id  = bbp_get_topic_author_id( $topic_id );
	$current_id = get_current_user_id();

	// Only show PM link if current user is not the author
	if ( $author_id && $author_id !== $current_id ) {
		$user = get_userdata( $author_id );
		if ( $user ) {
			$topic_title = get_the_title( $topic_id );

			$pm_url = add_query_arg(
				[
					'fepaction'   => 'newmessage',
					'fep_to'      => $user->user_login,
					'fep_subject' => rawurlencode( 'Re: ' . $topic_title ),
					'fep_message' => rawurlencode( 'Hi ' . $user->display_name . ",\n\nI saw your topic and wanted to follow up." ),
				],
				site_url( '/messages/' )
			);

			// Add style and button
			echo '<style>
                .fep-pm-link .button {
                    color: #3e4249;
                }
            </style>';
			echo '<span class="fep-pm-link"> <button onclick="window.location.href=\'' . esc_url( $pm_url ) . '\'" class="button">Private Message</button></span>';
		}
	}
}
add_action( 'bbp_theme_after_topic_started_by', 'mrr_add_pm_link_to_topic_starter' );

add_action(
	'mrr_after_topic_content',
	function ( $topic_id ) {
		if ( ! is_user_logged_in() ) {
			return;
		}

		$author_id  = bbp_get_topic_author_id( $topic_id );
		$current_id = get_current_user_id();

		if ( $author_id && $author_id !== $current_id ) {
			$user = get_userdata( $author_id );
			if ( $user ) {
				$topic_title = get_the_title( $topic_id );

				$pm_url = add_query_arg(
					[
						'fepaction'   => 'newmessage',
						'fep_to'      => $user->user_login,
						'fep_subject' => rawurlencode( 'Re: ' . $topic_title ),
						'fep_message' => rawurlencode( 'Hi ' . $user->display_name . ",\n\nI saw your topic and wanted to follow up." ),
					],
					site_url( '/messages/' )
				);
				// Add style and button
				echo '<style>
                .fep-pm-link .button {
                    color: #3e4249;
                }
            </style>';
				echo '<span class="fep-pm-link"><button onclick="window.location.href=\'' . esc_url( $pm_url ) . '\'" class="button">Private Message</button></span>';
			}
		}
	}
);

add_action(
	'mrr_after_reply_content_raw',
	function ( $reply ) {
		if ( ! is_user_logged_in() ) {
			return;
		}

		$current_id = get_current_user_id();
		$author_id  = (int) $reply->post_author;

		if ( $author_id && $author_id !== $current_id ) {
			$user        = get_userdata( $author_id );
			$topic_title = get_the_title( $reply->post_parent );

			if ( $user ) {
				$pm_url = add_query_arg(
					[
						'fepaction'   => 'newmessage',
						'fep_to'      => $user->user_login,
						'fep_subject' => rawurlencode( 'Re: ' . $topic_title ),
						'fep_message' => rawurlencode( 'Hi ' . $user->display_name . ",\n\nI saw your reply and wanted to follow up." ),
					],
					site_url( '/messages/' )
				);
				// Add style and button
				echo '<style>
                .fep-pm-link .button {
                    color: #3e4249;
                }
            </style>';
				echo '<span class="fep-pm-link"><button onclick="window.location.href=\'' . esc_url( $pm_url ) . '\'" class="button">Private Message</button></span>';
			}
		}
	}
);

add_action(
	'wp_footer',
	function () {
		if ( isset( $_GET['fepaction'] ) && $_GET['fepaction'] === 'newmessage' ) :
			?>
			<script>
				document.addEventListener("DOMContentLoaded", function () {
					const urlParams = new URLSearchParams(window.location.search);

					// Populate subject
					const subject = urlParams.get("fep_subject");
					if (subject && document.getElementById("message_title")) {
						document.getElementById("message_title").value = decodeURIComponent(subject);
					}

					// Populate message
					const message = urlParams.get("fep_message");
					if (message && document.getElementById("message_content")) {
						document.getElementById("message_content").value = decodeURIComponent(message).replace(/\\n/g, "\n");
					}
				});
			</script>
		<?php
		endif;
	}
);

function mrr_user_menu( $items, $args ) {
	if ( $args->theme_location === 'primary' ) {
		if ( is_user_logged_in() ) {
			$user = wp_get_current_user();

			$pm_url = site_url( '/messages/?fepaction=newmessage&fep_to=' . $user->user_login );

			$svg_icon = '
<svg class="mrr-user-icon" width="26" height="26" viewBox="0 0 24 24" fill="#ffffff" stroke="#cccccc" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
  <circle cx="12" cy="8" r="4"/>
  <path d="M4 20c0-4 4-6 8-6s8 2 8 6" fill="none"/>
</svg>';

			$menu  = '<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-align-bottom-left mega-menu-flyout mega-menu-item-217 user-icon-menu" id="mega-menu-item-217">';
			$menu .= '<a class="mega-menu-link" href="#">' . $svg_icon . '<span class="mega-indicator" data-has-click-event="true"></span></a>';

			$menu .= '<ul class="mega-sub-menu">';
			$menu .= '<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-168" id="mega-menu-item-168"><a class="mega-menu-link" href="' . esc_url( $pm_url ) . '">Messages</a></li>';
			$menu .= '<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-169" id="mega-menu-item-169"><a class="mega-menu-link" href="' . esc_url( wp_logout_url( home_url() ) ) . '">Logout</a></li>';
			$menu .= '</ul></li>';

			$items .= $menu;
		} else {
//			$items .= '<li class="menu-item"><a href="/login">Login</a></li>';
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'mrr_user_menu', 10, 2 );

/**
 * Define board recipients in a single place
 */
function get_board_notification_recipients(): array {
	return [
		'c.marv.gibbs@gmail.com',
		'jrgraifemberg@gmail.com',
		'Hillearyh@gmail.com',
		'markjuranek@me.com',
		'Sallyniess@gmail.com',
		'wilkin302@aol.com',
		// Add more board member emails here
	];
}

/**
 * End of Front End PM
 */

/**
 * Custom notification when a new bbPress Topic is posted, using BCC
 */
function custom_bbpress_new_topic_notification( $topic_id ): void {

	// List of additional email addresses you want to notify (BCC)
	$additional_recipients = get_board_notification_recipients();

	// Get the topic title, content, and URL
	$topic_title   = get_the_title( $topic_id );
	$topic_content = bbp_get_topic_content( $topic_id );
	$topic_url     = get_permalink( $topic_id );

	// Set email subject and body
	$subject = 'New Trading Post Topic Posted: ' . $topic_title;
	$body    = "A new trading post topic has been posted:\n\n";
	$body   .= 'Title: ' . $topic_title . "\n\n";
	$body   .= "Content:\n" . wp_strip_all_tags( $topic_content ) . "\n\n";
	$body   .= 'View it here: ' . $topic_url;

	// Build BCC headers
	$headers = [];

	foreach ( $additional_recipients as $email ) {
		$headers[] = 'Bcc: ' . $email;
	}

	// Optionally, you can also set the "From" address if needed
	$headers[] = 'From: Madison River Ranch <no-reply@mrr.marvgibbs.us>';

	// Send mail - use a neutral "To" address (yourself or no-reply)
	if ( defined( 'SEND_BBPRESS_NOTIFICATIONS' ) && SEND_BBPRESS_NOTIFICATIONS ) {
		wp_mail( 'no-reply@mrr.marvgibbs.us', $subject, $body, $headers );
	} else {
		error_log( '[BBPress Notify] Skipped sending email due to SEND_BBPRESS_NOTIFICATIONS=false' );
	}
}
add_action( 'bbp_new_topic', 'custom_bbpress_new_topic_notification' );

/**
 * Custom notification when a new bbPress reply is posted, using BCC
 */
function custom_bbpress_new_reply_notification( $reply_id, $topic_id ): void {

	// List of BCC recipients (same list as topic notifications)
	$additional_recipients = get_board_notification_recipients();

	// Get the topic title and reply content
	$topic_title   = get_the_title( $topic_id );
	$reply_content = bbp_get_reply_content( $reply_id );
	$reply_url     = get_permalink( $reply_id );

	// Email subject and body
	$subject = 'New Reply in Trading Post Topic: ' . $topic_title;
	$body    = "A new reply has been posted in the Trading Post topic:\n\n";
	$body   .= 'Topic: ' . $topic_title . "\n\n";
	$body   .= "Reply Content:\n" . wp_strip_all_tags( $reply_content ) . "\n\n";
	$body   .= 'View it here: ' . $reply_url;

	// BCC headers
	$headers = [];

	foreach ( $additional_recipients as $email ) {
		$headers[] = 'Bcc: ' . $email;
	}

	$headers[] = 'From: Madison River Ranch <no-reply@mrr.marvgibbs.us>';

	// Send email
	if ( defined( 'SEND_BBPRESS_NOTIFICATIONS' ) && SEND_BBPRESS_NOTIFICATIONS ) {
		wp_mail( 'no-reply@mrr.marvgibbs.us', $subject, $body, $headers );
	} else {
		error_log( '[BBPress Notify] Skipped sending email due to SEND_BBPRESS_NOTIFICATIONS=false' );
	}
}

add_action( 'bbp_new_reply', 'custom_bbpress_new_reply_notification', 10, 7 );

/**
 * Exclude Administrator accounts from Front End PM user lists
 *
 * @param array $args WP_User_Query arguments
 * @return array Modified query arguments
 */
function mrr_exclude_admins_from_fep( $args ) {
	// If role__not_in is already set, add to it, otherwise create it
	if ( isset( $args['role__not_in'] ) && is_array( $args['role__not_in'] ) ) {
		if ( ! in_array( 'administrator', $args['role__not_in'] ) ) {
			$args['role__not_in'][] = 'administrator';
		}
	} else {
		$args['role__not_in'] = array( 'administrator' );
	}

	return $args;
}

// Apply to all Front End PM user queries
add_filter( 'fep_directory_arguments', 'mrr_exclude_admins_from_fep' );
add_filter( 'fep_to_search_query_args', 'mrr_exclude_admins_from_fep' );
add_filter( 'fep_ajax_to_query_args', 'mrr_exclude_admins_from_fep' );

/**
 * End of Front End PM
 */

/**
 * Turn off Creative Minds license expired warnings
 */
function custom_admin_styles(): void {
	echo '<style>
        .cminds-notice,
        .notice[class*="cminds"] {
            display: none !important;
        }
    </style>';
}
add_action( 'admin_head', 'custom_admin_styles' );


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
