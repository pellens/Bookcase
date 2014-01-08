<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media {

	var $path   = "";
	var $target = "";
	
	public function __construct($params = array())
	{	
	
		$CI  =& get_instance();
		$CI->load->helper("url");
		
		// UPLOAD FOLDER AANMAKEN
		$upload_path = './uploads';

    	if ( ! file_exists($upload_path) )
    	{
    	    $create = mkdir($upload_path, 0777);
    	    $thumbs_folder = mkdir($upload_path . '/thumbs', 0777);
    	}
    	
    	/**

    		FILE DATABASE AANMAKEN

    	**/

    	if (!$CI->db->table_exists('media_uploads'))
		{
			$CI->load->dbforge();
			
			$fields = array(
				"id" 				=> array( "type" => "INT", 		'auto_increment' => TRUE ),
				"original_title" 	=> array( "type" => "varchar", 	"constraint" => "300" ),
				"new_title" 		=> array( "type" => "INT", 		"default" => 0 ),
				"date" 				=> array( "type" => "INT", 		"default" => 0 ),
				"file_type" 		=> array( "type" => "varchar", 	"constraint" => "300" ),
				"file_size" 		=> array( "type" => "varchar", 	"constraint" => "300" ),
				"alt" 				=> array( "type" => "varchar", 	"constraint" => "300" ),
				"title" 			=> array( "type" => "varchar", 	"constraint" => "300" ),
				"description" 		=> array( "type" => "text" ),
				"path" 				=> array( "type" => "varchar", 	"constraint" => "300" )
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('media_uploads',TRUE);	
		}

		/**

			VIDEO DATABASE AANMAKEN

		**/

    	if (!$CI->db->table_exists('media_videos'))
		{
			$CI->load->dbforge();
			
			$fields = array(
				"id" 			=> array( "type" => "INT", 'auto_increment' => TRUE ),
				"source" 		=> array( "type" => "varchar", "constraint" => "300" ),
				"video_id" 		=> array( "type" => "varchar", "constraint" => "50" ),
				"image_default" => array( "type" => "varchar", "constraint" => "500" ),
				"image_hq" 		=> array( "type" => "varchar", "constraint" => "500" ),
				"title" 		=> array( "type" => "varchar", "default" => "300" ),
				"date" 			=> array( "type" => "INT", "default" => 0 ),
				"description" 	=> array( "type" => "text" ),
				"url" 			=> array( "type" => "varchar", "constraint" => "300" )
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('media_videos',TRUE);	
		}
		
		// SLIDESHOWS
		if (!$CI->db->table_exists('media_slideshows'))
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
				"width" => array(
							"type" => "INT",
							"default" => 0
						),
				"height" => array(
							"type" => "INT",
							"default" => 0
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('media_slideshows',TRUE);	
		}
		
		// SLIDESHOWS
		if (!$CI->db->table_exists('media_albums'))
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
				"url_title" => array(
							"type" => "varchar",
							"constraint" => "300",
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('media_albums',TRUE);	
		}
	
	}
	
	public function upload_form( $target = "uploads" )
	{
		
		$CI  =& get_instance();
		$CI->load->helper("url");
		
		$rand = rand(0,10)*1000;
		
		return '<div id="queue"></div>
				<input id="file_upload" name="file_upload" type="file" multiple="true">
				<div class="media uploadify edit"></div>
		
				<script type="text/javascript">
					$(function() {
						$("#file_upload").uploadify({
							"formData"     : {
								"timestamp" : "'.time().'",
								"token"     : "'.md5("unique_salt" . time()).'"
							},
							"swf"      : "'.base_url().'js/core/uploadify.swf",
							// "uploader" : "'.base_url().'js/core/uploadify.php",
							"uploader" : "'.base_url(lang()."/admin/upload_file").'",
							"onUploadSuccess" : function(file, data, response)
							{
								if(data == "Filetype")
								{
									$(".ready").html("This type is not accepted...");
								}
								else
								{
									var fill = $(".edit.uploadify").html();
									
									var row = "<div class=\"item\">";
										row+= "<figure><img src=\"'.base_url().'uploads/"+data+"\"/></figure>";
										row+= "<p><label for=\"title\">Title</label><input type=\"text\" name=\"title[]\" id=\"title\"/></p>";
										row+= "<p><label for=\"alt\">Alternative</label><input type=\"text\" name=\"alt[]\" id=\"alt\"/></p>";
										row+= "<p><label>Description</label><textarea name=\"description[]\"></textarea></p>";
										row+= "<span class=\"crop\"><a href=\"'.base_url("admin/crop").'?image="+data+"\" onclick=\"return triggerPopup(\'"+data+"\');\" data-crop=\""+data+"\" class=\"crop\"><img src=\"'.base_url("images/crop.png").'\" class=\"icon\"/> Crop this image</a></span>";
										row+= "</div>";
            						
            						$(".edit.uploadify").html(row + fill);
            					}
        					}
						});
					});
				</script>';
	}

	public function make_image_square($image,$thumbWidth=300)
	{

		$CI  =& get_instance();
		$CI->load->library('image_lib');

		$s      = getimagesize($image);
		$info   = pathinfo($image);
		
		$width  = $s[0];
		$height = $s[1];
		
		if ($height > $width)
		{
		    $divisor = $width / $thumbWidth;
		}
		else
		{
		    $divisor = $height / $thumbWidth;
		}
		
		$resizedWidth   = ceil($width / $divisor);
		$resizedHeight  = ceil($height / $divisor);
		
		/* work out center point */
		$thumbx = floor(($resizedWidth  - $thumbWidth) / 2);
		$thumby = floor(($resizedHeight - $thumbWidth) / 2);

		$filename   = $info["filename"].".".$info["extension"];
		$new_image  = $_SERVER['DOCUMENT_ROOT'] ."/Bookcase/uploads/images/";
		$size 		= getimagesize($image);

		// X - Y AXE CROP
		
		//$config['image_library']  = 'GD2';
		//$config['source_image']	  = $image;
		//$config['new_image']      = $new_image;
		//$config['maintain_ratio'] = TRUE;
        ////$config['create_thumb']   = TRUE;
		////$config['width']	      = $resizedWidth;
		////$config['height']	      = $resizedHeight;
		//$config["x_axis"]         = $thumbx*100;
		//$config["y_axis"]         = $thumby*100;

		$configs[] = array('source_image' => $filename, 'new_image' => "x_".$filename, 'width' => 160, 'height' => 90);
        $configs[] = array('source_image' => $filename, 'new_image' => "x_".$filename, 'width' => 240, 'height' => 240);
        $configs[] = array('source_image' => $filename, 'new_image' => "x_".$filename, 'width' => 800, 'height' => 800);

		foreach ($configs as $config) {
            $CI->image_lib->thumb($config, FCPATH . 'uploads/images/');
        }

	}
	
	public function albums()
	{
		$CI  =& get_instance();
		
		return $CI->db->order_by("id")->get("media_albums")->result();
	}
	
	public function delete_uploaded_files_script()
	{
		return "<script>$(document).ready(function(){
			$('.actions .del').on('click',function()
			{
				var file = $(this).attr('data-file');
				delete_upload_row(file);
			});
			});
			
			function delete_upload_row(datafile)
			{
				$('.actions .del[data-file=\"'+datafile+'\"]').closest('.uploadrow').remove();
				return false;
			}
			</script>";
	}
	
	public function all_files()
	{
		$CI  =& get_instance();
		
		return $CI->db->get("media_uploads")->result();
	}

	public function add_video($item)
	{
		$CI  =& get_instance();

		// VIDEOS
		foreach($item["video_id"] as $key => $v):
			$videos[$key] = array(
				"video_id" 		=> $item["video_id"][$key],
				"image_default" => $item["video_image_default"][$key],
				"image_hq" 		=> $item["video_image_hq"][$key],
				"date" 			=> time(),
				"source" 		=> $item["video_source"][$key],
				"title" 		=> $item["video_title"][$key],
				"description" 	=> $item["video_desc"][$key]
			);
		endforeach;
		unset($item["video_id"]);
		unset($item["video_image_default"]);
		unset($item["video_image_hq"]);
		unset($item["video_source"]);
		unset($item["video_title"]);
		unset($item["video_desc"]);

		$array = array();
		foreach($videos as $video):
		
			switch($video["source"])
			{
				case "youtube" : $video["url"] = "http://www.youtube.com/watch?v=".$video["video_id"]; break;
			}

			$aantal = $CI->db->where("source",$video["source"])->where("video_id",$video["video_id"])->count_all_results("media_videos");

			if($aantal == 0)
			{
				$CI->db->insert("media_videos",$video);
				$array[] = $CI->db->insert_id();
			}
			else
			{
				$result = $CI->db->select("id")->where("source",$video["source"])->where("video_id",$video["video_id"])->get("media_videos")->result();
				$array[] = $result[0]->id;
			}

		endforeach;

		$item["videos"] = $array;

		return $item;
	}
	
	public function file_data($files,$view=false)
	{
		$CI  =& get_instance();
		
		$array = array();
		if($files):
		
		foreach($files as $file)
		{
			$result = $CI->db->where("new_title",$file)->get("media_uploads")->result();
			$array[] = $result[0];
		}
		
		if(!$view)
		{		
			return $array;
		}
		else
		{
		
			$row = "<div class='files'>";
			foreach($array as $value):
				$row.= "<div class='uploadrow'>";
				$row.= "<input type='hidden' value='".$value->new_title."' name='file[]'/>";
				$row.= "<div class='image'>";
				$row.= "<img src='".base_url("images/backend/filetypes/".$value->file_type.".png")."'/>";
				$row.= "</div>"; // filetype
				$row.= "<div class='content'><h4>".$value->new_title."</h4></div>";
				$row.= "<div class='actions'><a href='#' class='del' data-file='".$value->new_title."'>&times;</a></div>";
				$row.= "<div class='actions'><a href='".base_url("admin/mediahandler/crop")."?image=".$value->new_title."' onclick='return triggerPopup(\"".$value->new_title."\");' data-crop='".$value->new_title."' class='crop'><img src='".base_url("images/backend/icons/crop.png")."' class='icon'/></a></div>";
				$row.= "</div>";
			endforeach;
			$row.= "</div>";
			
			return $row;
		}
		
		endif;
	}
	
	public function media_size($img,$w=0,$h=0)
	{
	
	}
}