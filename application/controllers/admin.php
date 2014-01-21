<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library("products");
	}
	 
	public function index()
	{
		$data["active_link"] = "website";
		$data["pages"] 		 = $this->core->all_pages();
		$data["main"] 		 = "backend/Core/pages-overview";

		$this->load->view('backend/index',$data);
	}

	public function library($library,$page,$option=null)
	{
		require_once(APPPATH."/libraries/".ucwords($library)."/config.php");

		$data["nav"] = $nav;
		$this->load->view('backend/index',$data);
	}

	public function settings($param = false)
	{
		$data["active_link"] = "settings";
		$data["main"] = "backend/Core/settings";

		$this->load->view("backend/index",$data);
	}

	public function modules()
	{

		$data["active_link"] = "lib";
		$data["main"] = "backend/Core/libraries-overview";
		$data["modules"] = $this->core->libraries(true);

		$this->load->view("backend/index",$data);
	}

	public function page($fn,$id=false)
	{
		if(count($_POST)>0)
		{
			$this->core->edit_page();
		}
		else
		{
			$data["active_link"] = "website";
			$data["main"] 		 = "backend/Core/edit_page";
			$data["item"] 		 = $this->core->page($id);
			$this->load->view("backend/index",$data);
		}
	}

	public function upload_file()
	{

		// Define a destination

		$targetFolder     = "/Bookcase/uploads/"; // Relative to the root
		$thumbQuality     = 90;
		$verifyToken      = md5('unique_salt' . $_POST['timestamp']);

		if (!empty($_FILES) && $_POST['token'] == $verifyToken)
		{
		
			$tempFile   = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
		
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png','JPEG','JPG','mp4','pdf','zip','doc','xls','xlsx','docx');
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes))
			{
			
				$ext  = $fileParts['extension'];
				$time = time();
				
				// CLEAN THE FILE NAME
				$imageFileClean = strtolower(preg_replace("/[ !#$%^&*()+=]/", "", $fileParts["filename"]));  
				$filename       = $time."_".$imageFileClean.".".$fileParts['extension'];

				// IMAGE RESIZEN
	
				if($ext == "JPG" || $ext == "JPEG" || $ext == "jpg" || $ext == "jpeg")
				{

					$targetFile = rtrim($targetPath,'/') . '/images/' . $filename;
					move_uploaded_file($tempFile,$targetFile);

					//$this->media->make_image_square($targetFile,"100");
					//$this->media->make_image_square($targetFile,"300");
					//$this->media->make_image_square($targetFile,"600");
					//$this->media->resize_default_image($targetFile);

					echo "images/".$filename;
				}
				
				
			} else {
				echo 'Filetype';
			}
		}
	}

	public function crop()
	{
		$this->load->view("backend/snippets/crop");
	}

	public function lib($lib,$fn=false,$id=false)
	{

		$submitted = (isset($_POST) && count($_POST) > 0) ? true : false;
		
		(@include_once (APPPATH."/libraries/".ucwords($lib)."/config.php")) or die("This library is not installed or doesn't have a config-file...");
		$this->load->library($lib);
		$data["main"] = $admin["fn"][$fn]["view"];
		
		if($fn)
		{
			if($submitted):

				$this->$lib->$admin["fn"][$fn]["submit"]($_POST);
				redirect($admin["fn"][$fn]["redirect"],"refresh");

			else:

				if(isset($admin["fn"][$fn]["fn"]))
				{
					foreach($admin["fn"][$fn]["fn"] as $key => $function)
					{
						if($key == "delete" || $key == "update" || $key == "add")
						{
							$this->$lib->$function($id);
							redirect($admin["fn"][$fn]["redirect"],"refresh");
						}
						else
						{
							$data[$key] = $this->$lib->$function();
						}
						
					}
				}

				if($id)
				{
					if(isset($admin["fn"][$fn]["item"]))
					{
						$data["item"] = $this->$lib->$admin["fn"][$fn]["item"]($id);
					}
				}

			endif;
		}

		$data["active_link"] = "lib";
		$this->load->view("backend/index",$data);

	}

}