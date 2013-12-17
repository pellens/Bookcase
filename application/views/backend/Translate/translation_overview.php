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
						<th>&nbsp;</th>
					</tr>
					<? foreach($list as $trans):?>
					<tr>
						<td><?=$trans->key;?></td>
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