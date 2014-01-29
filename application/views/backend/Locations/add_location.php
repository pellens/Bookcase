<div class="full">
	
	<?=form_open();?>

	<h2><?=$title;?></h2>

	<ul class="tabs"></ul>

	<div class="block" data-pane="Location">

		<p><label for="adres">Adres</label><input type="text" name="adres" id="adres" class="required" value="<?=@$item->adres;?>"/>
			<span class="status">
				<? if(isset($item->adres)):?>
				<i class="fa fa-check-circle-o"></i>
				<? else: ?>
				<i class="fa fa-circle-o"></i>
				<? endif;?>
			</span></p>
			
			

			<p><label for="title">Title:</label><input type="text" class="required" name="title" id="title" value="<?=@$item->title;?>"/></p>

			<!-- IF WE EDIT AN ITEM, ADD THE ID -->
			<? if(isset($item)):?>
			<input type="hidden" name="id" value="<?=$item->id;?>"/>
			<? endif;?>
			<input type="hidden" name="address" id="address" value="<?=@$item->adres;?>"/>
		
			<!-- GOOGLE DATA -->
			<input type="hidden" class="" id="route" name="street" value="<?=@$item->street;?>"/>
			<input type="hidden" class="" id="street_number" name="number" value="<?=@$item->number;?>"/>
			<input type="hidden" class="" id="postal_code" name="postcode"/>
			<input type="hidden" class="" id="locality" name="city" value="<?=@$item->city;?>"/>
			<input type="hidden" class="" id="administrative_area_level_1" name="area_level_1"/>
			<input type="hidden" class="" id="administrative_area_level_2" name="area_level_2"/>
			<input type="hidden" class="" id="country" name="land" value="<?=@$item->country;?>"/>
			<input type="hidden" id="lat" name="lat" value="<?=@$item->lat;?>"/>
			<input type="hidden" id="lng" name="lng" value="<?=@$item->lng;?>"/>
			
			<p><label for="tel">Tel:</label><input type="text" class="required" name="tel" id="tel" value="<?=@$item->tel;?>"/></p>
			<p><label for="fax">Fax:</label><input type="text" name="fax" id="fax" value="<?=@$item->fax;?>"/></p>
			<p><label for="email">Email:</label><input type="email" class="required" name="email" id="email" value="<?=@$item->email;?>"/></p>
			<p><label for="website">Website:</label><input type="text" name="website" id="website" value="<?=@$item->website;?>"/></p>
			<p><label for="btw">BTW:</label><input type="text" name="btw" id="btw" value="<?=@$item->btw;?>"/></p>
	</div>

	<div class="block" data-pane="Details">
		<p>
				<label for="type">Locationtype</label>
				<select name="locationtype" class="required">
					<? foreach($this->locations->types_overview() as $type):?>
					<option value="<?=$type->id;?>" <?=( isset($item->type) && $item->type == $type->id) ? "selected='selected'" : "";?>>
						<?=$type->title;?>
					</option>
					<? endforeach;?>
				</select>
			</p>

			<p>
				<label for="type">Parent location</label>
				<select name="parent">
				<option>No parent location</option>
					<? foreach($this->locations->locations_overview() as $parent):?>
					<option value="<?=$parent->id;?>" <?=( isset($item->parent) && $item->parent == $parent->id) ? "selected='selected'" : "";?>>
						<?=$parent->title;?>
					</option>
					<? endforeach;?>
				</select>
			</p>	
	</div>

	<div class="block" data-pane="SEO">
		<?
			$data["item"] = @$item;
			$this->load->view("backend/snippets/seo_social",$data);
		?>
	</div>

	<div class="block" data-pane="Media">

		<? 
			//$this->media->resizeImage("seventies.png");

			$data["item"] = @$item;
			$this->load->view("backend/snippets/photos_upload",$data);
			unset($data);
		?>

	</div>

	<!-- ADD VIDEOS -->

	<div class="block" data-pane="Videos">
		<?
			$this->locations->location(@$item->id);
			$data["videos"] = $this->locations->location_videos();
			$this->load->view("backend/snippets/videos_add",$data);
		?>
	</div>

	<div class="actions">
		<input type="submit" value="Save location"/>
	</div>

</div>

<?=form_close();?>

<script>


$(document).ready(function(){
	initialize();
});

// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  administrative_area_level_2: 'long_name',
  country: 'short_name',
  postal_code: 'short_name'
};

function initialize() {
	var geocoder = new google.maps.Geocoder();
  	autocomplete = new google.maps.places.Autocomplete( (document.getElementById('adres')) , { types: ['geocode'] });
  	google.maps.event.addListener(autocomplete, 'place_changed', function() {
    	fillInAddress();
    	$("#address").val($("#adres").val());
  	});
  	google.maps.event.addDomListener(document.getElementById('adres'), 'keydown', function(e) { 
    if (e.keyCode == 13) 
    { 
            if (e.preventDefault) 
            { 
                    e.preventDefault(); 
            }
           }
       });
}

// The START and END in square brackets define a snippet for our documentation:
// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++)
  {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }

 $("#lat").val(place.geometry.location.lat());
 $("#lng").val(place.geometry.location.lng());

  $(".status").html("<i class='fa fa-check-circle-o'></i>");
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
          geolocation));
    });
  }
}
// [END region_geolocation]

    </script>