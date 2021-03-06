<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

	PRODUCTS
	
	A basic products library to store and display product items & categories.
	
	@package		CodeIgniter 		<http://www.codeigniter.com>
	@version		1.0
	@author			Gert Pellens		<http://www.gertpellens.com>
	@copyright		Gert Pellens		<http://www.gertpellens.com>

**/

class Products {

	var $CI;
	var $product  = "";
	var $title    = "";
	var $category = "";
	var $meta_description = "";
	
	public function __construct($params = array())
	{
	
		$CI =& get_instance();
		
		$CI->core->type = "product";
		
		/**
			
			PRODUCT CATEGORIES

		**/
		if (!$CI->db->table_exists('products_categories'))
		{
			$CI->load->dbforge();
			$fields = array(
				"id" 				=> array( "type" => "INT", 		'auto_increment' => TRUE ),
				"title" 			=> array( "type" => "varchar", 	"constraint" 	 => "300" ),
				"url_title" 		=> array( "type" => "varchar", 	"constraint" 	 => "300" ),
				"parent" 			=> array( "type" => "INT", 		"default" 		 => 0 ),
				"description" 		=> array( "type" => "text" ),
				"index" 			=> array( "type" => "varchar", 	"constraint" 	 => "30" ),
				"follow" 			=> array( "type" => "varchar", 	"constraint" 	 => "30" ),
				"revisit" 			=> array( "type" => "varchar", 	"constraint" 	 => "30" ),
				"meta_description" 	=> array( "type" => "text" ),
				"meta_keywords" 	=> array( "type" => "text" ),
				"lang" 				=> array( "type" => "varchar", 	"constraint" 	 => "5" )
			);
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('products_categories',TRUE);	
		}

		/**
			
			PRODUCT ITEMS

		**/
		if (!$CI->db->table_exists('products_items'))
		{
			// Basis contactformulier opbouwen
			$CI->load->dbforge();
			$fields = array(
				"id" 				=> array( "type" => "INT", 'auto_increment' => TRUE ),
				"title" 			=> array( "type" => "varchar", "constraint" => "300" ),
				"url_title" 		=> array( "type" => "varchar", "constraint" => "300" ),
				"price" 			=> array( "type" => "varchar", "constraint" => "300" ),
				"description" 		=> array( "type" => "text" ),
				"category_id" 		=> array( "type" => "INT" ),
				"lang" 				=> array( "type" => "varchar", "constraint" => "5" ),
				"index" 			=> array( "type" => "varchar", "constraint" => "30" ),
				"follow" 			=> array( "type" => "varchar", "constraint" => "30" ),
				"revisit" 			=> array( "type" => "varchar", "constraint" => "30" ),
				"meta_description" 	=> array( "type" => "text" ),
				"meta_keywords" 	=> array( "type" => "text" )
			);
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('products_items',TRUE);	
		}

		/**
			
			LINK LOCATIONS WITH A FORM

		**/		
		if (!$CI->db->table_exists('products_item_form'))
		{
			$CI->load->dbforge();
			$fields = array(
				"id" 			=> array( "type" => "INT" , 'auto_increment' => TRUE ),
				"form_id" 		=> array( "type" => "INT" ),
				"product_id" 	=> array( "type" => "INT" )
			);
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('products_item_form',TRUE);	
		}
		
		/**
			
			LINK LOCATIONS WITH PRODUCT ITEM

		**/
		if (!$CI->db->table_exists('products_item_location'))
		{
			$CI->load->dbforge();
			$fields = array(
				"id" 			=> array( "type" => "INT", 'auto_increment' => TRUE ),
				"location_id" 	=> array( "type" => "INT"),
				"product_id" 	=> array( "type" => "INT")
			);
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('products_item_location',TRUE);	
		}

		/**
			
			LINK VIDEOS WITH PRODUCT ITEM

		**/
		if (!$CI->db->table_exists('products_item_video'))
		{
			$CI->load->dbforge();
			$fields = array(
				"id" 			=> array( "type" => "INT", 'auto_increment' => TRUE ),
				"video_id" 		=> array( "type" => "INT" ),
				"product_id" 	=> array( "type" => "INT" )
			);
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('products_item_video',TRUE);	
		}

		/**
			
			LINK LOCATIONS WITH CATEGORY ITEM

		**/
		if (!$CI->db->table_exists('products_category_location'))
		{
			$CI->load->dbforge();
			$fields = array(
				"id" 			=> array( "type" => "INT", 'auto_increment' => TRUE ),
				"location_id" 	=> array( "type" => "INT"),
				"category_id" 	=> array( "type" => "INT")
			);
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('products_category_location',TRUE);	
		}

		/**
			
			LINK VIDEOS WITH CATEGORY ITEM

		**/
		if (!$CI->db->table_exists('products_category_video'))
		{
			$CI->load->dbforge();
			$fields = array(
				"id" 			=> array( "type" => "INT", 'auto_increment' => TRUE ),
				"video_id" 		=> array( "type" => "INT" ),
				"category_id" 	=> array( "type" => "INT" )
			);
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('products_category_video',TRUE);	
		}

	}
	
	
	function initialize($params = array())
	{
		$CI  =& get_instance();

		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
		
		// Heeft men een category opgegeven?
		if($this->category != "")
		{
			// Bestaat de category al?
			$result = $CI->db->where("url_title",$this->category)->get("products_categories");
			
			// Category aanmaken
			if($result->num_rows == 0)
			{
				$fields["url_title"] = $this->category;
				$CI->db->insert("products_categories",$fields);
				unset($fields);
			}
		}
	}
	
