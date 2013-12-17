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
				"Supported languages" 	=> "admin/lib/translate/languages_overview",
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
			),

			"languages_overview" => array(
				"view" => "backend/Translate/languages_overview"
			),

			"deactivate_language" => array(
				"view" => "",
				"redirect" => "admin/lib/translate/languages_overview",
				"fn" => array(
					"update" => "deactivate_language"
				)
			),

			"make_primary" => array(
				"view" => "",
				"redirect" => "admin/lib/translate/languages_overview",
				"fn" => array(
					"update" => "make_primary"
				)
			),

			"edit_translation" => array(
				"view" => "backend/Translate/edit_translation",
				"submit" => "edit_translation",
				"item"  => "key",
				"redirect" => "admin/lib/translate/translation_overview"
			),

			"add_language" => array(
				"view" => "backend/Translate/add_language",
				"submit" => "activate_language",
				"fn" => array(
					"languages" => "all_supported_languages"
				),
				"redirect" => "admin/lib/translate/languages_overview"
			)
		)

	);

?>