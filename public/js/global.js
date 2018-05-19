$('.toggleAnnonce').on('click', function(e) {
    var elem = $(this).parent().parent().children('.more');

    if (elem.css('display') == 'none') {
	$(this).parent().parent().children('.more').css('display', 'block');
	$(this).children().removeClass("fas fa-angle-down");
	$(this).children().addClass("fas fa-angle-up");
    } else {
	$(this).parent().parent().children('.more').css('display', 'none');
	$(this).children().removeClass("fas fa-angle-up");
	$(this).children().addClass("fas fa-angle-down");
    }
});


