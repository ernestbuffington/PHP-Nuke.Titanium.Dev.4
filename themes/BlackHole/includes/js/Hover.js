$(document).ready(function(){
	$('img').hover(function(){
		var current = $(this).attr("src");
		var swap = $(this).attr("data-alt-src");
		$(this).attr("src",swap);
		$(this).attr("data-alt-src",current);
	}, function(){
		var current = $(this).attr("src");
		var swap = $(this).attr("data-alt-src");
		$(this).attr("data-alt-src",current);
		$(this).attr("src",swap);

	});
})