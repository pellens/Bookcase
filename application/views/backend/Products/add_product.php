<?=form_open();?>

	<div class="left">
		<div class="tabs">
			<ul class="links">
				<li class="active" data-pane="add">Add product</li>
				<li data-pane="seo">Searchengines</li>
			</ul>

			<div class="active pane" data-pane="add">

					<p><label for="title">Title</label> <input type="text" name="title" id="title" value="<?=@$item->title;?>"/></p>
					<p><label for="price">Price</label> <input type="text" name="price" id="price" value="<?=@$item->price;?>"/></p>
					<p><label for="description">Description</label></p>
					<input type="hidden" value="<?=@$item->id;?>" name="id"/>

				<p><textarea name="description" id="ckeditor"><?=@$item->description;?></textarea></p>
			</div>
		</div>
	</div>
	
	<div class="right">
		<div class="box">
		<p><input type="submit" value="Save product" class="button green"/></p>
		</div>
	</div>

<?=form_close();?>

<script>
<? foreach($item as $block):?>
CKEDITOR.replace( 'ckeditor', {
	toolbar : "Bookcase"
});
<? endforeach;?>
</script>