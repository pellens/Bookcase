<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Social {

	var $CI;
	
	var $version = 1.0;
	
	// General
	var $url;
	var $scripts            = "";
	
	// Open Graph
	var $ogtitle			= "";
	var $ogtype				= "";
	var $ogurl				= "";
	var $ogimage			= "";
	var $ogdescription      = "";
	var $ogsitename         = "";
	
	// Twitter
	var $tweet_custom       = false;
	var $tweet_button_text;
	var $tweet_data_count   = "";
	var $tweet_text         = "Check out this page!";
	var $tweet_size         = "small";
	var $tweet_hashtags;
	var $tweet_via;
	
	var $twitter_feed_username = "";
	var $twitter_feed_limit    = "";
	var $twitter_feed_view     = false;
	var $twitter_feed_last_id  = 1;
	
	// Facebook
	var $fb_app_id          = "";
	var $fb_layout          = "button_count";
	var $fb_send_button     = false;
	var $fb_width           = 100;
	var $fb_action          = "like";
	var $fb_show_faces      = false;
	var $fb_font            = "arial";
	
	// Pinterest
	var $pin_custom         = false;
	var $pin_button_img     = "//assets.pinterest.com/images/PinExt.png";
	var $pin_button_text    = "Pin";
	var $pin_count_pos      = "horizontal";
	var $pin_media;
	var $pin_text;
	
	// Google
	var $google_size        = "medium";
	var $google_callback    = "";
	var $google_annotation  = "";
	
	public function __construct($params = array())
	{
	
		$CI =& get_instance();
		$CI->load->helper("url");
		$this->url = current_url();

		if (!$CI->db->table_exists('social_cron_twitter'))
		{
			
			// Basis contactformulier opbouwen
			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"username" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"last_id" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"last_update" => array(
							"type" => "INT",
							"default" => 0
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('social_cron_twitter',TRUE);	
		}
		
		if (!$CI->db->table_exists('social_tweets'))
		{
			
			// Basis contactformulier opbouwen
			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"username" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"tweet_id" => array(
							"type" => "VARCHAR",
							"constraint" => "300"
						),
				"status" => array(
							"type" => "text"
						),
				"date" => array(
							"type" => "varchar",
							"constraint" => "300"
						),
				"url" => array(
							"type" => "varchar",
							"constraint" => "400"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('social_tweets',TRUE);	
		}
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
	}
	
	function twitter_button()
	{
		if($this->tweet_custom)
		{
			$button  = '<a href="https://twitter.com/share';
  			$button .= '?url='.urlencode($this->url);
  			$button .= '&via=gpellens';
  			$button .= '&text=Dit is een test voor de text';
  			$button .= '&hashtags=awesome';
  			$button .= '" class="twitter-share">Tweet this post</a>';
		}
		else
		{
			$button  = '<a href="https://twitter.com/share" class="twitter-share-button"';
  			$button .= 'data-related="test" ';
  			$button .= 'data-url="'.urlencode($this->url).'" ';
  			$button .= 'data-lang="en" ';
  			$button .= 'data-text="Awesome!" ';
  			$button .= 'data-size="small" ';
  			$button .= 'data-count="" ';
  			$button .= 'data-via="gpellens" ';
  			$button .= 'data-hashtags="awesome" ';
  			$button .= '>Tweet</a>';
		}
		
		return $button;
	}
	
	function facebook_like()
	{
		$CI =& get_instance();
		if($CI->core->fb_app_id)
		{
			$this->fb_app_id = $CI->core->fb_app_id;
		}
		if(!$this->fb_app_id)
		{
			return "You need to configure a Facebook application id. You can obtain one at <a href='https://developers.facebook.com/apps'>Facebook Developers</a>.";
		}
		else
		{
			$formlink  = '<div class="fb-like" ';
			$formlink .= 'data-href="'.urlencode($this->url).'" ';
			$formlink .= 'data-send="false" ';
			$formlink .= 'data-layout="button_count" ';
			$formlink .= 'data-width="450" ';
			$formlink .= 'data-action="like" ';
			$formlink .= 'data-show-faces="true" ';
			$formlink .= 'data-font="verdana" ';
			$formlink .= '></div>';            
			return $formlink;
		}
	}
	
	function pinterest_button()
	{
		$button  = '<a href="http://pinterest.com/pin/create/button/';
  		$button .= '?url='.urlencode($this->url);
  		$button .= '&media=http%3A%2F%2Fwww.bmw.be%2F_common%2Fshared%2Fnewvehicles%2F5series%2Ftouring%2F2010%2Fshowroom%2F_img%2Fbackground.jpg';
  		$button .= '&description=Een%20woordje%20uitleg"';
  		$button .= 'class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';

  		return $button;
	}
	
	function google_button()
	{
		$button  = '<div class="google-button">';
		$button .= '<g:plusone ';
		$button .= 'size="'.$this->google_size.'"';
		$button .= 'callback="'.$this->google_callback.'"';
		$button .= 'annotation="'.$this->google_annotation.'"';
		//$button .= 'href="'.$this->url.'">';
		$button .= '</g:plusone>';
		$button .= '</div>';
		
		return $button;
	}
	
	function twitter_feed($username=null, $limit=10, $view=false)
	{
    	
    	$username = ($this->twitter_feed_username) ? $this->twitter_feed_username : $username;
    	$view     = ($this->twitter_feed_view)     ? $this->twitter_feed_view     : $view;
    	$limit    = ($this->twitter_feed_limit)    ? $this->twitter_feed_limit    : $limit;
    	
    	$CI =& get_instance();
    	$this->_twitter_feed_cron($username);
    	
    	$result = $CI->db->where("username",$username)->limit($limit)->get("social_tweets")->result();
    	
    	if($view)
    	{
    		$string = "<ul>";
    		foreach($result as $item):
    			$string .= "<li>";
    			$string .= "<article>";
    			$string .= "<div class='status'>";
    			$string .= $item->status;
    			$string .= "</div>";
    			$string .= "<time>";
    			$string .= $item->date;
    			$string .= "</time>";
    			$string .= "</article>";
    			$string .= "</li>";
    		endforeach;
    		$string .= "</ul>";
    		
    		return $string;
    	}
    	else
    	{
    		return $result;
    	}
    	 
    	
	}
	
	function _twitter_feed_cron($username)
	{
	
		$CI =& get_instance();
		$result = $CI->db->where("username",$username)->get("social_cron_twitter");
		
		// Limit van 3600 requests / dag
		// 1 dag = 86400 seconden
		// Om de 24 seconden request mogelijk
		// We kiezen voor om de 60 seconden
		
		if($result->num_rows == 1):
		
		$result = $result->result();
		
		
		if($result[0]->last_update+60 <= time())
		{
		
			// Op voorhand last_update instellen om duplicaten te vermijden
			$fields["last_update"] = time();
			$CI->db->where("username",$username)->update("social_cron_twitter",$fields);
			
			$tweets = simplexml_load_file("https://api.twitter.com/1/statuses/user_timeline.rss?screen_name=".$username."&since_id=".$result[0]->last_id);  
		
    		$tweet_array = array();  //Initialize empty array to store tweets
			
    		foreach ($tweets->channel->item as $tweet)
    		{
        	    $twit = $tweet->description;  //Fetch the tweet itself
			
        	    //Remove the preceding 'username: '
        	    $twit = substr(strstr($twit, ': '), 2, strlen($twit));  
			
        	    //Get the date it was posted
        	    $pubdate = strtotime($tweet->pubDate);
        	    $propertime = gmdate('d m Y, H:i', $pubdate);  //Customize this to your liking
			
				$url = (string)$tweet->link;
				$id = explode("/",$url);
					
				if($this->twitter_feed_last_id == 1)
				{
					$this->twitter_feed_last_id = (string)$id[5];
				}

        	    //Store tweet and time into the array
        	    $tweet_item = array(
        	    	"username" => $username,
        	    	'status' => $twit,
        	        'date' => $propertime,
        	        "url" => (string)$tweet->link,
        	        "tweet_id" => (string)$id[5]
        	    );

        	    $CI->db->insert("social_tweets",$tweet_item);
        	    
			}
			
			$fields["last_id"]     = $this->twitter_feed_last_id;
        	$fields["last_update"] = time();
        	$CI->db->where("username",$username)->update("social_cron_twitter",$fields);

		}
		
		endif;
		
	}
	
	function load_scripts($scripts = null)
	{

		$scripts = ($this->scripts) ? $this->scripts : $scripts;
		
		if(is_array($scripts))
		{
			$script_include = "";

		    foreach($scripts as $key => $script):

		    	$script_include .= $this->$script();
		    	
		    endforeach;
		    
		    return $script_include;
		}
		else
		{
			return $this->$scripts();
		}

	}
	
	function facebook()
	{
		return '
		<div id="fb-root"></div>
  		<script>(function(d, s, id) {
		    var js, fjs = d.getElementsByTagName(s)[0];
		    if (d.getElementById(id)) return;
		    js = d.createElement(s); js.id = id;
		    js.src = "//connect.facebook.net/nl_NL/all.js#xfbml=1&appId='.$this->fb_app_id.'";
		    fjs.parentNode.insertBefore(js, fjs);
		    }(document, "script", "facebook-jssdk"));
		</script>
	';
	}
	
	function twitter()
	{
		return '<script>!function(d,s,id){
  					var js,fjs=d.getElementsByTagName(s)[0];
  					if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}
  				}(document,"script","twitter-wjs");</script>';
	}
	
	function pinterest()
	{
		return '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';
	}
	
	function google()
	{
		return '<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>';
	}
	
	function _admin()
	{
		// Hier connectie maken en checken als er een nieuwere versie is
		// Checken op http://cmswebsite.com/version/share/
	}

}