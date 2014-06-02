var		g_isclick = 0;

function isEmpty( el ){
	return !$.trim(el.html())
}

$(document).ready(function (){
	if (!isEmpty($('.message'))) {
		$('.message').delay(1000).fadeOut(400);
	}

	$('.buttonsub').click(function() {
		if (g_isclick == 0) {
			$('.sub').show(400);
			g_isclick = 1;
		} else {
			$('.sub').hide(400);
			g_isclick = 0;
		}
	});
});
