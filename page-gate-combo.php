<?php
/*
	Template Name: Gate Combo Page	
*/


get_header(); 

$gate_title= get_field( 'gate_title' );
$main_gate_combination = get_field('main_gate_combination');
$common_area_combination = get_field('common_area_combination');

?>
		
<!-- FEATURE GATE COMBO IMAGE
=============================================================================== -->
<section class="feature-image feature-image-gate">
	<h1 class="page-title"><?php echo $gate_title; ?></h1>
</section>

<!-- ARCHIVES SECTION
=============================================================================== -->
<section id="gate-combination">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-1">
                <h3>Main & Upper Gate #<?php echo $main_gate_combination; ?></h3>
                <h3>Common Area Gate #<?php echo $common_area_combination; ?></h3>
			</div> <!-- .col -->
			
		</div> <!-- .row -->
	</div> <!-- .container -->
</section> <!-- #newsletters -->
				


<?php
get_footer();
