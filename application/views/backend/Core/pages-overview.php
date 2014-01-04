<div class="full">

	<div class="tabs">
		<ul class="links">
			<li class="active" data-pane="pages">Pages overview</li>
		</ul>

		<div class="panes">
			<div class="pane active" data-pane="pages">

				<table class="table table-bordered table-striped">
					<thead>
					<tr>
						<th>Page title</th>
						<th>Page machine name</th>
						<th>Progress</th>
						<th>&nbsp;</th>
					</tr>
					</thead>
					<tbody>
					<? foreach($pages as $page):?>
					<tr>
						<td><?=$page["title"];?></td>
						<td><?=$page["page"];?></td>
						<td width="200">
							<div class="progress">
								<div class="bar" style="width:<?=$page["progress"];?>"></div>
							</div>
						</td>
						<td>
							<?=anchor($page["url"],"Visit");?>
							<?=anchor("admin/page/edit/".$page["id"],"Edit");?>
						</td>
					</tr>
					<? endforeach;?>
					</tbody>
				</table>

			</div>
		</div>
	
	</div>
	
</div>