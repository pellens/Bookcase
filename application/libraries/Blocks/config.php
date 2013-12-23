<?

	$config = array(

		"title" 		=> "Blocks",
		"description" 	=> "Handles the content on pages.",
		"author" 		=> array(
			"name" 		=> "Gert Pellens",
			"url"  		=> "http://gerardo.be",
			"twitter"   => "@gpellens",
			"github"    => "pellens"
		),
		"version" => "0.1"

	);

	$nav = array(

		"title" => "Blocks",
		"nav" => array(
			"General" => array(
				"All content"		=> "admin/lib/blocks/blocks_overview"
			),
			"Administrators" => array()
		)

	);

	$admin = array(

		"fn" => array(

			"blocks_overview" => array(
				"view"      => "backend/Blocks/blocks_overview",
				"fn" => array(
					"list" => "blocks_overview"
				)
			),

			"edit_block" => array(
				"view" 		=> "backend/Blocks/edit_block",
				"submit" 	=> "edit_block",
				"item"      => "item",
				"redirect"  => "admin/lib/blocks/blocks_overview"
			)

		)

	);

?>