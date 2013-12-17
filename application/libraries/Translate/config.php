<?

	$config = array(

		"title" 		=> "Translate",
		"description" 	=> "Handles translation and multilanguage support.",
		"author" 		=> array(
			"name" 		=> "Gert Pellens",
			"url"  		=> "http://gerardo.be",
			"twitter"   => "@gpellens",
			"github"    => "pellens"
		),
		"version" => "0.1"

	);

	$nav = array(

		"title" => "Translate",
		"nav" => array(
			"General" => array(
				"Translation overiew" => "admin/lib/translate/translation_overview"
			),
			"Administrators" => array(
				"Active languages" 	=> "admin/lib/translate/languages",
				"Add language" 		=> "admin/lib/translate/add_language",
				"Settings"  		=> "admin/lib/translate/settings",
				"Permissions" 		=> "admin/lib/translate/permissions"
			)
		)

	);

	$admin = array(

		"fn" => array(

			"translation_overview" => array(
				"view" => "backend/Translate/translation_overview",
				"fn" => array(
					"list" => "translation"
				)
			)
		)

	);

?>