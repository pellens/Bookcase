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
					<input type="hidden" name="id" value="<?=$item->id;?>"/>
					<p><label for="title">Page title</label> <input autocomplete="off" type="text" name="title" id="title" value="<?=$item->title;?>"/></p>
					<p>
						<label>Permalink</label>
						<?=site_url(lang());?>/<span class="parents"></span><span class="permalink"></span><span class="wildcard"></span>
						<a href="#" class="wildcard"><span>+</span> Add wildcard</a>
						<a href="#" class="remove_wildcard"><span>-</span> Remove wildcard</a>
					</p>
					<input type="text" name="url" value="" id="url"/>
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

				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>Module</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<? foreach($this->core->libraries(true) as $lib):?>
						<tr>
							<td><input type="checkbox"/></td>
							<td><?=$lib["title"];?></td>
							<td><?=$lib["description"];?></td>
						</tr>
						<? endforeach;?>
					</tbody>
				</table>

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
			<label for="navigation">Navigation</label>
			<select name="navigation" id="navigation">
				<option value="0">No navigation</option>
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
						if($page["id"] != $item->id):
							$selected = ($item->parent == $page["page"]) ? "selected" : "";
				?>
				<option data-parent="<?=$page["page"];?>" <?=$selected;?> value="<?=$page["url"];?>"><?=$page["title"]." (".$page["page"].")";?></option>
				<?
						endif;
					endforeach;
				?>
			</select>
		</p>
		<p>
			<label for="template">Template</label>
			<select name="template" id="template">
				<option value="">Select template</option>
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


	fillRoute();

	$("#title").bind("keyup",function(){

		if($("#homepage").val() != 1)
		{
			$(".permalink").html( $("#title").val().toLowerCase().split(' ').join('-') );
		}
		else
		{
			$(".permalink").html("");
			$(".parents").html("");
		}
		fillRoute();
	});

	$("#homepage, #parent").bind("change",function(){
		fillRoute();
	});

	$("a.wildcard").bind("click",function(){
		$("span.wildcard").append("<span>(:any)/</span>");
		fillRoute();
	});
	$("a.remove_wildcard").bind("click",function(){
		$("span.wildcard span:last").remove();
		fillRoute();
	});

});

function fillRoute()
{

	var parents;
	var route;
	var title;
	var wildcard;

	if($("#homepage").val() != 1)
	{
		var title = $("#title").val().toLowerCase().split(' ').join('-');
		$(".permalink").html(title);

		if($("#parent option:selected").val()!=0)
		{
			var parents = $("#parent option:selected").val()+"/";
			$(".parents").html(parents);
		}
		else
		{
			var parents = "";
		}
	
		var wildcard = "";
		$("span.wildcard span").each(function(){
			wildcard+="(:any)/";
		});
			
		var route = parents;
			route+= title;
			route+= wildcard;
	
	}
	else
	{
		route = "";
	}
	$("#url").val(route);
}
</script>