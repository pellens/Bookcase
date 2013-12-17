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

			require_once("languages.php");

			foreach($fields as $lang)
			{
				$in["lang"] = $lang[1];
				$in["code"] = $lang[0];

				$CI->db->insert("translation_supported_languages",$in);
				unset($in);

			}

			$primary = array(
				"primary" => 1,
				"active"  => 1
			);

			$CI->db->where("code","en")->update("translation_supported_languages",$primary);
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

		return $CI->db->group_by("key")->order_by("key")->get("translation")->result();
	}

	public function key($key)
	{
		$CI =& get_instance();

		return $CI->db->where("key",$key)->get("translation")->result();
	}

	public function edit_translation()
	{
		$CI =& get_instance();

		$nr = count($_POST)-1;

		for($i=0;$i<=$nr;$i++):

			$fields["string"] = $_POST["string"][$i];
			$CI->db->where("id",$_POST["id"][$i])->update("translation",$fields);
			unset($fields);

		endfor;
		return true;
	}

	public function deactivate_language($code)
	{
		$CI =& get_instance();

		//-----------------------------------------------------------------------------
		// If this was the primary language
		// We will set the English language as primary and active
		//-----------------------------------------------------------------------------
		
		$result = $CI->db->where("code",$code)->get("translation_supported_languages")->result();
		if($result[0]->primary == 1)
		{
			$fields["primary"] = 1;
			$fields["active"]  = 1;
			$CI->db->where("code","en")->update("translation_supported_languages",$fields);
			unset($fields);
		}

		//-----------------------------------------------------------------------------
		// Deactivate the language
		//-----------------------------------------------------------------------------

		$update["active"]  = 0;
		$update["primary"] = 0;
		$CI->db->where("code",$code)->update("translation_supported_languages",$update);
		unset($update);
		return true;

	}

	public function activate_language()
	{
		$CI =& get_instance();

		$code = $CI->input->post("language",true);

		$fields["active"]  = "1";
		$fields["primary"] = $CI->input->post("primary",true);

		if($fields["primary"] == 1)
		{
			$edit["primary"] = 0;
			$CI->db->where("primary","1")->update("translation_supported_languages",$edit);
		}
		$CI->db->where("code",$code)->update("translation_supported_languages",$fields);
		return true;
	}

	public function make_primary($code)
	{
		$CI =& get_instance();

		//-----------------------------------------------------------------------------
		// Un-primary the current primary language
		//-----------------------------------------------------------------------------

		$fields["primary"] = 0;
		$CI->db->where("primary",1)->update("translation_supported_languages",$fields);
		unset($fields);

		//-----------------------------------------------------------------------------
		// Make new primary language
		//-----------------------------------------------------------------------------

		$fields["primary"] = 1;
		$CI->db->where("code",$code)->update("translation_supported_languages",$fields);
		unset($fields);

		return true;
	}

	public function add_language()
	{

	}

	public function progress_translation($lang)
	{
		$CI =& get_instance();
		$bar = 0;
		$total  	= $CI->db->where("lang",$lang)->count_all_results("translation");
		$progress 	= $CI->db->where("lang",$lang)->where("string","")->count_all_results("translation");

		if($total!=0)
		{
			$bar 		= 100 - (($progress)/$total) * 100;
		}
		else
		{
			$bar = 100;
		}
		return $bar."%";
	}


}