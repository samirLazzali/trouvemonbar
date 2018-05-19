$('.form').find('input, textarea').on('keyup blur focus', function (e) {

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

$('.tab a').on('click', function (e) {
    e.preventDefault();
    formHeight = document.getElementById("form").style.height;
    if (!$(this).parents('.active').length)
	document.getElementById("form").style.height = (formHeight == '540px' ? '480px' : '540px');

    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');

    target = $(this).attr('href');

    $('.tab-content > div').not(target).hide();

    $(target).fadeIn(600);

});

document.getElementById("connect").onclick = function(e) {
    if (document.getElementById("form").style.display == 'none') {
	$('.form').fadeIn(500);
	document.getElementById("connect").innerHTML = " Close";
    } else {
	$('.form').fadeOut(500);
	document.getElementById("connect").innerHTML = " Log In";
    }
};

document.getElementById("toggleAnnonce").onclick = function(e) {
    console.log("Hey");
};


