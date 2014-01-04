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
					"list" => "submitted_forms",
					"stats" => "submission_stats"
				)
			),

			"contacts_overview" => array(
				"view"      => "backend/Contactform/contacts_overview",
				"fn" => array(
					"list" => "contacts_overview"
				)
			),

			"forms_overview" => array(
				"view" => "backend/Contactform/forms_overview",
				"fn" => array(
					"list" => "all_forms"
				)
			),

			"edit_form" => array(
				"view" 		=> "backend/Contactform/edit_form",
				"submit" 	=> "edit_form",
				"item"      => "item",
				"redirect"  => "admin/lib/contactform/forms_overview"
			),

			"delete_form" => array(
				"view" => "",
				"redirect" => "admin/lib/contactform/forms_overview",
				"fn" => array(
					"delete" => "delete_form"
				)
			),

			"ajax_delete_field" => array(
				"view" => "",
				"redirect" => false,
				"submit" => "ajax_delete_field",
				"fn" => array(
					"delete" => "ajax_delete_field"
				)
			),

			"ajax_add_field" => array(
				"view" => "",
				"redirect" => false,
				"submit" => "ajax_add_field",
				"fn" => array(
					"add" => "ajax_add_field"
				)
			),

			"ajax_add_receiver" => array(
				"view" => "",
				"redirect" => false,
				"submit" => "ajax_add_receiver",
				"fn" => array(
					"add" => "ajax_add_receiver"
				)
			),

			"ajax_delete_receiver" => array(
				"view" => "",
				"redirect" => false,
				"submit" => "ajax_delete_receiver",
				"fn" => array(
					"delete" => "ajax_delete_receiver"
				)
			),

			"ajax_field_order" => array(
				"view" => "",
				"redirect" => false,
				"submit" => "ajax_field_order",
				"fn" => array(
					"add" => "ajax_field_order"
				)
			)

		)

	);

?>