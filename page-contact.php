<?php
/*
	Template Name: Contact Page	
*/


get_header(); 

?>

<!-- FEATURE IMAGE
=============================================================================== -->
<section class="feature-image feature-image-contact">
	<h1 class="page-title"><?php the_title(); ?></h1>
</section>

<!-- CONTACT
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