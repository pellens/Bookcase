<div class="left">

	<div class="tabs">

		<ul class="links">
			<li class="active" data-pane="contacts">Categories overview</li>
		</ul>

		<div class="panes">
			<div class="pane active" data-pane="contacts">
				<table class="table table-bordered table-striped">
					<thead>
					<tr>
					<th>Category title</th>
					<th>Number of products</th>
					<th>&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				<? foreach($list as $cat):?>
					<tr>
						<td><?=$cat->title;?></td>
						<td>x</td>
						<td>
							<?=anchor("admin/lib/products/edit_category/".$cat->id,"Edit");?>
							<?=anchor("admin/lib/products/del_category/".$cat->id,"Delete","class='del' data-alert='Are you sure you want to delete this category?'");?>
						</td>
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