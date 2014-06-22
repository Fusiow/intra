var		g_isclick = 0;
var		g_actsub = 0;
var		g_sub_categ_show = 0;
var		i = 1;

function isEmpty( el ){
	return !$.trim(el.html())
}

function show_sub(attr) {
	if (g_isclick == 0) {
		$(attr).show(400);
		g_actsub = attr;
		g_isclick = 1;
	} else if (attr == g_actsub) {
		$(attr).hide(200);
		g_isclick = 0;
	} else {
		$(g_actsub).hide(200);
		$(attr).show(400);
		g_actsub = attr;
	}
}

function show_sub2(attr) {
	if (g_isclick == 0) {
		$(attr).slideDown(400);
		g_actsub = attr;
		g_isclick = 1;
	} else {
		$(g_actsub).slideUp(200);
		$(attr).slideDown(400);
		g_actsub = attr;
	}
}


function vote_up(id) {
	$.ajax({
		url: '/forums/vote_up/' + id,
		success: function(data) {
		if (data == "OK"){
				alert("Votre vote a bien ete pris en compte !");
			} else {
				alert("Vous avez deja vote !");
			}
		}
	});
}

function vote_down(id) {
	$.ajax({
		url: '/forums/vote_down/' + id,
		success: function(data) {
			if (data == "OK"){
				alert("Votre vote a bien ete pris en compte !");
			} else {
				alert("Vous avez deja vote !");
			}
		}
	});
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

	$("#addbar").on('click', function() {
		data = "<br /><hr /><br /><div class='input text'><input name='data[subject][corr_title"+i+"]' placeholder='titre' type='text'></div><div><input name='data[subject][corr_instruc"+i+"]' placeholder='consigne' type='text' id='correctionCorrInstruc'></div><div class='input number'><label for='correctionCorrMax'></label><input placeholder='Note maximum' name='data[subject][corr_max"+i+"]' type='number'></div><div><input type='number' placeholder='Num min' name='data[subject][corr_min"+i+"]' ></div>";
		$("#result_cor").append(data);
		++i;
	});

	$("#search").on('keyup', function() {
		if ($("#search").val()) {
			$.post('/users/search/', {"Lulz":{"search": "" + $("#search").val() + ""}},
				function(data, text, jq) {
					$("#search_result").empty().append(data);
				});
		} else {
			$("#search_result").empty();
		}
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
