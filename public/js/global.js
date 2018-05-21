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

$('.reduce').on('click', function(e) {
    if ($(this).hasClass("expand")) {
	$('.more').show();
	$(this).removeClass("expand");
	$(this).children().addClass("fa-minus-square");
	$(this).children().removeClass("fa-plus-square");
    } else {
	$('.more').hide();
	$(this).addClass("expand");
	$(this).children().removeClass("fa-minus-square");
	$(this).children().addClass("fa-plus-square");
    }

});

$('.formresearch').find('input, textarea').on('keyup blur focus', function (e) {

    var $this = $(this),
	label = $this.prev('label');

    if (e.type === 'keyup') {
	if ($this.val() === '') {
	    label.removeClass('active highlight');
	} else {
	    label.addClass('active highlight');
	}
    } else if (e.type === 'blur') {
	if( $this.val() === '' ) {
	    label.removeClass('active highlight'); 
	} else {
	    label.removeClass('highlight');   
	}   
    } else if (e.type === 'focus') {

	if( $this.val() === '' ) {
	    label.removeClass('highlight'); 
	} 
	else if( $this.val() !== '' ) {
	    label.addClass('highlight');
	}
    }

});

