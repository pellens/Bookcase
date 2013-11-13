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
		function trans($key , $replace = array())
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
			}
		
		
			$CI->db->where("key",$key);
			
			if($CI->db->count_all_results("translation") == 0):
			
				$fields["key"]  = $key;
				$fields["lang"] = lang();
				$CI->db->insert("translation",$fields);
				
				return $key;
			
			else:
			
				$CI->db->where("key",$key)->where("lang",lang());
				foreach($CI->db->get("translation")->result() as $item):
					if ($item->string == "")
					{
						return $item->key;
					}
					else
					{
						$string = $item->string;
						if(count($replace) > 0)
						{	
							foreach($replace as $s => $r)
							{
								$string = str_replace($s, $r, $string);
							}
						}
						return $string;
					}
				endforeach;
			
			endif;

		}
		
	}