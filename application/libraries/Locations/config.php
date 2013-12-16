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

		"title" => "Core settings",
		"nav" => array(
			"General" => array(
				"All locations"		=> "admin/lib/locations/overview",
				"Add location" 		=> "admin/lib/locations/add"
			),
			"Administrators" => array(
				"Locationtypes" 	=> "admin/lib/locations/types",
				"Add locationtype"  => "admin/lib/locations/add-type",
				"Permissions" 		=> "admin/lib/locations/permissions"
			)
		)

	);

	$admin = array(

		"fn" => array(

			"overview" => array(
				"view"      => "backend/Locations/overview",
				"fn" => array(
					"list" => "locations_overview"
				)
			),

			"add" => array(
				"view" 		=> "backend/Locations/add-location",
				"submit" 	=> "add_location",
				"redirect"  => "admin/lib/locations/overview"
			),

			"edit" => array(
				"view" 		=> "backend/Locations/add-location",
				"submit" 	=> "edit_location",
				"item"      => "item",
				"redirect"  => "admin/lib/locations/overview"
			),

			"types" => array(
				"view" 		=> "backend/Locations/types_overview",
				"fn" => array(
					"list" => "types_overview"
				)
			)

		)

	);

?>