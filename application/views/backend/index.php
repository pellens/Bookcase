<!DOCTYPE html>
<html>
	<head>
    	<title>Bookcase</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" type="text/css" href="<?=base_url("css/backend")?>/backend.css"/>
    	<link rel="stylesheet" type="text/css" href="<?=base_url("css/backend")?>/grid.css"/>
    	<script type="text/javascript" src="<?=base_url("js/backend")?>/jquery-1.8.2.min.js"></script>
	</head>
	<body>
    	<div class="header">
    		<div class="container_16">
    			<div class="grid_16">
    				<h1>Bookcase</h1>
    			</div>
    		</div>	
    	</div>
    		
    	<div class="container_16">
    	
    		<div class="grid_4 nav">
			
				<nav>
					<ul>
						<? foreach($nav as $n):?>
						<li><?=anchor("admin/".$n,$n);?></li>
						<? endforeach;?>
					</ul>
				</nav>
			
			</div>
			
			<div class="grid_12">
				<h3>Page overview</h3>
				<? print_r($this->core->all_pages(true));?>
			</div>
		
		</div>

	</body>
</html>