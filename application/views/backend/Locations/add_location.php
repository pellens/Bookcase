<div class="left">
	
		<div class="tabs">
			<ul class="links">
				<li class="active" data-pane="add">New location</li>
				<li data-pane="seo">Searchengine</li>
				<li data-pane="photos">Photos</li>
				<li data-pane="videos">Videos</li>
			</ul>
			<div class="panes">
				<div class="pane active" data-pane="add">
					<div class="form-inline">

						<p><label for="adres">Adres</label><input type="text" name="adres" id="adres" value="<?=@$item->adres;?>"/>
						<span class="status">
							<? if(isset($item->adres)):?>
							<i class="icon-check-sign"></i>
							<? else: ?>
							<i class="icon-check"></i>
							<? endif;?>
						</span></p>
						
						<?=form_open();?>
						
						<p><label for="title">Title:</label><input type="text" name="title" id="title" value="<?=@$item->title;?>"/></p>

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
						<input type="hidden" class="" id="country" name="land"/>
						<input type="hidden" id="lat" name="lat"/>
						<input type="hidden" id="lng" name="lng"/>
			
						<p><label for="tel">Tel:</label><input type="text" name="tel" id="tel" value="<?=@$item->tel;?>"/></p>
						<p><label for="fax">Fax:</label><input type="text" name="fax" id="fax" value="<?=@$item->fax;?>"/></p>
						<p><label for="email">Email:</label><input type="email" name="email" id="email" value="<?=@$item->email;?>"/></p>
						<p><label for="website">Website:</label><input type="text" name="website" id="website" value="<?=@$item->website;?>"/></p>
						<p><label for="btw">BTW:</label><input type="text" name="btw" id="btw" value="<?=@$item->btw;?>"/></p>
					</div>
				</div>
				<div class="pane" data-pane="seo">
					<?
						$data["item"] = @$item;
						$this->load->view("backend/snippets/seo_social",$data);
					?>
				</div>
				<!-- ADD VIDEOS -->

				<div class="pane" data-pane="videos">
					<?
						$this->products->product(@$item->id);
						$data["videos"] = $this->products->product_videos();
						$this->load->view("backend/snippets/videos_add",$data);
					?>
				</div>
			</div>
		</div>

	</div>
	
	<div class="right">
	
		<div class="box">
			<p>
				<label for="type">Locationtype</label>
				<select name="locationtype">
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
			<? if(isset($item)):?>
			<p class="buttons-half">
				<a data-alert="Are you sure you want to delete this location?" href="<?=base_url("admin/lib/locations/del_location/".$item->id);?>" class="action del"><i class="icon-trash"></i></a>
				<input type="submit" class="button green" value="Save changes"/>
				</p>
			<? else: ?>
				<p><input type="submit" class="button green" value="Add location"/></p>
			<? endif;?>
		</div>

	</div>

<?=form_close();?>

<script>

initialize();

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

  $(".status").html("<i class='icon-check-sign'></i>");
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