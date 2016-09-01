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
			<div class="col-sm-3">
				<p><a href="/"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/img/mrr-logo.png" alt="Madison River Ranch"></a></p>
			</div> <!-- .col -->
			<div class="col-sm-6">
				<nav>
					<ul class="list-unstyled list-inline">
						<li><a href="">Home</a></li>
						<li><a href="">Board</a></li>
						<li><a href="">Archives</a></li>
						<li><a href="">Contact</a></li>
					</ul>
				</nav>
			</div> <!-- .col -->
			<div class="col-sm-3">
				<p class="pull-right">&copy; 2016 Madison River Ranch</p>
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
					
					<form class="form-inline" role="form">
						<div class="form-group">
							<label class="sr-only" for="subscribe-name">Your name</label>
							<input type="text" class="form-control" id="subscribe-name" placeholder="Your name">
						</div> <!-- form-group -->
						<div class="form-group">
							<label class="sr-only" for="subscribe-email">and your email</label>
							<input type="text" class="form-control" id="subscribe-email" placeholder="and your email">
							<input type="submit" class="btn btn-danger" value="Subscribe">
						</div> <!-- form-group -->	
					</form> <!-- form -->
					
					<hr>
					
					<p><small>By providing your email you consent to receiving occasional emails &amp; newsletters. <br>No Spam. Just good stuff. We respect your privacy &amp; you may unsubscribe at any time.</small></p>
				</div> <!-- modal-body -->
				
				
			</div> <!-- modal-content -->
		</div> <!-- modal-dialog -->
	</div> <!-- modal -->

	<!-- BOOTSTRAP CORE JAVASCRIPT
		Place at the end of the document so the pages load faster!
	===============================================================================  -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
	
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/main.js" type="text/javascript"></script>
	
	<!-- Type kit fonts -->
	<script src="//use.typekit.net/nax0mea.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>	
		
</body>
</html>
