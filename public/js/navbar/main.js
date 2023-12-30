(function ($) {
    $(window).scroll(function () {
        if ($(document).scrollTop() > 300) {
            // Navigation Bar
            $('.navbar').removeClass('fadeIn');
            $('.navbar').addClass('fixed-top animated fadeInDown');
        } else {
            $('.navbar').removeClass('fadeInDown');
            $('.navbar').removeClass('fixed-top');
            $('.navbar').addClass('animated fadeIn');
        }
    });
})(jQuery);