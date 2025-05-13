<?php
/**
 * Custom Loop - Replies
 *
 * @package bbPress
 * @subpackage Theme
 */

// Get the current topic ID
$topic_id = bbp_get_topic_id();

// Setup arguments to fetch replies
$args = array(
	'post_type'      => bbp_get_reply_post_type(),
	'post_parent'    => $topic_id,
	'post_status'    => [ 'publish', 'reported' ],
	'orderby'        => 'date',
	'order'          => 'ASC',
	'posts_per_page' => -1
);

// Query replies
$replies = get_posts( $args );

if ( ! empty( $replies ) ) :
	echo '<div class="bbp-replies">';

	foreach ( $replies as $reply ) :
		if ( function_exists( 'bbp_get_reply_status' ) && bbp_get_reply_status( $reply->ID ) === 'reported' ) {
			echo '<div class="bbp-template-notice error bbp-rc-reply-is-reported"><p>This reply has been reported for inappropriate content.</p></div>';
		}
		?>

        <div id="reply-<?php echo esc_attr( $reply->ID ); ?>" class="bbp-reply">
			<div class="bbp-reply-header">
				<strong><?php echo esc_html( get_the_author_meta( 'display_name', $reply->post_author ) ); ?></strong> replied on
				<time datetime="<?php echo esc_attr( get_the_date( 'c', $reply ) ); ?>">
					<?php echo esc_html( get_the_date( '', $reply ) ); ?>
				</time>
			</div>


            <div class="bbp-reply-content">
				<?php echo wpautop( $reply->post_content ); ?>
				<?php do_action( 'mrr_after_reply_content_raw', $reply ); ?>

				<?php
				// Manually invoke the plugin's report link logic
				if ( is_user_logged_in() ) {
					$report_plugin = bbp_ReportContent::get_instance();
					if ( $report_plugin ) {
						$args = array(
							'id' => $reply->ID,
							'link_before' => '<span class="bbp-admin-links">',
							'link_after'  => '</span>',
						);
						echo $report_plugin->get_reply_report_link( $args );
					}
				}
				?>
            </div>
		</div>
	<?php
	endforeach;

	echo '</div>';
else :
	// Optional: No replies yet - you can leave this blank or show a message
	// echo '<p>No replies yet. Be the first to reply!</p>';
endif;
?>
