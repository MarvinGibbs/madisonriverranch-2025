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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if we are on a single topic page
        if ( document.body.classList.contains('single-topic') ) {

            var replyForm = document.getElementById('new-post');
            if ( replyForm ) {
                replyForm.addEventListener('submit', function(event) {
                    // Mark that user submitted a reply
                    localStorage.setItem('scrollToLastReply', '1');
                });
            }
        }

        // After reload, if submission flag exists
        if (localStorage.getItem('scrollToLastReply') === '1') {
            localStorage.removeItem('scrollToLastReply');
            setTimeout(function() {
                var replies = document.querySelectorAll('.bbp-reply');
                if (replies.length > 0) {
                    var lastReply = replies[replies.length - 1];
                    lastReply.scrollIntoView({ behavior: 'smooth', block: 'start' });

                    // Optional: highlight effect
                    lastReply.style.backgroundColor = '#ffffcc';
                    setTimeout(function() {
                        lastReply.style.backgroundColor = '';
                    }, 2000);
                }
            }, 800); // slight delay to allow page to render
        }
    });
</script>


	<!-- !FOOTER
	=============================================================================== -->
	<footer>
		<div class="container">
			<div class="row">
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
			</div> <!-- .row -->
		</div> <!-- .container -->
	</footer>

	<!-- Step 7 cleanup: removed the orphaned #myModal newsletter-signup modal (Mailchimp
	     #myOptin form). The board removed the "Subscribe to our Mailing List" feature and
	     replaced it with the "Good Neighbor & Guest Policy" PDF button instead - nothing
	     on the site triggers this modal anymore (confirmed via grep for data-bs-target/
	     href="#myModal" across the theme before removing). Matching JS in main.js removed
	     in the same pass. -->

	<!-- Type kit fonts -->
	<script src="//use.typekit.net/nax0mea.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>

	<script src='https://apis.google.com/js/client.js?onload=handleClientLoad'></script>

<?php wp_footer(); ?>
</body>
</html>
