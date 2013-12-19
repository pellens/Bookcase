<div class="left">

	<div class="tabs">

		<ul class="links">
			<li class="active" data-pane="inbox">Inbox</li>
		</ul>

		<div class="panes">
			<div class="pane" data-pane="inbox">
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
			<li>x unread messages</li>
			<li>x total messages</li>
		</ul>
	</div>

</div>