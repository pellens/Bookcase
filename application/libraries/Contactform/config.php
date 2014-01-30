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

		"title" => "Inbox &amp; Contacts",
		"icon"  => "fa-inbox",
		"nav" => array(
			"General" => array(
				"Inbox" 		=> "admin/lib/contactform/messages_overview",
				"Contacts"		=> "admin/lib/contactform/contacts_overview"
				
			),
			"Settings" => array(
				"Forms"         => "admin/lib/contactform/forms_overview"
			)
		)

	);

	$admin = array(

		"fn" => array(

			"messages_overview" => array(
				"desc"      => "Get a list of all submitted messages.",
				"view"      => "backend/Contactform/messages_overview",
				"fn" => array(
					"list" => "submitted_forms",
					"stats" => "submission_stats"
				),
				"active_link" => "modules"
			),

			"submission" => array(
				"title" => "Message",
				"desc" => "View a submitted message.",
				"view" => "backend/contactform/message",
				"item" => "submission",
				"active_link" => "modules"
			),

			"contact" => array(
				"title" => "Contactperson",
				"desc" => "View contact details.",
				"view" => "backend/Contactform/contact",
				"submit" => "edit_submitter",
				"item" => "submitter",
				"redirect" => "admin/lib/contactform/contacts_overview",
				"active_link" => "modules"
			),

			"contacts_overview" => array(
				"desc"      => "Get a list of all submitters (contacts).",
				"view"      => "backend/Contactform/contacts_overview",
				"fn" => array(
					"list" => "contacts_overview"
				),
				"active_link" => "modules"
			),

			"forms_overview" => array(
				"desc"      => "Get a list of all forms.",
				"view" => "backend/Contactform/forms_overview",
				"fn" => array(
					"list" => "all_forms"
				),
				"active_link" => "settings"
			),

			"edit_form" => array(
				"desc"      => "Edit a contactform.",
				"view" 		=> "backend/Contactform/edit_form",
				"submit" 	=> "edit_form",
				"item"      => "item",
				"redirect"  => "admin/lib/contactform/forms_overview",
				"active_link" => "settings"
			),

			"delete_form" => array(
				"desc"      => "Delete a contactform.",
				"view" => "",
				"redirect" => "admin/lib/contactform/forms_overview",
				"fn" => array(
					"delete" => "delete_form"
				),
				"active_link" => "settings"
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