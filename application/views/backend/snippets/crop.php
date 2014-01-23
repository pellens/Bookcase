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
		background-color: #EEE;
		width:600px;
		height:300px;
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
		width:400px;
		height:260px;
		line-height: 250px;
		text-align: center;
		color:#555;
		text-shadow:0 1px 1px #FFF;
	}

	.tabs {
		margin:0;
		padding:0;
		float:left;
		border-right: 1px solid #FFF;
	}

	.jcroptabs {
		list-style: none;
		margin: 0;
		padding:5px;
		width:150px;
	}

	.jcroptabs li {
		float:left;
		background: #FFF;
		margin: 0 0 1px 0;
		padding:5px 0 5px 10px;
		line-height: 16px;
		width:139px;
		cursor:pointer;
	}

	.jcroptabs li span {
		font-size: 10px;
		color:#888;
	}

	.jcroptabs li.active {
		font-weight: bold;
	}

	.panes {
		float:left;
		padding:5px;
		border-left: 1px solid #CCC;
		width:350px;
		height:250px;
	}

	.panes .jcrop-holder {
		display: none;
	}
	
	.bottom {
		height: 35px;
		width:590px;
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
			$array[] = array("name" => $style->title, "b"=>$style->width, "h"=>$style->height);
		}
	?>

</head>
<body>

		<!-- VOOR DE HIDDEN FORM -->
		<div id="form" class="jcrop"></div>

		<!-- IMAGE KOMT HIER SAMEN MET VERSCHILLENDE FORMATEN -->
		<div class="image">
			<div class="tabs"></div>
			<div class="panes"><img src="<?=base_url("uploads/".$_GET['image']);?>?rand=<?=rand()*1000;?>" class="cropbox" /></div>
		</div>
		
		<div class="bottom">
			<a href="#" class="close">Close croptool</a>
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
					
					$old_image = $_SERVER['DOCUMENT_ROOT'] . "/Bookcase/uploads/" . $_GET["image"];
					$size = getimagesize($old_image);
					$max_w = ($size[0]/100)*98;
					$max_h = ($size[1]/100)*98;
				?>
				
					// CROPS TOEWIJZEN
					$('.cropbox').Jcrop({
					    aspectRatio: <?=$img["b"]/$img["h"];?>,
					    onSelect: function(coords){
					    	$("#x_<?=$img['name'];?>_<?=md5($_GET["image"]);?>",opener.document).val(coords.x);
					    	$("#y_<?=$img['name'];?>_<?=md5($_GET["image"]);?>",opener.document).val(coords.y);
					    	$("#w_<?=$img['name'];?>_<?=md5($_GET["image"]);?>",opener.document).val(coords.w);
					    	$("#h_<?=$img['name'];?>_<?=md5($_GET["image"]);?>",opener.document).val(coords.h);
					    	$("#t_<?=$img['name'];?>_<?=md5($_GET["image"]);?>",opener.document).val("<?=strtolower($img['name']);?>");
					    },
					    boxWidth: 500,
					    boxHeight: 250,
					    maxSize: [<?=$max_w.",".$max_h;?>]
					});
					
					// BESTAAN DE INPUTVELDEN AL?
					if( !$("#x_<?=$img['name'];?>_<?=md5($_GET["image"]);?>",opener.document).length > 0 )
					{
					
						// FORM OPBOUWEN VOOR COORDINATEN IN TE PLAATSEN
						var string = "<input type='hidden' id='x_<?=$img['name'];?>_<?=md5($_GET["image"]);?>' value='' name='x[]'/>";
							string+= "<input type='hidden' id='y_<?=$img['name'];?>_<?=md5($_GET["image"]);?>' value='' name='y[]'/>";
							string+= "<input type='hidden' id='w_<?=$img['name'];?>_<?=md5($_GET["image"]);?>' value='' name='w[]'/>";
							string+= "<input type='hidden' id='h_<?=$img['name'];?>_<?=md5($_GET["image"]);?>' value='' name='h[]'/>";
							string+= "<input type='hidden' id='t_<?=$img['name'];?>_<?=md5($_GET["image"]);?>' value='' name='t[]'/>";
							
						//$("#form.jcrop").append(string);
						$("#test",opener.document).append(string);
					
					}
	
					// TABS OPBOUWEN VOOR MEERDERE FORMATEN
					$(".tabs ul.jcroptabs").prepend("<li><?=$img['name'];?><br/><span><?=$img['b'].'x'.$img['h'];?></span></li>");

				<? endforeach;?>

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

</body>
</html>