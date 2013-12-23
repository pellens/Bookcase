<?=form_open();?>

<div class="left">

	<div class="tabs">
		<ul class="links">
			<li class="active" data-pane="edit">Edit block</li>
		</ul>
		<div class="panes">
			<div class="pane active" data-pane="edit">
			
				<? foreach($item as $block):?>
				<div class="item">
					<p><strong><?=$block->title;?> (<?=$block->lang;?>)</strong></p>
					<input type="hidden" name="id[]" value="<?=$block->id;?>"/>
					<textarea id="ckeditor_<?=$block->id;?>" name="content[]"><?=$block->content;?></textarea>
				</div>
				<? endforeach;?>

			</div>
		</div>
	</div>

</div>

<div class="right">
<div class="box">
<input type="submit" value="Save content" class="button green"/>
</div>
</div>

<?=form_close();?>

<script>
<? foreach($item as $block):?>
CKEDITOR.replace( 'ckeditor_<?=$block->id;?>', {
	toolbar : "Bookcase"
});
<? endforeach;?>
</script>