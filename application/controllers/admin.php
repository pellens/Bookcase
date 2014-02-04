<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin extends CI_Controller {

		public function __construct()
		{
			parent::__construct();

			if(!isset($_SESSION["user_id"]) && $this->uri->segment(3) != "login")
			{
				redirect("admin/login","refresh");
			}
		}

		public function login()
		{
	
			// If it is the first time we enter the admni-area,
			// we need to create a superadmin user
			if($this->db->count_all_results("users") == 0)
			{
				$this->register();
			}
			else
			{
		
				if(isset($_POST) && count($_POST) > 0)
				{
					$email = $this->input->post("email",true);
					$pass  = md5($this->input->post("password",true));
		
					$result = $this->db->where("email",$email)->where("password",$pass)->get("users");
					if($result->num_rows == 1)
					{
						$user = $result->result();
						$user = $user[0];
	
						$fields["last_login"] = time();
						$this->db->where("id",$user->id)->update("users",$fields);
		
						$_SESSION["user_id"] = $user->id;
						$_SESSION["role_id"] = $user->role_id;
	
						redirect("admin","refresh");
					}
				}
				else
				{
					$this->load->view("backend/Core/login");
				}
			}
	
	
		}
	
		public function logout($url=false)
		{
			session_unset();
			session_destroy();
	
			if($url)
			{
				redirect($url,"refresh");
			}
			else
			{
				redirect(base_url(),"refresh");
			}
	
		}
	
		public function register()
		{
			if(isset($_POST) && count($_POST) > 0)
			{
				$fields["password"] 	   = md5($this->input->post("password",true));
				$fields["email"]    	   = $this->input->post("email",true);
				$fields["username"] 	   = $this->input->post("username",true);
				$fields["account_created"] = time();
				$fields["role_id"]         = 1;
	
				$this->db->insert("users",$fields);
				redirect("admin/login","refresh");
			}
			else
			{
				$this->load->view("backend/Core/register");
			}
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
					$imageFileClean  = strtolower(preg_replace("/[ !#$%^&*()+=]/", "", $fileParts["filename"])); 
					$filename_no_ext = $time."_".$imageFileClean;
					$filename        = $filename_no_ext.".".strtolower($fileParts['extension']);

					// IMAGE RESIZEN
		
					if($ext == "JPG" || $ext == "JPEG" || $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "PNG")
					{

						$targetFile = rtrim($targetPath,'/') . '/images/' . $filename;
						move_uploaded_file($tempFile,$targetFile);

						require_once(FCPATH.APPPATH."/libraries/media/Image.php");
						
						// STANDAARD FORMATEN
						$formats["500_500"] = array("500","500");
						$formats["120_120"] = array("120","120");
						$image = new Image($targetFile);
						
						foreach($formats as $folder => $f):
							$image->resize($f[0],$f[1],'crop');
							$image->save($filename_no_ext,rtrim($targetPath,'/') . '/images/'.$folder);
						endforeach;

						$filearray = array(
							"src" 		=> "uploads/images/".$filename,
							"filetype" 	=> "image",
							"ext" 		=> $ext,
							"title" 	=> $filename
						);
					}
					else
					{
						$targetFile = rtrim($targetPath,'/') . '/files/' . $filename;
						move_uploaded_file($tempFile,$targetFile);

						$filearray = array(
							"src" 		=> "uploads/files/".$filename,
							"filetype" 	=> "file",
							"ext" 		=> $ext,
							"title" 	=> $filename
						);
					}

					$fields["file_type"]      = $ext;
					$fields["file_size"]	  = filesize($targetFile);
					$fields["date"] 		  = time();
					$fields["original_title"] = $imageFileClean.".".$ext;
					$fields["new_title"]      = $filearray["title"];
					$fields["path"]			  = $filearray["src"];
					
					echo json_encode($filearray);

					

					$this->db->insert("media_uploads",$fields);
					
				} else {
					echo 'Filetype';
				}
			}
		}

		public function crop()
		{

			if(isset($_POST) && count($_POST) > 0)
			{

				header("Cache-Control: no-cache, must-revalidate");

				$result    = $this->db->where("path",$_POST["image_name"])->get("media_uploads")->result();
				$new_title = $result[0]->new_title;
				$bom = explode(".",$new_title);
				$new_title = $bom[0];
				unset($result);

				require_once(FCPATH.APPPATH."/libraries/media/Image.php");

				$aantal = count($_POST["x"]);
				for($i=0;$i<=$aantal-1;$i++):

					$image   = new Image($_POST["image_name"]);

					$x = $_POST["x"][$i];
					$y = $_POST["y"][$i];
					$w = $_POST["w"][$i];
					$h = $_POST["h"][$i];

					$result = $this->db->where("id",$_POST["t"][$i])->get("media_image_styles")->result();
					$result = $result[0];
					$cw     = $result->width;
					$ch     = $result->height;

					$div = $cw/$w;

					$w = $w;
					$x = $x;

					$h = $h;
					$y = $y;

					$ratio = $cw/$ch;

					$image->resize($cw,$ch,"crop",array($x,$w),array($y,$h*$ratio));
					
					$image->save($new_title,"uploads/images/".$cw."_".$ch."/");

				endfor;

				echo "<link href='//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
				<style>
					.complete {
						width: 650px;
						height: 500px;
						float: left;
						text-align: center;
						font-size: 20px;
						background-color: #E7EBF1;
						line-height: 350px;
						color: #34495e;
						font-family:Helvetica;
					}
				
					.complete i {
						margin-right: 20px;
						color:#27ae60;
					}
				</style>
				<div class='complete'>
					<i class='fa fa-check'></i>
					Cropping complete!
				</div>

				<script>setTimeout('self.close();',2000);</script>";
			}
			else
			{
				$data["image_styles"] = $this->media->image_styles();
				$this->load->view("backend/snippets/crop",$data);
			}
		}

		public function lib($lib,$fn=false,$id=false)
		{

			$submitted = (isset($_POST) && count($_POST) > 0) ? true : false;

			(@include_once (APPPATH."/libraries/".strtolower($lib)."/config.php")) or die("This library is not installed or doesn't have a config-file...");
			$this->load->library($lib);
			$data["main"]  = $admin["fn"][$fn]["view"];
			$data["title"] = @$admin["fn"][$fn]["title"];

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

			$data["active_link"] = $admin["fn"][$fn]["active_link"];
			$this->load->view("backend/index",$data);

		}

	}