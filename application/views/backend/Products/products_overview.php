<div class="full">

	<h2>Products overview</h2>

	<div class="block">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th><input type="checkbox"/></th>
					<th>Product</th>
					<th>Category</th>
					<th>Price</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			<? foreach($list as $prod):?>
				<tr>
					<td width="1%"><input type="checkbox"/></td>
					<td><?=anchor("admin/lib/products/edit_product/".$prod->id,$prod->title);?></td>
					<td><?=$prod->category_title;?></td>
					<td><?=$prod->price;?> &euro;</td>
					<td class="actions">
						<?=anchor("admin/lib/products/del_product/".$prod->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this product?'");?>
					</td>
				</tr>
			<? endforeach;?>
			</tbody>
		</table>

	</div>

	<div class="block">

		<div class="stats">
			<ul>
				<li><?=count($list);?> products</li>
				<li><?=count($this->products->categories_overview());?> products</li>
			</ul>
		</div>

	</div>

</div>