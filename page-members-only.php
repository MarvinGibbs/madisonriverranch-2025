<?php
/*
	Template Name: Members Only Page	
*/


get_header(); 

?>
		
<!-- FEATURE MEMBERS ONLY IMAGE
=============================================================================== -->
<section class="feature-image feature-image-members-only">
	<h1 class="page-title"><?php the_title(); ?></h1>
</section>

<!-- ARCHIVES SECTION
=============================================================================== -->
<section id="members-only">
	<div class="container">
		<div class="row">
			<div class="col-sm-5 col-sm-offset-1">
				<?php get_template_part( 'template-parts/content', 'financials' ); ?>
			</div> <!-- .col -->
			<div class="col-sm-5 col-sm-offset-1">
				<?php get_template_part( 'template-parts/content', 'meeting-minutes' ); ?>
			</div> <!-- .col -->
			
		</div> <!-- .row -->
	</div> <!-- .container -->
</section> <!-- #newsletters -->
				


<?php
get_footer();