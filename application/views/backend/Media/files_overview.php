<div class="full">

	<h2>All files  <?=anchor("admin/lib/media/add_file","New file","class='button light'");?></h2>

	<ul class="tabs"></ul>

	<?
		$photos 		 = array();
		$files  		 = array();
		$total_file_size = 0;

		foreach($list as $file):
	
			switch($this->media->get_file_type($file->file_type)):
				case "image" : $photos[] = $file; break;
				default : $files[] = $file; break;
			endswitch;
	
			$total_file_size+=$file->file_size;

		endforeach;
	?>

	<? if(count($files) > 0):?>

	<div class="block" data-pane="Files">
		<table class="table table-bordered">
			<thead>
			<tr>
				<th width="1%"><input type="checkbox"/></th>
				<th>Title</th>
				<th>Type</th>
				<th>Size</th>
				<th>Date</th>
				<th>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
				<? foreach($files as $file):?>
				<tr>
					<td class="small"><input type="checkbox"/></td>
					<td><?=anchor("admin/lib/media/edit_file/".$file->id,$file->original_title);?></td>
					<td><img src="<?=base_url("images/core/icons/filetypes/".$file->file_type.".png");?>" class="file-icon"/> <?=$file->file_type;?></td>
					<td><?=filesize_to_mb($file->file_size);?></td>
					<td><?=time_elapsed_string($file->date);?></td>
					<td class="actions">
						<?=anchor("admin/lib/media/del_file/".$file->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this file?'");?>
					</td>
				</tr>
				<? endforeach;?>
			</tbody>
		</table>
	</div>
	<? endif;?>
	
	<? if(count($photos) > 0):?>
		<div class="block" data-pane="Photos">
			
			<? foreach($photos as $photo):?>
				<div class="photo">
					<figure>
						<a href="<?=base_url("admin/lib/media/edit_file/".$photo->id);?>"><img src="<?=base_url("uploads/images/120_120/".$photo->new_title);?>"/></a>
					</figure>
				</div>
			<? endforeach;?>

		</div>
	<? endif;?>

	<div class="block stats">
		<ul>
			<li><i class="fa fa-file-o"></i> <?=count($list);?> files</li>
			<li><i class="fa fa-signal"></i> <?=filesize_to_mb($total_file_size);?> total</li>
		</ul>
	</div>

</div>