/*$('.formresearch').find('input, textarea').on('keyup blur focus', function (e) {

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
    formHeight = document.getElementById("formresearch").style.height;
    if (!$(this).parents('.active').length)
	document.getElementById("formresearch").style.height = (formHeight == '540px' ? '480px' : '540px');

    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');

    target = $(this).attr('href');

    $('.tab-content > div').not(target).hide();

    $(target).fadeIn(600);

});

document.getElementById("research").onclick = function(e) {
    if (document.getElementById("formresearch").style.display == 'none') {
	$('.formresearch').fadeIn(500);
	document.getElementById("connect").innerHTML = "<i class=\"fas fa-times-circle\"></i> Close";
    } else {
	$('.formresearch').fadeOut(500);
	document.getElementById("connect").innerHTML = "<i class=\"fas fa-sign-in-alt\" aria-hidden=\"true\"></i> Log In";
    }
   
};*/

document.getElementById("research").onclick = function(){
	var form = document.getElementById("formresearch");
	if (form.style.display == 'none') {
		form.style.display = "block";

	}
	else {
		form.style.display = "none";
	}

}