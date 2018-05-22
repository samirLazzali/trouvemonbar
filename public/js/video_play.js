$(document).ready(function () {
    var media = $('video').not("[autoplay='autoplay']");
    var tolerancePixel = 250;

    function checkMedia() {
        var scrollTop = $(window).scrollTop() + tolerancePixel;
        var scrollBottom = $(window).scrollTop() + $(window).height() - tolerancePixel;

        media.each(function (index, el) {
            var yTopMedia = $(this).offset().top;
            var yBottomMedia = $(this).height() + yTopMedia;

            if (scrollTop < yBottomMedia && scrollBottom > yTopMedia) {
                $(this).get(0).play();
            } else {
                $(this).get(0).pause();
            }
        });

    }
    $(document).on('scroll', checkMedia);
});
