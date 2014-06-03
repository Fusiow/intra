var		g_isclick = 0;
var		g_actsub = NULL;

function isEmpty( el ){
	return !$.trim(el.html())
}

function subMenu(attr) {
	if (g_isclick == 0) {
		$('.sub_' + attr).show(400);
		g_isclick = 1;
		g_actsub = attr;
	} else if (attr != g_actsub) {
		$('.sub_' + g_actsub).hide(400);
		$('.sub_' + attr).show(400);
		g_actsub = attr;
	}
}

$(document).ready(function (){
	if (!isEmpty($('.message'))) {
		$('.message').delay(1000).fadeOut(400);
	}

});
