<div class="full">

	<?=form_open();?>

	<h2>Add a new product</h2>

	<ul class="tabs"></ul>

	<div class="block" data-pane="Content">
		<p><label for="title">Title</label> <input type="text" name="title" id="title" value="<?=@$item->title;?>"/></p>
		<p><label for="price">Price</label> <input type="text" name="price" id="price" value="<?=@$item->price;?>"/></p>
		<p><label for="category">Category</label> <?=$this->products->categories_overview(null,true,"select");?></p>
		<p><label for="description">Description</label></p>
		<input type="hidden" value="<?=@$item->id;?>" name="id"/>
	
		<p><textarea name="description" id="ckeditor"><?=@$item->description;?></textarea></p>
	</div>

	<div class="block" data-pane="Media">

		<? 
			//$this->media->resizeImage("seventies.png");

			$data["item"] = @$item;
			$this->load->view("backend/snippets/photos_upload",$data);
			unset($data);
		?>

	</div>

	<div class="block" data-pane="Videos">
		<?
			$this->products->product(@$item->id);
			$data["videos"] = $this->products->product_videos();
			$this->load->view("backend/snippets/videos_add",$data);
			unset($data);
		?>
	</div>

	<div class="block" data-pane="Locations">
		<p><label>Linked to location:</label></p>
		<ul class="checkbox-list">
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

	<div class="block" data-pane="SEO">
		<?
			$data["item"] = @$item;
			$this->load->view("backend/snippets/seo_social",$data);
		?>
	</div>

	<div class="actions">
		<input type="submit" value="Save product"/>
	</div>

</div>

<?=form_close();?>

<script>
CKEDITOR.replace( 'ckeditor', {
	toolbar : "Bookcase"
});
</script>