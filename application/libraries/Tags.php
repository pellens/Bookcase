<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags {

	var $CI;
	
	public function __construct($params = array())
	{
		$CI  =& get_instance();
		if (!$CI->db->table_exists('tags'))
		{
			echo "geen databse";
		}
	}
	
	public function _add_tag($tag)
	{
		$fields["tag"] = $tag;
		$CI->db->insert("tags",$tag);
	}

}