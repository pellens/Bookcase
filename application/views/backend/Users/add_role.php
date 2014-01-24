<div class="full">

	<?=form_open();?>

	<h2>Add user role</h2>

		<div class="block">
		
		<input type="hidden" value="<?=@$item->id;?>" name="id"/>

		<p>
			<label>Role title</label>
			<span class="help-text">Once you added a role, make sure to set it's permissions.</span>
			<input type="text" name="title" value="<?=@$item->title;?>"/>
		</p>

	</div>

	<div class="actions">
		<input type="submit" value="Save user role"/>
	</div>

	<?=form_close();?>

</div>