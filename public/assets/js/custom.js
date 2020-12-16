$(document).ready(function () {
    AOS.init();

    if ($(window).width() > 991) {
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

    $("#searchBtn").on('click', function (e) {
        $(this).hide();
        $("#searchForm").show();
        $("#searchForm input").focus();
    });

    $("#searchForm input").focusout(function (e) {
        $("#searchBtn").show();
        $("#titleBarNav").removeClass("hidden");
        $("#searchForm").hide();
    });

    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }

    $('.slugify').keyup(function(){
        $('#'+$(this).data('target')).val(slugify($(this).val()))
    })

    // Start Text Typing
    const words = [
        "Article",
        "Reviews",
        "Stories",
        "Geeks",
        "Technology",
        "Games",
        "Foodies",
        "Programming",
        "Pop Culture",
        "Design",
      ];
    const timePerWord = 3000; // milliseconds
    const timePerLetter = 50; //milliseconds
    
    let current = words[0];
    const wordEl = document.getElementById("switchtext");
    
    setInterval(switchText, timePerWord);
    
    async function switchText() {
        const index = words.indexOf(current);
        const curLength = current.length;
    
        for (let i = 0; i <= curLength; i += 1) {
            await wait(timePerLetter);
            current = current.substring(0, current.length - 1);
            wordEl.innerText = current;
        }
    
        await wait(current.length * timePerLetter);
    
        const newWord = words[index + 1] || words[0];
            for (let idx = 0; idx <= newWord.length; idx += 1) {
                await wait(timePerLetter);
                current = newWord.substring(0, idx);
                wordEl.innerText = current;
            }
    }
    
    function wait(timeout) {
        return new Promise((resolve) => setTimeout(() => resolve(), timeout));
    }
    // End Text Typing

    // Image Movement - Maximum offset for image
		var maxDeltaX = 20,
        maxDeltaY = 20;

    $(document).on('mousemove', function(e) {

        // Get viewport dimensions
        var viewportWidth = document.documentElement.clientWidth,
            viewportHeight = document.documentElement.clientHeight;

        var mouseX = e.pageX / viewportWidth * 2 - 1,
        mouseY = e.pageY / viewportHeight * 2 - 1;

        // Calculate how much to transform the image
        var translateX = mouseX * maxDeltaX,
            translateY = mouseY * maxDeltaY;
        $('.animated').css('transform', 'translate('+translateX+'px, '+translateY+'px)');
    });
    // Image Movement End

    // Navbar Scroll
    $(window).scroll(function() {
        if($(window).width() > 767 && $(this).scrollTop() > 1) { 
            $('.navbar').removeClass('navbar-transparent');
            $('.navbar').addClass('border');
        } else {
            $('.navbar').addClass('navbar-transparent');
            $('.navbar').removeClass('border');
        }
    });
});

