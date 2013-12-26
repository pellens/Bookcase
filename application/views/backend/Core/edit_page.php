<?=form_open();?>

<div class="left">
	
	<div class="tabs">
		<ul class="links">
			<li class="active" data-pane="page">Edit page</li>
			<li data-pane="modules">Linked modules</li>
			<li data-pane="seo">Searchengine</li>
		</ul>

		<div class="panes">

			<div class="pane active" data-pane="page">

				<div class="form-inline">
					<p><label for="title">Page title</label> <input autocomplete="off" type="text" name="title" id="title" value="<?=$item->title;?>"/></p>
					<p><label>Permalink</label> <?=site_url(lang());?>/<span class="parents"></span><span class="permalink"></span></p>
					<input type="hidden" name="url" id="url"/>
				</div>


				<table class="table table-bordered table-striped">
					<tr>
						<th>Blockname</th>
						<th>Content preview</th>
						<th>&nbsp;</th>
					</tr>
					<? foreach($this->blocks->blocks_page($item->page) as $block):?>
					<tr>
						<td><?=$block->title;?></htd>
						<td><?=character_limiter(strip_tags($block->content),100);?></td>
						<td><?=anchor("admin/lib/blocks/edit_block/".$block->block_id,"Edit");?></td>
					</tr>
					<? endforeach;?>
				</table>

			</div>

			<div class="pane" data-pane="seo">
				<?
					$data["item"] = $item;
					$this->load->view("backend/snippets/seo_social",$data);
				?>
			</div>

			<div class="pane" data-pane="modules">
				<p>Hier moeten we bepaalde libraries kunnen linken om te autoloaden</p>
				<p>In library database ook autoloaded-flag aan toe voegen</p>
			</div>
		</div>
	</div>
</div>

<div class="right">
	<div class="box">
		<p>
			<label for="homepage">This is the homepage?</label>
			<select name="homepage" id="homepage">
				<option <?=($item->homepage == 0) ? "selected" : "";?> value="0">No</option>
				<option <?=($item->homepage == 1) ? "selected" : "";?> value="1">Yes</option>
			</select>
		</p>
		<p>
			<label for="main_nav">Navigation</label>
			<select name="main_nav" id="main_nav">
				<option value="0">No navigation</option>
				<option value="1">Yes</option>
			</select>
		</p>
		<p>
			<label for="visible">Make page visible?</label>
			<select name="visible" id="visible">
				<option value="0">No</option>
				<option value="1">Yes</option>
			</select>
		</p>
		<p>
			<label for="parent">Parent page</label>
			<select name="parent" id="parent">
				<option value="0">No parent page</option>
				<?
					foreach($this->core->all_pages() as $page):
						if($page->id != $item->id):
							$selected = ($item->parent == $page->page) ? "selected" : "";
				?>
				<option data-parent="<?=$page->page;?>" <?=$selected;?> value="<?=$page->url;?>"><?=$page->title." (".$page->page.")";?></option>
				<?
						endif;
					endforeach;
				?>
			</select>
		</p>
		<p>
			<label for="template">Template</label>
			<select name="template" id="template">
				<option value="0">Select template</option>
			</select>
		</p>
		<p>
			<input type="submit" value="Add page" class="button green"/>
		</p>
	</div>
</div>

<?=form_close();?>

<script>

$(document).ready(function(){

	$("#title").bind("keyup",function(){

		if($("#homepage").val() != 1)
		{
			$(".permalink").html($(this).val().toLowerCase().split(' ').join('-'));
			$("#url").val("<?=site_url(lang());?>/"+$(".permalink").html());
		}
	});

	$("#homepage").bind("change",function(){
		$(".permalink").html("");
		$("#url").val("<?=site_url(lang());?>/");
	});

	$("#parent").bind("change",function(){
		$(".parents").html($("#parent option:selected").val()+"/");
	});
});

</script>