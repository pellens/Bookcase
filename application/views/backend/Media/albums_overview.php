<div class="full">

	<h2>Albums <?=anchor("admin/lib/media/add_album","New album","class='button light'");?></h2>

	<div class="block">
		
		<table class="table table-bordered">
			<thead>
				<tr>
					<td width="1%"><input type="checkbox"/></td>
					<th>Album title</th>
					<th>Photos</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($list as $album):?>
					<tr>
						<td><input type="checkbox"/></td>
						<td><?=anchor("admin/lib/media/edit_album/".$album->id,$album->title);?></td>
						<td>x</td>
						<td class="actions">
							<?=anchor("admin/lib/media/del_album/".$album->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this album?'");?>
						</td>
					</tr>
				<? endforeach;?>
			</tbody>
		</table>

	</div>

	<div class="block stats">
		<ul>
			<li><i class="fa fa-folder-o"></i> <?=count($list);?> albums</li>
			<li><i class="fa fa-picture-o"></i> x photos</li>
		</ul>
	</div>

</div>