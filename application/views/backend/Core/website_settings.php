<div class="full">

	<form method="post">

	<h2>Website settings</h2>

	

	<h3>General</h3>
	<div class="block">

		<p>
			<label>Website title</label>
			<span class="help-text">Enter your company or websitename here.</span>
			<input type="text" name="title" value="<?=$settings->title;?>"/>
		</p>
		<p>
			<label>Website slogan</label>
			<span class="help-text">Enter your company or website's slogan here.</span>
			<input type="text" name="slogan" value="<?=$settings->slogan;?>"/>
		</p>		

	</div>

	<h3>Social media</h3>
	<div class="block">

		<p>
			<label>Facebook application ID</label>
			<span class="help-text">If you have a Facebook application, enter the app id here.</span>
			<input type="text" name="fb_app_id" value="<?=$settings->fb_app_id;?>"/>
		</p>

		<p>
			<label>Facebook secret</label>
			<span class="help-text">If you have a Facebook application, enter the app secret here.</span>
			<input type="text" name="facebook_secret" value="<?=$settings->facebook_secret;?>"/>
		</p>

		<p>
			<label>Twitter application ID</label>
			<span class="help-text">If you have a Twitter application, enter the app id here.</span>
			<input type="text" name="twitter_key" value="<?=$settings->twitter_key;?>"/>
		</p>

		<p>
			<label>Twitter secret</label>
			<span class="help-text">If you have a Twitter application, enter the app secret here.</span>
			<input type="text" name="twitter_secret" value="<?=$settings->twitter_secret;?>"/>
		</p>

		<p>
			<label>Google client ID</label>
			<span class="help-text">If you have a Google application, enter the client id here.</span>
			<input type="text" name="google_client_id" value="<?=$settings->google_client_id;?>"/>
		</p>

		<p>
			<label>Google client secret</label>
			<span class="help-text">If you have a Google application, enter the client secret here.</span>
			<input type="text" name="google_client_secret"/>
		</p>

	</div>

	<div class="actions">
		<input type="submit" value="Save settings"/>
	</div>

	</form>

</div>