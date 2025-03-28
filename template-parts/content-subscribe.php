<?php 
// Advanced Custom Fields
$subscribe_text 		= get_field( 'subscribe_text' );
$subscribe_button_text 	= get_field( 'subscribe_button_text' );
 ?>

<!-- !OPT IN SECTION
=============================================================================== -->
<section id="optin">
	<div class="container">
		<div class="row">
			<div class="col-sm-offset-2 col-sm-6">
				<p class="lead"><strong><?php echo $subscribe_text; ?></strong></p>
			</div> <!-- .col -->
			<div class="col-sm-4">
				<a class="btn btn-success btn-lg btn-block" href="/wp-content/uploads/2022/08/MRR-Guest-Letter-2.pdf" target="_blank">
					<?php echo $subscribe_button_text; ?>
				</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->	
</section> <!-- #optin -->
