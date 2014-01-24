

<div class="full">

	<?=form_open();?>

	<h2>New location type</h2>

	<div class="block">

		<!-- IF WE EDIT AN ITEM, ADD THE ID -->
		<input type="hidden" name="id" value="<?=@$item->id;?>"/>

		<p><label for="title">Type title</label> <input type="text" name="title" id="title" value="<?=@$item->title;?>"/></p>
		<p>
			<label for="type">Parent locationtype</label>
			<select name="parent">
				<option value="0">No parent locationtype</option>
				<? foreach($this->locations->types_overview() as $type):?>
				<option value="<?=$type->id;?>" <?=( @$item->parent == $type->id) ? "selected='selected'" : "";?>>
					<?=$type->title;?>
				</option>
				<? endforeach;?>
			</select>
		</p>
	</div>

	<h3>SEO &amp; Social media</h3>
	<div class="block">
		<?
			$data["item"] = @$item;
			$this->load->view("backend/snippets/seo_social",$data);
		?>
	</div>

	<div class="actions">
		<input type="submit" value="Save locationtype"/>
	</div>

	<?=form_close();?>

</div>