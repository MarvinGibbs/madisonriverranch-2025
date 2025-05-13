<?php
/**
Template Name: Forum Guidelines
 */

add_action(
	'wp_footer',
	function () {
		if ( is_page( 'forum-guidelines' ) && is_user_logged_in() ) {
			?>
		<script>
			document.addEventListener("DOMContentLoaded", function () {
				const agreeBtn = document.getElementById("agree-btn");

				if (agreeBtn) {
					agreeBtn.addEventListener("click", function () {
						fetch("<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>", {
							method: "POST",
							headers: {
								"Content-Type": "application/x-www-form-urlencoded"
							},
							body: new URLSearchParams({
								action: "set_forum_agreement",
								_ajax_nonce: "<?php echo esc_attr( wp_create_nonce( 'forum_agree_nonce' ) ); ?>"
							})
						})
							.then(res => res.json())
							.then(data => {
								if (data.success) {
									window.location.href = "<?php echo esc_url( home_url( '/trading-post/' ) ); ?>";
								} else {
									alert("There was a problem saving your agreement.");
								}
							});
					});
				}
			});
		</script>
			<?php
		}
	}
);

require 'header.php';
?>

	<div class="container" id="forum-guidelines">
		<div class="row" id="primary">
			<div id="content" class="col-sm-12">
				<label>To participate with Trading Post you must read these Guidelines and click 'I Agree' at the bottom!</label>
				<h4>Trading Post Guidelines</h4>
				<?php require get_template_directory() . '/inc/bbpress-forum-guidelines.php'; ?>

				<form method="post">
					<input type="checkbox" name="agree" id="agree" required>
					<label for="agree">I have read and agree to the forum guidelines.</label>
					<input type="submit" id="agree-btn" name="agree-btn" value="I Agree">
				</form>

			</div> <!-- content -->
		</div> <!-- row -->
	</div> <!-- container -->

<?php

require 'footer.php';
