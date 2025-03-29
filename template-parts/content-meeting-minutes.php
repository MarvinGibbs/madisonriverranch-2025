<?php
global $post;

$publications = new WP_Query( array(
	'post_type'      => 'publication',
	'category_name'  => 'minutes',
	'orderby'        => 'post_id',
	'posts_per_page' => - 1,
	'order'          => 'DECS',
) );
if ( $publications->have_posts() ) : ?>
	<!-- There are publications so open the widget -->
	<div class="widget">
		<h4>Meeting Minutes</h4>
			<?php
			/*
				The html for each year looks like this:

				<ul class="list-unstyled list-inline">
					<li><span class='fa fa-file-pdf-o'></span> <a href='$uri' title='$filename' target='_blank'>$pub_title</a></li>
					<li><span class='fa fa-file-pdf-o'></span> <a href='$uri' title='$filename' target='_blank'>$pub_title</a></li>
				</ul>

				There are usually only 2 newsletter a year so there are only be 2 list items.
				That being said there will be one of the above <ul>'s for each year

			*/

			$current_year = ""; // Empty value used to determine when to close <ul>
			while ( $publications->have_posts() ) : $publications->the_post();

				$post_tags = wp_get_post_tags( $post->ID );
				$tags = wp_list_pluck( $post_tags, 'name' );
				$year = $tags[0];
				if ( strcmp($current_year, $year) != 0 ) :
					// True - Starting a new year
					if ( strcmp($current_year, "") != 0) :
						// True - Closing the previous year
						echo "\n\t\t</ul> <!-- End </ul> $current_year -->";

					endif;

					$current_year = $year;

					echo "\n\t\t<!-- Start <ul> $current_year -->\n\t\t<ul class='list-unstyled list-inline'>";

				endif;
				$uri = get_post_meta( $post->ID, 'wpa_upload_doc', true );
				$filename  = basename( $uri );
				// Filter legacy URLs to strip out bad pipes
				$uri = str_replace( 'http|', 'http://', $uri );
				$uri = str_replace( 'https|', 'https://', $uri );
				$pub_title = $post->post_title;

				echo "\n\t\t\t<li><span class='fa fa-file-pdf-o'></span> <a href='$uri' title='$filename' target='_blank'>$pub_title</a></li>";

			endwhile;

			if ( strcmp($current_year, "") != 0) :
				// True - Closing the last year
				echo "\n\t\t</ul> <!-- End </ul> $current_year -->";
			endif;

			?>

	</div> <!-- .widget -->


<?php endif;
wp_reset_postdata(); ?>
