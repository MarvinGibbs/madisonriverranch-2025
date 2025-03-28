<?php
/*
	Template Name: Access Denied Page	
*/


get_header(); 

?>
		
<!-- FEATURE MEMBERS ONLY IMAGE
=============================================================================== -->
<section class="feature-image feature-image-access-denied">
	<h1 class="page-title"><?php the_title(); ?></h1>
</section>

<!-- ARCHIVES SECTION
=============================================================================== -->
<section id="accessdenied">
	<div class="container">
		<div id="primary" class="row">
			<main id="content" class="col-sm-8">
				<div class="error-404 not-found">
					<div class="page-content">
						<h2>Sorry but you have no access to this content.</h2>
						<h3> You must be logged in. <a href="#cmreg-only-login-click">Click here to login</a></h3>
						
						<h3>... or , just head back to the <a href="<?php echo esc_url( home_url( '/' ) ); ?>">home page</a>.</h3>
						
					</div> <!-- .page-content -->
				</div> <!-- .error-404 -->
			</main> <!-- #content -->
		</div> <!-- #primary -->
	</div> <!-- .container -->
</section> <!-- #accessdenied -->
				


<?php
get_footer();