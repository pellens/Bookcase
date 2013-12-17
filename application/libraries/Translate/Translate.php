<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Translate {

	public function __construct($params = array())
	{
	
		$CI =& get_instance();

		// FILE DATABASE AANMAKEN
    	if (!$CI->db->table_exists('translation'))
		{
		
			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"string" => array(
							"type" => "text"
						),
				"key" => array(
						"type" => "varchar",
						"constraint" => "300"
						),
				"lang" => array(
						"type" => "varchar",
						"constraint" => "5"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('translation',TRUE);
			unset($fields);
		}

		// FILE DATABASE AANMAKEN
    	if (!$CI->db->table_exists('translation_supported_languages'))
		{
		
			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
						"type"           => "INT",
                        'auto_increment' => TRUE
					),
				"lang" => array(
						"type" => "varchar",
						"constraint" => "300"
					),
				"code" => array(
						"type" => "varchar",
						"constraint" => "10"
					),
				"primary" => array(
						"type" => "int",
						"default" => 0
					),
				"active" => array(
						"type" => "int",
						"default" => 0
					)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('translation_supported_languages',TRUE);	
			unset($fields);

			$primary = array(
				"lang" => "English",
				"code" => "en",
				"primary" => 1,
				"active"  => 1
			);
			$CI->db->insert("translation_supported_languages",$primary);
		}

		if( $CI->uri->segment(1) == "" || strlen($CI->uri->segment(1)) != 2)
		{
			$primary = $CI->db->select("code")->where("primary",1)->get("translation_supported_languages")->result();

			$url = $primary[0]->code."/".uri_string()."?".$_SERVER["QUERY_STRING"];
			redirect($url);
		}
	}

	public function all_supported_languages($active = false)
	{
		$CI =& get_instance();
		if($active) $CI->db->where("active",1);
		return $CI->db->get("translation_supported_languages")->result();
	}

	public function translation($lang = false)
	{
		$CI =& get_instance();

		return $CI->db->order_by("key")->get("translation")->result();
	}

	public function progress_translation($lang)
	{
		$CI =& get_instance();
		$bar = 0;
		$total  	= $CI->db->where("lang",$lang)->count_all_results("translation");
		$progress 	= $CI->db->where("lang",$lang)->where("string","")->count_all_results("translation");
		$bar 		= 100 - (($progress)/$total) * 100;
		return $bar."%";
	}


}