<div class="left">

	<div class="tabs">

		<ul class="links">
			<li class="active" data-pane="inbox">Inbox</li>
		</ul>

		<div class="panes">
			<div class="pane active" data-pane="inbox">
				<table class="table table-bordered table-striped">
				<tr>
					<th colspan="2">&nbsp;</th>
					
					<th>Contactperson</th>
					<th>Form</th>
					<th>Date</th>
				</tr>
				<? foreach($list as $mes):?>
					<? $fields = unserialize($mes->fields);?>
					<tr>
						<td><input type="checkbox"/></td>
						<td><i class="icon-envelope"></i> <?=anchor("admin/lib/contactform/submission/".$mes->id,"Read message");?></td>
						<td><?=$fields["name"];?></td>
						<td><?=anchor("admin/lib/contactform/edit_form/".$mes->form_id,$mes->name);?></td>
						<td><?=date("d/m/Y H:i:s",$fields["date"]);?></td>
					</tr>
				<? endforeach;?>
				</table>
			</div>
		</div>

	</div>

</div>

<div class="right">

	<div class="box">
		<ul class="inbox-stats">
			<li><?=$stats["inbox"];?> unread messages</li>
			<li><?=$stats["unread"];?> total messages</li>
		</ul>
	</div>

</div>