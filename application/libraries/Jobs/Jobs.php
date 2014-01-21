<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

	JOBS
	
	A basic jobs library.
	
	@package		CodeIgniter 		<http://www.codeigniter.com>
	@version		1.0
	@author			Gert Pellens		<http://www.gertpellens.com>
	@copyright		Gert Pellens		<http://www.gertpellens.com>

**/

class Jobs {

	var $CI;
	var $job;
	
	public function __construct($params = array())
	{
	
		$CI =& get_instance();
		
		$CI->core->type = "product";
		
		/**
			
			JOBS ITEMS

		**/

		if (!$CI->db->table_exists('jobs_items'))
		{
			$CI->load->dbforge();
			$fields = array(
				"id" 				=> array( "type" => "INT", 		'auto_increment' => TRUE ),
				"title" 			=> array( "type" => "varchar", 	"constraint" 	 => "300" ),
				"url_title" 		=> array( "type" => "varchar", 	"constraint" 	 => "300" ),
				"description" 		=> array( "type" => "text" ),
				"requirments" 		=> array( "type" => "text" ),
				"offer" 			=> array( "type" => "text" ),
				"index" 			=> array( "type" => "varchar", 	"constraint" 	 => "30" ),
				"follow" 			=> array( "type" => "varchar", 	"constraint" 	 => "30" ),
				"revisit" 			=> array( "type" => "varchar", 	"constraint" 	 => "30" ),
				"meta_description" 	=> array( "type" => "text" ),
				"meta_keywords" 	=> array( "type" => "text" ),
				"lang" 				=> array( "type" => "varchar", 	"constraint" 	 => "5" ),
				"date" 				=> array( "type" => "INT" )
			);
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('jobs_items',TRUE);	
		}

		/**

			LINK JOBS WITH A LOCATION

		**/

		if (!$CI->db->table_exists('jobs_item_location'))
		{
			$CI->load->dbforge();
			$fields = array(
				"id" 			=> array( "type" => "INT", 'auto_increment' => TRUE ),
				"location_id" 	=> array( "type" => "INT"),
				"job_id" 		=> array( "type" => "INT")
			);
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('jobs_item_location',TRUE);	
		}

		/**
			
			LINK VIDEOS WITH A JOB ITEM

		**/
		if (!$CI->db->table_exists('jobs_item_video'))
		{
			$CI->load->dbforge();
			$fields = array(
				"id" 			=> array( "type" => "INT", 'auto_increment' => TRUE ),
				"video_id" 		=> array( "type" => "INT" ),
				"job_id" 	=> array( "type" => "INT" )
			);
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('jobs_item_video',TRUE);	
		}

	}

	/**
		
		GET A SPECIFIC JOB

	**/

	public function job($job=null)
	{
		$CI  =& get_instance();
		$this->job = ($job != null) ? $job : $this->job;
		$this->jobs_string_to_int();

		$result = $CI->db->where("id",$this->job)->get("jobs_items");
		if($result->num_rows != 0):
		
			$result = $result->result();
			return $result[0];

		else:
			return "No job found...";
		endif;
	}

	/**
		
		JOBS OVERVIEW

	**/

	public function jobs_overview($lang=true)
	{
		$CI  =& get_instance();

		if($lang)
		{
			$lang = (!is_string($lang)) ? lang() : $lang;
			$CI->db->where("lang",$lang);
		}
		
		return 	$CI->db
				->order_by("date","DESC")
				->get("jobs_items")
				->result();
	}

	/**

		ADD A JOB

	**/

