<div class="full">

	<?=form_open()?>

	<h2>Edit file</h2>

		<div class="block">
			
			<input type="hidden" value="<?=@$item->id;?>" name="id"/>
			<p>
				<label>Title</label>
				<input type="text" name="title" value="<?=@$item->title;?>"/>
			</p>
			<p>
				<label>Description</label>
				<input type="text" name="alt" value="<?=@$item->alt;?>"/>
			</p>
	
		</div>

		<div class="block">

			<p>
				<label>This file can only be downloaded by:</label>
				<span class="help-text">Select none to make it downloadable for everyone.</span>
			</p>
			<ul class="checkbox-list">
				<? foreach($this->users->roles_overview() as $role):?>
				<li><label><input type="checkbox" name="roles[]"/> <?=$role->title;?></label></li>
				<? endforeach;?>
			</ul>

		</div>

		<div class="block">
			<p><strong>File uploaded on</strong> <?=date("d-m-Y H:i:s",$item->date);?></p>
			<p><strong>File original title:</strong> <?=$item->original_title;?></p>
			<p><strong>File save title:</strong> <?=$item->new_title;?></p>
			<p><strong>File type:</strong> <?=$item->file_type;?></p>
			<p><strong>File size:</strong> <?=filesize_to_mb($item->file_size);?></p>
		</div>
	
		<div class="actions">
			<input type="submit" value="Save file"/>
		</div>

	<?=form_close();?>

</div>