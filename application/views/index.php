<!DOCTYPE html>
<html>
	<head>
    	<title>Bookcase</title>

    	<?=$this->core->metatags();?>
    	<link href="<?=base_url("css/backend/backend.css");?>" rel="stylesheet" media="screen">

	</head>
	<body>
    	<div class="install-box">
			<h1>Bookcase freshly installed!</h1>
			<p><?=anchor("admin","Visit the core backend");?></p>
			<?
				$config["twitter_feed_username"] = "gpellens";
				$config["twitter_feed_limit"] = 10;
				$config["twitter_feed_view"] = false;

				$this->social->initialize($config);

				echo $this->social->facebook_like("http://facebook.com/journize");

				print_r($this->social->twitter_feed());
			?>
		</div>
	</body>
</html>