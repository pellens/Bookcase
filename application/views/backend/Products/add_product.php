<?=form_open();?>

	<div class="left">
		<div class="tabs">
			<ul class="links">
				<li data-pane="add">Add product</li>
				<li class="active" data-pane="photos">Photos</li>
				<li data-pane="videos">Videos</li>
				<li data-pane="seo">Searchengines</li>
			</ul>
			<div class="panes">

				<!-- ADD PRODUCT -->

				<div class=" pane" data-pane="add">

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

				<div class="active pane" data-pane="photos">

					<? $this->media->make_image_square("/Applications/MAMP/htdocs/Bookcase/uploads/images/1389136660_img_1776.jpg",200);?>
					<?
						$data["item"] = @$item;
						$this->load->view("backend/snippets/photos_upload",$data);
						unset($data);
					?>
				</div>

				<!-- ADD VIDEOS -->
				<div class="pane" data-pane="videos">
					<?
						$this->products->product(@$item->id);
						$data["videos"] = $this->products->product_videos();
						$this->load->view("backend/snippets/videos_add",$data);
						unset($data);
					?>
				</div>

			</div>

		</div>
	</div>
	
	<div class="right">
		<div class="box">
		<p><label>Linked to location:</label></p>
		<ul>
			<?
				$locations = array();
				foreach($this->products->product_locations() as $loc):
					array_push($locations,$loc->id);
				endforeach;
			?>
			<? foreach($this->locations->locations_overview() as $loc):
				$checked = (is_int(array_search($loc->id,$locations))) ? "checked='checked'" : "";
			?>
			<li><label><input type="checkbox" value="<?=$loc->id;?>" <?=$checked;?> name="location[]"/> <?=$loc->title;?></label></li>
			<? endforeach;?>
		</ul>
		</div>

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