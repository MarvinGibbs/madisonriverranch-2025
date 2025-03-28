<?php
/*
	Template Name: FAQs Page	
*/


get_header(); ?>

<!-- FEATURE FAQ IMAGE
=============================================================================== -->
<section class="feature-image feature-image-faq">
	<h1 class="page-title"><?php the_title(); ?></h1>
</section>

<!-- FAQs
=============================================================================== -->
<div class="container">
	<div class="row" id="primary">
		<div id="content" class="col-sm-12">
			
			<section class="main-content">
				
				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php the_content(); ?>
				
				<?php endwhile; ?>
				
			</section> <!-- main-content -->
		</div> <!-- content -->
	</div> <!-- row -->
</div> <!-- container -->

<?php
get_footer();
