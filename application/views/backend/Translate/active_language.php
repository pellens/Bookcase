<?=form_open();?>

<div class="left">
	<div class="tabs">
		<ul class="links">
			<li class="active">Add language</li>
		</ul>

		<div class="panes">
			<div class="pane active">
				<div class="form-inline">
					<p><label>Language</label>
						<select name="language">
						<? foreach($languages as $lang):?>
						<option value="<?=$lang->code;?>" <?=($lang->active==1)?"disabled='disabled'":"";?>><?=$lang->lang;?></option>
						<? endforeach;?>
						</select>
					</p>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="right">
	<div class="box">
		<p><label>Make default language?</label>
			<select name="primary">
				<option value="0">No</option>
				<option value="1">Yes</option>
			</select>
		</p>

		<p><input type="submit" value="Add language" class="button green"/></p>
	</div>
</div>

<?=form_close();?>