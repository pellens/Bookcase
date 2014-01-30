<div class="full">

	<?=form_open()?>

	<h2>Edit file</h2>

		<ul class="tabs"></ul>

		<div class="block" data-pane="File">
			
			<figure class="preview">
				<? if(general_filetype($item->file_type) == "image"):?>
					<img src="http://placehold.it/100x100"/>
				<? else:?>
					<img src="<?=base_url("images/core/icons/filetypes/".$item->file_type);?>.png"/>
				<? endif;?>
			</figure>

			<input type="hidden" value="<?=@$item->id;?>" name="id"/>
			<p>
				<label>Title</label>
				<input type="text" name="title" value="<?=@$item->title;?>"/>
			</p>
			<p>
				<label>Description</label>
				<input type="text" name="alt" value="<?=@$item->alt;?>"/>
			</p>
			<? if(general_filetype($item->file_type) == "file"):?>
			<p>
				<label>This file can only be downloaded by:</label>
				<span class="help-text">Select none to make it downloadable for everyone.</span>
			</p>
			<ul class="checkbox-list">
				<? foreach($this->users->roles_overview() as $role):?>
				<li><label><input type="checkbox" name="roles[]"/> <?=$role->title;?></label></li>
				<? endforeach;?>
			</ul>
		<?  endif;?>
	
		</div>

		<? if(general_filetype($item->file_type) == "image"):?>
		<div class="block" data-pane="Crop">
			<table class="table-bordered table">
				<thead>
					<tr>
						
						<th width="1%">&nbsp;</th>
						<th width="1%">&nbsp;</th>
						<th>Image style</th>
						<th>Width</th>
						<th>Height</th>
					</tr>
				</thead>
				<tbody>
					<? foreach($this->media->image_styles() as $style):?>
					<tr>
						<td><i class="fa fa-check"></i></td>
						<td>Crop</td>
						<td><?=$style->title;?></td>
						<td><?=$style->width;?> px</td>
						<td><?=$style->height;?> px</td>
					</tr>
					<? endforeach;?>
				</tbody>
			</table>
		</div>
		<? endif;?>


		<div class="block" data-pane="Info">
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