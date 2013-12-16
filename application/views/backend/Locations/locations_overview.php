<div class="full">

	<div class="tabs">
		<ul class="links">
			<li class="active">Locations overview</li>
		</ul>
	</div>

	<div class="panes">

		<div class="pane">

			<div class="list locations">
				<? foreach($list as $loc):?>
				<div class="item">
					<a href="<?=base_url("admin/lib/locations/edit_location/".$loc->id);?>"><img src="http://maps.googleapis.com/maps/api/staticmap?center=40.718217,-73.998284&zoom=13&size=240x100&maptype=roadmap&markers=color:red%7Ccolor:red%7Clabel:3%7C40.718217,-73.998284&sensor=false"/></a>
					<?=anchor("admin/lib/locations/edit_location/".$loc->id,$loc->title);?>
					<p class="small"><?=$loc->adres;?></p>
				</div>
				<? endforeach;?>
			</div>
		</div>

	</div>
</div>