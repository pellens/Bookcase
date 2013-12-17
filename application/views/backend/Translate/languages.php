<div class="left">

	<div class="tabs">
		<ul class="links">
			<li class="active">Supported languages</li>
		</ul>

		<div class="panes">
			<div class="pane active">
				<table class="table table-bordered table-striped">
					<tr>
						<th>Language</th>
						<th>Base url</th>
						<th>Progress</th>
						<th>Active</th>
					</tr>
					<? foreach($list as $lang):?>
					<tr>
						<td><?=$lang->lang;?></td>
						<td><?=base_url($lang->code);?></td>
						<td width="200">
							<div class="progress">
								<div class="bar" style="width:<?=$this->translate->progress_translation($lang->code);?>"></div>
							</div>
						</td>
						<td><?=($lang->active == 1) ? "yes" : "no";?></td>
					</tr>
				<? endforeach;?>
				</table>
			</div>
		</div>
	</div>

</div>