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
				"Image styles" => "admin/lib/media/image_styles"
			)
		)

	);

	$admin = array(

		"fn" => array(

			"photos_overview" => array(
				"view"      => "backend/Media/photos_overview",
				"fn" => array(
					"list" => "photos_overview"
				)
			),

			"image_styles" => array(
				"view"      => "backend/Media/image_styles",
				"fn" => array(
					"list" => "image_styles"
				)
			)


		)

	);

?>