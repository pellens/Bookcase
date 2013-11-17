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
			"General" => array(
				"Website settings" => "admin/library/core/settings",
				"Libraries"        => "admin/library/core/libraries"
			),
			"Administrators" => array(
				"Create admin" => "admin/library/core/add_admin",
				"Administrators"  => "admin/library/core/admins",
				"Permissions" => "admin/library/core/permissions"
			)
		)

	);

?>