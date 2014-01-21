<?

	$config = array(

		"title" 		=> "Locations",
		"description" 	=> "Handles all locations based on an address.",
		"author" 		=> array(
			"name" 		=> "Gert Pellens",
			"url"  		=> "http://gerardo.be",
			"twitter"   => "@gpellens",
			"github"    => "pellens"
		),
		"version" => "0.1"

	);

	$nav = array(

		"title" => "Locations",
		"icon"  => "fa-map-marker",
		"nav" => array(
			"General" => array(
				"All locations"		=> "admin/lib/locations/locations_overview",
				"Add location" 		=> "admin/lib/locations/add_location"
			),
			"Administrators" => array(
				"Locationtypes" 	=> "admin/lib/locations/types_overview",
				"Add locationtype"  => "admin/lib/locations/add_type"
			)
		)

	);

	$admin = array(

		"fn" => array(

			"locations_overview" => array(
				"view"      => "backend/Locations/locations_overview",
				"fn" => array(
					"list" => "locations_overview"
				)
			),

			"ajax_locations_order" => array(
				"view" => "",
				"redirect" => false,
				"submit" => "ajax_locations_order",
				"fn" => array(
					"add" => "ajax_locations_order"
				)
			),

			"add_location" => array(
				"view" 		=> "backend/Locations/add_location",
				"submit" 	=> "add_location",
				"redirect"  => "admin/lib/locations/locations_overview"
			),

			"edit_location" => array(
				"view" 		=> "backend/Locations/add_location",
				"submit" 	=> "edit_location",
				"item"      => "item",
				"redirect"  => "admin/lib/locations/locations_overview"
			),

			"del_location" => array(
				"view" => "",
				"redirect" => "admin/lib/locations/locations_overview",
				"fn" => array(
					"delete" => "del_location"
				)
			),

			"add_type" => array(
				"view" 		=> "backend/Locations/add_type",
				"submit" 	=> "add_type",
				"redirect" 	=> "admin/lib/locations/types_overview"
			),

			"edit_type" => array(
				"view" => "backend/Locations/add_type",
				"submit" => "edit_type",
				"item" => "type",
				"redirect" => "admin/lib/locations/types_overview"
			),

			"del_type" => array(
				"view" => "",
				"redirect" => "admin/lib/locations/types_overview",
				"fn" => array(
					"delete" => "del_type"
				)
			),

			"types_overview" => array(
				"view" 		=> "backend/Locations/types_overview",
				"fn" => array(
					"list" => "types_overview"
				)
			)

		)

	);

?>