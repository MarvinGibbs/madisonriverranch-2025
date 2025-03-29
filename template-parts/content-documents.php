<?php
	global $post;

	$publications = new WP_QUERY( array( 	'post_type' => 'publication',
											'category_name' => 'ranch_documents',
											'orderby' => 'name',
											'order' => 'DESC' ) );

	if ( $publications->have_posts() ) : ?>
		<div class="widget">
			<h3>Documents</h3>
			<ul>
				<?php while ( $publications->have_posts() ) : $publications->the_post();
					$uri = get_post_meta( $post->ID, 'wpa_upload_doc', true );
					$filename  = basename( $uri );
					// Filter legacy URLs to strip out bad pipes
					$uri = str_replace( 'http|', 'http://', $uri );
					$uri = str_replace( 'https|', 'https://', $uri );
					$pub_title = $post->post_title;
					 echo "<li><i class='fa fa-file-pdf-o'></i> <a href='$uri' title='$filename' target='_blank'>$pub_title</a></li>";
				 endwhile;
				 wp_reset_postdata();
				?>

			</ul>
		</div> <!-- .widget -->

	<?php
	endif;
?>
