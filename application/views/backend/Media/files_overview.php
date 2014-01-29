<div class="full">

	<h2>All files  <?=anchor("admin/lib/media/add_file","New file","class='button light'");?></h2>

	<div class="block">
		<table class="table table-bordered">
			<thead>
			<tr>
				<th width="1%"><input type="checkbox"/></th>
				<th>Title</th>
				<th>Type</th>
				<th>Size</th>
				<th>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<? $total_file_size=0; foreach($list as $file):?>
			<tr>
				<td class="small"><input type="checkbox"/></td>
				<td><?=anchor("admin/lib/media/edit_file/".$file->id,$file->original_title);?></td>
				<td><img src="<?=base_url("images/core/icons/filetypes/".$file->file_type.".png");?>" class="file-icon"/> <?=$file->file_type;?></td>
				<td><?=filesize_to_mb($file->file_size);?></td>
				<td class="actions">
					<?=anchor("admin/lib/media/del_file/".$file->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this file?'");?>
				</td>
			</tr>

			<? $total_file_size+=$file->file_size;?>
			<? endforeach;?>
			</tbody>
		</table>
	</div>

	<div class="block stats">
		<ul>
			<li><i class="fa fa-file-o"></i> <?=count($list);?> files</li>
			<li><i class="fa fa-signal"></i> <?=filesize_to_mb($total_file_size);?> total</li>
		</ul>
	</div>

</div>