<div class="box">
		<h2>Pagina overzicht</h2>



		<div id="tree">
		  <ul id="treeData" style="display:none;">

		  	<? foreach($this->core->all_pages() as $page):?>
		  	<li><?=anchor("admin/page/edit/".$page->id,$page->page);?></li>
		 	<? endforeach;?>
		    
		    <!--
		    <li id="1">Node 1
		    <li id="2" class="folder">Folder 2
		      <ul>
		        <li id="3">Node 2.1
		        <li id="4">Node 2.2
		      </ul>
		     -->
		  </ul>
		</div>

		<div class="actions">
			<a href="<?=base_url("admin/page/add");?>" class="button blue">Pagina toevoegen</a>
		</div>

	</div>