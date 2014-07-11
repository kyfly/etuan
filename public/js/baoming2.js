$(document).ready(function(){
	$(".blank").hide();

	$(".strip").click(function(){
		$(".blank").hide();
		$(".cover").show();
		$(this).find(".blank").show();
		$(this).find(".cover").hide();
		$(this).find(".blank").find("input").focus();
		$(this).find(".blank").find("textarea").focus();
	});
	
	
});