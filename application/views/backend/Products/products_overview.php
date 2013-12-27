<div class="left">

	<div class="tabs">

		<ul class="links">
			<li class="active" data-pane="contacts">Products overview</li>
		</ul>

		<div class="panes">
			<div class="pane active" data-pane="contacts">
				<table class="table table-bordered table-striped">
					<thead>
					<tr>
					<th>Product title</th>
					<th>Product category</th>
					<th>Product price</th>
					<th>&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				<? foreach($list as $prod):?>
					<tr>
						<td><?=$prod->title;?></td>
						<td><?=$prod->category_title;?></td>
						<td><?=$prod->price;?> &euro;</td>
						<td><?=anchor("admin/lib/products/edit_product/".$prod->id,"Edit");?></td>
					</tr>
				<? endforeach;?>
				</table>
				</tbody>
			</div>
		</div>

	</div>

</div>

<div class="right">

	<div class="box">
		<ul class="inbox-stats">
			<li><?=count($list);?> products</li>
		</ul>
	</div>

</div>