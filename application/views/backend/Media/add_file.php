<div class="full">

	<?=form_open()?>

	<h2>Add new file</h2>


		<div class="block">

			<? 
				//$this->media->resizeImage("seventies.png");
	
				$data["item"] = @$item;
				$this->load->view("backend/snippets/photos_upload",$data);
				unset($data);
			?>
	
		</div>
	
		<div class="actions">
			<input type="submit" value="Save file"/>
		</div>

	<?=form_close();?>

</div>