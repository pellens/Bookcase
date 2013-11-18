$(document).ready(function(){

	$(".google_search_results_preview .description").html($("#meta_description").val());
	$(".google_search_results_preview .title").html($("#title").val());
	
	// GOOGLE DESCRIPTION CHARACTER COUNTER
	if($("#meta_description").length !=0)
	{
		$(".count").html($("#meta_description").val().length);
	}
	
	$("#meta_description, #title").bind("keyup",function(){
		$(".google_search_results_preview .description").html($("#meta_description").val());
		$(".count").html($("#meta_description").val().length);
		$(".google_search_results_preview .title").html($("#title").val());
	});
	
	$("#product_category").bind("change",function(){
		$(".google_search_results_preview .crumbs span.cat").html($(this + "option:selected").html());
	});

});