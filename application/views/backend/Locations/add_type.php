<?=form_open();?>

<div class="left">

	<div class="tabs">
		<ul class="links">
			<li class="active" data-pane="types">Add type</li>
			<li data-pane="seo">Searchengines</li>
		</ul>
		<div class="panes">
			<div class="pane active" data-pane="types">
				<div class="form-inline">
					<!-- IF WE EDIT AN ITEM, ADD THE ID -->
					<? if(isset($item)):?>
					<input type="hidden" name="id" value="<?=$item->id;?>"/>
					<? endif;?>
					<p><label for="title">Type title</label> <input type="text" name="title" id="title" value="<?=@$item->title;?>"/></p>
				</div>
			</div>
			<div class="pane" data-pane="seo">
					<?
						$data["item"] = @$item;
						$this->load->view("backend/snippets/seo_social",$data);
					?>
				</div>
		</div>
	</div>

</div>

<div class="right">
	
	<div class="box">
		<p>
			<label for="type">Parent locationtype</label>
			<select name="locationtype">
				<option value="0">No parent locationtype</option>
				<? foreach($this->locations->types_overview() as $type):?>
				<option value="<?=$type->id;?>" <?=( isset($item->type) && $item->type == $type->id) ? "selected='selected'" : "";?>>
					<?=$type->title;?>
				</option>
				<? endforeach;?>
			</select>
		</p>

		<? if(isset($item) && $item->id !=2 && $item->id != 1):?>
			<p class="buttons-half">
			<a data-alert="Are you sure you want to delete this locationtype?" href="<?=base_url("admin/lib/locations/del_type/".$item->id);?>" class="action del"><i class="icon-trash"></i></a>
			<input type="submit" class="button green" value="Save changes"/>
			</p>
		<? else: ?>
			<p><input type="submit" class="button green" value="<?=(isset($item))? "Save locationtype" : "Add locationtype";?>"/></p>
		<? endif;?>
	</div>

</div>

<?=form_close();?>