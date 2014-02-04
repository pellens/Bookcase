<?php
    require "less/lessc.inc.php";
    $less = new lessc;
    $less->checkedCompile("less/backend.less", "css/backend/backend.css");
    $less->checkedCompile("less/gerardo.less", "css/backend/gerardo.css");
?>
<!DOCTYPE html>
<html>
	<head>
    	<title>Bookcase</title>

    	<meta http-equiv="Content-Type"         content="text/html; charset=utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    	<link rel="stylesheet" type="text/css" href="<?=base_url("css/backend")?>/bootstrap.css"/>
    	<link rel="stylesheet" type="text/css" href="<?=base_url("css/backend")?>/ui.fancytree.css"/>
    	<link rel="stylesheet" type="text/css" href="<?=base_url("css/backend")?>/backend.css"/>
      <link rel="stylesheet" type="text/css" href="<?=base_url("css/backend")?>/gerardo.css"/>
    	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    	<script type="text/javascript" src="<?=base_url("js/core")?>/jquery.1.10.2.js"></script>
    	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.js"></script>
    	<!--<script type="text/javascript" src="<?=base_url("js/core")?>/bootstrap.js"></script>-->
    	<script type="text/javascript" src="<?=base_url("js/core/jquery.uploadify.min.js")?>"></script>
      <script type="text/javascript" src="<?=base_url("js/backend")?>/custom.js"></script>
      <script type="text/javascript" src="<?=base_url("js/core")?>/jquery.filtertable.min.js"></script>
      <script type="text/javascript" src="<?=base_url("ckeditor/ckeditor.js?rand=".rand()*100000);?>"></script>
    	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=true"></script>

	</head>
	<body class="row">

	<div class="container eq-height">

		<div class="header">
			<h1><?=$this->core->website_title;?></h1>
			<nav>
                <ul>
				    <li <?=($active_link == "website")  ? "class='active'" : "";?>><?=anchor("admin","Website");?></li>
				    <li <?=($active_link == "modules")      ? "class='active'" : "";?>><?=anchor("admin/lib/blocks/blocks_overview","Modules");?></li>
				    <li <?=($active_link == "settings") ? "class='active'" : "";?>><?=anchor("admin/lib/core/website-settings","Settings");?></li>
                </ul>
			</nav>

      <?=langswitch();?>
      
		</div>

		<div class="sidebar eq-height">
			<?
				switch($active_link)
				{
					case "" 		:
					case "website"	: $this->load->view("backend/sidebar-website"); break;
					case "settings" : $this->load->view("backend/sidebar-settings"); break;
					default 		: $this->load->view("backend/sidebar-modules"); break;
				}
			?>
		</div>

		<div class="main eq-height">
			<?=$this->load->view($main);?>
		</div>

	</div>

	<script>
	function triggerPopup(file)
	{
		window.open('<?=base_url("admin/crop");?>?image='+file, "_blank", "width=650,height=400,scrollbars=no,toolbar=0,status=0,location=0,resizable=yes,screenx=0,screeny=0"); return false;
	}
	</script>

	</body>
</html>