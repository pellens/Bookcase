<div class="left">

	<div class="tabs">

		<ul class="links">
			<li class="active" data-pane="forms">Forms overview</li>
		</ul>

		<div class="panes">
			<div class="pane active" data-pane="forms">
				<table class="table table-bordered table-striped">
					<tr>
						<th>Formname</th>
						<th>Save submits</th>
						<th>Save contacts</th>
						<th>Send email</th>
						<th>Submissions</th>
						<th></th>
					</tr>
				<? foreach($list as $form):?>
					<tr>
						<td><?=$form->name;?></td>
						<td><?=($form->save_submit==1)?"Yes":"No";?></td>
						<td><?=($form->save_contact==1)?"Yes":"No";?></td>
						<td><?=($form->send_mail==1)?"Yes":"No";?></td>
						<td>x</td>
						<td>
							<?=anchor("admin/lib/contactform/edit_form/".$form->id,"Edit");?>
							<?=anchor("admin/lib/contactform/del_form/".$form->id,"Delete","class'delete'");?>
						</td>
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
			<li>x unread messages</li>
			<li>x total messages</li>
		</ul>
	</div>

</div>