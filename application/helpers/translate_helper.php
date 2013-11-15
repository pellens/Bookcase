<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
			foreach($CI->translate->all_supported_languages(true) as $lang)
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