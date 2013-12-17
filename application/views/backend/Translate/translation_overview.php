<div class="full">

	<div class="tabs">

		<ul class="links">
			<li class="active">Translations overview</li>
		</ul>

		<div class="panes">

			<div class="pane active">
				
				<table class="table table-bordered table-striped">
					<tr>
						<th>Keyword</th>
						<? foreach($this->translate->all_supported_languages() as $lang):?>
						<th><?=strtoupper($lang->code);?></th>
						<? endforeach;?>
						<th>&nbsp;</th>
					</tr>
					<? foreach($list as $trans):?>
					<tr>
						<td><?=$trans->key;?></td>
						<td>Done of niet?</td>
						<td><?=anchor("admin/lib/translate/edit_translation/".$trans->id,"Edit");?></td>
					</tr>
					<? endforeach;?>
				</table>

			</div>

		</div>

	</div>

</div>