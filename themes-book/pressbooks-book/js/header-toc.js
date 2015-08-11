(function($) {

	// Header TOC show/hide menu
	$(document).ready(function() {

		// Header search box
		$('#header-toc').hide();
		$('a.header-toc-btn').click(function() {
			$('#header-toc').slideToggle(500);
			return false;
		});

	});

})(jQuery); //End of ( function( $ ) {