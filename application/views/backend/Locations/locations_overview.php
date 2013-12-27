<div class="full">

	<div class="tabs">
		<ul class="links">
			<li class="active">Locations overview</li>
		</ul>
	</div>

	<div class="panes">

		<div class="pane">

			<table class="table table-bordered table-striped locations">
				<thead>
				<tr>
					<th>Map</th>
					<th>Location</th>
					<th>Address</th>
				</tr>
				</thead>
				<tbody>
				<? foreach($list as $loc):?>
				<tr class="item" id="item-<?=$loc->id;?>">
					<td width="100">
						<a href="<?=base_url("admin/lib/locations/edit_location/".$loc->id);?>">
							<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?=urlencode($loc->adres);?>&zoom=12&size=100x60&maptype=roadmap&sensor=false"/>
						</a>
					</td>
					<td><?=anchor("admin/lib/locations/edit_location/".$loc->id,$loc->title);?></td>
					<td><p class="small"><?=$loc->adres;?></p></td>
				</tr>
				<? endforeach;?>
				</tbody>
			</table>
		</div>

	</div>
</div>

<script>

$(document).ready(function(){

	$(".table.locations tbody").sortable({
			opacity: 0.6,
			cursor: 'move',
			connectWith: ".table.locations tbody",
			update: function() {
			var order = $(this).sortable("serialize"); 
			$.post("<?=base_url(lang().'/admin/lib/locations/ajax_locations_order');?>", order, function(data){
				console.log(data);
			}); 															 
		}								  
	});

});
</script>