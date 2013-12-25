<!DOCTYPE html>
<html>
	<head>
    	<?=$this->core->metatags();?>
    	<link href="<?=base_url("css/backend/backend.css");?>" rel="stylesheet" media="screen">

	</head>
	<body>
		<h1><?=$this->core->website_title;?></h1>
		<?=langswitch();?>
		<?=crumbs();?>
    	<div class="install-box">
			<h1>Bookcase freshly installed!</h1>
			<p><?=anchor("admin","Visit the core backend");?></p>
		</div>

		<?=$this->blocks->block("homepage_tekst",false);?>
	</body>
</html>