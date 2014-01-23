<div class="full">

	<form method="post">

	<h2>Image style</h2>

		<div class="block">
		
		<input type="hidden" value="<?=@$item->id;?>" name="id"/>

		<p>
			<label>Image style title</label>
			<input type="text" name="title" value="<?=@$item->title;?>"/>
		</p>
		<p>
			<label>Image style width</label>
			<input type="text" name="width" value="<?=@$item->width;?>"/> px
		</p>
		<p>
			<label>Image style height</label>
			<input type="text" name="height" value="<?=@$item->height;?>"/> px
		</p>

	</div>

	<div class="actions">
		<input type="submit" value="Save image style"/>
	</div>

</div>