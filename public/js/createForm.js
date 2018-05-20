var modules = [document.getElementById("selectmodule1"), document.getElementById("selectmodule2"), document.getElementById("selectmodule3"), document.getElementById("selectmodule4"), document.getElementById("selectmodule5")];

function disappear(item, index) {
    item.style.display = 'none';
}

$(".toggle").on('click', function (e) {
    modules.forEach(disappear);
    if (this.value != 0) {
	modules[this.value - 1].style.display = 'inline';
    }
});

$('.tab a').on('click', function (e) {
    e.preventDefault();

    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');

    target = $(this).attr('href');

    $('.tab-content > div').not(target).hide();

    $(target).fadeIn(400);

});

$('.create').find('input, textarea').on('keyup blur focus', function (e) {

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
