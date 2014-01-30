<div class="full">

	<?=form_open();?>

	<h2>New product category</h2>

	<ul class="tabs"></ul>

	<div class="block" data-pane="Category">

		<p><label for="title">Title</label> <input type="text" name="title" class="required" id="title" value="<?=@$item->title;?>"/></p>
		<p>
			<label for="category">Parent category</label>
			<select name="parent" id="category">
				<option value="0">No parent category</option>
				<? foreach($this->products->categories_overview() as $cat):?>
				<option value="<?=$cat->id;?>" <?=(@$item->parent == $cat->id) ? "selected" : "";?>><?=$cat->title;?></option>
				<? endforeach;?>
			</select>
		</p>
		<p><label for="description">Description</label></p>
		<input type="hidden" value="<?=@$item->id;?>" name="id"/>
		<p><textarea name="description" id="ckeditor"><?=@$item->description;?></textarea></p>
	
	</div>

	<div class="block" data-pane="SEO">
		<?
			$data["item"] = @$item;
			$this->load->view("backend/snippets/seo_social",$data);
		?>
	</div>

			<!-- ADD VIDEOS -->
	<div class="block" data-pane="Videos">
		<?
			$this->products->product(@$item->id);
			$data["videos"] = $this->products->category_videos();
			$this->load->view("backend/snippets/videos_add",$data);
		?>
	</div>

	<div class="block" data-pane="Locations">
		<p><label>Linked to location:</label></p>
		<ul class="checkbox-list">
			<?
				$locations = array();
				foreach($this->products->category_locations() as $loc):
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

	<div class="actions">
		<input type="submit" value="Save category"/>
	</div>

<?=form_close();?>


</div>

<script>
CKEDITOR.replace( 'ckeditor', {
	toolbar : "Bookcase"
});
</script>