<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if ( ! function_exists('crumbs'))
	{
		function crumbs()
		{
			$CI =& get_instance();
			
			$result = $CI->db->where("page",$CI->core->page)->get("core_pages")->result();
			$crumbs[] = array(
				"title" => $result[0]->title,
				"url"   => current_url()
			);

			if($result[0]->parent != "")
			{
				$parent = $result[0]->parent;

				while($parent != "")
				{
					$result = $CI->db->where("page",$parent)->get("core_pages")->result();
					$crumbs[] = array(
						"title" => $result[0]->title,
						"url"   => "/".lang()."/".$result[0]->url
					);
					if($result[0]->parent != "")
					{
						$parent = $result[0]->parent;
					} else {
						$parent = "";
					}
				}

			}
			$crumbs = array_reverse($crumbs);
			$number = count($crumbs);

			$string = "<div class='crumbs'>";
			$string.= "<ul>";

			foreach($crumbs as $crumb):
				$string.= "<li>";
				$string.= anchor($crumb["url"],$crumb["title"]);
				$string.= "</li>";
				if($number-- > 1) $string.= "<li class='seperator'>&rsaquo;</li>";
			endforeach;

			$string.= "</ul>";
			$string.= "</div>";

			return $string;
		}
	}

	if ( ! function_exists('tree'))
	{
		function tree()
		{
			$CI =& get_instance();
			$result = $CI->db->select("p0.id, p0.url, p0.page, p0.parent, p1.id as parent_id")->order_by("parent_id","DESC")->from("core_pages as p0")->join("core_pages as p1","p1.page = p0.parent","left")->get()->result();

			$pages = array();
			foreach($result as $item):
				
					$pages[] = array(
						"id" => $item->id,
						"name" => $item->page,
						"parent" => ($item->parent_id == "") ? 0 : $item->parent_id,
						"parent_name" => $item->parent,
						"link" => $item->url
					);
			endforeach;

			$list = categoriesToTree($pages);
			$navarray = GenerateNavArray($list);
			return GenerateNavHTML($navarray);
			
			
		}

		function categoriesToTree(&$categories) {

		    $map = array(
		        0 => array('sub' => array())
		    );
		
		    foreach ($categories as &$category) {
		        $category['sub'] = array();
		        $map[$category['id']] = &$category;
		    }
		
		    foreach ($categories as &$category) {
		        $map[$category['parent']]['sub'][] = &$category;
		    }
		
		    return $map[0]['sub'];
		
		}

		// Generate your multidimensional array from the linear array
		function GenerateNavArray($arr, $parent = 0)
		{
		    $pages = Array();
		    foreach($arr as $page)
		    {
		        if($page['parent'] == $parent)
		        {
		            $page['sub'] = isset($page['sub']) ? $page['sub'] : GenerateNavArray($arr, $page['id']);
		            $pages[] = $page;
		        }
		    }
		    return $pages;
		}
		
		// loop the multidimensional array recursively to generate the HTML
		function GenerateNavHTML($nav)
		{
			$html = "";
		    foreach($nav as $page)
		    {
		        $html .= '<ul><li data-id="'.$page['id'].'">';
		        $html .= '<a href="' . base_url("admin/page/edit/".$page["id"]) . '">' . $page['name'] . '</a>';
		        $html .= GenerateNavHTML($page['sub']);
		        $html .= '</li></ul>';
		    }
		    return $html;
		}

	}

