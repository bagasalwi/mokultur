$(document).ready(function () {
    AOS.init();

    // alert('text');

    if ($(window).width() > 991){
        $('.navbar-light .d-menu').hover(function () {
            $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
        }, function () {
            $(this).find('.sm-menu').first().stop(true, true).delay(120).slideUp(100);
            });
        }
        
    // jQuery code
    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var offcanvas_id = $(this).attr("data-trigger");
        $(offcanvas_id).toggleClass("show");
        $("body").toggleClass("offcanvas-active");
        $(".screen-overlay").toggleClass("show");
    });
    
    // Close menu when pressing ESC
    $(document).on("keydown", function (event) {
        if (event.keyCode === 27) {
        $(".mobile-offcanvas").removeClass("show");
        $("body").removeClass("overlay-active");
        }
    });
    
    $(".btn-close, .screen-overlay").click(function (e) {
        $(".screen-overlay").removeClass("show");
        $(".mobile-offcanvas").removeClass("show");
        $("body").removeClass("offcanvas-active");
    });
    
    // add padding top to show content behind navbar
    $('body').css('padding-top', $('.navbar').outerHeight() + 'px')

    // detect scroll top or down
    if ($('.smart-scroll').length > 0) { // check if element exists
        var last_scroll_top = 0;
        $(window).on('scroll', function() {
            scroll_top = $(this).scrollTop();
            if(scroll_top < last_scroll_top) {
                $('.smart-scroll').removeClass('scrolled-down').addClass('scrolled-up');
            }
            else {
                $('.smart-scroll').removeClass('scrolled-up').addClass('scrolled-down');
            }
            last_scroll_top = scroll_top;
        });
    }

    $("#searchBtn").on('click', function(e) {
        $(this).hide();
        $("#searchForm").show();
        $("#searchForm input").focus();
    });

    $("#searchForm input").focusout(function(e){
        $("#searchBtn").show();
        $("#titleBarNav").removeClass("hidden");
        $("#searchForm").hide();
    });

});
