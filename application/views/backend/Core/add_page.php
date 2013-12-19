<?=form_open();?>

<div class="left">
	
	<div class="tabs">
		<ul class="links">
			<li class="active" data-pane="page">Add new page</li>
			<li data-pane="modules">Linked modules</li>
			<li data-pane="seo">Searchengine</li>
		</ul>

		<div class="panes">
			<div class="pane active" data-pane="page">
				<div class="form-inline">
					<p><label for="title">Page title</label> <input autocomplete="off" type="text" name="title" id="title"/></p>
					<p><label>Permalink</label> <?=site_url();?><span class="parents"></span><span class="permalink"></span></p>
				</div>
			</div>

			<div class="pane" data-pane="seo">
					<?
						$data["item"] = @$item;
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
			<label for="main_nav">Place in main navigation?</label>
			<select name="main_nav" id="main_nav">
				<option value="0">No</option>
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
				<option value="1" data-parent="diensten">Diensten</option>
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
		$(".permalink").html($(this).val().toLowerCase().split(' ').join('-'));
	});

	$("#parent").bind("change",function(){
		$(".parents").html($("#parent option:selected").attr("data-parent")+"/");
	});
});

</script>