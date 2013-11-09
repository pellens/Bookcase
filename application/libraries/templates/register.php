<html>
	<head>
		<title>Register - Bookcase</title>
		<link href="<?=base_url("css/core/setup.css");?>" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
	
		<div class="box install warning">
			
			<h1>Please create an account</h1>

			<p><b>Looks like their are no admins yet...</b><br/>
			To access the backend of the website, you need an admin account. Please create on here.</p>
			
			<?=form_open();?>
				<input type="hidden" name="first_admin" value="1"/>
				<p><label>Name</label> <input type="text" name="name" autocomplete="off"/></p>
				<p><label>E-mail</label> <input type="text" name="email" autocomplete="off"/></p>
				<p><label>Password</label> <input type="password" name="password" autocomplete="off"/></p>
				<p><label>&nbsp;</label> <input type="submit" value="Create account"/></p>
			<?=form_close();?>
			
		</div>
	
	</body>

</html>