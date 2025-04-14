<?php
/**
	Template Name: Forums Page
 */

get_header();

?>

<!-- FEATURE IMAGE
=============================================================================== -->
<section class="feature-image feature-image-forums">
	<h1 class="page-title"><?= 'Forums'; ?></h1>
</section>

	<div class="container">
		<div class="row" id="primary">
			<div id="content" class="col-sm-12">
				<div class="panel-group" id="accordion">
					<div class="bbp-guidelines">
						<strong>Forum Guidelines:</strong> Please be respectful, stay on topic, and follow all community rules.
						<a class="panel-heading" id="read-more-less" data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">Read More</a>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in>
				<div class="panel-body">

				<?php require get_template_directory() . '/inc/bbpress-forum-guidelines.php'; ?>

					<div style="text-align: left; padding-left: 3em; padding-bottom: 1em;">
						<a class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne">Read Less</a>
					</div>
				</div>
			</div>
		</div>


		<section class="main-content">

					<?php
					while ( have_posts() ) :
						the_post();

						the_content();

					endwhile; // End of the loop.
					?>


				</section> <!-- main-content -->
			</div> <!-- content -->
		</div> <!-- row -->
	</div> <!-- container -->


<?php
get_footer();
