(function($) {

    $(document).ready(function() {

        // Book info page Sharrre buttons
        $('#twitter').sharrre({
			  share: {
			    twitter: true
			  },
			  template: '<div class="box"><a class="count" href="#">{total}</a><a class="share" href="#"><span class="screen-reader-text">Twitter</span></a></div>',
			  enableHover: false,
			  enableTracking: true,
			  buttons: { twitter: {via: 'Pressbooks'}},
			  click: function(api, options){
			    api.simulateClick();
			    api.openPopup('twitter');
			  }
			});
		$('#facebook').sharrre({
			  share: {
			    facebook: true
			  },
			  template: '<div class="box"><a class="count" href="#">{total}</a><a class="share" href="#"><span class="screen-reader-text">Facbook</span></a></div>',
			  enableHover: false,
			  enableTracking: true,
			  click: function(api, options){
			    api.simulateClick();
			    api.openPopup('facebook');
			  }
			});
		$('#googleplus').sharrre({
			  share: {
			    googlePlus: true
			  },
			  template: '<div class="box"><a class="count" href="#">{total}</a><a class="share" href="#"><span class="screen-reader-text">Google +</span></a></div>',
			  enableHover: false,
			  enableTracking: true,
			  urlCurl: PB_SharrreToken.urlCurl,
			  click: function(api, options){
			    api.simulateClick();
			    api.openPopup('googlePlus');
			  }
			});
			
			


    }); //End of $(document).ready()

})(jQuery); //End of ( function( $ ) {