<?php
/**
	Template Name: Trading Post Page
 */

get_header();

?>

<!-- FEATURE IMAGE
=============================================================================== -->
<section class="feature-image feature-image-forums">
	<h1 class="page-title"><?= 'Trading Post'; ?></h1>
</section>

	<div class="container">
		<div class="row" id="primary">
			<div id="content" class="col-sm-12">
				<div class="panel-group" id="accordion">
					<div class="bbp-guidelines">
						<strong>Trading Post Guidelines:</strong> Please be respectful, stay on topic, and follow all community rules.
						<a class="panel-heading" id="read-more-less" data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">Read More</a>
					</div>
					<div id="collapseOne" class="panel-collapse collapse">
				<div class="panel-body">

				<?php require get_template_directory() . '/inc/bbpress-forum-guidelines.php'; ?>

					<div style="text-align: left; padding-left: 3em; padding-bottom: 1em;">
						<a class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">Read Less</a>
					</div>
				</div>
			</div>
                    <div class="forums-optin-wrap">
						<?php echo do_shortcode( '[bbpnns_optin]' ); ?>
                    </div>
                    <div class="forum-breadcrumbs">
	            <?php echo do_shortcode('[forum_breadcrumbs]'); ?>
            </div>
		</div>


		<section class="main-content">

			<?php
			do_action( 'before_main_content' );

			if ( bbp_is_single_forum() ) {
				bbp_get_template_part( 'content', 'single-forum' );
			} elseif ( bbp_is_single_topic() ) {
				bbp_get_template_part( 'content', 'single-topic' );
			} elseif ( bbp_is_single_reply() ) {
				bbp_get_template_part( 'content', 'single-reply' );
			} elseif ( bbp_is_forum_archive() || bbp_is_topic_archive() ) {
				bbp_get_template_part( 'content', 'archive-forum' );
			} else {
				the_content(); // fallback if no bbPress content
			}

			do_action( 'after_main_content' );
			?>


				</section> <!-- main-content -->
			</div> <!-- content -->
		</div> <!-- row -->
	</div> <!-- container -->


<?php
get_footer();
