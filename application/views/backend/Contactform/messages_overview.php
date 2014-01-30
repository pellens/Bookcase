<div class="full">

	<h2>Inbox</h2>

	<div class="block">

		<table class="table table-striped">
			<thead>
				<tr>
					<th width="1%"><input type="checkbox"/></th>
					<th>Contact</th>
					<th>Subject</th>
					<th>Date</th>
				</tr>
			</thead>
			<? foreach($list as $mes):?>
				<? $fields = unserialize($mes->fields);?>
				<tr class="<?=($mes->read==0)?"unread":"";?>">
					<td><input type="checkbox"/></td>
					<td><?=$fields["name"];?></td>
					<td><?=anchor("admin/lib/contactform/submission/".$mes->id,$mes->subject);?></td>
					<td><?=time_elapsed_string($fields["date"]);?></td>
				</tr>
			<? endforeach;?>
		</table>

	</div>

	<div class="block stats">

		<div>
			<ul>
				<li><i class="fa fa-envelope"></i><?=$stats["unread"];?> unread messages</li>
				<li><i class="fa fa-inbox"></i><?=count($list);?> total messages</li>
			</ul>
		</div>

	</div>

</div>