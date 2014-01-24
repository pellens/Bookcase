<div class="full">

	<form method="post">

	<h2>Add a user</h2>

	<h3>User general info</h3>

		<div class="block">
		
		<input type="hidden" value="<?=@$item->id;?>" name="id"/>

		<p>
			<label>First name</label>
			<input type="text" name="first_name" value="<?=@$item->first_name;?>"/>
		</p>
		<p>
			<label>Last name</label>
			<input type="text" name="name" value="<?=@$item->name;?>"/>
		</p>
		<p>
			<label>Username</label>
			<span class="help-text">With a username a user can login, combined with his/her password.</span>
			<input type="text" name="username" value="<?=@$item->username;?>"/>
		</p>
		<p>
			<label>E-mailadres</label>
			<input type="email" name="email" value="<?=@$item->email;?>"/>
		</p>

		<p>
			<label>User role</label>
			<span class="help-text">Choose here what role this user will have. Each role is linked to permissions.</span>
			<select name="role_id">
				<? foreach($roles as $role):?>
				<option value="<?=$role->id;?>" <?=($role->id == @$item->role_id) ? "selected" : "";?>><?=$role->title;?></option>
				<? endforeach;?>
			</select>
		</p>

	</div>

	<h3>User social media</h3>

	<div class="block">
		<p>
			<label>Facebook ID</label>
			<span class="help-text">Used to link content to a user and provide avatars with Facebook.<br/>Use <a href="http://findmyfacebookid.com/">this tool</a>.</span>
			<input type="text" name="facebook_id" value="<?=@$item->facebook_id;?>"/>
		</p>
		<p>
			<label>Google+ ID</label>
			<span class="help-text">Used to link content to a user and provide avatars with Google. Example: https://plus.google.com/<u>101887151227437834262</u></span>
			<input type="text" name="google_id" value="<?=@$item->google_id;?>"/>
		</p>
	</div>

	<h3>Password</h3>

	<div class="block">
		<p>
			<label>Choose a password</label>
			<input type="password" name="password" id="password_1" value=""/>
		</p>
		<p>
			<label>Retype password</label>
			<input type="password" name="password" id="password_2" value=""/>
		</p>
	</div>

	<div class="actions">
		<input type="submit" value="Save user"/>
	</div>

</div>