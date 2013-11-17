<!DOCTYPE html>
<html>
	<head>
    	<title>Bookcase</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" type="text/css" href="<?=base_url("css/backend")?>/bootstrap.css"/>
    	<link rel="stylesheet" type="text/css" href="<?=base_url("css/backend")?>/backend.css"/>
    	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    	<script type="text/javascript" src="<?=base_url("js/core")?>/jquery.1.10.2.js"></script>
    	<script type="text/javascript" src="<?=base_url("js/core")?>/bootstrap.js"></script>
	</head>
	<body>

	<div class="container">
    		
    	<div class="menu">
			
				<nav>
					<ul>
						<li class="active"><i class="icon-dashboard icon-2x"></i></li>
						<li><?=anchor('admin/library/','<i class="icon-plus icon-2x"></i>');?></li>
						<li><?=anchor('admin/library/market/items','<i class="icon-shopping-cart icon-2x"></i>');?></li>
						<li><?=anchor('admin/library/','<i class="icon-envelope-alt icon-2x"></i>');?></li>
						<li><?=anchor('admin/library/locality/locations','<i class="icon-globe icon-2x"></i>');?></li>
						<li><?=anchor('admin/library/core/settings','<i class="icon-gear icon-2x"></i>');?></li>
					</ul>
				</nav>
			
			</div>

			<div class="submenu">

				<h2><?=$nav["title"];?></h2>

				<? foreach($nav["nav"] as $sub => $link):?>

					<h3><?=$sub;?></h3>

					<nav>
						<ul>
							<? foreach($link as $name => $url):?>
								<li><?=anchor($url,$name);?></li>
							<? endforeach;?>
						</ul>
					</nav>

				<? endforeach;?>
			</div>
			
			<div class="main">

				<h3>Users</h3>

				<?=$this->users->users(true);?>


				<h3>Page overview</h3>
				<? print_r($this->core->all_pages(true));?>

				<h3>Libraries</h3>

				<table class="table table-bordered table-striped">
				<tr>
					<th>Library</th>
					<th>Description</th>
					<th>Version</th>
				</tr>
				<? foreach( $this->core->libraries(true) as $library):?>

					<tr>
						<td class="title"><?=$library["title"];?></td>

						<? if(isset($library["error"])):?>
						<td class="error" colspan="2"><?=$library["error"];?></td>
						<? else: ?>
							<td class="description"><?=$library["description"];?></td>
							<td class="version"><?=$library["version"];?></td>
						<? endif;?>
					</tr>

				<? endforeach;?>
				</table>

				<h3>Market categories</h3>
				<?=$this->market->all_categories("list");?>

				<div class="developer">
					<pre>$this->market->all_categories( $view );
					$view = false
					$view = "list"
					$view = "tree"
					$view = "select"</pre>

				<h3>Supported languages</h3>
				<table class="table table-bordered table-striped">
				<tr>
					<th>Language</th>
					<th>Url-code</th>
					<th>Status</th>
					<th>Active?</th>
				</tr>
				<? foreach($this->translate->all_supported_languages() as $lang):?>
					<tr>
						<td><?=$lang->lang;?></td>
						<td><?=base_url($lang->code);?></td>
						<td width="200">
							<div class="progress">
								<div class="bar" style="width:<?=$this->translate->progress_translation($lang->code);?>"></div>
							</div>
						</td>
						<td><?=($lang->active == 1) ? "yes" : "no";?></td>
					</tr>
				<? endforeach;?>
				</table>
			</div>
		
		</div>
	</div>

	</body>
</html>