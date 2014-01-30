<div class="full">

	<?=form_open();?>

	<h2>Add a job</h2>

	<ul class="tabs"></ul>

	<div class="block" data-pane="Job">

		<input type="hidden" value="<?=@$item->id;?>" name="id"/>

		<p><label for="title">Title</label> <input type="text" name="title" class="required" id="title" value="<?=@$item->title;?>"/></p>

		<p><label for="description">Description</label></p>
		<span class="help-text">Type here a short description of the job, make it clear what it's about.</span>
		<p><textarea name="description" id="ckeditor"><?=@$item->description;?></textarea></p>

	</div>

	<div class="block" data-pane="Requirements">
		<p><label for="description">Requirements</label></p>
		<span class="help-text">What requirements are needed to perform this job?</span>
		<p><textarea name="requirments" id="requirments"><?=@$item->requirments;?></textarea></p>
	</div>

	<div class="block" data-pane="Offer">
		<p><label for="description">Offer</label></p>
		<span class="help-text">What do you offer to perform this job?</span>
		<p><textarea name="offer" id="offer"><?=@$item->offer;?></textarea></p>
	</div>

	<div class="block" data-pane="SEO">
		<?
			$data["item"] = @$item;
			$this->load->view("backend/snippets/seo_social",$data);
		?>
	</div>

	<div class="block" data-pane="Videos">
		<?
			$this->jobs->job(@$item->id);
			$data["videos"] = $this->jobs->job_videos();
			$this->load->view("backend/snippets/videos_add",$data);
			unset($data);
		?>
	</div>

	<div class="block" data-pane="Locations">
		<p><label>Linked to location:</label></p>
		<ul class="checkbox-list">
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

	<div class="actions">
		<input type="submit" value="Save job"/>
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