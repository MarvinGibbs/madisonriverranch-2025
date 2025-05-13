<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_single_topic' ); ?>

<div id="bbp-topic-<?php bbp_topic_id(); ?>" class="bbp-topic-single">

    <div class="bbp-topic-header">
        <h1 class="bbp-topic-title"><?php bbp_topic_title(); ?></h1>
        <div class="bbp-topic-meta">
			<?php bbp_topic_author_link(); ?> on <?php bbp_topic_post_date(); ?>
	        <?php bbp_topic_admin_links(); ?>
        </div>
    </div>

    <div class="bbp-topic-content">
		<?php bbp_topic_content(); ?>
		<?php do_action( 'mrr_after_topic_content', bbp_get_topic_id() ); ?>
    </div>

</div>

<?php
// ✨ NEW: Add the replies loop and the reply form below the topic
bbp_get_template_part( 'pagination', 'replies' );
bbp_get_template_part( 'loop', 'replies' );
bbp_get_template_part( 'form', 'reply' );
?>

<?php do_action( 'bbp_template_after_single_topic' ); ?>
