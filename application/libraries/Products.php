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
		
		if (!$CI->db->table_exists('products_categories'))
		{

			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"title" => array(
							"type" => "varchar",
							"constraint" => "300",
						),
				"url_title" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"parent" => array(
							"type" => "INT",
							"default" => 0
						),
				"meta_description" => array(
							"type" => "text"
						),
				"meta_keywords" => array(
							"type" => "text"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('products_categories',TRUE);	
		}
		
		if (!$CI->db->table_exists('products_items'))
		{
			
			// Basis contactformulier opbouwen
			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"title" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"url_title" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"price" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"description" => array(
							"type" => "text"
						),
				"product_category" => array(
							"type" => "INT"
						),
				"lang" => array(
							"type" => "varchar",
							"constraint" => "5"
						),
				"meta_description" => array(
							"type" => "text"
						),
				"meta_keywords" => array(
							"type" => "text"
						),
				"files" => array(
							"type" => "text"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('products_items',TRUE);	
		}
		
		if (!$CI->db->table_exists('products_item_form'))
		{
			
			// Basis contactformulier opbouwen
			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"form_id" => array(
							"type" => "INT"
						),
				"product_id" => array(
							"type" => "INT"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('products_item_form',TRUE);	
		}
		
		if (!$CI->db->table_exists('products_item_locations'))
		{

			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"locations" => array(
							"type" => "TEXT"
						),
				"product_id" => array(
							"type" => "INT"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('products_item_locations',TRUE);	
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

		return $CI->db->where("id",$this->category)->get("products_categories")->result();
	}
	
	
	public function categories($parent=null)
	{
		$CI  =& get_instance();
		
		if($parent != null)
		{
			if(!is_int($parent))
			{
				$result = $CI->db->select("id")->where("url_title",$parent)->get("products_categories")->result();
				$parent = $result[0]->id;
			}
			$CI->db->where("parent",$parent);
		}
		
		if($CI->db->get("products_categories")->num_rows == 0)
		{
			return false;
		}
		else
		{
			return $CI->db->get("products_categories")->result();
		}
	}
	
	public function category_products( $category=null, $num=null )
	{

		$CI  =& get_instance();
		$this->category = ($category != null) ? $category : $this->category;
		$this->products_string_to_int();
		
		$CI->db->where("product_category",$this->category);
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
			
			return $result;
		else:
			return "No product found...";
		endif;
	}
	
	public function product_locations( $product=null )
	{
		$CI  =& get_instance();
		$this->product = ($product != null) ? $product : $this->product;
		$this->products_string_to_int();
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
	
	public function all_products()
	{
		$CI  =& get_instance();
		return $CI->db->order_by("id","DESC")->get("products_items");
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
					->where("product_category",$category)
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
						->select("product_category")->get("products_items")->result();
		return $result[0]->product_category;
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