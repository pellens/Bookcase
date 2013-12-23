<!DOCTYPE html>
<html>
	<head>
    	<title>Bookcase</title>
    	<?=$this->core->metatags();?>
    	<link href="<?=base_url("css/backend/backend.css");?>" rel="stylesheet" media="screen">

	</head>
	<body>
		<?=langswitch();?>
    	<div class="install-box">
			<h1>Bookcase freshly installed!</h1>
			<p><?=anchor("admin","Visit the core backend");?></p>
		</div>

		<?=$this->blocks->block("homepage_tekst",false);?>
	</body>
</html>