<div class="full">

	<h2>Location types  <?=anchor("admin/lib/locations/add_type","New location type","class='button light'");?></h2>

	<div class="block">
		<table class="table table-bordered">
			<thead>
			<tr>
				<th width="1%"><input type="checkbox"/></th>
				<th>Title</th>
				<th>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<? foreach($list as $type):?>
			<tr>
				<td class="small"><input type="checkbox"/></td>
				<td><?=anchor("admin/lib/locations/edit_type/".$type->id,$type->title);?></td>
				<td class="actions">
					<?=anchor("admin/lib/locations/del_type/".$type->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this location type?'");?>
				</td>
			</tr>
			<? endforeach;?>
			</tbody>
		</table>
	</div>

	<div class="block stats">
		<ul>
			<li><i class="fa fa-folder-o"></i> <?=count($list);?> location types</li>
		</ul>
	</div>

</div>