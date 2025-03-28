<?php
/*
	Template Name: Home Page	
*/


get_header(); ?>

	<?php get_template_part( 'template-parts/content', 'main' ); ?>

	<?php get_template_part( 'template-parts/content', 'subscribe' ); ?>


<!-- NEWS INFO
=============================================================================== -->
<section id="news-info">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<?php get_template_part( 'template-parts/content', 'links' ); ?>
			</div> <!-- .col -->
			<div class="col-sm-3">
				<?php get_template_part( 'template-parts/content', 'recent-newsletters' ); ?>
			</div> <!-- .col -->
			<div class="col-sm-5">
				<?php get_template_part( 'template-parts/content', 'upcoming-events' ); ?>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
	
</section>


<?php
get_footer();