	public function category($category=null)
	{
		$CI =& get_instance();
		$this->category = ($category != null) ? $category : $this->category;
		$this->products_string_to_int();

		$result = $CI->db->where("id",$this->category)->get("products_categories")->result();
		return $result[0];
	}

	
	public function categories_overview( $parent=null , $lang=true , $view=false )
	{
		$CI  =& get_instance();

		// SUBCATEGORY?
		if($parent != null)
		{

			// Deze functie apart wrappen, kan meermaals vanpas komen!
			if(!is_int($parent))
			{
				$result = $CI->db->select("id")->where("url_title",$parent)->get("products_categories")->result();
				$parent = $result[0]->id;
			}

			$CI->db->where("parent",$parent);
		}
		
		if($CI->db->get("products_categories")->num_rows == 0)
		{
			return ($view) ? "<p>No categories available...</p>" : false;
		}
		else
		{

			// TAAL BEPALEN
			if($lang)
			{
				$lang = (!is_string($lang)) ? lang() : $lang;
				$CI->db->where("lang",$lang);
			}

			if($view == "select")
			{
	
				$result  = $CI->db->get("products_categories")->result();
				$options = "<select name='category'>";
	
				foreach($result as $c):
					$options.= "<option value='".$c->id."'>".$c->title."</option>";
				endforeach;

				$options.="</select>";
	
				return $options;
	
			}

			if($view == "list")
			{
				$result  = $CI->db->get("products_categories")->result();
				$options = "<ul class='product-categories'>";
	
				foreach($result as $c):
					$options.= "<li>".$c->title."</li>";
				endforeach;

				$options.="</ul>";
	
				return $options;
			}

			return $CI->db->get("products_categories")->result();
		}
	}
	
	public function category_products( $category=null, $num=null )
	{

		$CI  =& get_instance();
		$this->category = ($category != null) ? $category : $this->category;
		$this->products_string_to_int();
		
		$CI->db->where("category_id",$this->category);
		if($num!=null)
		{
			$CI->db->limit($num)->order_by("id","DESC"); 
		}
		
		$result = $CI->db->get("products_items");
		
		
		if($result->num_rows == 0):
			return false;
		else:
			return $result->result();
		endif;

	}
	
	public function product($product=null)
	{
		$CI  =& get_instance();
		$this->product = ($product != null) ? $product : $this->product;
		$this->products_string_to_int();
		
		$result = $CI->db->where("id",$this->product)->get("products_items");
		if($result->num_rows != 0):
		
			$result = $result->result();
			
			$this->title            = $result[0]->title;
			$this->meta_description = $result[0]->meta_description;
			$this->meta_keywords    = $result[0]->meta_keywords;
			
			return $result[0];
		else:
			return "No product found...";
		endif;
	}


