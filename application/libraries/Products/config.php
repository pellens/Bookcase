<?

	$config = array(

		"title" 		=> "Products",
		"description" 	=> "List products, productcategories and link them to default libraries.",
		"author" 		=> array(
			"name" 		=> "Gert Pellens",
			"url"  		=> "http://gerardo.be",
			"twitter"   => "@gpellens",
			"github"    => "pellens"
		),
		"version" => "0.1"

	);

	$nav = array(

		"title" => "Products",
		"nav" => array(
			"General" => array(
				"All products" 	 => "admin/lib/products/products_overview",
				"Add product" => "admin/lib/products/add_product",
				"All categories" => "admin/lib/products/categories_overview",
				"Add category" => "admin/lib/products/add_category"
				
			),
			"Administrators" => array()
		)

	);

	$admin = array(

		"fn" => array(

			"products_overview" => array(
				"view"      => "backend/Products/products_overview",
				"fn" => array(
					"list" => "products_overview"
				)
			),

			"add_product" => array(
				"view" 		=> "backend/Products/add_product",
				"submit" 	=> "add_product",
				"redirect"  => "admin/lib/products/products_overview"
			),

			"categories_overview" => array(
				"view"      => "backend/Products/categories_overview",
				"fn" => array(
					"list" => "categories_overview"
				)
			),

			"add_category" => array(
				"view" 		=> "backend/Products/add_category",
				"submit" 	=> "add_category",
				"redirect"  => "admin/lib/products/categories_overview"
			),

			"edit_product" => array(
				"view" 		=> "backend/Products/add_product",
				"submit" 	=> "edit_product",
				"item"      => "product",
				"redirect"  => "admin/lib/products/categories_overview"
			),

			"edit_category" => array(
				"view" 		=> "backend/Products/add_category",
				"submit" 	=> "edit_category",
				"item"      => "category",
				"redirect"  => "admin/lib/products/categories_overview"
			)

		)

	);

?>