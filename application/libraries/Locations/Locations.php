<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

	LOCATIONS
	
	Setting basic configurations for a website or pages
	
	@package		CodeIgniter 		<http://www.codeigniter.com>
	@version		1.0
	@author			Gert Pellens		<http://www.gerardo.be>
	@copyright		Gert Pellens		<http://www.gerardo.be>

**/

class Locations {

	var $location;
	var $location_type;

	public function __construct($params = array())
	{
	
		$CI =& get_instance();
		
		$CI->core->type = "locations";
		
		if (!$CI->db->table_exists('locations_items'))
		{

			$CI->load->dbforge();
			
			$fields = array(
				"id" 				=> array( "type" => "INT", 		'auto_increment' => TRUE ),
				"title" 			=> array( "type" => "varchar", 	"constraint" => "300" ),
				"url_title" 		=> array( "type" => "varchar", 	"constraint" => "300" ),
				"adres" 			=> array( "type" => "varchar", 	"constraint" => "500" ),
				"street" 			=> array( "type" => "varchar", 	"constraint" => "300" ),
				"number" 			=> array( "type" => "varchar", 	"constraint" => "5" ),
				"city" 				=> array( "type" => "varchar", 	"constraint" => "300" ),
				"tel" 				=> array( "type" => "varchar", 	"constraint" => "300" ),
				"fax" 				=> array( "type" => "varchar", 	"constraint" => "300" ),
				"lat" 				=> array( "type" => "varchar", 	"constraint" => "300" ),
				"lng" 				=> array( "type" => "varchar", 	"constraint" => "300" ),
				"area_level_1" 		=> array( "type" => "varchar", 	"constraint" => "300" ),
				"area_level_2" 		=> array( "type" => "varchar", 	"constraint" => "300" ),
				"email" 			=> array( "type" => "varchar", 	"constraint" => "300" ),
				"website" 			=> array( "type" => "varchar", 	"constraint" => "300" ),
				"btw" 				=> array( "type" => "varchar", 	"constraint" => "300" ),
				"country" 			=> array( "type" => "varchar", 	"constraint" => "300" ),
				"index" 			=> array( "type" => "varchar", 	"constraint" => "30" ),
				"follow" 			=> array( "type" => "varchar", 	"constraint" => "30" ),
				"revisit" 			=> array( "type" => "varchar", 	"constraint" => "30" ),
				"meta_description" 	=> array( "type" => "text" ),
				"meta_keywords" 	=> array( "type" => "text" ),
				"type" 				=> array( "type" => "INT", 		"constraint" => "1" ),
				"parent" 			=> array( "type" => "INT", 		"constraint" => "1" ),
				"position" 			=> array( "type" => "INT", 		"constraint" => "1" )
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('locations_items',TRUE);	
		}

		if (!$CI->db->table_exists('locations_types'))
		{

			$CI->load->dbforge();
			
			$fields = array(
				"id" => array( "type"           => "INT",
                            'auto_increment' => TRUE
						),
				"title" => array( "type" => "varchar",
							"constraint" => "300",
						),
				"url_title" => array( "type" => "varchar",
							"constraint" => "300"
						),
				"index" => array( "type" => "varchar",
							"constraint" => "30"
						),
				"follow" => array( "type" => "varchar",
							"constraint" => "30"
						),
				"revisit" => array( "type" => "varchar",
							"constraint" => "30"
						),
				"meta_description" => array( "type" => "text"
						),
				"meta_keywords" => array( "type" => "text" ),
				"parent" => array( "type" => "INT", "constraint" => "3" )
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('locations_types',TRUE);	

			unset($fields);
			$fields["title"] 		= "Basic";
			$fields["url_title"] 	= "basic";
			$fields["parent"] 		= "0";
			$CI->db->insert("locations_types",$fields);

			unset($fields);
			$fields["title"] 		= "Headquarter";
			$fields["url_title"] 	= "headquarter";
			$fields["parent"] 		= "0";
			$CI->db->insert("locations_types",$fields);
		}

	}

	public function locations_overview($parent = null)
	{
		$CI =& get_instance();

		if($parent != null) $CI->db->where("parent",$parent);
		return $CI->db->order_by("position","ASC")->get("locations_items")->result();
	}

	public function types_overview($parent = null)
	{
		$CI =& get_instance();
		if($parent != null) $CI->db->where("parent",$parent);
		return $CI->db->order_by("title")->get("locations_types")->result();
	}

	public function add_type()
	{
		$CI =& get_instance();

		$fields["title"] 			= $CI->input->post("title",true);
		$fields["url_title"] 		= url_title($fields["title"],"-",true);
		$fields["meta_description"]	= $CI->input->post("meta_description",true);
		$fields["meta_keywords"]	= $CI->input->post("meta_keywords",true);
		$fields["revisit"]	        = $CI->input->post("revisit",true);
		$fields["index"]	        = $CI->input->post("index",true);
		$fields["follow"]	        = $CI->input->post("follow",true);

		$CI->db->insert("locations_types",$fields);
		return true;
	}

	public function edit_type()
	{
		$CI =& get_instance();

		$fields["title"] 			= $CI->input->post("title",true);
		$fields["url_title"] 		= url_title($fields["title"],"-",true);
		$fields["meta_description"]	= $CI->input->post("meta_description",true);
		$fields["meta_keywords"]	= $CI->input->post("meta_keywords",true);
		$fields["revisit"]	        = $CI->input->post("revisit",true);
		$fields["index"]	        = $CI->input->post("index",true);
		$fields["follow"]	        = $CI->input->post("follow",true);
		$fields["parent"]	        = $CI->input->post("parent",true);

		$CI->db->where("id",$CI->input->post("id",true))->update("locations_types",$fields);

		return true;
	}

	public function del_location($id)
	{
		$CI =& get_instance();

		$fields["parent"] = "0";
		$CI->db->where("parent",$id)->update("locations_items",$fields);
		$CI->db->where("id",$id)->delete("locations_items");
		return true;
	}

	public function del_type($id)
	{
		$CI =& get_instance();

		$fields["type"] = "1";
		$CI->db->where("type",$id)->update("locations_items",$fields);
		$CI->db->where("id",$id)->delete("locations_types");
		return true;
	}

	public function add_location()
	{
		$CI =& get_instance();

		$fields = $this->prep_data();
		$CI->db->insert("locations_items",$fields);
		return true;
	}

	public function edit_location()
	{
		$CI =& get_instance();

		$fields = $this->prep_data();
		$CI->db->where("id",$CI->input->post("id",true))->update("locations_items",$fields);
		return true;
	}

	public function item($id)
	{
		$CI =& get_instance();

		$this->location = $id;

		$result = $CI->db->where("id",$id)->get("locations_items")->result();
		return $result[0];
	}

	public function type($id)
	{
		$CI =& get_instance();

		$result = $CI->db->where("id",$id)->get("locations_types")->result();
		return $result[0];
	}

	public function ajax_locations_order($fields)
	{
		$CI =& get_instance();

		foreach($fields["item"] as $pos => $id):
			
			$update["position"] = $pos;
			$CI->db->where("id",$id)->update("locations_items",$update);
			unset($update);

		endforeach;
		return true;
	}

	public function prep_data()
	{

		$CI =& get_instance();

		$fields["title"] 			= $CI->input->post("title",true);
		$fields["url_title"] 		= url_title($fields["title"],"-",true);
		$fields["adres"]  			= $CI->input->post("address",true);
		$fields["street"] 			= $CI->input->post("street",true);
		$fields["number"] 			= $CI->input->post("number",true);
		$fields["city"] 			= $CI->input->post("city",true);
		$fields["tel"] 				= $CI->input->post("tel",true);
		$fields["fax"] 				= $CI->input->post("fax",true);
		$fields["area_level_1"] 	= $CI->input->post("area_level_1",true);
		$fields["area_level_2"] 	= $CI->input->post("area_level_2",true);
		$fields["lat"] 				= $CI->input->post("lat",true);
		$fields["lng"] 				= $CI->input->post("lng",true);
		$fields["email"] 			= $CI->input->post("email",true);
		$fields["country"] 			= $CI->input->post("land",true);
		$fields["type"] 			= $CI->input->post("locationtype",true);
		$fields["parent"] 			= $CI->input->post("parent",true);
		$fields["meta_description"]	= $CI->input->post("meta_description",true);
		$fields["meta_keywords"]	= $CI->input->post("meta_keywords",true);
		$fields["revisit"]	        = $CI->input->post("revisit",true);
		$fields["index"]	        = $CI->input->post("index",true);
		$fields["follow"]	        = $CI->input->post("follow",true);
		$fields["website"]	        = $CI->input->post("website",true);
		$fields["btw"]	        	= $CI->input->post("btw",true);

		return $fields;
	}

}