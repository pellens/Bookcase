<p><label>YouTube or Vimeo URL</label> <input type="text" id="video"/> <input type="button" id="add_video" value="Add video"/></p>

<div class="videos">
	
	<? foreach($videos as $video):?>
		<div class='video' data-video='<?=$video->id;?>'>
    	    		
    		<input type='hidden' name='video_id[]' value='<?=$video->video_id;?>'/>
    		<input type='hidden' name='video_title[]' value='<?=$video->title;?>'/>
    		<input type='hidden' name='video_source[]' value='<?=$video->source;?>'/>
    		<input type='hidden' name='video_desc[]' value='<?=$video->description;?>'/>
    		<input type='hidden' name='video_image_hq[]' value='http://img.youtube.com/vi/"+video_id+"/hqdefault.jpg'/>
    		<input type='hidden' name='video_image_default[]' value='http://img.youtube.com/vi/"+video_id+"/default.jpg'/>
		
    		<figure><img src='http://img.youtube.com/vi/<?=$video->video_id;?>/default.jpg'/></figure>
    		<h2><?=$video->title;?></h2>
    		<p><?=$video->description;?></p>
    		       
    		<a href='#' class='del' onclick='deleteVideo(<?=$video->id;?>); return false;'>&times;</a>
    	</div>
	<? endforeach;?>

</div>

<script>

function deleteVideo(row)
{
	$(".video[data-video="+row+"]").remove();
}
$(document).ready(function(){

	$("#add_video").bind("click",function(){

		var row = "";
		var url = $("#video").val();
	
		var i = url.indexOf("youtu");
		var youtube = (i===-1) ? false : true;
		
		var i = url.indexOf("vimeo");
		var vimeo = (i===-1) ? false : true;
	
		if(youtube)
		{
			var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
			video_id = (videoid != null) ? videoid[1] : false;
	
			$.ajax({
    	        url: "http://gdata.youtube.com/feeds/api/videos/"+video_id+"?v=2&alt=json",
    	        dataType: "jsonp",
    	    	success: function (data)
    	    	{
    	    		var seconds = Math.round((new Date()).getTime() / 1000);
	
    	    		row+= "<div class='video' data-video='"+seconds+"'>";
    	    		
    	    		row+= "<input type='hidden' name='video_id[]' value='"+video_id+"'/>";
    	    		row+= "<input type='hidden' name='video_title[]' value='"+data.entry.title.$t+"'/>";
    	    		row+= "<input type='hidden' name='video_source[]' value='youtube'/>";
    	        	row+= "<input type='hidden' name='video_desc[]' value='"+data.entry.media$group.media$description.$t+"'/>";
    	        	row+= "<input type='hidden' name='video_image_hq[]' value='http://img.youtube.com/vi/"+video_id+"/hqdefault.jpg'/>";
    	        	row+= "<input type='hidden' name='video_image_default[]' value='http://img.youtube.com/vi/"+video_id+"/default.jpg'/>";
	
    	        	row+= "<figure><img src='http://img.youtube.com/vi/"+video_id+"/default.jpg'/></figure>";
    	        	row+= "<h2>"+data.entry.title.$t+"</h2>";
    	        	row+= "<p>"+data.entry.media$group.media$description.$t+"</p>";
    	       
    	       		row+= "<a href='#' class='del' onclick='deleteVideo("+seconds+"); return false;'>&times;</a>";
    	       		row+= "</div>";
	
    	       		$(".videos").append(row); 
	
    	    	}
    	    });
		}
	
		if(vimeo)
		{
    		var match = /vimeo.*\/(\d+)/i.exec( url );
	
    	 	// VIMEO
    	 	var video_id = match[1];
		
			$.getJSON('http://www.vimeo.com/api/v2/video/' + video_id + '.json?callback=?', {format: "json"}, function(data) {
		
				$("input#video_id").val(video_id);
				$('input#title').val(data[0].title);
				$("#video_title").html(data[0].title);
				$('input#source').val(data[0].url);
				$('p#description').html(data[0].description);
				$("input#small_image").val(data[0].thumbnail_medium);
				$("input#hq_image").val(data[0].thumbnail_large);
				$("#video_thumb").attr("src",data[0].thumbnail_large);
			});
		}

		$("#video").val("");
	
		return false;

	});

});


</script>