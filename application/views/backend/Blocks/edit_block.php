<div class="full">

	<?=form_open();?>

	<h2>Edit textblock</h2>

	<ul class="tabs"></ul>

	<? foreach($item as $block):?>
		<div class="block" data-pane="<?=strtoupper($block->lang);?>">
			<input type="hidden" name="id[]" value="<?=$block->id;?>"/>
			<textarea id="ckeditor_<?=$block->id;?>" name="content[]"><?=$block->content;?></textarea>
		</div>
	<? endforeach;?>

	<div class="actions">
		<input type="submit" value="Save textblock"/>
	</div>

	<?=form_close();?>

</div>

<script>
<? foreach($item as $block):?>
CKEDITOR.replace( 'ckeditor_<?=$block->id;?>', {
	toolbar : "Bookcase"
});
<? endforeach;?>
</script>