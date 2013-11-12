<!DOCTYPE html>
<html>
	<head>
    	<title>Bookcase</title>
		<?=$this->social->load_scripts("facebook");?>
    	<?=$this->core->metatags();?>
    	<link href="<?=base_url("css/backend/backend.css");?>" rel="stylesheet" media="screen">

	</head>
	<body>
    	<div class="install-box">
			<h1>Bookcase freshly installed!</h1>
			<p><?=anchor("admin","Visit the core backend");?></p>
		</div>
	</body>
</html>