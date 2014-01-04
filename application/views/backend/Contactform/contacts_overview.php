<div class="left">

	<div class="tabs">

		<ul class="links">
			<li class="active" data-pane="contacts">Contacts overview</li>
		</ul>

		<div class="panes">
			<div class="pane active" data-pane="contacts">
				<table class="table table-bordered table-striped">
				<thead>
				<tr>
				<th>Contactperson</th>
				<th>E-mail</th>
				<th>&nbsp;</th>
				</thead>
				<? foreach($list as $mes):?>
					<tr>
						<td><?=ucwords(strtolower($mes->name));?></td>
						<td><?=mailto($mes->email,$mes->email);?></td>
						<td><?=anchor("lib/contactform/contact/".$mes->id,"View contact");?></td>
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
			<li>x contacts</li>
			<li>x prospects</li>
		</ul>
	</div>

</div>