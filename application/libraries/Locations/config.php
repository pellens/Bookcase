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
				"Locations"		=> "admin/lib/locations/locations_overview",
				"New location" 		=> "admin/lib/locations/add_location",
				"Location types" 	=> "admin/lib/locations/types_overview",
				"New location type"  => "admin/lib/locations/add_type"
			)
		)

	);

	$admin = array(

		"fn" => array(

			"locations_overview" => array(
				"title"     => "Locations",
				"desc"      => "Get a list of all locations.",
				"view"      => "backend/Locations/locations_overview",
				"fn" => array(
					"list" => "locations_overview"
				),
				"active_link" => "modules"
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
				"title"     => "New location",
				"desc"      => "Add a new location.",
				"view" 		=> "backend/Locations/add_location",
				"submit" 	=> "add_location",
				"redirect"  => "admin/lib/locations/locations_overview",
				"active_link" => "modules"
			),

			"edit_location" => array(
				"title"     => "Edit location",
				"desc"      => "Edit a location.",
				"view" 		=> "backend/Locations/add_location",
				"submit" 	=> "edit_location",
				"item"      => "location",
				"redirect"  => "admin/lib/locations/locations_overview",
				"active_link" => "modules"
			),

			"del_location" => array(
				"desc"      => "Delete a location.",
				"view" => "",
				"redirect" => "admin/lib/locations/locations_overview",
				"fn" => array(
					"delete" => "del_location"
				),
				"active_link" => "modules"
			),

			"add_type" => array(
				"title"     => "New location type",
				"desc"      => "Add a location type.",
				"view" 		=> "backend/Locations/add_type",
				"submit" 	=> "add_type",
				"redirect" 	=> "admin/lib/locations/types_overview",
				"active_link" => "modules"
			),

			"edit_type" => array(
				"title"     => "Edit location type",
				"desc"      => "Edit a location type.",
				"view" => "backend/Locations/add_type",
				"submit" => "edit_type",
				"item" => "type",
				"redirect" => "admin/lib/locations/types_overview",
				"active_link" => "modules"
			),

			"del_type" => array(
				"desc"      => "Delete a location type.",
				"view" => "",
				"redirect" => "admin/lib/locations/types_overview",
				"fn" => array(
					"delete" => "del_type"
				),
				"active_link" => "modules"
			),

			"types_overview" => array(
				"title"     => "Location types",
				"desc"      => "Get a list of all location types.",
				"view" 		=> "backend/Locations/types_overview",
				"fn" => array(
					"list" => "types_overview"
				),
				"active_link" => "modules"
			)

		)

	);

?>