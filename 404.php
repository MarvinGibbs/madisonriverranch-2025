<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Madison_River_Ranch
 */

get_header(); ?>

	<!-- FEATURE ARCHIVES IMAGE
	=============================================================================== -->
	<section class="feature-image feature-image-archives">
		<h1 class="page-title">Sorry! That page can't be found.</h1>
	</section>

	<div class="container">
		<div id="primary" class="row">
			<main id="content" class="col-sm-8">
				<div class="error-404 not-found">
					<div class="page-content">
						<h2>Don't fret! Let's get you back on track.</h2>
						
						<!-- NEWSLETTERS
						=============================================================================== -->
						<h3>Newsletters</h3>
						<p>Perhaps you were looking for a newsletter</p>
						<?php get_template_part( 'template-parts/content', 'newsletters' ); ?>
						
						<p>... or , just head back to the <a href="<?php echo esc_url( home_url( '/' ) ); ?>">home page</a>.</p>
						
					</div> <!-- .page-content -->
				</div> <!-- .error-404 -->
			</main> <!-- #content -->
		</div> <!-- #primary -->
	</div> <!-- .container -->

<?php
get_footer();
