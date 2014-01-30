<div class="full">

	<h2>Locations <?=anchor("admin/lib/locations/add_location","New location","class='button light'");?></h2>

	<div class="block">
		<table class="table table-bordered locations">
			<thead>
			<tr>
				<th width="1%"><input type="checkbox"//th>
				<th>Location</th>
				<th>Type</th>
				<th>Address</th>
				<th width="1%"></th>
			</tr>
			</thead>
			<tbody>
			<? foreach($list as $loc):?>
			<tr class="item" style="cursor:move;" id="item-<?=$loc->id;?>">
				<td><input type="checkbox"/></td>
				<td><?=anchor("admin/lib/locations/edit_location/".$loc->id,$loc->title);?></td>
				<td><? $type = $this->locations->type($loc->type); echo $type->title;?></td>
				<td><?=$loc->adres;?></td>
				<td class="actions"><?=anchor("admin/lib/locations/del_location/".$loc->id,"<i class='fa fa-times'></i>","class='del' data-alert='Are you sure you want to delete this location?'");?></td>
			</tr>

			<? $countries[] = $loc->country;?>
			<? endforeach;?>
			</tbody>
		</table>
	
	</div>

	<div class="block map">
		<div id="map"></div>
	</div>

	<div class="block stats">
		<ul>
			<? $countries=array_unique($countries);?>
			<li><i class="fa fa-home"></i> <?=count($list);?> location(s)</li>
			<li><i class="fa fa-globe"></i> <?=count($countries);?> countrie(s)</li>
		</ul>
	</div>

</div>

<script src="https://maps.googleapis.com/maps/api/js?key=&amp;sensor=false&amp;extension=.js"></script>
<script>

$(document).ready(function(){


var map;
var styles      = [{ 'featureType': 'water', 'stylers': [{ 'visibility': 'on' },{ 'color': '#afcfef' } ]  },{ 'featureType': 'road.highway', 'elementType': 'geometry', 'stylers': [{ 'color': '#c5c6c6' } ]  },{ 'featureType': 'road.arterial', 'elementType': 'geometry', 'stylers': [{ 'color': '#e4d7c6' } ]  },{ 'featureType': 'road.local', 'elementType': 'geometry', 'stylers': [{ 'color': '#fbfaf7' } ]  },{ 'featureType': 'poi.park', 'elementType': 'geometry', 'stylers': [{ 'color': '#c5dac6' } ]  },{ 'featureType': 'administrative', 'stylers': [{ 'visibility': 'on' },{ 'lightness': 33 } ]  },{ 'featureType': 'road'  },{ 'featureType': 'poi.park', 'elementType': 'labels', 'stylers': [{ 'visibility': 'on' },{ 'lightness': 100 } ]  },{  },{ 'featureType': 'road', 'stylers': [{ 'lightness': 20 } ]  }];
var mapOptions  = {
    zoomControl             : true,
    zoomControlOptions      : { style: google.maps.ZoomControlStyle.SMALL },
    disableDoubleClickZoom  : true,
    mapTypeControl          : false,
    scaleControl            : false,
    scrollwheel             : false,
    streetViewControl       : true,
    draggable               : true,
    overviewMapControl      : false,
    mapTypeId               : google.maps.MapTypeId.ROADMAP,
    styles                  : styles
}

    var InfoWindow  = null;
    var locations   = new Array();

    var mapElement = document.getElementById('map');
    var map = new google.maps.Map(mapElement, mapOptions);


    var latlngbounds = new google.maps.LatLngBounds();
    
    <? foreach($list as $loc):?>

        var latlngmarker = new google.maps.LatLng(<?=$loc->lat;?>, <?=$loc->lng;?>);
        var marker = new google.maps.Marker({
            icon: '',
            position: latlngmarker,
            map: map
        });
        latlngbounds.extend(latlngmarker);

    <? endforeach;?>

    map.fitBounds(latlngbounds);



	$(".table.locations tbody").sortable({
			opacity: 0.6,
			cursor: 'move',
			axis:"y",
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