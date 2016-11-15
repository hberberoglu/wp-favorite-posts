jQuery(document).ready( function($) {
    $('.wpfp-span').on('click', '.wpfp-link', function() {
        var dhis = $(this);
        wpfp_do_js( dhis, 1 );
        // For favorite post listing page
				if (dhis.hasClass('remove-parent')) {
					dhis.parent("li").fadeOut();
				}
        return false;
    });
		
		$('.wpfp-widget-ul').on('click', '.wpfp-link', function() {
			var dhis = $(this);
			wpfp_do_js( dhis, 1 );
			// For favorite post listing page
			if (dhis.hasClass('remove-parent')) {
				dhis.parent("li").fadeOut();
			}
			return false;
		});
		
});

function wpfp_do_js( dhis, doAjax ) {
	loadingImg = dhis.prev();
	loadingImg.show();
	beforeImg = dhis.prev().prev();
	beforeImg.hide();
	url = document.location.href.split('#')[0];
	params = dhis.attr('href').replace('?', '') + '&ajax=1';
	if ( doAjax ) {
		jQuery.get(url, params, function(data) {
			dhis.parent().html(data);
			if(typeof wpfp_after_ajax == 'function') {
				wpfp_after_ajax( dhis ); // use this like a wp action.
			}
			loadingImg.hide();
		}
		);
	}
}
