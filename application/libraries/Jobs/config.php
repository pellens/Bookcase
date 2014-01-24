<?

	$config = array(

		"title" 		=> "Jobs",
		"description" 	=> "Simple jobs-database",
		"author" 		=> array(
			"name" 		=> "Gert Pellens",
			"url"  		=> "http://gerardo.be",
			"twitter"   => "@gpellens",
			"github"    => "pellens"
		),
		"version" => "0.1"

	);

	$nav = array(

		"title" => "Jobs",
		"icon"  => "fa-bullhorn",
		"nav" => array(
			"General" => array(
				"All jobs" 	 => "admin/lib/jobs/jobs_overview",
				"Add job" => "admin/lib/jobs/add_job"
				
			)
		)

	);

	$admin = array(

		"fn" => array(

			"jobs_overview" => array(
				"desc"      => "Get a list of all jobs.",
				"view"      => "backend/Jobs/jobs_overview",
				"fn" => array(
					"list" => "jobs_overview"
				),
				"active_link" => "modules"
			),

			"add_job" => array(
				"desc"      => "Add a new job opening.",
				"view" 		=> "backend/Jobs/add_job",
				"submit" 	=> "add_job",
				"redirect"  => "admin/lib/jobs/jobs_overview",
				"active_link" => "modules"
			),

			"del_job" => array(
				"desc"      => "Delete a job.",
				"view" => "",
				"redirect" => "admin/lib/jobs/jobs_overview",
				"fn" => array(
					"delete" => "del_job"
				),
				"active_link" => "modules"
			),

			"edit_job" => array(
				"desc"      => "Edit a job.",
				"view" 		=> "backend/Jobs/add_job",
				"submit" 	=> "edit_job",
				"item"      => "job",
				"redirect"  => "admin/lib/jobs/jobs_overview",
				"active_link" => "modules"
			)

		)

	);

?>