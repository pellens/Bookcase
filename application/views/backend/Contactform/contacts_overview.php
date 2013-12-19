<div class="left">

	<div class="tabs">

		<ul class="links">
			<li class="active" data-pane="contacts">Contacts overview</li>
		</ul>

		<div class="panes">
			<div class="pane active" data-pane="contacts">
				<table class="table table-bordered table-striped">
				<? foreach($list as $mes):?>
					<tr>
						<td><? print_r($mes);?></td>
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