        $(document).ready(function() {
            $(window).on("scroll", function() {
                var wn = $(window).scrollTop();
                if (wn > 1) {
                    $(".nav").css("background", "rgba(0, 0, 0, .91)");
                } else {
                    $(".nav").css("background", "rgba(0, 0, 0, .0)");
                }
            });
        });