	/**
		
		VIDEOS LINKED TO A PRODUCT

	**/
	
	public function product_videos( $product=null )
	{
		$CI  =& get_instance();
		$this->product = ($product != null) ? $product : $this->product;

		$result = $CI->db->where("cv.product_id",$this->product)->from("products_item_video AS cv")->join("media_videos AS mv","mv.id = cv.video_id","left")->get()->result();
		return $result;
	}

	/**
		
		LOCATIONS LINKED TO A PRODUCT

	**/

	public function product_locations( $product=null )
	{
		$CI  =& get_instance();
		$this->product = ($product != null) ? $product : $this->product;
		$this->products_string_to_int();

		$result = $CI->db->where("pl.product_id",$this->product)->from("products_item_location AS pl")->join("locations_items AS l","l.id = pl.location_id","left")->get()->result();
		return $result;
	}

	/**
		
		VIDEOS LINKED TO A CATEGORY

	**/

	public function category_videos( $category=null )
	{
		$CI  =& get_instance();
		$this->category = ($category != null) ? $category : $this->category;
		$this->products_string_to_int();

		$result = $CI->db->where("pv.category_id",$this->category)->from("products_category_video AS pv")->join("media_videos AS mv","mv.id = pv.video_id","left")->get()->result();
		return $result;
	}

	/**
		
		LOCATIONS LINKED TO A CATEGORY

	**/

	public function category_locations( $category=null )
	{
		$CI  =& get_instance();
		$this->category = ($category != null) ? $category : $this->category;
		$this->products_string_to_int();

		$result = $CI->db->where("pl.category_id",$this->category)->from("products_category_location AS pl")->join("locations_items AS mv","mv.id = pl.location_id","left")->get()->result();
		return $result;
	}
	






	public function product_has_location( $location=null , $product=null )
	{
		$CI  =& get_instance();
		$this->product = ($product != null) ? $product : $this->product;
		$this->products_string_to_int();
		
		$result = $CI->db->select("locations")->where("product_id",$this->product)->get("products_item_locations");

		if($result->num_rows != 0)
		{
			$result = $result->result();
			$result = unserialize($result[0]->locations);
			foreach($result as $loc):
				if($loc == $location) return true;
			endforeach;
		
			return false;
		}
		else
		{
			return false;
		}
	}
	
	public function product_has_form( $form=null , $product=null )
	{
		$CI  =& get_instance();
		$this->product = ($product != null) ? $product : $this->product;
		$this->products_string_to_int();
		
		$result = $CI->db->where("product_id",$this->product)->where("form_id",$form)->get("products_item_form");

		if($result->num_rows == 1) return true;
		else return false;
	}
	
	public function products_overview($lang=true)
	{
		$CI  =& get_instance();

		if($lang)
		{
			$lang = (!is_string($lang)) ? lang() : $lang;
			$CI->db->where("p.lang",$lang);
		}
		
		return 	$CI->db->select("p.title, p.id, p.price, p.description, c.title as category_title")
				->order_by("p.id","DESC")
				->from("products_items AS p")
				->join("products_categories as c","c.id = p.category_id","left")
				->get()
				->result();
	}
	
	public function products_string_to_int()
	{
		$CI  =& get_instance();
		if($this->product && !is_numeric($this->product))
		{
			$result = $CI->db->select("id")->where("url_title",$this->product)->get("products_items")->result();
			$this->product = @$result[0]->id;
		}
		
		if($this->category && !is_numeric($this->category))
		{
			$result = $CI->db->select("id")->where("url_title",$this->category)->get("products_categories")->result();
			$this->category = @$result[0]->id;
		}
	}
	
	public function related($product=null,$limit=5)
	{
		$CI  =& get_instance();
		
		// Op basis van de parent categorie
		$product  = ($product != null) ? $product : $this->product;
		$category = $this->product_parent($product);
		
		return $CI->db
					->where("category_id",$category)
					->where("id !=",$product)
					->limit($limit)
					->get("products_items")->result();
	}
	
	public function related_pages($page_type)
	{
		echo $page_type;
	}
	
