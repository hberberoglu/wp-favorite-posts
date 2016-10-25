jQuery(document).ready( function($) {
    $('.wpfp-link').live( 'click', function() {
        var dhis = $(this);
        wpfp_do_js( dhis, 1 );
        // For favorite post listing page
        if ( dhis.hasClass( 'remove-parent' ) ) {
            if ( typeof $.fn.Velocity !== 'undefined' ) {
                dhis.parent("li").velocity('fadeOut');
            } else {
                dhis.parent("li").fadeOut();
            }
        }
        return false;
    });
});

var wpfp_do_js = function( dhis, doAjax ) {
    var loadingImg = dhis.prev();
    var beforeImg = dhis.prev().prev();
    var url = document.location.href.split('#')[0];
    var params = dhis.attr('href').replace('?', '') + '&ajax=1';

    if ( typeof $.fn.Velocity !== 'undefined ' ) {
        loadingImg.velocity({ opacity: 1 }, { display: 'inline-block' })
        beforeImg.velocity({ opacity: 0 }, { display: 'none' })
    } else {
        loadingImg.show();
        beforeImg.hide();
    }

    if ( doAjax ) {
        jQuery.get( url, params, function(data) {
                dhis.parent().html(data);
                if ( typeof wpfp_after_ajax == 'function' ) {
                    wpfp_after_ajax( dhis ); // Use this like a WP action.
                }
                if ( typeof $.fn.Velocity !== 'undefined' ) {
                    loadingImg.velocity({ opacity: 0 }, { display: 'none' });
                } else {
                    loadingImg.hide();
                }
            }
        );
    }
};
