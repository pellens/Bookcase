<div class="full">

	<div class="tabs">
		<ul class="links">
			<li class="active">Locations overview</li>
		</ul>
	</div>

	<div class="panes">

		<div class="pane">

			<ul class="list locations">
				<? foreach($list as $loc):?>
				<li class="item" id="item-<?=$loc->id;?>">
					<a href="<?=base_url("admin/lib/locations/edit_location/".$loc->id);?>">
						<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?=urlencode($loc->adres);?>&zoom=10&size=240x100&maptype=roadmap&markers=color:red%7Ccolor:red%7C<?=urlencode($loc->adres);?>&sensor=false"/>
					</a>
					<?=anchor("admin/lib/locations/edit_location/".$loc->id,$loc->title);?>
					<p class="small"><?=$loc->adres;?></p>
				</li>
				<? endforeach;?>
			</ul>
		</div>

	</div>
</div>

<script>

$(document).ready(function(){

	$("ul.list.locations").sortable({
			opacity: 0.6,
			cursor: 'move',
			connectWith: "ul.list.locations",
			update: function() {
			var order = $(this).sortable("serialize"); 
			$.post("<?=base_url(lang().'/admin/lib/locations/ajax_locations_order');?>", order, function(data){
				console.log(data);
			}); 															 
		}								  
	});

});
</script>