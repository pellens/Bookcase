<div class="full">

	<h2>All files  <?=anchor("admin/lib/media/add_file","New file","class='button light'");?></h2>

	<div class="block">
		<table class="table table-bordered">
			<thead>
			<tr>
				<th width="1%"><input type="checkbox"/></th>
				<th>Title</th>
				<th>Size</th>
				<th>Downloads</th>
				<th>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<? foreach($list as $file):?>
			<tr>
				<td class="small"><input type="checkbox"/></td>
				<td><?=anchor("admin/lib/media/edit_file/".$file->id,$file->title);?></td>
				<td class="actions">
					<?=anchor("admin/lib/media/del_file/".$file->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this file?'");?>
				</td>
			</tr>
			<? endforeach;?>
			</tbody>
		</table>
	</div>

	<div class="block stats">
		<ul>
			<li><i class="fa fa-folder-o"></i> <?=count($list);?> files</li>
		</ul>
	</div>

</div>