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
    	
    	// FILE DATABASE AANMAKEN
    	if (!$CI->db->table_exists('media_uploads'))
		{
			$CI->load->dbforge();
			
			$fields = array(
				"id" => array(
							"type"           => "INT",
                            'auto_increment' => TRUE
						),
				"original_title" => array(
							"type" => "varchar",
							"constraint" => "300",
						),
				"new_title" => array(
							"type" => "INT",
							"default" => 0
						),
				"date" => array(
							"type" => "INT",
							"default" => 0
						),
				"file_type" => array(
							"type" => "varchar",
							"constraint" => "300",
						),
				"file_size" => array(
							"type" => "varchar",
							"constraint" => "300",
						),
				"alt" => array(
							"type" => "varchar",
							"constraint" => "300",
						),
				"title" => array(
							"type" => "varchar",
							"constraint" => "300",
						),
				"description" => array(
							"type" => "text"
						),
				"path" => array(
							"type" => "varchar",
							"constraint" => "300"
						)
			);
		
			$CI->dbforge->add_field($fields);
			$CI->dbforge->add_key('id', TRUE);
			$CI->dbforge->create_table('media_uploads',TRUE);	
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
		
		return '<form>
					<div id="queue"></div>
					<input id="file_upload_'.$rand.'" name="file_upload" type="file" multiple="true">
					<form class="media uploadify" method="post">
						<div class="error"></div>
						<div class="media uploadify edit edit_'.$rand.'"></div>
					
				
		
				<script type="text/javascript">
					$(function() {
					
						$("#file_upload_'.$rand.'").uploadify({
							"formData"     : {
								"timestamp" : "'.time().'",
								"token"     : "'.md5("unique_salt" . time()).'",
								"target"    : "'.$target.'"
							},
							"preventCaching" : true,
							"buttonText" : "+ &nbsp; Bestanden toevoegen",
							"swf"      : "'.base_url().'js/core/uploadify.swf",
							"uploader" : "'.base_url("admin/mediahandler/upload").'",
							"onUploadSuccess" : function(file, data, response)
							{
								if(data == "forbidden")
								{
									$(".uploadify .error").html("This filetype is not allowed...");
								}
								else
								{
									
									var crop = false;
									var ext  = data.split(".");
									var ext  = ext[1];
									
									switch(ext)
									{
										case "jpg"  :
										case "jpeg" :
										case "JPG"  :
										case "png"  :
										case "gif"  : crop = true;
									}

									var row = "<div class=\"uploadrow "+data+"\">";
										row+= "<input type=\"hidden\" name=\"file[]\" value=\""+data+"\"/>";
										row+= "<div class=\"image\"><img src=\"'.base_url("images/backend/filetypes").'/"+ext+".png\"/></div>";
										row+= "<div class=\"content\"><h4>"+data+"</h4></div>";
										row+= "<div class=\"actions\"><a href=\"#\" class=\"del\" data-file=\""+data+"\" onclick=\"delete_upload_row(\'"+data+"\');\">&times;</a></div>";
										if(crop) row+= "<div class=\"actions\"><a href=\"'.base_url("admin/mediahandler/crop").'?image="+data+"\" onclick=\"return triggerPopup(\'"+data+"\');\" data-crop=\""+data+"\" class=\"crop\"><img src=\"'.base_url("images/backend/icons/crop.png").'\" class=\"icon\"/></a></div>";
										row+= "</div>";
            						
            						$(".edit.uploadify.edit_'.$rand.'").append(row);
            					}
        					}
						});
					});
				</script>
				<script>
				function triggerPopup(file)
		    		{
		    			window.open("'.base_url("admin/mediahandler/crop").'?image="+file, "_blank", "width=600,height=300,scrollbars=no,toolbar=no, status=no,location=no,resizable=yes,screenx=0,screeny=0"); return false;
		    		}</script>';
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