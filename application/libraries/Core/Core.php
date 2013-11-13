<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

	CORE
	
	Setting basic configurations for a website or pages
	
	@package		CodeIgniter 		<http://www.codeigniter.com>
	@version		1.0
	@author			Gert Pellens		<http://www.gertpellens.com>
	@copyright		Gert Pellens		<http://www.gertpellens.com>

**/

class Core {
	
	var $CI;
	var $page          = "";
	var $scripts       = "";
	var $type          = "";
	var $type_id       = "";
	var $page_title    = "";
	var $fb_app_id  = "";
	var $website_title = "";
	var $all_pages_open  = "<div>";
	var $all_pages_close = "</div>";
	var $list_open 		= "<div class='list'>";
	var $list_close     = "</div>";

	public function __construct($params = array())
	{
	
		$CI =& get_instance();

		$CI->load->database();
		$CI->load->helper("url");
		
		if(empty($CI->db->database)):
			require_once("templates/setup.php");
			die();
			exit();
		endif;
		
		if (!$CI->db->table_exists('core_settings'))
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
				"fb_app_id" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"facebook_secret" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"google_client_id" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"google_client_secret"  => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"twitter_key" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"twitter_secret" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"lang" => array(
							"type" => "varchar",
							"constraint" => "10"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('core_settings',TRUE);
			
			unset($fields);
			
			$fields["title"] = "CodeIgniter Bookcase";
			$CI->db->insert("core_settings",$fields);
		}
		
		if (!$CI->db->table_exists('core_admins'))
		{
		    $CI->load->dbforge();
		
		    $fields = array(
		    	"id" => array(
		    				"type"           => "INT",
        	                'auto_increment' => TRUE
		    			),
		    	"email" => array(
		    				"type" => "varchar",
		    				"constraint" => "300",
		    			),
		    	"password" => array(
		    				"type" => "varchar",
		    				"constraint" => "300"
		    			),
		    	"name" => array(
		    				"type" => "varchar",
		    				"constraint" => "300"
		    			),
		    	"created_at" => array(
		    				"type" => "varchar",
		    				"constraint" => "300"
		    			),
		    	"last_login"  => array(
		    				"type" => "varchar",
		    				"constraint" => "300"
		    			),
		    	"avatar" => array(
		    				"type" => "varchar",
		    				"constraint" => "300"
		    			),
		    	"role" => array(
		    				"type" => "INT"
		    			)
		    );

		    $CI->dbforge->add_field($fields);
		    $CI->dbforge->add_key('id', TRUE);
		    $CI->dbforge->create_table('core_admins',TRUE);
		    
		    unset($fields);

		}

		if (!$CI->db->table_exists('core_libraries'))
		{
		    $CI->load->dbforge();
		
		    $fields = array(
		    	"id" => array(
		    				"type"           => "INT",
        	                'auto_increment' => TRUE
		    			),
		    	"active" => array(
		    				"type"           => "INT",
		    				"default" 		=> "0",
		    			),
		    	"title" => array(
		    				"type" => "varchar",
		    				"constraint" => "300",
		    			),
		    	"description" => array(
		    				"type" => "text"
		    			),
		    	"author" => array(
		    				"type" => "text"
		    			),
		    	"version" => array(
		    				"type" => "text"
		    			)
		    );

		    $CI->dbforge->add_field($fields);
		    $CI->dbforge->add_key('id', TRUE);
		    $CI->dbforge->create_table('core_libraries',TRUE);
		    
		    unset($fields);

		}
		
		if (!$CI->db->table_exists('core_admins_roles'))
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
		    			)
		    );
		    
		    
		    $CI->dbforge->add_field($fields);
		    $CI->dbforge->add_key('id', TRUE);
		    $CI->dbforge->create_table('core_admins_roles',TRUE);
		    unset($fields);
		    
		    $fields["title"] = "Administrator";
		    
		    $CI->db->insert("core_admins_roles",$fields);
		    unset($fields);
		
		}
		
		// FILE DATABASE AANMAKEN
    	if (!$CI->db->table_exists('core_pages'))
		{
		
			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"type" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"type_id" => array(
							"type" => "INT"
						),
				"title" => array(
							"type" => "varchar",
							"constraint" => "300",
						),
				"page" => array(
							"type" => "varchar",
							"constraint" => "300",
						),
				"keywords" => array(
							"type" => "TEXT"
						),
				"description" => array(
							"type" => "text"
						),
				"url" => array(
							"type" => "varchar",
							"constraint" => "500",
						),
				"author" => array(
							"type" => "varchar",
							"constraint" => "500"
						),
				"index" => array(
							"type"=>"varchar",
							"constraint" => "40",
							"default" => "index"
						),
				"follow" => array(
							"type"=>"varchar",
							"constraint" => "40",
							"default" => "follow"
						),
				"revisit" => array(
							"type"=>"varchar",
							"constraint" => "40",
							"default" => "7 days"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('core_pages',TRUE);	
		}
		
		/**
		
		Listener: save page settings if given
		
		**/
		
		$settings = $CI->db->get("core_settings")->result();
		$this->website_title = $settings[0]->title;


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

		$this->save_page($params);
		$this->save_routes();
		
		$CI =& get_instance();
			
		$general = $CI->db->get("core_settings")->result();
		$config  = $CI->db->where("page",$this->page)->get("core_pages")->result();
						
		$this->page_title       = $config[0]->title;
		
		// SEO
		$this->meta_description = $config[0]->description;
		$this->fb_app_id     	= $general[0]->fb_app_id;
		$this->meta_keywords    = $config[0]->keywords;
		$this->index            = $config[0]->index;
		$this->follow           = $config[0]->follow;
		$this->revisit          = $config[0]->revisit;
	}
	
	function save_page($params)
	{

		$CI =& get_instance();
		
		// Specifiek module?
		
		//if($this->type):
		//
		//	$params["type"]    = $this->type;
		//	$params["type_id"] = $this->type_id;
		//
		//	$num = $CI->db->where("type",$this->type)->where("type_id",$this->type_id)->get("core_pages");
		//	
		//else:
		
			$num = $CI->db->where("page",$params["page"])->get("core_pages");
		
		//endif;


		// Page doesn't exists yet
		if($num->num_rows == 0):
			$CI->db->insert("core_pages",$params);
			return;
		endif;
		
		// Page excists, does it need an update?
		$result = $num->result();
		if($result[0]->type != $this->type)
		{
			$CI->db->where("page",$params["page"])->update("core_pages",$params);
			return;
		}
		
	}
	
    function save_routes()
	{
	    // http://darrenonthe.net/2011/05/06/dynamic-routing-from-database-in-codeigniter/
	}
	
	function scripts($params = null)
	{
	
		$CI  =& get_instance();
		$CI->load->helper("url");
		
		$scripts = '
		<!-- GOOGLE HTML5 SHIV -->
		<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		';
    	
		if(is_array($params))
		{
			$scripts .= '<script src="http://www.google.com/jsapi"></script>';
			
			foreach($params as $item):
				$scripts .= $this->_script($item);
			endforeach;
			
			return $scripts;
		}
		elseif($params == null)
		{
			return $scripts.'
		<!-- STANDARD SCRIPTS -->
		<script src="http://www.google.com/jsapi"></script>
		<script type="text/javascript">google.load("jquery", "1.4.2");</script>
		<script src="'.base_url().'js/core/modernizr.js" type="text/javascript"></script>
		';
		}
		else
		{
			return '<script src="http://www.google.com/jsapi"></script>'.$this->_script($params);
		}	
	}
	
	function _script($script)
	{

		switch($script):
		
			case "jqueryui"      : return '<script type="text/javascript">google.load("jqueryui","1.7.2");</script>'; break;
			case "jquery"        : return '<script type="text/javascript" src="'.base_url().'js/core/jquery-1.9.0.min.js"></script>'; break;
			case "visualization" : return '<script type="text/javascript">google.load("visualization", "1");</script>'; break;
			case "picker"        : return '<script type="text/javascript">google.load("picker", "1");</script>'; break;
			case "modernizr"     : return '<script type="text/javascript" src="'.base_url().'js/core/modernizr.js"></script>'; break;
			case "uploadify"     : return '<script type="text/javascript" src="'.base_url().'js/core/jquery.uploadify.min.js"></script>'; break;
			case "maps"		     : return '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>'; break;
			case "fancybox"      : return '<script type="text/javascript" src="'.base_url().'js/core/fancybox.js"></script>'; break;
			case "flexslider"    : return '<script type="text/javascript" src="'.base_url().'js/core/jquery.flexslider.js"></script>'; break;
		
		endswitch;
	}
	
	function metatags()
	{

		if($this->page)
		{

			$meta  = '
			<meta charset="utf-8" />
			<meta name="language" content="'.lang().'" />
			
			<title>'.$this->page_title.' - '.$this->website_title.'</title>
			
			<!-- GENERAL SETTINGS -->
			<meta name="generator"          content="Bookcase" />
			<meta name="keywords"           content="'.$this->meta_keywords.'">
			<meta name="description"        content="'.$this->meta_description.'">
			<meta name="author"             content="">
			<meta name="viewport"           content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
			
			<!-- SEO -->
			<meta name="google"             content="" />
			<meta name="language"           content="" />
			<meta name="robots"             content="'.$this->index.','.$this->follow.'" />
			<meta name="revisit-after"      content="'.$this->revisit.'" />
			
			<!-- FACEBOOK -->
			<meta property="fb:app_id"      content="'.$this->fb_app_id.'" />
			
			<!-- SOCIAL MEDIA -->
			<meta property="og:title"       content="'.$this->page_title.'" />
			<meta property="og:type"        content="'.$this->type.'" />
			<meta property="og:url"         content="'.current_url().'" />
			<meta property="og:image"       content="" />
			<meta property="og:description" content="'.$this->meta_description.'" />
			<meta property="og:site_name"   content="'.$this->website_title.'" />
			
			<!-- STYLE -->
			<link rel="icon"                type="image/x-icon" href="" />
			<link rel="shortcut icon"       type="image/x-icon" href="" />
			';
			
			return $meta;
		
		}
		else
		{
			die("<p>Please configurate the pagename in the <b>Core Library</b> first!</p>");
		}
	}
	
	function all_pages($view = false, $admin = false)
	{
		$CI =& get_instance();
		$pages = $CI->db->get("core_pages")->result();
		
		if($view)
		{

			foreach($pages as $page):

				$output  = "<table>";
				$output .= "<tr>";
				$output .= "<td class='title'>".$page->page."</td>";

				if($admin)
				{
					$output .= "<td class='actions'>";
					$output .= anchor("admin/page/".$page->id,"Edit",'class="edit"');
					$output .= anchor("admin/page/del/".$page->id,"Delete",'class="del"');
					$output .= "</td>";
				}

				$output .= "</tr>";
				$output .= "</table>";
			
			endforeach;
			
			return $output;
		}
		else
		{
			return $pages;
		}
	
	}
	
	function libraries()
	{
		$CI =& get_instance();
		$libraries = array();

		if ($handle = opendir('./application/libraries/'))
		{

        	while (false !== ($entry = readdir($handle)))
        	{
            	if ($entry != "." && $entry != ".." && $entry != ".DS_Store")
            	{
                	
                	$filename    = "./application/libraries/".$entry."/config.php";

					if (file_exists($filename))
					{
					    include("./application/libraries/".$entry."/config.php");

					    // The library is been used for the first time
					    // Let's add the settings, but keep it inactive
					    if( $CI->db->where("title",$config["title"])->count_all_results("core_libraries") == 0)
					    {
					    	$config["author"] = serialize($config["author"]);
					    	$CI->db->insert("core_libraries",$config);
					    }
					    
					    $result = $CI->db->select("title,description,author,active")->where("title",$config["title"])->get("core_libraries")->result();
					    $libraries[] = array(
					    	"title" => $result[0]->title,
					    	"description" => $result[0]->description,
					    	"author" => $result[0]->author,
					    	"active" => $result[0]->active
				    	);

					} else {
						$libraries[] = array(
					    	"title" => $entry,
					    	"error" => "No configuration file found..."
					    );
					}

            	}
        	}
        	closedir($handle);
   		}


   		return $libraries;
	}

	function page( $page )
	{
		$CI =& get_instance();
		$CI->db->where("page",$page);
		$result = $CI->db->get("core_pages")->result();
		
		return $result[0];
	}

}