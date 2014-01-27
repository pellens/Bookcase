<div class="full">

	<?=form_open()?>

	<h2>Add new album</h2>

		<ul class="tabs"></ul>

		<div class="block" data-pane="Album">
			
			<input type="hidden" value="<?=@$item->id;?>" name="id"/>
			<p>
				<label>Album title</label>
				<input type="text" name="title" value="<?=@$item->title;?>"/>
			</p>
	
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
				$this->media->album(@$item->id);
				$data["videos"] = $this->media->album_videos();
				$this->load->view("backend/snippets/videos_add",$data);
				unset($data);
			?>
		</div>
	
		<div class="actions">
			<input type="submit" value="Save album"/>
		</div>

	<?=form_close();?>

</div>