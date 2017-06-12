(function ($) {

    "use strict";

    $('.scroll').click(function() {
        var id = this.hash;
        scrollTo(id);
        return false;


    });

    function scrollTo(id) {
        var slideTo = jQuery(id).position().top;

        // slide button

        $('html,body').animate({
            scrollTop:slideTo + 'px'
        }, 1500, 'easeInOutExpo');
    }


    // Add handler on 'Scroll down to learn more' link
    $().ready(function(){
        $(".content-scroll .scroll-button").click(function(e){
            e.preventDefault();
            $("body,html").animate({scrollTop: $(window).height()});
        });
    });

}(jQuery));

