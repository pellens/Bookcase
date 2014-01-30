$(window).resize(function(){
	equalizeHeight();
});


// Alle boxes within a row get the same height
function equalizeHeight()
{
	var boxHeight = 0;

	$(".eq-height").removeAttr("style");

	$(".row").each(function(){

		$(this).find(".eq-height").each(function(){
			var currentBoxHeight = $(this).innerHeight();
			if(currentBoxHeight > boxHeight) boxHeight = currentBoxHeight;
		});

		$(this).find(".eq-height").css({"height":boxHeight-51+"px"});
		$(".container").css({"height":boxHeight+"px"});

	});
}

function ArrNoDupe(a) {
    var temp = {};
    for (var i = 0; i < a.length; i++)
        temp[a[i]] = true;
    var r = [];
    for (var k in temp)
        r.push(k);
    return r;
}


$(document).ready(function(){

	$(".required").each(function(){
		$(this).parent("p").children("label").append("<span class='req'>*</span>");
	});

	$("form").bind("submit",function(){

		var panes = new Array();
		var error = 0;
		$(".required").each(function(){

			var val = $(this).val();

			if(val != "" && val != " ")
			{
				$(this).parent("p").children("label").removeClass("error");
			}
			else
			{
				var pane = $(this).parent("p").parent(".pane").attr("data-pane");
				$(this).parent("p").children("label").addClass("error");
				error = 1;
				panes.push(pane);
			}
		});

		var panes = ArrNoDupe(panes);

		if(error == 1)
		{
			for(var i = 0; i <= panes.length-1; i++)
			{
				$(".tabs li[data-pane="+panes[i]+"]").append("<span class='req'>*</span>");
			}

			return false;
		}
		else {
			return true;
		}

	});

	$(".block").each(function(){
		if($(this).attr("data-pane"))
		{
			var title = $(this).attr("data-pane");
			var row = "<li data-pane='"+title+"'>"+title+"</li>";
			$(".tabs").append(row);
			$(this).addClass("pane").attr("data-pane",title);
		}
	});

	$(".full .block.pane").first().addClass("active");
	$(".tabs li").first().addClass("active");

	$(".tabs li").bind("click",function(){
		$(".tabs li").removeClass("active");
		$(this).addClass("active");

		var pane = $(this).attr("data-pane");
		$(".block").removeClass("active");
		$(".block[data-pane="+pane+"]").addClass("active");
	});

	equalizeHeight();

	if($(".tabs").size() == 0)
	{
		$('.table').filterTable({
    	    minRows:1,
    	    placeholder:'Search list',
    	    label: ''
    	});
    }

	//equalHeights();

	$(".sidebar .box h2").bind("click",function(){
		$(".sidebar .box ul").hide();
		$(this).parent(".box").children(".nav").show();
	});

	// TABS

	$(".tabs .links li").bind("click",function(){

		//equalHeights();

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
	var left_height    = $(".main .left").height();
	var right_height   = $(".main .right").height();

	console.log(main_height);
	console.log(left_height+" "+right_height);

	if(sidebar_height > main_height)
	{
		$(".main .left").css("height",sidebar_height+"px");
		$(".main .right").css("height",sidebar_height+"px");
		$(".main .full").css("height",sidebar_height+"px");
	}
	else if(main_height > sidebar_height)
	{
		
		if(left_height > right_height)
		{
			$(".main .right").css("height",left_height+"px");
		}
		else
		{
			console.log("change left");
			$(".main .left").css("height",right_height+"px");
		}
	}
}