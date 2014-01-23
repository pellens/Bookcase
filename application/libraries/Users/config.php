<?

	$config = array(

		"title" 		=> "Users",
		"description" 	=> "Library for handling the basics of users: profile, roles, login, registration.",
		"author" 		=> array(
			"name" 		=> "Gert Pellens",
			"url"  		=> "http://gerardo.be",
			"twitter"   => "@gpellens",
			"github"    => "pellens"
		),
		"version" => "0.1"

	);

	$nav = array(

		"title" => "Users",
		"icon" => "fa-users",
		"nav" => array(
			"General" => array(),
			"Settings" => array(
				"Add user" => "admin/lib/users/add_user",
				"Users overview" => "admin/lib/users/users_overview",
				"User roles" => "admin/lib/users/user_roles",
				"Permissions" => "admin/lib/users/permissions"
			)
		)

	);

	$admin = array(

		"fn" => array(

			"users_overview" => array(
				"view"      => "backend/Users/users_overview",
				"fn" => array(
					"list" => "users_overview"
				),
				"active_link" => "settings"
			)

		)

	);

?>