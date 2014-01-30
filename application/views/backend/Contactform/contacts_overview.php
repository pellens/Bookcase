<div class="full">

	<h2>Contacts</h2>

	<div class="block">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="1%"><input type="checkbox"/></th>
					<th>Name</th>
					<th>E-mail</th>
					<th>Tel</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($list as $mes):?>
					<tr>
						<td width="1%"><input type="checkbox"/></td>
						<td><?=anchor("admin/lib/contactform/contact/".$mes->id,ucwords(strtolower($mes->name)));?></td>
						<td><?=mailto($mes->email,$mes->email);?></td>
						<td><?=$mes->tel;?></td>
						<td class="actions">
							<?=anchor("admin/lib/contactform/del_contact/".$mes->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this contact?'");?>
						</td>
					</tr>
				<? endforeach;?>
			</tbody>
		</table>
	</div>

	<div class="block stats">

		<div>
			<ul>
				<li><i class="fa fa-shopping-cart"></i> <?=count($list);?> contact(s)</li>
			</ul>
		</div>

	</div>

</div>