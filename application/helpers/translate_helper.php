<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Nog controle uitvoeren dat als de gekozen taal in de URL wel ondersteunt wordt
	// door de website. Dit moeten we dus ook ergens toelaten.
	// Uiteindelijk hier dan ook de group_by() verwijderen uit de code

	if ( ! function_exists('lang'))
	{
		function lang()
		{
			$CI =& get_instance();
			return $CI->uri->segment(1);
		}
	}

	if ( ! function_exists('supported_lang'))
	{
		function supported_lang()
		{
			$CI =& get_instance();
			if( $CI->db->where("code",lang())->count_all_results("translation_supported_languages") == 1 )
			{
				return true;
			}
			return false;
		}
	}

	if ( ! function_exists('langswitch'))
	{
		function langswitch($view = true)
		{
			$CI =& get_instance();
			foreach($CI->db->get("translation_supported_languages")->result() as $lang)
			{
				$anchor[] = array(
					"class"  => (lang() == $lang->code) ? "active" : "",
					"active" => (lang() == $lang->code) ? 1 : 0,
					"lang"   => $lang->code,
					"long"   => $lang->lang,
					"url"    => str_replace("/".lang(), "/".$lang->code, current_url())
				);
			}

			if(!$view)
			{
				return $anchor;
			}
			else
			{
				$widget = "<ul class='languages'>";
				foreach($anchor as $row):
					$widget.= "<li class='".$row["class"]."'>";
					$widget.= "<a href='".$row["url"]."'>".$row["lang"]."</a>";
					$widget.= "</li>";
				endforeach;
				$widget.= "</ul>";

				return $widget;
			}
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
							)
				);
				unset($fields);
			
				$CI->dbforge->add_field($fields);
				$CI->dbforge->add_key('id', TRUE);
				$CI->dbforge->create_table('translation_supported_languages',TRUE);	
			}
		
			if(supported_lang())
			{

			
				$CI->db->where("key",$key)->where("lang",lang());
				
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
			else
			{
				return "Unsupported language";
			}

		}
		
	}