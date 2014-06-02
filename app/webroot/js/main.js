function isEmpty( el ){
	return !$.trim(el.html())
}

$(document).ready(function (){
	if (!isEmpty($('.message'))) {
		$('.message').delay(1000).fadeOut(400);
	}
});
