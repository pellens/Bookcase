<?=form_open();?>
<div class="left">

	<div class="tabs">

		<ul class="links">
			<li data-pane="edit" class="active">Edit translation</li>
		</ul>

		<div class="panes">
			<div class="pane active" data-pane="edit">
				<div class="form-inline">
					<h2>Translation of "<?=$item[0]->key;?>"</h2>
					
					<? foreach($item as $lang):?>
					<p>
						<label for="lang_<?=$lang->id;?>"><?=strtoupper($lang->lang);?></label>
						<input type="text" name="string[]" value="<?=$lang->string;?>"/>
						<input type="hidden" name="id[]" value="<?=$lang->id;?>"/>
					</p>
					<? endforeach;?>

				</div>
			</div>
		</div>

	</div>

</div>

<div class="right">

<div class="box">
<p><input type="submit" value="Save changes" class="button green"/></p>
</div>

</div>

<?=form_close();?>