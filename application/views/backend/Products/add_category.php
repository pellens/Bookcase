<?=form_open();?>

	<div class="left">
		<div class="tabs">
			<ul class="links">
				<li class="active" data-pane="add">Add category</li>
				<li data-pane="seo">Searchengines</li>
			</ul>
			<div class="panes">
			<div class="active pane" data-pane="add">

					<p><label for="title">Title</label> <input type="text" name="title" id="title" value="<?=@$item->title;?>"/></p>
					<p><label for="category">Parent category</label> <?=$this->products->categories_overview(null,true,"select");?></p>
					<p><label for="description">Description</label></p>
					<input type="hidden" value="<?=@$item->id;?>" name="id"/>

				<p><textarea name="description" id="ckeditor"><?=@$item->description;?></textarea></p>
			</div>

			<div class="pane" data-pane="seo">
				<?
					$data["item"] = @$item;
					$this->load->view("backend/snippets/seo_social",$data);
				?>
			</div>
			</div>

		</div>
	</div>
	
	<div class="right">
		<div class="box">
		<p><input type="submit" value="Save category" class="button green"/></p>
		</div>
	</div>

<?=form_close();?>

<script>
CKEDITOR.replace( 'ckeditor', {
	toolbar : "Bookcase"
});
</script>