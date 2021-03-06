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
		"icon"  => "fa-shopping-cart",
		"nav" => array(
			"General" => array(
				"All products" 	 => "admin/lib/products/products_overview",
				"Add product" => "admin/lib/products/add_product",
				"All categories" => "admin/lib/products/categories_overview",
				"Add category" => "admin/lib/products/add_category"
				
			)
		)

	);

	$admin = array(

		"fn" => array(

			"products_overview" => array(
				"title"     => "Products",
				"desc"      => "Get a list of all products.",
				"view"      => "backend/Products/products_overview",
				"fn" => array(
					"list" => "products_overview"
				),
				"active_link" => "modules"
			),

			"add_product" => array(
				"title"     => "New product",
				"desc"      => "Add a new product.",
				"view" 		=> "backend/Products/add_product",
				"submit" 	=> "add_product",
				"redirect"  => "admin/lib/products/products_overview",
				"active_link" => "modules"
			),

			"del_product" => array(
				"title"     => "Edit product",
				"desc"      => "Delete a product.",
				"view" 		=> "",
				"redirect" 	=> "admin/lib/products/products_overview",
				"fn" => array(
					"delete" => "del_product"
				),
				"active_link" => "modules"
			),

			"edit_product" => array(
				"title"     => "Edit product",
				"desc"      => "Edit a product.",
				"view" 		=> "backend/Products/add_product",
				"submit" 	=> "edit_product",
				"item"      => "product",
				"redirect"  => "admin/lib/products/products_overview",
				"active_link" => "modules"
			),

			"categories_overview" => array(
				"desc"      => "Get a list of all product categories.",
				"view"      => "backend/Products/categories_overview",
				"fn" => array(
					"list" => "categories_overview"
				),
				"active_link" => "modules"
			),

			"add_category" => array(
				"desc"      => "Add a new product category.",
				"view" 		=> "backend/Products/add_category",
				"submit" 	=> "add_category",
				"redirect"  => "admin/lib/products/categories_overview",
				"active_link" => "modules"
			),

			"del_category" => array(
				"desc"      => "Delete a product category.",
				"view" => "",
				"redirect" => "admin/lib/products/categories_overview",
				"fn" => array(
					"delete" => "del_category"
				),
				"active_link" => "modules"
			),

			"edit_category" => array(
				"desc"      => "Edit a product category.",
				"view" 		=> "backend/Products/add_category",
				"submit" 	=> "edit_category",
				"item"      => "category",
				"redirect"  => "admin/lib/products/categories_overview",
				"active_link" => "modules"
			)

		)

	);

?>