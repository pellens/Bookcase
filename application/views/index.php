<!DOCTYPE html>

<html lang="<?=lang();?>">

	<head>
    	<?=$this->core->metatags();?>
	</head>

	<body>		

		
    	<div class="install-box">
			<h3>Bookcase freshly installed!</h3>
			<p><?=anchor("admin","Visit the backend");?></p>
		</div>

		<hr/>


		<h1><?=$this->core->website_title;?></h1>
		
		
		<div class="langswitch">
			<p>Choose a language</p>
			<?=langswitch();?>
		</div>
		

		<div class="crumbs">
			<span>You are here:</span>
			<?=crumbs();?>
		</div>
		
		
		<div class="textblock">
			<?=$this->blocks->block("homepage_tekst",false);?>
		</div>

		<pre>
		
		-- PRODUCT --

		<? print_r($this->products->product(1));?>

		-- VIDEOS --

		<? print_r($this->products->product_videos());?>

		-- LOCATIONS --

		<? print_r($this->products->product_locations());?>

		-- CATEGORIEËN --
		<? //print_r($this->products->products_overview());?>
		<? print_r($this->products->categories_overview(0));?>
		</pre>
		
		<div class="product-categories">
			<? foreach($categories as $category):?>
				<div class="item">
					<h3><?=anchor("producten/".$category->url_title,$category->title);?></h3>
					<p><?=strip_tags($category->description);?></p>
				</div>
			<? endforeach;?>
		</div>


	</body>

</html>