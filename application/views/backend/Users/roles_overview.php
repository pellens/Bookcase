<div class="full">

	<h2>User roles</h2>

		<div class="block">
		
		<table class="table table-bordered">
			<thead>
				<tr>
					<td><input type="checkbox"/></td>
					<th>Role title</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($list as $role):?>
					<tr>
						<td width="1%"><input type="checkbox"/></td>
						<td><?=anchor("admin/lib/users/edit_role/".$role->id,$role->title);?></td>
						<td class="actions">
							<?=anchor("admin/lib/users/del_role/".$role->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this user role?'");?>
						</td>
					</tr>
				<? endforeach;?>
			</tbody>
		</table>

	</div>

	<div class="block stats">
		<ul>
			<li><i class="fa fa-users"></i> <?=count($list);?> roles</li>
		</ul>
	</div>

</div>