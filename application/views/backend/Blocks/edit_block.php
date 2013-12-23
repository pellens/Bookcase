<div class="left">

	<div class="tabs">
		<ul class="links">
			<li class="active" data-pane="edit">Edit block</li>
		</ul>
		<div class="panes">
			<div class="pane active" data-pane="edit">
			
				<? foreach($item as $block):?>
				<div class="item">
					<p><strong><?=$block->title;?> (<?=$block->lang;?>)</strong></p>
					<textarea name="content"><?=$block->content;?></textarea>
				</div>
				<? endforeach;?>

			</div>
		</div>
	</div>

</div>

<div class="right">

</div>