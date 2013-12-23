<div class="full">

	<div class="tabs">
		<ul class="links">
			<li class="active" data-pane="types">All content</li>
		</ul>
		<div class="panes">
			<div class="pane active" data-pane="types">
				<table class="table table-bordered table-striped">
					<tr>
						<th>Language</th>
						<th>Title</th>
						<th>Content preview</th>
						<th>&nbsp;</th>
					</tr>
					<? foreach($list as $block):?>
					<tr>
						<td><?=$block->lang;?></td>
						<td><?=$block->title;?></htd>
						<td><?=character_limiter(strip_tags($block->content),100);?></td>
						<td><?=anchor("admin/lib/blocks/edit_block/".$block->block_id,"Edit");?></td>
					</tr>
					<? endforeach;?>
				</table>
			</div>
		</div>
	</div>

</div>