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
				"Add user" => "admin/settings/add_user",
				"Users overview" => "admin/settings/users",
				"User roles" => "admin/settings/user_roles",
				"Permissions" => "admin/settings/permissions"
			)
		)

	);

?>