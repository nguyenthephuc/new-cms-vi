jQuery(document).ready(function(){
	var loadding = "<center style='margin-top: 10%'>Loading...</center>";
	var mainContent = jQuery('#page-wrapper');
	if(typeof history.pushState !== 'undefined'){
		jQuery('body').on('click', 'a.request', function(e){
			mainContent.html(loadding);
			var url = jQuery(this).attr('href');
			jQuery.get(url, function(data){
				jQuery.ytLoad({
					registerAjaxHandlers: false
				});
				jQuery.ytLoad('start');
				mainContent.html(data);
				// after load data -> get title
				var title = jQuery('#pagetitle').val();
				jQuery('title').text(title);
				jQuery('#panelTile').text(title);
				jQuery('#navicationTile').text(title);
				jQuery.ytLoad('complete');
				history.pushState(data, title, url);
				var newheight = jQuery(document).height();
				jQuery('#dhtmlgoodies_xpPane').height(newheight);
			}); // end get
			e.preventDefault();
		}); // end body on click

		window.onpopstate = function(e){
			if(e.state != null){
				jQuery.ytLoad({
					registerAjaxHandlers: false
				});
				jQuery.ytLoad('start');
				mainContent.html(e.state);
				var title = jQuery('#pagetitle').val();
				jQuery('title').text(title);
				jQuery('#panelTile').text(title);
				jQuery('#navicationTile').text(title);
				jQuery.ytLoad('complete');
				e.preventDefault();
				var newheight = jQuery(document).height();
				jQuery('#dhtmlgoodies_xpPane').height(newheight);
			}
		}; // end onpopstate
		history.pushState(mainContent.html(), jQuery('title').text(), location.href);
	} // end if
});