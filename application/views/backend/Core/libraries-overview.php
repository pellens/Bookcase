<div class="full">
<h1>Libraries</h1>

				<table class="table table-bordered table-striped">
				<tr>
					<th>Library</th>
					<th>Description</th>
					<th>Version</th>
				</tr>
				<? foreach( $modules as $library):?>

					<tr>
						<td class="title"><?=$library["title"];?></td>

						<? if(isset($library["error"])):?>
						<td class="error" colspan="2"><?=$library["error"];?></td>
						<? else: ?>
							<td class="description"><?=$library["description"];?></td>
							<td class="version"><?=$library["version"];?></td>
						<? endif;?>
					</tr>

				<? endforeach;?>
				</table>

</div>