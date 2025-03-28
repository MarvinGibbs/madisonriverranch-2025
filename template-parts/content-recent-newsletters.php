<?php 	
global $post;

$publications = new WP_QUERY( array(	'post_type' => 'publication',
										'category_name' => 'newsletters', 
										'orderby' => 'post_id', 
										'order' => 'DECS' ) ); 
if ( $publications->have_posts() ) : ?>
	<!-- There are publications so open the widget -->
	<div class="widget">
		<h4>Recent Newsletters</h4>	
			<ul>

			<?php
				$max = 2;
				$count = 0;
				while ( $publications->have_posts() ) : $publications->the_post();
					$count = $count + 1;
					$uri = get_post_meta( $post->ID, 'wpa_upload_doc', true );
					$filename  = basename( $uri );
					// Filter legacy URLs to strip out bad pipes
					$uri = str_replace( 'http|', 'http://', $uri );
					$uri = str_replace( 'https|', 'https://', $uri );
					$pub_title = $post->post_title;
			
					echo "<li><i class='fa fa-file-pdf-o'></i> <a href='$uri' title='$filename' target='_blank'>$pub_title</a></li>";
					
					if ($count == $max) {
						break;
					}
			
				endwhile; ?>

		</ul>
	</div> <!-- .widget -->
	
	
<?php endif;
wp_reset_postdata(); ?>
