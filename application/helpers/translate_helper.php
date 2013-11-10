<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if ( ! function_exists('lang'))
	{
		function lang()
		{
			$CI =& get_instance();
			return $CI->uri->segment(1);
		}
	}

	if ( ! function_exists('trans'))
	{
		function trans($string)
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
							)
				);
			
				$CI->dbforge->add_field($fields);
				$CI->dbforge->add_key('id', TRUE);
				$CI->dbforge->create_table('translation',TRUE);	
			}
		
		
			$CI->db->where("string",$string);
			
			if($CI->db->count_all_results("translation") == 0):
			
				$fields["string"] = $string;
				$CI->db->insert("translation",$fields);
				
				return $string;
			
			else:
			
				$CI->db->where("string",$string);
				foreach($CI->db->get("translation")->result() as $item):
					return $item->string;
				endforeach;
			
			endif;

		}
		
	}