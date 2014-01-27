<div class="full">

	<?=form_open();?>

	<h2>Add a job</h2>

	<h3>Job description</h3>
	<div class="block">

		<input type="hidden" value="<?=@$item->id;?>" name="id"/>

		<p><label for="title">Title</label> <input type="text" name="title" id="title" value="<?=@$item->title;?>"/></p>

		<p><label for="description">Description</label></p>
		<span class="help-text">Type here a short description of the job, make it clear what it's about.</span>
		<p><textarea name="description" id="ckeditor"><?=@$item->description;?></textarea></p>

	</div>

	<h3>Requirements</h3>
	<div class="block">
		<p><textarea name="requirments" id="requirments"><?=@$item->requirments;?></textarea></p>
	</div>

	<h3>Offer</h3>
	<div class="block">
		<p><textarea name="offer" id="offer"><?=@$item->offer;?></textarea></p>
	</div>

		<div class="tabs">
			<ul class="links">
				<li class="active" data-pane="add">Add job</li>
				<li data-pane="videos">Videos</li>
				<li data-pane="seo">Searchengines</li>
			</ul>
			<div class="panes">

				<!-- ADD PRODUCT -->

				<div class="active pane" data-pane="add">

					

					

					

				</div>
	
				<!-- SEO & SOCIAL MEDIA SETTINGS -->

				<div class="pane" data-pane="seo">
					<?
						$data["item"] = @$item;
						$this->load->view("backend/snippets/seo_social",$data);
					?>
				</div>

				<!-- ADD VIDEOS -->
				<div class="pane" data-pane="videos">
					<?
						$this->jobs->job(@$item->id);
						$data["videos"] = $this->jobs->job_videos();
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
				$this->jobs->job(@$item->id);
				foreach($this->jobs->job_locations() as $loc):
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
	CKEDITOR.replace( 'requirments', {
		toolbar : "Bookcase"
	});
	CKEDITOR.replace( 'offer', {
		toolbar : "Bookcase"
	});
</script>