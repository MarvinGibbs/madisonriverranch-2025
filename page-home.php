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
				<div class="widget">
				<h4>Links of Interest</h4>	
				<ul>
					<li><a href="http://rwis.mdt.mt.gov/scanweb/swframe.asp?Pageid=RPUStatus&Units=English&Groupid=564000&Siteid=564000&DisplayClass=Java&SenType=All;" target="_blank">Raynolds Pass Web Cam</a></li>
					<li><a href="https://www.slideinn.com/blogs/" target="_blank">Galloup's Slide Inn Fishing Report</a></li>
					<li><a href="http://www.mrfc.com/MadisonRiverMontanaFishing/MadisonRiverReport.aspx" target="_blank">Madison River Fishing Company Report</a></li>
					<li><a href="http://waterdata.usgs.gov/mt/nwis/uv/?site_no=06038500&PARAmeter_cd=00060,00065,00010" target="_blank">Madison Streamflow below Hebgen Dam</a></li>
					<li><a href="http://waterdata.usgs.gov/mt/nwis/uv/?site_no=06038800&PARAmeter_cd=00060,00065,00010" target="_blank">Madison Streamflow at Kirby Ranch</a></li>
					<li><a href="http://www.michaelcramerphotography.com" target="_blank">Website Images from Mike Cramer</a></li>
				</ul>
			</div> <!-- widget -->
			</div> <!-- .col -->
			<div class="col-sm-4">
				<div class="widget">
					<h4>Recent Newsletters</h4>	
					<ul>
						<li><a href="">Spring, 2016</a></li>
						<li><a href="">Fall, 2015</a></li>
						<li><a href="">Spring, 2015</a></li>
					</ul>
				</div> <!-- widget -->

			</div> <!-- .col -->
			
			<div class="col-sm-4">
				<div class="widget">
					<h4>Upcoming Events</h4>
					<ul>
						<li>Owners meeting June, 26, 2016</li>
						<li>Ranch work day June, 27, 2016</li>
					</ul>
				</div> <!-- .widget -->
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
	
</section>


<?php
get_footer();
