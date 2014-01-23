<?

	$config = array(

		"title" 		=> "Media",
		"description" 	=> "Handles media like photos, videos and documents.",
		"author" 		=> array(
			"name" 		=> "Gert Pellens",
			"url"  		=> "http://gerardo.be",
			"twitter"   => "@gpellens",
			"github"    => "pellens"
		),
		"version" => "0.1"

	);

	$nav = array(

		"title" => "Media",
		"icon"  => "fa-picture-o",
		"nav" => array(
			"General" => array(
				"Photos"		=> "admin/lib/media/photos_overview"
			),
			"Administrators" => array(),
			"Settings" => array(
				"Image styles"    => "admin/lib/media/image_styles",
				"Add image style" => "admin/lib/media/add_style"
			)
		)

	);

	$admin = array(

		"fn" => array(

			"photos_overview" => array(
				"desc"      => "Get a list of all photos.",
				"view"      => "backend/Media/photos_overview",
				"fn" => array(
					"list" => "photos_overview"
				),
				"active_link" => "settings"
			),

			"image_styles" => array(
				"desc"      => "Get a list of all image styles.",
				"view"      => "backend/Media/image_styles",
				"fn" => array(
					"list" => "image_styles"
				),
				"active_link" => "settings"
			),

			"add_style" => array(
				"desc"      => "Add a new image style.",
				"view" 		=> "backend/Media/add_style",
				"submit" 	=> "add_style",
				"redirect"  => "admin/lib/media/image_styles",
				"active_link" => "settings"
			),

			"del_style" => array(
				"desc"      => "Delete an image style.",
				"view" => "",
				"redirect" => "admin/lib/media/image_styles",
				"fn" => array(
					"delete" => "del_style"
				),
				"active_link" => "settings"
			),

			"edit_style" => array(
				"desc"      => "Edit an image style.",
				"view" 		=> "backend/Media/add_style",
				"submit" 	=> "edit_style",
				"item"      => "image_style",
				"redirect"  => "admin/lib/media/image_styles",
				"active_link" => "settings"
			)


		)

	);

?>