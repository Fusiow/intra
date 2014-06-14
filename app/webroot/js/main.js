var		g_isclick = 0;
var		g_actsub = 0;
var		g_sub_categ_show = 0;

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

	$('.mark').on('keydown', function(event){
		if (event.which == 9) {
			val = $(this).val();
			start = $(this)[0].selectionStart;
			end = $(this)[0].selectionEnd;
			$(this)[0].value = val.substring(0, start) + '\t' + val.substring(end);
			$(this)[0].selectionStart = $(this)[0].selectionEnd = start + 1;
			return false;
		}
	});

	$('.mark').on('keyup', function(){
		var converter = new Showdown.converter();
		var mark = converter.makeHtml($('.mark').val());
		$('#result').empty().append(mark);
		$('#result').val().replace(/\n/g, "<br />");
		hljs.highlightBlock($('#result pre code')[0], ' ', false);
	});

	$('#category').change(function(){
		$('#category option:selected').each(function() {
			$.ajax({
				url: '/forums/sub_category/' + $(this).val(),
				success: function(data) {
					str = data;
					$('#subcategory').html('');
					$('#subcategory').append(str);
					if (g_sub_categ_show == 0) {
						$('#subcategory').show(400);
						g_sub_categ_show = 1;
					}
				},
			});
		});
	});

	hljs.initHighlightingOnLoad();
});
