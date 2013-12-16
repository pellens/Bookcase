<div class="full">

	<div class="tabs">
		<ul class="links">
			<li class="active" data-pane="types">Location types</li>
		</ul>
		<div class="panes">
			<div class="pane active" data-pane="types">
				<table class="table table-bordered table-striped">
					<tr>
						<th>&nbsp;</th>
						<th>Title</th>
						<th>&nbsp;</th>
					</tr>
					<? foreach($list as $type):?>
					<tr>
						<td class="small"><input type="checkbox"/></td>
						<td><?=$type->title;?></td>
						<td>
							<?=anchor("admin/lib/locations/edit_type/".$type->id,"Edit");?>
							<?=anchor("admin/lib/locations/del_type/".$type->id,"Delete");?>
						</td>
					</tr>
					<? endforeach;?>
				</table>
			</div>
		</div>
	</div>

</div>