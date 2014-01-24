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
				"Add role" => "admin/lib/users/add_role",
				"User roles" => "admin/lib/users/user_roles",
				"Permissions" => "admin/lib/users/permissions"
			)
		)

	);

	$admin = array(

		"fn" => array(

			"users_overview" => array(
				"desc"      => "Get a list of all users within this CMS.",
				"view"      => "backend/Users/users_overview",
				"fn" => array(
					"list" => "users_overview"
				),
				"active_link" => "settings"
			),

			"permissions" => array(
				"desc"      => "Change permissions for specific user roles.",
				"view"      => "backend/Users/permissions",
				"submit"    => "edit_permissions",
				"redirect"  => "admin/lib/users/permissions",
				"fn" => array(
					"permissions" => "permissions",
					"roles" => "roles_overview"
				),
				"active_link" => "settings"
			),

			"user_roles" => array(
				"desc"      => "Get a list of all roles.",
				"view"      => "backend/Users/roles_overview",
				"fn" => array(
					"list" => "roles_overview"
				),
				"active_link" => "settings"
			),

			"add_user" => array(
				"desc"      => "Add a new user.",
				"view" 		  => "backend/Users/add_user",
				"submit" 	  => "add_user",
				"fn" => array(
					"roles" => "roles_overview"
				),
				"redirect"    => "admin/lib/users/users_overview",
				"active_link" => "settings"
			),

			"add_role" => array(
				"desc"      => "Add a new user role.",
				"view" 		  => "backend/Users/add_role",
				"submit" 	  => "add_role",
				"redirect"    => "admin/lib/users/permissions",
				"active_link" => "settings"
			),

			"del_user" => array(
				"desc"      => "Delete a user.",
				"view"     => "",
				"redirect" => "admin/lib/users/users_overview",
				"fn"       => array(
					"delete" => "del_user"
				),
				"active_link" => "settings"
			),

			"edit_user" => array(
				"desc"      => "Edit a user.",
				"view" 		=> "backend/Users/add_user",
				"submit" 	=> "edit_user",
				"fn" => array(
					"roles" => "roles_overview"
				),
				"item"      => "user",
				"redirect"  => "admin/lib/users/users_overview",
				"active_link" => "settings"
			)

		)

	);

?>