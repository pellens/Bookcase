<div class="full">

	<h2>Product categories <?=anchor("admin/lib/products/add_category","New category","class='button light'");?></h2>

	<div class="block">

				<table class="table table-bordered">
					<thead>
					<tr>
					<th width="1%"><input type="checkbox"/></th>
					<th>Category title</th>
					<th>Number of products</th>
					<th>&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				<? foreach($list as $cat):?>
					<tr>
						<td width="1%"><input type="checkbox"/></td>
						<td><?=anchor("admin/lib/products/edit_category/".$cat->id,$cat->title);?></td>
						<td><?=count($this->products->category_products($cat->id));?></td>
						<td class='actions'>
							<?=anchor("admin/lib/products/del_category/".$cat->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this category?'");?>
						</td>
					</tr>
				<? endforeach;?>
				</tbody>
				</table>
				
	</div>
	<div class="block stats">

		<div>
			<ul>
				<li><i class="fa fa-shopping-cart"></i> <?=count($this->products->products_overview());?> products</li>
				<li><i class="fa fa-th-list"></i> <?=count($list);?> categories</li>
			</ul>
		</div>

	</div>

</div>