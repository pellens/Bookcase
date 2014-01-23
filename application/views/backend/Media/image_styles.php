<div class="full">

	<h2>Image styles</h2>

		<div class="block">
		
		<table class="table table-bordered">
			<thead>
				<tr>
					<td><input type="checkbox"/></td>
					<th>Style title</th>
					<th>Width</th>
					<th>Height</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($list as $imgs):?>
					<tr>
						<td width="1%"><input type="checkbox"/></td>
						<td><?=anchor("admin/lib/media/edit_style/".$imgs->id,$imgs->title);?></td>
						<td width="1%"><?=$imgs->width;?> px</td>
						<td width="1%"><?=$imgs->height;?> px</td>
						<td class="actions">
							<?=anchor("admin/lib/media/del_style/".$imgs->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this image style?'");?>
						</td>
					</tr>
				<? endforeach;?>
			</tbody>
		</table>

	</div>

	<div class="block stats">
		<ul>
			<li><i class="fa fa-crop"></i> <?=count($list);?> image styles</li>
		</ul>
	</div>

</div>