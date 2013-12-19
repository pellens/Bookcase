<?

	$config = array(

		"title" 		=> "Contactform",
		"description" 	=> "Build dynamic contactforms with a contacts management system.",
		"author" 		=> array(
			"name" 		=> "Gert Pellens",
			"url"  		=> "http://gerardo.be",
			"twitter"   => "@gpellens",
			"github"    => "pellens"
		),
		"version" => "0.1"

	);

	$nav = array(

		"title" => "Contactforms",
		"nav" => array(
			"General" => array(
				"Inbox" 		=> "admin/lib/contactform/messages_overview",
				"Contacts"		=> "admin/lib/contactform/contacts_overview",
				"Forms"         => "admin/lib/contactform/forms_overview"
				
			),
			"Administrators" => array(
				"Add form" 	=> "admin/lib/contactform/add_form"
			)
		)

	);

	$admin = array(

		"fn" => array(

			"messages_overview" => array(
				"view"      => "backend/Contactform/messages_overview",
				"fn" => array(
					"list" => "submitted_forms"
				)
			),

			"contacts_overview" => array(
				"view"      => "backend/Contactform/contacts_overview",
				"fn" => array(
					"list" => "_contactform_contacts"
				)
			),

			"forms_overview" => array(
				"view" => "backend/Contactform/forms_overview",
				"fn" => array(
					"list" => "all_forms"
				)
			)

			/*"edit_location" => array(
				"view" 		=> "backend/Locations/add_location",
				"submit" 	=> "edit_location",
				"item"      => "item",
				"redirect"  => "admin/lib/locations/locations_overview"
			),

			"del_location" => array(
				"view" => "",
				"redirect" => "admin/lib/locations/locations_overview",
				"fn" => array(
					"delete" => "del_location"
				)
			),

			"add_type" => array(
				"view" 		=> "backend/Locations/add_type",
				"submit" 	=> "add_type",
				"redirect" 	=> "admin/lib/locations/types_overview"
			),

			"edit_type" => array(
				"view" => "backend/Locations/add_type",
				"submit" => "edit_type",
				"item" => "type",
				"redirect" => "admin/lib/locations/types_overview"
			),

			"del_type" => array(
				"view" => "",
				"redirect" => "admin/lib/locations/types_overview",
				"fn" => array(
					"delete" => "del_type"
				)
			),

			"types_overview" => array(
				"view" 		=> "backend/Locations/types_overview",
				"fn" => array(
					"list" => "types_overview"
				)
			)*/

		)

	);

?>