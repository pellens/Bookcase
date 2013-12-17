<div class="full">

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
						<th></th>
					</tr>
					<? foreach($this->translate->all_supported_languages(true) as $lang):?>
					<tr>
						<td>
							<?=($lang->primary == 1) ? "<span class='label label-info'>Primary</span>" : "";?> <?=$lang->lang;?></td>
						<td><?=base_url($lang->code);?></td>
						<td width="200">
							<div class="progress">
								<div class="bar" style="width:<?=$this->translate->progress_translation($lang->code);?>"></div>
							</div>
						</td>
						<td>
							<?=anchor("admin/lib/translate/make_primary/".$lang->code,"Make primary");?>
							<?=anchor("admin/lib/translate/deactivate_language/".$lang->code,"Deactivate");?>
						</td>
					</tr>
				<? endforeach;?>
				</table>
			</div>
		</div>
	</div>

</div>