	public function add_job($fields)
	{
		$CI  =& get_instance();

		// IS THERE A VIDEO ADDED?
		if(isset($fields["video_id"])) $fields = $CI->media->add_video($fields);
		if(isset($fields["videos"]))
		{
			$videos = $fields["videos"];
			unset($fields["videos"]);
		}

		// IS THERE A LOCATION ADDED?
		if(isset($fields["location"]))
		{
			$locations = $fields["location"];
			unset($fields["location"]);
		}

		// CLEAN POST
		foreach($fields as $key => $val):
			$data[$key] = $CI->input->post($key,true);
		endforeach;

		$data["lang"] 		 = lang();
		$data["date"]        = time();
		unset($data["id"]);

		$CI->db->insert("jobs_items",$data);
		$job_id = $CI->db->insert_id();

		// LINK VIDEO TO PRODUCT ITEM
		if(isset($videos)):
			foreach($videos as $video):
				$v["video_id"] = $video;
				$v["job_id"] = $job_id;
				$CI->db->insert("jobs_item_video",$v);
				unset($v);
			endforeach;
			unset($videos);
		endif;

		// LINK LOCATION TO PRODUCT ITEM
		if(isset($locations)):
			foreach($locations as $location):
				$l["location_id"] = $location;
				$l["job_id"] = $job_id;
				$CI->db->insert("jobs_item_location",$l);
				unset($v);
			endforeach;
			unset($locations);
		endif;

		return true;
	}

	/**

		EDIT A JOB

	**/

	public function edit_job($item)
	{

		$CI  =& get_instance();

		// DELETE CURRENT VIDEOS & LOCATIONS
		$CI->db->where("job_id",$CI->input->post("id",true))->delete("jobs_item_video");
		$CI->db->where("job_id",$CI->input->post("id",true))->delete("jobs_item_location");

		// IS THERE A LOCATION ADDED?
		if(isset($item["location"])):
			foreach($item["location"] as $loc):
				$l["location_id"] = $loc;
				$l["job_id"]  = $CI->input->post("id",true);
				$CI->db->insert("jobs_item_location",$l);
				unset($l);
			endforeach;
		endif;
		unset($item["location"]);

		// IS THERE A VIDEO ADDED?
		if(isset($item["video_id"])) $item = $CI->media->add_video($item);

		// LINK VIDEO TO PRODUCT ITEM
		if(isset($item["videos"])):
			foreach($item["videos"] as $video):
				$v["video_id"]   = $video;
				$v["job_id"] = $CI->input->post("id",true);
				$CI->db->insert("jobs_item_video",$v);
				unset($v);
			endforeach;
			unset($item["videos"]);
		endif;

		// CLEAN POST
		foreach($item as $key => $field):
			$fields[$key] = $CI->input->post($key,true);
		endforeach;
		$fields["date"] = time();

		// UPDATE THE PRODUCT ITEM
		$CI->db->where("id",$fields["id"])->update("jobs_items",$fields);

		return true;
	}

	/**

		DELETE A PRODUCT

	**/

	public function del_job($id)
	{
		$CI =& get_instance();

		// VIDEOS & LOCATIONS DELETEN
		$CI->db->where("job_id",$id)->delete("jobs_item_video");
		$CI->db->where("job_id",$id)->delete("jobs_item_location");

		// PRODUCT DELETEN
		$CI->db->where("id",$id)->delete("jobs_items");
		
		return true;
	}

	/**
		
		VIDEOS LINKED TO A JOB

	**/
	
	public function job_videos( $job=null )
	{
		$CI  =& get_instance();
		$this->job = ($job != null) ? $job : $this->job;
		$this->jobs_string_to_int();

		$result = $CI->db->where("jv.job_id",$this->job)->from("jobs_item_video AS jv")->join("media_videos AS mv","mv.id = jv.video_id","left")->get()->result();
		return $result;
	}

	/**
		
		LOCATIONS LINKED TO A JOB

	**/

	public function job_locations( $job=null )
	{
		$CI  =& get_instance();
		$this->job = ($job != null) ? $job : $this->job;
		$this->jobs_string_to_int();

		$result = $CI->db->where("jl.job_id",$this->job)->from("jobs_item_location AS jl")->join("locations_items AS l","l.id = jl.location_id","left")->get()->result();
		return $result;
	}

	/**
		
		IF A STRING_URL IS GIVEN, CHANGE IT TO THE ID

	**/

	public function jobs_string_to_int()
	{
		$CI  =& get_instance();
		if($this->job && !is_numeric($this->job))
		{
			$result = $CI->db->select("id")->where("url_title",$this->product)->get("jobs_items")->result();
			$this->job = @$result[0]->id;
		}
	}

}