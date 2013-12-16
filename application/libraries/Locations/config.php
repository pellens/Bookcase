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
				"Overview"  		=> "admin/lib/locations/overview",
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
				"main"      => "backend/Locations/overview",
				"fn" => array(
					"list" => "overview"
				)
			),

			"add" => array(
				"main" 		=> "backend/Locations/add-location",
				"submit" 	=> "add_location",
				"redirect"  => "admin/lib/locations/overview"
			),

			"edit" => array(
				"main" 		=> "backend/Locations/add-location",
				"submit" 	=> "edit_location",
				"item"      => "item",
				"redirect"  => "admin/lib/locations/overview"
			)

		)

	);

?>