<html>
	<head>
		<title>Setup Complete - Bookcase</title>
		<link href="<?=base_url("css/core/setup.css");?>" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
	
		<div class="box install complete">
			
			<h1>Ready to roll!</h1>

			<p><b>Alright, looks like everything is set to go!</b><br/>
			
			You can start coding. Better check out the <?=anchor("/docs","Bookcase Documentation","target='_blank'");?> before you do!</p>
			
			<p><b>Website settings</b><br/>
			Frontend: <?=anchor("/",base_url());?><br/>
			Backend: <?=anchor("/admin",base_url("admin"));?>
			

		</div>
	
	</body>

</html>