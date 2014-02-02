<div class="full">

	<form method="post">

	<h2>Website settings</h2>

	<ul class="tabs"></ul>

	<div class="block" data-pane="General">

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

	<div class="block" data-pane="Social">

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

	<div class="block" data-pane="Analytics">
		<p>
			<label>Google analytics snippet</label>
			<span class="help-text">Paste here your trackingcode from <a href="http://analytics.google.com" target="_blank">Google Analytics</a>.</span>
			<textarea name="analytics"><?=base64_decode($settings->analytics);?></textarea>
	</div>

	<div class="actions">
		<input type="submit" value="Save settings"/>
	</div>

	</form>

</div>