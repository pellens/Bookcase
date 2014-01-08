<?=form_open();?>

	<div class="left">
		<div class="tabs">
			<ul class="links">
				<li class="active" data-pane="add">Add category</li>
				<li data-pane="videos">Videos</li>
				<li data-pane="seo">Searchengines</li>
			</ul>
			<div class="panes">
			<div class="active pane" data-pane="add">

					<p><label for="title">Title</label> <input type="text" name="title" id="title" value="<?=@$item->title;?>"/></p>
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

			<!-- ADD VIDEOS -->
				<div class="pane" data-pane="videos">
					<?
						$this->products->product(@$item->id);
						$data["videos"] = $this->products->category_videos();
						$this->load->view("backend/snippets/videos_add",$data);
					?>
				</div>
			</div>

		</div>
	</div>
	
	<div class="right">
	<div class="box">
	<p>
		<label for="category">Parent category</label>
		<select name="parent" id="category">
			<option value="0">No parent category</option>
			<? foreach($this->products->categories_overview() as $cat):?>
			<option value="<?=$cat->id;?>" <?=(@$item->parent == $cat->id) ? "selected" : "";?>><?=$cat->title;?></option>
			<? endforeach;?>
		</select>
	</p>
	</div>
	<div class="box">
		<p><label>Linked to location:</label></p>
		<ul>
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