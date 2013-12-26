<!DOCTYPE html>
<html lang="<?=lang();?>">
	<head>
    	<?=$this->core->metatags();?>
    	<link href="<?=base_url("css/backend/backend.css");?>" rel="stylesheet" media="screen">

	</head>
	<body>
		
		
    	<div class="install-box">
			<h2>Bookcase freshly installed!</h2>
			<p><?=anchor("admin","Visit the core backend");?></p>
		</div>

		<hr/>
		<h1><?=$this->core->website_title;?></h1>
		<?=langswitch();?>
		<?=crumbs();?>
		<?=$this->blocks->block("homepage_tekst",false);?>

		<? foreach($categories as $category):?>
			<pre><? print_r($category);?></pre>
		<? endforeach;?>

	</body>
</html>