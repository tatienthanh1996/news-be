jQuery(document).ready(function ($) {
    
    // Header sticky
    //add a space for header
    if (jQuery('.header-sticky').length > 0) {
        var headerSpaceH = jQuery('.header-sticky').height();
        jQuery('.header-sticky').after('<div class="headerSpace" style="height: ' + headerSpaceH + 'px;"></div>');
    }
    var didScroll;
    var lastScrollTop = 0;
    var headerHeight = jQuery('.header').outerHeight();
    // var headerPosition = jQuery('.header').offset().top;
    jQuery(window).scroll(function (event) {
        didScroll = true;
    });
    setInterval(function () {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 50);

    function hasScrolled() {
        var st = jQuery(this).scrollTop();
        if (Math.abs(lastScrollTop - st) <= 50)
            return;
        if (st > lastScrollTop || st < headerHeight) {
            jQuery('.headerSpace').removeClass('show');
            jQuery('.header-sticky').removeClass('on-top');
            jQuery('#back-top').removeClass('show');
        } else {
            jQuery('.headerSpace').addClass('show');
            jQuery('.header-sticky').addClass('on-top');
            // jQuery('.header-sticky').css("height", headerSpaceH);
            jQuery('#back-top').addClass('show');
        }
        lastScrollTop = st;
    }

});













        




