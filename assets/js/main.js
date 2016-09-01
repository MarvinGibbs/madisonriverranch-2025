$(function() {
	// Cache the window object
	var $window = $(window);
	
	// Parallax background effect
	$('section[data-type="background"]').each(function() {
		
		var $bgobj = $(this); // assign the object
		
		var initialYCoord = -1;
		
		$window.scroll(function() {
			
			var yCoord, xCoord;
			
			var bgPos = $bgobj.css( "backgroundPosition" );
			
			var num = /(\d+)/g;
			var numMatch = bgPos.match(num);
			if (numMatch != null) {
				xCoord = numMatch[0];
				yCoord = numMatch[1];
				
				if (initialYCoord == -1) {
					initialYCoord = +yCoord;
				}
			
				// scoll the background at var speed
				// the yPos is a negative value because we are scrolling it UP!
				var yPos = $window.scrollTop() / $bgobj.data('speed');
				
				var newYPercent = initialYCoord + yPos;
				
				// Put together our final background position
				
				var coords = xCoord + '% ' + newYPercent + '%';
				
				// Move the background
				$bgobj.css({backgroundPosition: coords});
			}
		}); // end window scroll
	})
})