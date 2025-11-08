<!-- !MAIN
=============================================================================== -->
<section id="main-section">
	<article>
		<div class="container clearfix">
			<div class="row">
				<div class="col-sm-offset-5 col-sm-7 main-section-text">
					<h1><?php bloginfo('name'); ?></h1>
					<p class="lead"><?php bloginfo('description'); ?></p>

					<!-- 🔔 Info Line -->
					<p class="lead">
						Our site now has the <strong>Trading Post</strong> feature.
					</p>

					<!-- 🎯 View Demo Button -->
					<div class="demo-button-wrap text-center">
						<button id="viewDemoBtn" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#videoModal">
							View Trading Post Demo
						</button>
					</div>

					<!-- 🎥 Bootstrap Modal -->
					<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="videoModalLabel">Trading Post Demo</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body text-center">
									<video controls autoplay width="100%">
										<source src="/wp-content/uploads/2025/07/TradingPost-Demo.mp4" type="video/mp4">
										Your browser does not support the video tag.
									</video>
								</div>
							</div>
						</div>
					</div>

				</div> <!-- .col -->
			</div> <!-- .row -->
		</div> <!-- .container -->
	</article>

</section> <!-- #main-section -->
