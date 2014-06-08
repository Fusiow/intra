var		g_isclick = 0;
var		g_actsub = 0;

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

	if ($('#img_1') && $('#img_2')) {
		$('#img_1').delay(800).slideDown(400);
		$('#img_2').delay(1000).show(500);
	}
});
