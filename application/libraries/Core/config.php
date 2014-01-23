<?

	$config = array(

		"title" 		=> "Core",
		"description" 	=> "Handles the core functionality of Bookcase.",
		"author" 		=> array(
			"name" 		=> "Gert Pellens",
			"url"  		=> "http://gerardo.be",
			"twitter"   => "@gpellens",
			"github"    => "pellens"
		),
		"version" => "0.1"

	);

	$nav = array(

		"title" => "General settings",
		"icon" => "fa-gear",
		"nav" => array(
			"General" => array(),
			"Settings" => array(
				"Website settings" => "admin/lib/core/website-settings"
			)
		)

	);

	$admin = array(

		"fn" => array(

			"website-settings" => array(
				"view"      => "backend/Core/website_settings",
				"submit"    => "update_general_settings",
				"redirect"  => "admin/lib/core/website-settings",
				"fn" => array(
					"settings" => "general_settings"
				),
				"active_link" => "settings"
			)

		)

	);

?>