	public function product_parent($product)
	{
		$CI  =& get_instance();
		$result = $CI->db
						->where("id",$product)
						->select("category_id")->get("products_items")->result();
		return $result[0]->category_id;
	}

	/**

		ADD A PRODUCT

	**/

	public function add_product($fields)
	{
		$CI  =& get_instance();

		// IS THERE A VIDEO ADDED?
		if(isset($fields["video_id"])) $fields = $CI->media->add_video($fields);
		if(isset($fields["videos"]))
		{
			$videos = $fields["videos"];
			unset($fields["videos"]);
		}

		// IS THERE A LOCATION ADDED?
		if(isset($fields["location"]))
		{
			$locations = $fields["location"];
			unset($fields["location"]);
		}

		// CLEAN POST
		foreach($fields as $key => $val):
			$data[$key] = $CI->input->post($key,true);
		endforeach;

		$data["lang"] 		 = lang();
		$data["category_id"] = $data["category"];
		
		unset($data["category"]);
		unset($data["id"]);

		$CI->db->insert("products_items",$data);
		$product_id = $CI->db->insert_id();

		// LINK VIDEO TO PRODUCT ITEM
		if(isset($videos)):
			foreach($videos as $video):
				$v["video_id"] = $video;
				$v["product_id"] = $product_id;
				$CI->db->insert("products_item_video",$v);
				unset($v);
			endforeach;
			unset($videos);
		endif;

		// LINK LOCATION TO PRODUCT ITEM
		if(isset($locations)):
			foreach($locations as $location):
				$l["location_id"] = $location;
				$l["product_id"] = $product_id;
				$CI->db->insert("products_item_location",$l);
				unset($v);
			endforeach;
			unset($locations);
		endif;

		return true;
	}

	/**

		EDIT A PRODUCT

	**/

	public function edit_product($item)
	{

		$CI  =& get_instance();

		// DELETE CURRENT VIDEOS & LOCATIONS
		$CI->db->where("product_id",$CI->input->post("id",true))->delete("products_item_video");
		$CI->db->where("product_id",$CI->input->post("id",true))->delete("products_item_location");

		// IS THERE A LOCATION ADDED?
		if(isset($item["location"])):
			foreach($item["location"] as $loc):
				$l["location_id"] = $loc;
				$l["product_id"]  = $CI->input->post("id",true);
				$CI->db->insert("products_item_location",$l);
				unset($l);
			endforeach;
		endif;
		unset($item["location"]);

		// IS THERE A VIDEO ADDED?
		if(isset($item["video_id"])) $item = $CI->media->add_video($item);

		// LINK VIDEO TO PRODUCT ITEM
		if(isset($item["videos"])):
			foreach($item["videos"] as $video):
				$v["video_id"]   = $video;
				$v["product_id"] = $CI->input->post("id",true);
				$CI->db->insert("products_item_video",$v);
				unset($v);
			endforeach;
			unset($item["videos"]);
		endif;

		// CLEAN POST
		foreach($item as $key => $field):
			$fields[$key] = $CI->input->post($key,true);
		endforeach;

		// RESET CATEGORY
		// SHOULD BE FIXED...
		$fields["category_id"] = $fields["category"];
		unset($fields["category"]);

		// UPDATE THE PRODUCT ITEM
		$CI->db->where("id",$fields["id"])->update("products_items",$fields);

		return true;
	}

	/**

		DELETE A PRODUCT

	**/

	public function del_product($id)
	{
		$CI =& get_instance();

		// VIDEOS & LOCATIONS DELETEN
		$CI->db->where("product_id",$id)->delete("products_item_video");
		$CI->db->where("product_id",$id)->delete("products_item_location");

		// PRODUCT DELETEN
		$CI->db->where("id",$id)->delete("products_items");
		
		return true;
	}

	/**

		ADD A CATEGORY

	**/

