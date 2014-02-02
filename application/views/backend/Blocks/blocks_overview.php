<div class="full">

	<h2>Textblocks</h2>

	<div class="block">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th><input type="checkbox"/></th>
					<th>Language</th>
					<th>Title</th>
					<th>Content preview</th>
				</tr>
			</thead>
			<tbody>
			<? foreach($list as $block):?>
			<tr>
				<td width="1%"><input type="checkbox"/></td>
				<td><?=$block->lang;?></td>
				<td><?=anchor("admin/lib/blocks/edit_block/".$block->block_id,$block->title);?></td>
				<td><?=character_limiter(strip_tags($block->content),60);?></td>
			</tr>
			<? endforeach;?>
			</tbody>
		</table>
	</div>

</div>