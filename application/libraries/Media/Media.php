<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media {

	var $path   = "";
	var $target = "";

	var $image        = "";
	var $small_image  = "";
	var $name         = "";
	var $type         = "";
	var $thumb        = "";
	var $square       = "";
	var $resized      = "";
	var $thumbPath    = 'uploads/images/';
	var $squarePath   = 'uploads/images/';
	var $resizedPath  = 'uploads/images/';
	var $targetFolder = 'uploads/images/';
	var $generalFolder = 'uploads/images/';
	var $width        = "";
	var $height       = "";
	var $thumbQuality = 90;
	var $thumbSize    = "150";
	var $squareSize   = "300";
	var $full         = "";
	var $rotation     = null;
	var $max_height   = '900';
	var $max_width    = '1200';
	var $fixedResize  = true;
	var $thumbed      = true;
	var $squared      = true;


	
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

		/**

			IMAGE STYLES AANMAKEN

		**/

    	if (!$CI->db->table_exists('media_image_styles'))
		{
			$CI->load->dbforge();
			
			$fields = array(
				"id" 	 => array( "type" => "INT", 'auto_increment' => TRUE ),
				"title"  => array( "type" => "varchar", "constraint" => "300" ),
				"width"  => array( "type" => "INT" ),
				"height" => array( "type" => "INT" )
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('media_image_styles',TRUE);	
		}
		

		// SLIDESHOWS
		if (!$CI->db->table_exists('media_slideshows'))
		{

			$CI->load->dbforge();
			
			$fields = array(
				"id" 	  => array( "type" => "INT", 'auto_increment' => TRUE ),
				"title"   => array( "type" => "varchar", "constraint" => "300" ),
				"width"   => array( "type" => "INT", "default" => 0 ),
				"height"  => array( "type" => "INT", "default" => 0 )
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
				"id" 		=> array( "type" => "INT", 'auto_increment' => TRUE ),
				"title" 	=> array( "type" => "varchar", "constraint" => "300" ),
				"url_title" => array( "type" => "varchar", "constraint" => "300" )
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('media_albums',TRUE);	
		}

		// SLIDESHOWS
		if (!$CI->db->table_exists('media_album_photos'))
		{

			$CI->load->dbforge();
			
			$fields = array(
				"id" 		=> array( "type" => "INT", 'auto_increment' => TRUE ),
				"album_id" 	=> array( "type" => "INT" ),
				"photo_id"  => array( "type" => "INT" )
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('media_album_photos',TRUE);	
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



	/**

	**/



	public function image_data($image)
	{
	
		$camera = "";
		$model  = "";

		$targetPath = FCPATH . $this->targetFolder;

		// Validate the file type
		$fileTypes = array('jpg','jpeg','gif','png','JPG'); // File extensions
		$fileParts = pathinfo($targetPath.$image);

		if (in_array($fileParts['extension'],$fileTypes)) {

			$this->image  = rtrim($targetPath,'/') . '/' . $image;
			$image_info = getimagesize($this->image);
				
			// Png's mogen niet ingelezen worden
			if($fileParts['extension'] != "png")
			{
				// METADATA VAN FOTO INLADEN
        		$exif   = exif_read_data($this->image,"IFD0");
				$camera = (@$exif["Make"] != null) ? $exif["Make"] : false;
				$model  = (@$exif["Model"] != null) ? $exif["Model"] : false;
					
				if($exif["DateTime"])
				{
					// DATUM OMZETTEN NAAR MKTIME
					$bom  = explode(" ",$exif["DateTime"]);
					$f    = explode(":",$bom[0]);
					$l    = explode(":",$bom[1]);
					$date = mktime($l[0],$l[1],$l[2],$f[1],$f[2],$f[0]);
				}
					
				$flip = false;
					
				switch(@$exif['Orientation'])
				{
					case 1 : $this->rotation = false; break;
					case 3 : $this->rotation = 180; break;
					case 6 : $this->rotation = -90; $flip = true; break;
					case 8 : $this->rotation = 90; $flip = true; break;
					default : $this->rotation = false; break;
				}
			}
				
			if(@$flip)
			{
				$this->width  = $image_info[1];
				$this->height = $image_info[0];	
			}		
			else
			{
				$this->width  = $image_info[0];
				$this->height = $image_info[1];
			}
			$this->type   = $image_info[2];

			
			$this->thumb   = "thumb_".$fileParts["filename"].".".$fileParts['extension'];
			$this->square  = "square_".$fileParts["filename"].".".$fileParts['extension'];
			$this->resized = "resized_".$fileParts["filename"].".".$fileParts['extension'];
				
			if($this->type == IMAGETYPE_JPEG)
  			{
  				$this->full = imagecreatefromjpeg($this->image);
  			}
  			elseif($this->type == IMAGETYPE_PNG)
  			{
  			    $this->full = imagecreatefrompng($this->image);
  			}
  			if($this->rotation != null) $this->full = imagerotate($this->full,$this->rotation,0);
  					
  				
				$date = (@$date) ? $date : time();

				$thumb   = $this->createSquare();				
				$resized = $this->resizeImage();
				$square  = $this->createBigSquare();
				
				$fields["file_name"]   = ($this->fixedResize) ? "photos/".$this->resized : $this->small_image;
				$fields["thumb"]       = ($this->thumbed) ? "thumbs/".$this->thumb : $this->small_image;
				$fields["square"]      = ($this->squared) ? "big_square/".$this->square : $this->small_image;
				$fields["user_id"]     = $_POST["user_id"];
				$fields["camera"]      = @$camera;
				$fields["model"]       = @$model;
				$fields["date"]        = $date;
				$fields["date_posted"] = time();
				$fields["journey"]     = $_POST["journey"];
				$fields["status"]      = 10;
				
				$this->db->insert("v2_act_photos",$fields);
				$id = $this->db->insert_id();
				
				$string = "<div class='row'>";
					$string.= "<div class='img'>";
						$string.= "<img src='".base_url().$thumb."'/>";
					$string.= "</div>";
				
					$string.= "<div class='info'>";

				$string.= "<p><label>Comment</label> <textarea name='description[]'></textarea></p>";
				$string.= "<p><label>Location</label> ".$this->travel_model->visited_places($_POST["user_id"],$fields["journey"],null,"select",false,true)."</p>";
				
				$string.= '
					<input type="hidden" name="data_ori[]" value="'.$date.'"/>
					<input type="hidden" name="id[]" value="'.$id.'"/>
					<input type="hidden" name="journey[]" value="'.$_POST["journey"].'"/>';
				
				$string.= "</div>";
				$string.= "</div>";
				
				unlink($this->image);

				
			} else {
				
				$string = 'Filetype';
			}

		
		echo $string;
		
	}
	
	function rotateImage()
	{
		$photo = $this->db->where("id",$this->input->post("id",true))->where("user_id",$this->input->post("user",true))->get("v2_act_photos")->result();
		
		if(count($photo) != 0)
		{

			$photo = $photo[0];
			
			$config['image_library'] = 'gd';
			$config['rotation_angle'] = '90';
			
			$this->load->library('image_lib');
			
			$config['source_image']	= "./uploads/".$photo->file_name;
			$this->image_lib->initialize($config);
			$this->image_lib->rotate();
			
			$config['source_image']	= "./uploads/".$photo->thumb;
			$this->image_lib->initialize($config);
			$this->image_lib->rotate();
			
			if($photo->square != "")
			{
				$config['source_image']	= "./uploads/".$photo->square;
				$this->image_lib->initialize($config);
				$this->image_lib->rotate();
			}

			echo $this->photo_model->big_url($photo->file_name);
		}
	}
	
	function resizeImage($image)
	{
		
		$this->image_data($image);

		$fullPath = 'uploads/';
		$max_height = '900';
		$max_width = '1200';
		
		if($this->width > $max_width || $this->height > $max_height)
		{
		
			// Liggende foto
			if($this->width > $this->height)
			{
				$divisor = $this->width / $max_width;
			}
			
			// Staande foto
			else
			{
				$divisor = $this->height / $max_height;
			}
  			
  			$resizedWidth   = ceil($this->width / $divisor);
			$resizedHeight  = ceil($this->height / $divisor);
  			$resized        = imagecreatetruecolor($resizedWidth, $resizedHeight);
  			
			imagecopyresized($resized, $this->full, 0, 0, 0, 0, $resizedWidth, $resizedHeight, $this->width, $this->height);
			
			if($this->type == IMAGETYPE_JPEG)
			{
			  imagejpeg($resized, $this->resizedPath.$this->resized, $this->thumbQuality);
			}
			elseif($this->type == IMAGETYPE_PNG)
			{
			  imagePNG($resized,$this->resizedPath.$this->resized, $this->thumbQuality);
			}
			
		}
		else
		{
			$this->fixedResize = false;
		}
		
		
		
	}
	
	function createSquare()
	{

  		$fullPath     = 'uploads/';
  		$thumbSize    = 150;
		
		if($this->width > $thumbSize || $this->height > $thumbSize)
		{
  			
  			/* work out the smaller version, setting the shortest side to the size of the thumb, constraining height/wight */
  			if ($this->height > $this->width)
  			{
  				$divisor = $this->width / $thumbSize;
  			}
  			else
  			{
  			    $divisor = $this->height / $thumbSize;
  			}
  			
			$resizedWidth   = ceil($this->width / $divisor);
			$resizedHeight  = ceil($this->height / $divisor);
			
			/* work out center point */
			$thumbx = floor(($resizedWidth  - $thumbSize) / 2);
			$thumby = floor(($resizedHeight - $thumbSize) / 2);
			
			/* create the small smaller version, then crop it centrally to create the thumbnail */
			$resized  = imagecreatetruecolor($resizedWidth, $resizedHeight);
			imagecopyresized($resized, $this->full, 0, 0, 0, 0, $resizedWidth, $resizedHeight, $this->width, $this->height);
			
			
			$thumb    = imagecreatetruecolor($thumbSize, $thumbSize);
			imagecopyresized($thumb, $resized, 0, 0, $thumbx, $thumby, $thumbSize, $thumbSize, $thumbSize, $thumbSize);
				
			
			if($this->type == IMAGETYPE_JPEG)
			{
			  imagejpeg($thumb, $this->thumbPath.$this->thumb, $this->thumbQuality);
			}
			elseif($this->type == IMAGETYPE_PNG)
			{
			  imagePNG($thumb,$this->thumbPath.$this->thumb, $this->thumbQuality);
			}
			
			return "$this->thumbPath$this->thumb";
		}
		
		else
		{
			$this->thumbed = false;
			return $this->generalFolder.$this->small_image;
			
		}
  
	}
	



	/**

	**/




	
	public function albums_overview()
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

	/**

		OVERVIEW OF THE IMAGE STYLES

	**/

	public function image_styles()
	{
		$CI  =& get_instance();
		return $CI->db->get("media_image_styles")->result();
	}

	/**

		ADD A NEW IMAGE STYLE

	**/

	public function add_style($fields)
	{
		$CI  =& get_instance();
		foreach($_POST as $key => $value):
			$style[$key] = $CI->input->post($key,true);
		endforeach;

		// CHECK IF SIZE ALREADY EXISTS
		$aantal = $CI->db->where("width",$style["width"])->where("height",$style["height"])->count_all_results("media_image_styles");

		// INSERT INTO DATABASE
		if($aantal == 0)
		{
			$CI->db->insert("media_image_styles",$style);
			
			// CREATE FOLDER
			$folder = $style["width"]."_".$style["height"];
			if (!file_exists(FCPATH.'uploads/images/'.$folder))
			{
		    	mkdir(FCPATH.'uploads/images/'.$folder, 0777, true);
			}

			unset($style);
		}

		return true;
	}

	/**

		DELETE AN IMAGE STYLE

	**/

	public function del_style($style)
	{
		$CI  =& get_instance();
		$CI->db->where("id",$style)->delete("media_image_styles");
		return true;
	}

	/**

		EDIT AN IMAGE STYLE

	**/

	public function edit_style($style)
	{
		$CI  =& get_instance();

		foreach($_POST as $key => $value)
		{
			$fields[$key] = $CI->input->post($key,true);
		}

		// CREATE FOLDER
		$folder = $fields["width"]."_".$fields["height"];
		if (!file_exists(FCPATH.'uploads/images/'.$folder))
		{
			mkdir(FCPATH.'uploads/images/'.$folder, 0777, true);
		}

		$CI->db->where("id",$fields["id"])->update("media_image_styles",$fields);
		return true;
	}

	/**

		GET A SPECIFIC IMAGE STYLE

	**/
	
	public function image_style($style)
	{
		$CI  =& get_instance();
		$result = $CI->db->where("id",$style)->get("media_image_styles")->result();
		return $result[0];
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