<div class="full">

	<?=form_open()?>

	<h2>Add new album</h2>

		<div class="block">
			
			<input type="hidden" value="<?=@$item->id;?>" name="id"/>
			<p>
				<label>Album title</label>
				<input type="text" name="title" value="<?=@$item->title;?>"/>
			</p>
	
		</div>
	
		<div class="actions">
			<input type="submit" value="Save album"/>
		</div>

	<?=form_close();?>

</div>