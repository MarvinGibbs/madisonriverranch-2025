<?php

$board_title = get_field( 'board_title' );

?>

<!-- !BOARD
=============================================================================== -->
<section id="board" class="feature-image-board">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<h2><?php echo $board_title; ?></h2>

				<?php
				$loop = new WP_Query(
					[
						'post_type' => 'board_member',
						'orderby'   => 'post_id',
						'order'     => 'ASC',
					]
				);

				while ( $loop->have_posts() ) :
					$loop->the_post();
					?>

					<!-- MEMBERS -->
					<div class="row member">
						<div class="col-sm-4">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( [ 200, 200 ] );
							}
							?>
						</div> <!-- .col -->
						<div class="col-sm-8">
							<blockquote>
							<?php the_title(); ?>
								<cite>
								<?php the_content(); ?>
								</cite>
							</blockquote>
						</div> <!-- .col -->
					</div> <!-- .row -->

						<?php
				endwhile;

					wp_reset_query();
				?>

			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</section> <!-- #board -->
