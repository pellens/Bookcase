<div class="left">

	<div class="tabs">

		<ul class="links">
			<li class="active" data-pane="overview">Translations overview</li>
		</ul>

		<div class="panes">

			<div class="pane active" data-pane="overview">
				
				<table class="table table-bordered table-striped">
					<tr>
						<th>Keyword</th>
						<th>Progress</th>
						<th>&nbsp;</th>
					</tr>
					<? foreach($list as $trans):?>
					<tr>
						<td><?=$trans->key;?></td>
						<td width="200">
							
							<div class="progress">
								<div class="bar" style="width:<?=$this->translate->key_progress($trans->key);?>%"></div>
							</div>
						</td>
						<td><?=anchor("admin/lib/translate/edit_translation/".$trans->key,"Edit");?></td>
					</tr>
					<? endforeach;?>
				</table>

			</div>

		</div>

	</div>

</div>

<div class="right">
	<div class="box">
		<p><label>Total progress:</label></p>
		<ul class="lang-stats">
			<? foreach($this->translate->all_supported_languages(true) as $lang):?>
			<li>
				<label><?=strtoupper($lang->code);?></label>
				<span class="progress">
					<span class="bar" style="width:<?=$this->translate->progress_translation($lang->code);?>;">
					</span>
				</span>
			</li>
			<? endforeach;?>
		</ul>
	</div>
</div>