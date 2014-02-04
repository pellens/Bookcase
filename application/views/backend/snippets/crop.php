<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<script src="<?=base_url("js/core/jquery.1.10.2.js");?>"></script>
	<script src="<?=base_url("js/core/jquery.color.js");?>"></script>
	<script src="<?=base_url("js/core/jquery.Jcrop.js");?>"></script>
	<link rel="stylesheet" href="<?=base_url("js/core/jquery.Jcrop.css");?>" type="text/css" />

	<style>

	body {
		font-family: Helvetica;
		font-size: 12px;
		margin:0;
		padding:0;
	}

	.image {
		float:left;
		background-color: #E7EBF1;
		width:650px;
		height:350px;
	}

	.cropbox {

	}

	.image .error {
		color: #B94A48;
		background-color: #F2DEDE;
		border-color: #EED3D7;
		height:30px;
		line-height: 30px;
		text-align: center;
		width:100%;
		border-top: 5px solid #FFF;
		float:left;
		display:none;
	}

	.init {
		width: 490px;
		height: 380px;
		line-height: 380px;
		text-align: center;
		color:#555;
		text-shadow:0 1px 1px #FFF;
	}

	.tabs {
		margin:0;
		padding:0;
		float:left;
	}

	.jcroptabs {
		list-style: none;
		margin: 0;
		padding:0;
		width:150px;
		background-color: #1B1E24;
		height:400px;
	}

	.jcroptabs li {
		float:left;
		margin: 0;
		padding:10px 0 10px 10px;
		line-height: 16px;
		width:139px;
		cursor:pointer;
		color:#FFF;
	}

	.jcroptabs li span {
		font-size: 10px;
		color:#CCC;
	}

	.jcroptabs li.active {
		font-weight: bold;
		background: #22262E;
	}

	.panes {
		float:left;
		padding:5px;
		width: 490px;
		height: 390px;
	}

	.panes .jcrop-holder {
		display: none;
	}
	
	.bottom {
		position: absolute;
		z-index: 10;
		bottom: 0;
		left: 0;
		width: 150px;
	}
	
	.close {
		background: rgb(0, 122, 255);
		color: #FFF;
		text-decoration: none;
		line-height: 30px;
		float: right;
		padding: 0 10px;
		margin-top: 5px;
		margin-right: 5px;
	}

	</style>

	<title>Welcome to CodeIgniter</title>

	<?
		foreach($image_styles as $style)
		{
			$array[] = array("id"=>$style->id, "name" => $style->title, "b"=>$style->width, "h"=>$style->height);
		}
	?>

</head>
<body>

	<?=form_open();?>

		<!-- VOOR DE HIDDEN FORM -->
		<div id="form" class="jcrop"></div>

		<!-- IMAGE KOMT HIER SAMEN MET VERSCHILLENDE FORMATEN -->
		<div class="image">
			<div class="tabs"></div>
			<div class="panes"><img src="<?=base_url($_GET['image']);?>?rand=<?=rand()*1000;?>" class="cropbox" /></div>
		</div>

		<script language="Javascript">

			$(document).ready(function(){

				$(".close").bind("click",function(){
					window.close();
					return false;
				});

				// INDIEN WE MEERDERE FORMATEN MOETEN KNIPPEN
				$(".tabs").append("<ul class='jcroptabs'></ul>");

				// ARRAY VAN FORMATEN AFLOPEN
				<?
					foreach($array as $img):
					
					$old_image = FCPATH . $_GET["image"];
					$size = getimagesize($old_image);
					$max_w = $size[0];
					$max_h = $size[1];
				?>
				
					// CROPS TOEWIJZEN
					$('.cropbox').each(function() {
						$(this).Jcrop({
					    aspectRatio: <?=$img["b"]/$img["h"];?>,
					    onSelect: function(coords){
					    	$("#x_<?=$img['name'];?>").val(coords.x);
					    	$("#y_<?=$img['name'];?>").val(coords.y);
					    	$("#w_<?=$img['name'];?>").val(coords.w);
					    	$("#h_<?=$img['name'];?>").val(coords.h);
					    	$("#t_<?=$img['name'];?>").val("<?=$img['id'];?>");
					    	$("#image_width").val($(".jcrop-holder").width());
					    	$("#image_height").val($(".jcrop-holder").height());
					    },
					    boxWidth: 480,
					    boxHeight: 390
					    //maxSize: [<?=$max_w.",".$max_h;?>]
						});
					});
					
					// BESTAAN DE INPUTVELDEN AL?
					if( !$("#x_<?=$img['name'];?>").length > 0 )
					{
					
						// FORM OPBOUWEN VOOR COORDINATEN IN TE PLAATSEN
						var string = "<input type='text' id='x_<?=$img['name'];?>' value='' name='x[]'/>";
							string+= "<input type='text' id='y_<?=$img['name'];?>' value='' name='y[]'/>";
							string+= "<input type='text' id='w_<?=$img['name'];?>' value='' name='w[]'/>";
							string+= "<input type='text' id='h_<?=$img['name'];?>' value='' name='h[]'/>";
							string+= "<input type='text' id='t_<?=$img['name'];?>' value='' name='t[]'/>";
							
						//$("#form.jcrop").append(string);
						$("#test").append(string);
					
					}
	
					// TABS OPBOUWEN VOOR MEERDERE FORMATEN
					$(".tabs ul.jcroptabs").prepend("<li><?=$img['name'];?><br/><span><?=$img['b'].'x'.$img['h'];?></span></li>");

				<? endforeach;?>

				string = "<input type='text' id='image_width' value='' name='image_width'/>";
				string+= "<input type='text' id='image_height' value='' name='image_height'/>";

				$("#test").append(string);

				$(".panes").append("<div class='init'>Bewerk de afbeelding door formaten links te selecteren.</div>");
				$(".image").append("<div class='error'>Gelieve al de formaten toe te passen op deze afbeelding.</div>");
				
				$(".jcroptabs li").bind("click",function()
				{
					$(".init").hide();
					var index = $(this).index();
					$(".jcroptabs li").removeClass("active");
					$(this).addClass("active");
					$(".panes .jcrop-holder").hide();
					$(".panes .jcrop-holder:eq("+index+")").show();
				});

				$(".panes .jcrop-holder").show();

					
				$(".fancybox-close").bind("click",checkCoords());
			});

			function checkCoords()
			{
				var error = 0;

				<? foreach($array as $img): ?>
					if( $("#w_<?=$img['name'];?>").val() == "" ) error = 1;
				<? endforeach;?>

				if(error == 1)
				{
					$(".image .error").show();
					return false;
				}
				else
				{
					//parent.$.fn.fancybox.close();
					return true;
				}
			}


		</script>

		<div id="test">
			<? $size = getimagesize($_GET["image"]); ?>
			<input type='text' id='image_name' value='<?=$_GET["image"];?>' name='image_name'/>
		</div>

		<div class="bottom">
			<input type="submit" value="Save cropped images"/>
		</div>

	<?=form_close();?>

</body>
</html>