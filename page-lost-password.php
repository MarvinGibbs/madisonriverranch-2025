<?php
/*
	Template Name: Lost Password Page	
*/


get_header(); 

?>
		
<!-- FEATURE NEWSLETTERS IMAGE
=============================================================================== -->
<section class="feature-image feature-image-lost-password">
	<h1 class="page-title"><?php the_title(); ?></h1>
</section>

<!-- ARCHIVES SECTION
=============================================================================== -->
<section id="lost-password">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-1">
				<?php echo do_shortcode('[cmreg-reset-password showheader=1]'); ?>
			</div> <!-- .col -->
			
		</div> <!-- .row -->
	</div> <!-- .container -->
</section> <!-- #newsletters -->
				


<?php
get_footer();
