$(document).ready(function(){
	$(".blank").hide();

	$(".input-combine").click(function(){
		$(this).find(".blank").toggle();
		$(this).find(".strip").toggle();
	});
});