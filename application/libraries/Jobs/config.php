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
				
			),
			"Administrators" => array()
		)

	);

	$admin = array(

		"fn" => array(

			"jobs_overview" => array(
				"view"      => "backend/Jobs/jobs_overview",
				"fn" => array(
					"list" => "jobs_overview"
				)
			),

			"add_job" => array(
				"view" 		=> "backend/Jobs/add_job",
				"submit" 	=> "add_job",
				"redirect"  => "admin/lib/jobs/jobs_overview"
			),

			"del_job" => array(
				"view" => "",
				"redirect" => "admin/lib/jobs/jobs_overview",
				"fn" => array(
					"delete" => "del_job"
				)
			),

			"edit_job" => array(
				"view" 		=> "backend/Jobs/add_job",
				"submit" 	=> "edit_job",
				"item"      => "job",
				"redirect"  => "admin/lib/jobs/jobs_overview"
			)

		)

	);

?>