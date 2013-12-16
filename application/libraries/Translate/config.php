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
				"Overiew" => "admin/lib/translate/"
			),
			"Administrators" => array(
				"Active languages" 	=> "admin/lib/translate/languages",
				"Add language" 		=> "admin/lib/translate/add-language",
				"Settings"  		=> "admin/lib/translate/settings",
				"Permissions" 		=> "admin/lib/translate/permissions"
			)
		)

	);

?>