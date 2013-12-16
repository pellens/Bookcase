$(document).ready(function(){

	equalHeights();

	// TABS

	$(".tabs .links li").bind("click",function(){

		$(".tabs .links li").removeClass("active");
		$(this).addClass("active");

		var pane = $(this).attr("data-pane");

		$(".tabs .panes .pane").removeClass("active");
		$(".tabs .panes .pane[data-pane="+pane+"]").addClass("active");

	});

	// DELETE

	$(".del").bind("click submit",function(){

		var r = confirm($(this).attr("data-alert"));
		if (r == true)
		{
  			return true;
  		}
		else
  		{
  			return false;
  		}

	});







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

$(window).resize(function(){
	equalHeights();
});

function equalHeights()
{
	var sidebar_height = $(".sidebar").height();
	var main_height    = $(".main").height();
	
	console.log(sidebar_height);
	if(sidebar_height > main_height)
	{
		$(".main .left").css("height",sidebar_height+"px");
		$(".main .right").css("height",sidebar_height+"px");
		$(".main .full").css("height",sidebar_height+"px");
	}
}