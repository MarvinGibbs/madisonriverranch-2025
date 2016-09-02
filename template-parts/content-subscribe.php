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
				<button class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#myModal">
					<?php echo $subscribe_button_text; ?>
				</button>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->	
</section> <!-- #optin -->
