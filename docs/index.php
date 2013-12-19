<!doctype html> <!-- CORRECT DOCTYPE IS IMPORTANT -->
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
 
    <head>
    
    	<title>Documentation</title>
    	
    	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    	<link rel="stylesheet" type="text/css" href="css/grid.css"/>
    	<link rel="stylesheet" type="text/css" href="css/desktop.css"/>
    	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    	<script src="js/jquery.js" type="text/javascript"></script>
    	<script src="js/pretify.js" type="text/javascript"></script>
    	<script src="js/bootstrap.min.js" type="text/javascript"></script>
    	
    	<link href='http://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet' type='text/css'>
    	
    	<!-- HTML5 SHIV -->
    	<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    
    </head>

	<body onload="prettyPrint()">
	
		<div class="container_12">

			<div class="grid_12 title">
			<h1><i class="icon-book icon-2x"></i> Bookcase</h1>
			</div>
			<div class="grid_12 crumbs">
			<ul>
			<li><a href="#">Bookcase</a></li>
			<li><a href="#">Documentation</a></li>
			<li><a href="#">How to install</a></li>
			</ul>
			</div>
			<div class="grid_2 menu">

				<h3>Getting started</h3>
				<ul>
					<li><a href="?page=installation">How to install</a></li>
					<li><a href="?page=workflow">How it works</a></li>
				</ul>

				<h3>Libraries</h3>

						<ul>
							<li><a href="?page=core">Core</a></li>
							<li><a href="?page=translate">Translate</a></li>
							<li><a href="?page=database">Database</a></li>
							<li><a href="?page=contactform">Contactform(s)</a></li>
							<li><a href="?page=products">Products</a></li>
							<li><a href="?page=social">Social</a></li>
							<li><a href="?page=blocks">Blocks</a></li>
							<li><a href="?page=locality">Locality</a></li>
							<li><a href="?page=media">Media</a></li>
						</ul>
					<h3>Helpers</h3>


						<ul>
							<li><a href="?page=translate">Translate</a></li>
						</ul>
				<h3>Advanced</h3>

				<ul>
					<li><a href="?page=library_create">Create a library</a></li>
					<li><a href="?page=library_backend">Admin implementation</a></li>
				</ul>

			</div>
			
			<div class="grid_10 main">
				<div class="content"><?
					if($_GET["page"]):
						include($_GET["page"].".php");
					else:
						include("start.php");	
					endif;
				?>
				</div>
			</div>
		</div>
		
	</body>

</html>