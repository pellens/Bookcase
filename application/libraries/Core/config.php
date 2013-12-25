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

		"title" => "Core settings",
		"nav" => array(
			"Settings" => array(
				"Website settings" => "admin/settings/website_settings",
				"Modules"        => "admin/settings/libraries"
			),
			"Administrators" => array(
				"New user" => "admin/settings/add_user",
				"Permissions" => "admin/settings/permissions"
			)
		)

	);

?>