	function add_category($fields=null)
	{

		$CI =& get_instance();

		// IS THERE A VIDEO ADDED?
		if(isset($fields["video_id"])) $fields = $CI->media->add_video($fields);
		if(isset($fields["videos"]))
		{
			$videos = $fields["videos"];
			unset($fields["videos"]);
		}

		// IS THERE A LOCATION ADDED?
		if(isset($fields["location"]))
		{
			$locations = $fields["location"];
			unset($fields["location"]);
		}

		if(isset($_POST))
		{
			$fields["title"]       		= $CI->input->post("title",true);
			$fields["url_title"]        = url_title($fields["title"],"-",true);
			$fields["meta_description"] = $CI->input->post("meta_description",true);
			$fields["meta_keywords"] 	= $CI->input->post("meta_keywords",true);
			$fields["parent"]      		= $CI->input->post("parent",true);
			$fields["lang"]             = lang();

			$CI->db->insert("products_categories",$fields);
			$category_id = $CI->db->insert_id();

			// LINK VIDEO TO CATEGORY ITEM
			if(isset($videos)):
				foreach($videos as $video):
					$v["video_id"] = $video;
					$v["category_id"] = $category_id;
					$CI->db->insert("products_category_video",$v);
					unset($v);
				endforeach;
				unset($videos);
			endif;
	
			// LINK LOCATION TO CATEGORY ITEM
			if(isset($locations)):
				foreach($locations as $location):
					$l["location_id"] = $location;
					$l["category_id"] = $category_id;
					$CI->db->insert("products_category_location",$l);
					unset($v);
				endforeach;
				unset($locations);
			endif;

			return true;

		}


	}

	/**
		
		EDIT A CATEGORY

	**/

	public function edit_category($item)
	{
		$CI =& get_instance();

		// DELETE CURRENT VIDEOS & LOCATIONS
		$CI->db->where("category_id",$CI->input->post("id",true))->delete("products_category_video");
		$CI->db->where("category_id",$CI->input->post("id",true))->delete("products_category_location");

		// IS THERE A LOCATION ADDED?
		if(isset($item["location"])):
			foreach($item["location"] as $loc):
				$l["location_id"] = $loc;
				$l["category_id"]  = $CI->input->post("id",true);
				$CI->db->insert("products_category_location",$l);
				unset($l);
			endforeach;
		endif;
		unset($item["location"]);

		// IS THERE A VIDEO ADDED?
		if(isset($item["video_id"])) $item = $CI->media->add_video($item);

		// LINK VIDEO TO PRODUCT ITEM
		if(isset($item["videos"])):
			foreach($item["videos"] as $video):
				$v["video_id"]   = $video;
				$v["category_id"] = $CI->input->post("id",true);
				$CI->db->insert("products_category_video",$v);
				unset($v);
			endforeach;
			unset($item["videos"]);
		endif;

		if(isset($_POST))
		{
			foreach($item as $key => $value):

				$fields[$key] = $CI->input->post($key,true);

			endforeach;

			$CI->db->where("id",$fields["id"])->update("products_categories",$fields);
			return true;
		}
	}

	/**

		DELETE A CATEGORY

	**/
	
	public function del_category($id)
	{
		$CI =& get_instance();

		// VIDEOS & LOCATIONS DELETEN
		$CI->db->where("category_id",$id)->delete("products_category_video");
		$CI->db->where("category_id",$id)->delete("products_category_location");

		$fields["category_id"] = 0;
		$CI->db->where("category_id",$id)->update("products_items",$fields);

		// CATEGORY DELETEN
		$CI->db->where("id",$id)->delete("products_categories");

		return true;
	}

	
	public function form()
	{
		
		$CI  =& get_instance();
					
		if ($CI->db->table_exists('contactform_forms'))
		{
			$result = $CI->db->select("contactform_forms.name AS name")
								->from("products_item_form")
								->where("product_id",$this->product)
								->join("contactform_forms","contactform_forms.id = products_item_form.form_id","LEFT")
								->get()
								->result();
								
			if(@$result[0]->name)
			{
				$CI->load->library("Contactform");
				return $CI->contactform->generate($result[0]->name);
			}
			else
			{
				return "<p style='color:red;'>No form connected...</p>";
			}
		
		}
		else
		{
			return "<p style='color:red;'>You need to load the Contactform library to use this function.</p>";
		}
	}
	
	public function _add_categorie($data)
	{
		$CI->db->insert("products_categories",$data);
	}
	

}