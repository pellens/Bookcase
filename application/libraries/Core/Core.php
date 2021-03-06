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
	var $page         	  = "";
	var $scripts      	  = "";
	var $type         	  = "";
	var $type_id      	  = "";
	var $page_title   	  = "";
	var $analytics        = "";
	var $url          	  = "";
	var $fb_app_id    	  = "";
	var $website_title	  = "";
	var $all_pages_open   = "<div>";
	var $all_pages_close  = "</div>";
	var $list_open 		  = "<div class='list'>";
	var $list_close       = "</div>";

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
				"slogan" => array(
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
				"analytics" => array(
							"type" => "text"
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
			
			$fields["title"]  = "CodeIgniter Bookcase";
			$fields["slogan"] = "Custom made CMS";
			$CI->db->insert("core_settings",$fields);
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
							"constraint" => "300"
						),
				"meta_keywords" => array(
							"type" => "TEXT"
						),
				"meta_description" => array(
							"type" => "text"
						),
				"url" => array(
							"type" => "varchar",
							"constraint" => "500"
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
						),
				"redirect" => array(
							"type"=>"int"
						),
				"visible" => array(
							"type"=>"int"
						),
				"parent" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"homepage" => array(
							"type" => "int",
							"default" => "0"
						),
				"template" => array(
							"type" => "varchar",
							"constraint" => "300"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('core_pages',TRUE);	
		}
		
		/**
		
		Listener: save page settings if given
		
		**/
		
		$settings 			 = $CI->db->get("core_settings")->result();
		$this->website_title = $settings[0]->title;
		$this->analytics     = $settings[0]->analytics;

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
		$this->meta_description = $config[0]->meta_description;
		$this->url 				= base_url(lang()."/".$config[0]->url);
		$this->fb_app_id     	= $general[0]->fb_app_id;
		$this->meta_keywords    = $config[0]->meta_keywords;
		$this->index            = $config[0]->index;
		$this->follow           = $config[0]->follow;
		$this->revisit          = $config[0]->revisit;
	}

	function general_settings()
	{
		$CI =& get_instance();

		$result = $CI->db->get("core_settings")->result();
		return $result[0];
	}

	function update_general_settings($fields)
	{
		$CI =& get_instance();
		foreach($_POST as $key => $value):
			if($key == "analytics")
			{
				$fields[$key] = base64_encode($value);
			}
			else
			{
				$fields[$key] = $CI->input->post($key,true);
			}
		endforeach;

		$CI->db->update("core_settings",$fields);
		return true;
	}
	
	function get_website_permissions($view = false)
	{

		$data["uploads"] 		= FCPATH."/uploads";
		$data["uploads/images"] = FCPATH."/uploads/images";
		$data["upload/files"] 	= FCPATH."/uploads/documents";
		$data["css/frontend"] 	= FCPATH."/css/frontend";

		$per = array();

		foreach($data as $key => $perms):

			$per[$key] = (is_writable($perms)) ? "Writable" : "Make this folder writable!";

		endforeach;
		
		if($view):
			$row = "<table>";
			foreach($per as $key => $val):
			$row.= "<tr><td><code>".$key."</code></td><td>".$val."</td></tr>";
			endforeach;
			$row.= "</table>";
			return $row;
		else:
			return $per;
		endif;

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
        <!-- STANDARD SCRIPTS -->
        <script src="'.base_url().'js/core/jquery.1.10.2.js" type="text/javascript"></script>
        <script src="'.base_url().'js/core/modernizr.js" type="text/javascript"></script>
		';
    	
		if(is_array($params))
		{		
			foreach($params as $item):
				$scripts .= $this->_script($item);
			endforeach;
			
			return $scripts;
		}
		elseif($params == null)
		{
			return $scripts;
		}
		else
		{
			return $scripts.= $this->_script($params);
		}	
	}
	
	function _script($script)
	{

		switch($script):
			

			case "jqueryui"      : return '<script type="text/javascript">google.load("jqueryui","1.7.2");</script>'; break;
			case "visualization" : return '<script type="text/javascript">google.load("visualization", "1");</script>'; break;
			case "picker"        : return '<script type="text/javascript">google.load("picker", "1");</script>'; break;
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

			$meta  = '<meta charset="utf-8" />
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
        <meta name="language"           content="'.lang().'" />
        <meta name="robots"             content="'.$this->index.','.$this->follow.'" />
        <meta name="revisit-after"      content="'.$this->revisit.'" />
        
        <link rel="canonical" href="'.$this->url.'"/>

        <!-- FACEBOOK -->
        <meta property="fb:app_id"      content="'.$this->fb_app_id.'" />
        
        <!-- SOCIAL MEDIA -->
        <meta property="og:title"       content="'.$this->page_title.'" />
        <meta property="og:type"        content="'.$this->type.'" />
        <meta property="og:url"         content="'.$this->url.'" />
        <meta property="og:image"       content="" />
        <meta property="og:description" content="'.$this->meta_description.'" />
        <meta property="og:site_name"   content="'.$this->website_title.'" />
        
        <!-- STYLE -->
        <link rel="icon"                type="image/x-icon" href="" />
        <link rel="shortcut icon"       type="image/x-icon" href="" />

        '.base64_decode($this->analytics).'
			';
			
			return $meta;
		
		}
		else
		{
			die("<p>Please configurate the pagename in the <b>Core Library</b> first!</p>");
		}
	}

	function edit_page()
	{
		$CI =& get_instance();
		foreach($_POST as $key => $value):
			$data[$key] = $CI->input->post($key,true);
		endforeach;

		// Navigation handling
		unset($data["navigation"]);

		if($data["homepage"] == 1)
		{
			$change["homepage"] = 0;
			$CI->db->where("homepage","1")->update("core_pages",$change);
		}

		$CI->db->where("id",$data["id"])->update("core_pages",$data);

		redirect("admin");

	}
	
	function all_pages($view = false, $admin = false)
	{
		$CI =& get_instance();
		$pages = $CI->db->get("core_pages")->result();
		
		if($view)
		{

            $output  = "<table class='table table-bordered table-striped'>";

            $output .= "<tr>";
            $output .= "<th>Page title</th>";
            $output .= "<th>Machine name</th>";
            $output .= "<th>Complete</th>";
            $output .= "</tr>";

			foreach($pages as $page):

				
				$output .= "<tr>";
				$output .= "<td class='title'>".$page->title."</td>";
                $output .= "<td class='machinename'>".$page->page."</td>";
                $output .= "<td class='status' width='200'>";
                $output .= '<div class="progress"><div class="bar" style="width: '.$this->page_progress($page->page).'"></div></div>';
                $output .= "</td>";

				if($admin)
				{
					$output .= "<td class='actions'>";
					$output .= anchor("admin/page/".$page->id,"Edit",'class="edit"');
					$output .= anchor("admin/page/del/".$page->id,"Delete",'class="del"');
					$output .= "</td>";
				}

				$output .= "</tr>";
				
			
			endforeach;

            $output .= "</table>";
			
			return $output;
		}
		else
		{
			$i = 0;
			foreach($pages as $page):
				$data[$i] = (array)$page;
				$data[$i]["progress"] = $this->page_progress($page->page);
				$i++;
			endforeach;

			if(isset($data)) {
				return $data;
			} else {
				return false;
			}

		}
	
	}
	
    function page_progress($page)
    {
        $CI =& get_instance();

        $supported  = array("title","meta_keywords","meta_description");
        $bar        = 0;
        $total      = 0;
        $progress   = 0;

        foreach ($CI->db->where("page",$page)->get("core_pages")->result() as $key => $value):

            foreach($supported as $s):
                
                $total+=1;
                if($value->$s != "" && $value->$s != " ") $progress+=1;

            endforeach;

        endforeach;

        $bar = 100 - (($total-$progress)/$total) * 100;

        return round($bar)."%";
    }

	function libraries( $active = false )
	{
		$CI =& get_instance();
		$libraries = array();

		if ($handle = opendir('./application/libraries/'))
		{

        	while (false !== ($entry = readdir($handle)))
        	{
            	if ($entry != "." && $entry != ".." && $entry != ".DS_Store" && $entry != "index.html")
            	{
                	$filename    = FCPATH."application/libraries/".$entry."/config.php";

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
					    
					    $result = $CI->db->select("title,version,description,author,active")->where("title",$config["title"])->get("core_libraries")->result();
					    $libraries[] = array(
					    	"title" => $result[0]->title,
					    	"description" => $result[0]->description,
					    	"author" => unserialize($result[0]->author),
					    	"active" => $result[0]->active,
                            "version" => $result[0]->version
				    	);

					}
                    else
                    {
                        if(!$active)
                        {
						    $libraries[] = array(
					       	   "title" => $entry,
					           "error" => "No configuration file found..."
					        );
                        }
					}

            	}
        	}
        	closedir($handle);
   		}


   		return $libraries;
	}

	public function page( $page )
	{

		$CI =& get_instance();
		if(is_numeric($page))
		{	
			$CI->db->where("id",$page);
		}
		else
		{
			$CI->db->where("page",$page);
		}
		
		
		$result = $CI->db->get("core_pages")->result();
		
		return $result[0];
	}

}