<div class="full">

	<h2>Users <?=anchor("admin/lib/users/add_user","New user","class='button light'");?></h2>

		<div class="block">
		
		<table class="table table-bordered">
			<thead>
				<tr>
					<td><input type="checkbox"/></td>
					<th>Name</th>
					<th>Role</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($list as $user):?>
					<tr>
						<td width="1%"><input type="checkbox"/></td>
						<td><?=anchor("admin/lib/users/edit_user/".$user->id,$user->first_name." ".$user->name);?></td>
						<td><?=$user->role_title;?></td>
						<td class="actions">
							<?=anchor("admin/lib/users/del_user/".$user->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this user?'");?>
						</td>
					</tr>
				<? endforeach;?>
			</tbody>
		</table>

	</div>

	<div class="block stats">
		<ul>
			<li><i class="fa fa-users"></i> <?=count($list);?> users</li>
		</ul>
	</div>

</div>