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
				<?php include get_template_directory() . '/inc/bbpress-forum-guidelines.php'; ?>
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
