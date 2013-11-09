<!doctype html> <!-- CORRECT DOCTYPE IS IMPORTANT -->
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
 
    <head>
    
    	<title>Documentation</title>
    	
    	<link rel="stylesheet" type="text/css" href="css/desktop.css"/>
    	<link rel="stylesheet" type="text/css" href="css/grid.css"/>
    	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    	
    	<script src="js/jquery.js" type="text/javascript"></script>
    	<script src="js/bootstrap.min.js" type="text/javascript"></script>
    	
    	<link href='http://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet' type='text/css'>
    	
    	<!-- HTML5 SHIV -->
    	<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    
    </head>
    
    <body>
    
    <html>

	<head>
	
		<title>Webtools</title>
		<link href="css/desktop.css" type="text/css" rel="stylesheet" />
		<link href="css/grid.css" type="text/css" rel="stylesheet" />
		<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
		
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/pretify.js"></script>
	</head>

	<body onload="prettyPrint()">
	
		<div class="container_12">
			<div class="grid_2">
				<h3>Libraries</h3>
				<ul>
					<li><a href="?page=installation">How to install</a></li>
					<li><a href="?page=core">Core</a></li>
					<li><a href="?page=contactform">Contactform(s)</a></li>
					<li><a href="?page=products">Products</a></li>
					<li><a href="?page=social">Social</a></li>
					<li><a href="?page=blocks">Blocks</a></li>
					<li><a href="?page=locations">Locations</a></li>
					<li><a href="?page=media">Media</a></li>
				</ul>
				
				<h3>Helpers</h3>
			</div>
			
			<div class="grid_10">
				<?
					if($_GET["page"]):
						include($_GET["page"].".php");
					else:
						include("start.php");	
					endif;
				?>
			</div>
		</div>
		
	</body>

</html>