<?=form_open();?>

	<div class="left">
		<div class="tabs">
			<ul class="links">
				<li class="active" data-pane="add">Add product</li>
				<li data-pane="photos">Photos</li>
				<li data-pane="videos">Videos</li>
				<li data-pane="seo">Searchengines</li>
			</ul>
			<div class="panes">

				<!-- ADD PRODUCT -->

				<div class="active pane" data-pane="add">
	
					<p><label for="title">Title</label> <input type="text" name="title" id="title" value="<?=@$item->title;?>"/></p>
					<p><label for="price">Price</label> <input type="text" name="price" id="price" value="<?=@$item->price;?>"/></p>
					<p><label for="category">Category</label> <?=$this->products->categories_overview(null,true,"select");?></p>
					<p><label for="description">Description</label></p>
					<input type="hidden" value="<?=@$item->id;?>" name="id"/>
	
					<p><textarea name="description" id="ckeditor"><?=@$item->description;?></textarea></p>

				</div>
	
				<!-- SEO & SOCIAL MEDIA SETTINGS -->

				<div class="pane" data-pane="seo">
					<?
						$data["item"] = @$item;
						$this->load->view("backend/snippets/seo_social",$data);
					?>
				</div>

				<!-- ADD PHOTOS -->

				<div class="pane" data-pane="photos">
					<?
						$data["item"] = @$item;
						$this->load->view("backend/snippets/photos_upload",$data);
					?>
				</div>

				<!-- ADD VIDEOS -->

				<div class="pane" data-pane="videos">
					<?
						$this->products->product(@$item->id);
						$data["videos"] = $this->products->product_videos();
						$this->load->view("backend/snippets/videos_add",$data);
					?>
				</div>

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
CKEDITOR.replace( 'ckeditor', {
	toolbar : "Bookcase"
});
</script>