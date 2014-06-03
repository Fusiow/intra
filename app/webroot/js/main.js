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
	} else if (g_actsub == attr){
		$('.sub_' + attr).hide(400);
		g_isclick = 0;
		g_actsub = NULL;
	} else {
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
