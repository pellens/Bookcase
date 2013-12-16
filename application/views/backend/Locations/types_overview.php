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
							<? if($type->id != 1 && $type->id != 2):?>
								<?=anchor("admin/lib/locations/del_type/".$type->id,"Delete","class='del'  data-alert='Are you sure you want to delete this locationtype?'");?>
							<? endif;?>
						</td>
					</tr>
					<? endforeach;?>
				</table>
			</div>
		</div>
	</div>

</div>