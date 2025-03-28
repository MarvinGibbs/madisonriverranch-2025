<?php
/*
	Template Name: Newsletters Page	
*/


get_header(); 

?>
		
<!-- FEATURE NEWSLETTERS IMAGE
=============================================================================== -->
<section class="feature-image feature-image-newsletters">
	<h1 class="page-title"><?php the_title(); ?></h1>
</section>

<!-- ARCHIVES SECTION
=============================================================================== -->
<section id="newsletters">
	<div class="container">
		<div class="row">
			<div class="col-sm-5 col-sm-offset-1">
				<?php get_template_part( 'template-parts/content', 'newsletters' ); ?>
			</div> <!-- .col -->
			
		</div> <!-- .row -->
	</div> <!-- .container -->
</section> <!-- #newsletters -->
				


<?php
get_footer();
