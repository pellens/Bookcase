<div class="full">

	<h2>Website pages</h2>

	<div class="block">

				<table class="table table-bordered">
					<thead>
					<tr>
						<th width="1%">&nbsp;</th>
						<th>Page title</th>
						<th>Machine name</th>
						<th>Progress</th>
					</tr>
					</thead>
					<tbody>
						<? if($pages):?>
							<? foreach($pages as $page):?>
							<tr>
								<td>
									<? if($page["visible"] == 0):?><i class="fa fa-eye-slash"></i><? endif;?>
									<? if($page["homepage"] == 1):?><i class="fa fa-home"></i><? endif;?>
								</td>
								<td><?=anchor("admin/page/edit/".$page["id"],$page["title"]);?></td>
								<td><?=$page["page"];?></td>
								<td width="250">
									<div class="progress">
										<div class="bar" style="width:<?=$page["progress"];?>"></div>
									</div>
								</td>
							</tr>
							<? endforeach;?>
						<? else:?>
							<tr><td colspan="4">There are currently no pages listed...</td></tr>
						<? endif;?>
					</tbody>
				</table>

			</div>
		</div>
	
	</div>
	
</div>