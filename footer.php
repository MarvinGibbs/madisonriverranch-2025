<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Madison_River_Ranch
 */

?>


<?php wp_footer(); ?>

	<!-- !FOOTER
	=============================================================================== -->
	<footer>
		<div class="container">
			<div class="col-sm-4">
				<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/mrr-logo.png" alt="Madison River Ranch"></a></p>
			</div> <!-- .col -->
			<div class="col-sm-5">
				<?php 
						
					wp_nav_menu( array (
						
						'theme_location' 	=> 'footer',
						'container'			=> 'nav',
						'menu_class'		=> 'list-unstyled list-inline'
							
					)); 
					
				?>
			</div> <!-- .col -->
			<div class="col-sm-3">
				<p class="pull-right">&copy; 2009-<?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
			</div> <!-- .col -->
		</div> <!-- .container -->	
	</footer>
	
	<!-- !MODAL
	=============================================================================== -->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						<i class="fa fa-envelope"></i> Subscribe to our Mailing List
					</h4>
				</div> <!-- modal-header -->
				
				<div class="modal-body">
					<p>Simply enter you name and email! And you will receive all association newsletters and mailings</p>
					
					<!-- Begin MailChimp Signup Form -->
					<form action="//madisonriverranch.us14.list-manage.com/subscribe/post?u=69ced26c172bdf3d569b623a1&amp;id=8574a75125" method="post" name="mc-embedded-subscribe-form" class="form-inline validate" target="_blank" novalidate role="form" id="myOptin">
						<div class="form-group">
							<label class="sr-only" for="mce-FNAME">Your name</label>
							<input type="text" name="FNAME" class="form-control" id="mce-FNAME" placeholder="Your name">
						</div> <!-- form-group -->
					    <div class="form-group">
						    <label class="sr-only" for="mce-EMAIL">and your email</label>
							<input type="email" value="" name="EMAIL" class="form-control" id="mce-EMAIL" placeholder="and your email">
						    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_69ced26c172bdf3d569b623a1_8574a75125" tabindex="-1" value=""></div>
						    <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-danger" disabled="disabled">
					    </div> <!-- form-group -->
					</form>

					<!--End mc_embed_signup-->
					
					<hr>
					
					<p><small>By providing your email you consent to receiving occasional emails &amp; newsletters. <br>No Spam. Just good stuff. We respect your privacy &amp; you may unsubscribe at any time.</small></p>
				</div> <!-- modal-body -->
				
				
			</div> <!-- modal-content -->
		</div> <!-- modal-dialog -->
	</div> <!-- modal -->

	<!-- BOOTSTRAP CORE JAVASCRIPT
		Place at the end of the document so the pages load faster!
	===============================================================================  -->
    
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
 	<script src="<?php bloginfo('template_directory'); ?>/assets/js/main.js" type="text/javascript"></script>
	
	<!-- Type kit fonts -->
	<script src="//use.typekit.net/nax0mea.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>	

	<script src='https://apis.google.com/js/client.js?onload=handleClientLoad'></script>
		
</body>
</html>