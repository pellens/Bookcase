<?

	$config = array(

		"title" 		=> "Locality",
		"description" 	=> "Handles countries and locations.",
		"author" 		=> array(
			"name" 		=> "Gert Pellens",
			"url"  		=> "http://gerardo.be",
			"twitter"   => "@gpellens",
			"github"    => "pellens"
		),
		"version" => "0.1"

	);

	$nav = array(

		"title" => "Locality",
		"nav" => array(
			"Locations" => array(
				"Add a location" => "admin/library/locality/add_location",
				"All locations"  => "admin/library/locality/locations"
			),
			"Global" => array(
				"Countries" => "admin/library/locality/countries",
				"Settings"  => "admin/library/locality/settings"
			)
		)

	);

?>