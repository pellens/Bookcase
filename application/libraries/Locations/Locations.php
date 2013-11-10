<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

	CORE
	
	Setting basic configurations for a website or pages
	
	@package		CodeIgniter 		<http://www.codeigniter.com>
	@version		1.0
	@author			Gert Pellens		<http://www.gertpellens.com>
	@copyright		Gert Pellens		<http://www.gertpellens.com>

**/

class Locations {

	var $CI;
	var $location       = "";
	var $address        = "";
	var $static_w       = 300;
	var $static_h       = 200;
	var $map_zoom       = 10;
	var $map_type       = "roadmap";

	public function __construct($params = array())
	{
	
		$CI =& get_instance();
		
		$CI->core->type = "location";
		
		if (!$CI->db->table_exists('locations'))
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
				"street" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"city" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"country" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"tel" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"fax" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"email" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"website" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"hq" => array(
							"type" => "INT",
							"constraint" => "1"
						),
				"BTW" => array(
							"type" => "VARCHAR",
							"constraint" => "300"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('locations',TRUE);	
		}
	
	}
	
	function initialize($params = array())
	{
	
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
		
	}
	
	function all_locations()
	{
		$CI =& get_instance();
		return $CI->db->order_by("title","ASC")->get("locations");
	}
	
	
	function location($location = null)
	{
		$CI =& get_instance();
		$this->location = ($location == null) ? $this->location : $location;
		$this->location_string_to_int();
		
		$result = $CI->db->where("id",$this->location)->get("locations");
		return $result;
	}
	
	function location_string_to_int()
	{
		$CI  =& get_instance();
		if($this->location && !is_numeric($this->location))
		{
			$result = $CI->db->select("id")->where("url_title",$this->location)->get("locations")->result();
			$this->location = @$result[0]->id;
		}
	}
	
	function headquarters()
	{
		$CI =& get_instance();
		return $CI->db->where("hq",1)->get("locations");
	}
	
	
	function map( $address = null , $width = null , $height = null )
	{
		if($width !=null && $height != null)
		{
			$this->static_h = $height;
			$this->static_w = $width;
		}
		$CI =& get_instance();
		$this->location = ($address == null) ? $this->location : $address;
		$this->location_string_to_int();
		$item          = $CI->db->where("id",$this->location)->get("locations")->result();
		$this->address = $item[0]->street."+".$item[0]->city."+".$item[0]->country;
		
		return "<img src='https://maps.googleapis.com/maps/api/staticmap?center=".urlencode($this->address)."&zoom=".$this->map_zoom."&size=".$this->static_w."x".$this->static_h."&maptype=".$this->map_type."&markers=color:blue%7Clabel:S%7C".urlencode($this->address)."&sensor=false' class='static_map'/>";

	}
		
}
